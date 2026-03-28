<?php 

namespace App\Services;

use App\Events\EntregasEvent;
use App\Models\Farmacia;
use App\Models\Pedido;
use App\Models\FarmaciaMedicamento;
use App\Models\StockItem;
use App\Repositories\Interfaces\PedidoInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class PedidoService
{
    public function __construct(public PedidoInterface $repository){}

    public function criarPedido(
        int $usuarioId,
        array $items,
        string $endereco,
        float $latitude,
        float $longitude,
        string $metodoPagamento
    ) {

        return DB::transaction(function () use (
            $usuarioId,
            $items,
            $endereco,
            $latitude,
            $longitude,
            $metodoPagamento ,
        ) {
            
        $dataPedido = null;

        $farmacia = $this->encontrarFarmaciaComTodosItens($items, $latitude, $longitude);

        if (!$farmacia) {
            return back()->withErrors([
                'farmacia' => 'Os medicamentos selecionados estão dispostos em múltiplas farmácias , não é possivel confirmar o pedido...'
            ]);        
        }
         

        $pedido = Pedido::create([
                'user_id' => $usuarioId,
                'farmacia_id' => $farmacia->id,
                'status' => 'pendente',
                'total' => 0,
                'data_pedido' => $dataPedido ?? now(),
                'endereco'=> $endereco,
                'latitude' =>  $latitude,
                'longitude' => $longitude 
                ]);

            $total = 0;

            foreach ($items as $item) {
                $stock = StockItem::findOrFail($item['stockId']);

                if (! $stock->temStock($item['quantidade'])) {
                    throw new Exception(
                        "Stock insuficiente para {$stock->medicamento->name}"
                    );
                }

                $subtotal = $stock->preco * $item['quantidade'];

                $pedido->items()->create([
                    'stock_items_id' => $stock->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $stock->preco,
                    'subtotal' => $subtotal,
                    'pedido_id' => $pedido->id
                    // 'medicamento_id' => $farmacia->medicamentos->id
                ]); 

                // $pedido->update(['status' => 'Aprovado']);

                
                $stock->baixarStock($item['quantidade']);
                
                $total += $subtotal;

                // Event(new EntregasEvent($pedido));
                
            }

            $pedido->update(['total' => $total]);

            // Validação simples para garantir que o método é permitido
            $metodosPermitidos = ['iban', 'express', 'dinheiro'];
            if (!in_array($metodoPagamento, $metodosPermitidos)) {
                throw new Exception('Método de pagamento inválido. Use: iban, express ou dinheiro.');
            }

            // // Buscar dados da farmácia
            // $farmacia = \App\Models\Farmacia::findOrFail($farmacia->id);

            $ibanDestino = null;
            $numeroExpress = null;

            if ($metodoPagamento === 'iban') {
                $ibanDestino = $farmacia->iban;
                if (empty($ibanDestino)) {
                    throw new Exception('A farmácia não possui IBAN cadastrado.');
                }
            }
            if ($metodoPagamento === 'express') {
                $numeroExpress = $farmacia->numero_express;
                if (empty($numeroExpress)) {
                    throw new Exception('A farmácia não possui Número Express cadastrado.');
                }
            }

            $pedido->pagamento()->create([
                'metodo' => $metodoPagamento,
                'valor' => $total,
                'status' => 'pendente',
                'iban_destino' => $ibanDestino,
                'numero_express' => $numeroExpress,
                'pedido_id' => $pedido->id
            ]);

            return $pedido;
        });
    }

    public function getAllPedidosByPharmacy( $perPage ){
        return $this->repository->getAllPedidosByPharmacy($perPage);
    }

    public function getPedidosDeHojeByPharmacy($perPage){
        return $this->repository->getPedidosDeHojeByPharmacy($perPage);
    }

    public function getLastPedidosByPharmacy(){
        return Pedido::where('farmacia_id', auth()->user()->farmacia_id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
    }

    public function getPedidosPast7days()
    {
        $farmaciaId = auth()->user()->farmacia_id;
        
        // Gerar os últimos 7 dias com seus respectivos nomes
        $diasSemana = [];
        $datas = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $data = now()->subDays($i);
            $datas[] = $data->format('Y-m-d');
            $diasSemana[] = $data->format('D'); // Seg, Ter, Qua, etc.
        }
        
        // Buscar pedidos agrupados por data
        $pedidos = Pedido::where('farmacia_id', $farmaciaId)
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as data, COUNT(*) as total')
            ->groupBy('data')
            ->pluck('total', 'data');
        
        // Mapear valores
        $valores = [];
        foreach ($datas as $data) {
            $valores[] = $pedidos[$data] ?? 0;
        }
        
        return [
            'labels' => $diasSemana,
            'values' => $valores
        ];
    }

        public function getOrigemPedidosByPharmacy($farmaciaId)
        {
            return Pedido::where('farmacia_id', $farmaciaId)
                ->whereNotNull('endereco')
                ->selectRaw('endereco, COUNT(*) as total')
                ->groupBy('endereco')
                ->having('total', '>', 0)
                ->orderBy('total', 'desc')
                ->get()
                ->mapWithKeys(function ($item) {
                    // Limitar tamanho do texto para exibição no gráfico
                    $endereco = strlen($item->endereco) > 30 
                        ? substr($item->endereco, 0, 27) . '...' 
                        : $item->endereco;
                    return [$endereco => $item->total];
                })
                ->toArray();
        }

    // public function getOrigemPedidosByPharmacy($farmaciaId)
    // {
    //     try {
    //         // Query mais simples
    //         $pedidos = Pedido::where('farmacia_id', $farmaciaId)
    //             ->whereNotNull('endereco')
    //             ->get(['endereco']);
            
    //         if ($pedidos->isEmpty()) {
    //             return [];
    //         }
            
    //         $result = [];
    //         foreach ($pedidos as $pedido) {
    //             $endereco = $pedido->endereco;
    //             if (!isset($result[$endereco])) {
    //                 $result[$endereco] = 0;
    //             }
    //             $result[$endereco]++;
    //         }
            
    //         // Ordenar
    //         arsort($result);
            
    //         // Limitar e formatar
    //         $final = [];
    //         $count = 0;
    //         foreach ($result as $endereco => $total) {
    //             if ($count >= 8) break;
    //             $enderecoFormatado = strlen($endereco) > 30 
    //                 ? substr($endereco, 0, 27) . '...' 
    //                 : $endereco;
    //             $final[$enderecoFormatado] = $total;
    //             $count++;
    //         }
            
    //         return $final;
            
    //     } catch (\Exception $e) {
    //         \Log::error('Erro em getOrigemPedidosByPharmacy: ' . $e->getMessage());
    //         return [];
    //     }
    // }





    public function encontrarFarmaciaComTodosItens(array $items, float $lat, float $lng){
    $stockIds = collect($items)->pluck('stockId');

    $farmacias = StockItem::whereIn('id', $stockIds)
        ->get()
        ->groupBy('farmacia_id');

    foreach ($farmacias as $farmaciaId => $stocks) {
        if ($stocks->count() == count($items)) {

            $farmacia = Farmacia::selectRaw("
                *,
                (6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distancia
            ", [$lat, $lng, $lat])
            ->where('id', $farmaciaId)
            ->orderBy('distancia')
            ->first();

            return $farmacia;
        }
    }

    return null;
}
}