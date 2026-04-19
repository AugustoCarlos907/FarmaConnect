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
        string $metodoPagamento,
        string $prescricaoPath = null ,
        string $comprovativoExpress = null,
        $distanciaKm = null,    // novo
        $taxaEntrega = null     // novo
    ) {

       
        $metodosPermitidos = ['express', 'numerario']; 
        if (!in_array($metodoPagamento, $metodosPermitidos)) {
            throw new \Exception("Método de pagamento inválido. Use: express ou numerario.");
        }

        // $farmacia = $this->encontrarFarmaciaComTodosItens($items, $latitude, $longitude);

        // if (!$farmacia) {
        //     return back()->withErrors([
        //         'farmacia' => 'Os medicamentos selecionados estão dispostos em múltiplas farmácias , não é possivel confirmar o pedido...'
        //     ]);        
        // }


            $farmaciasIds = [];
            foreach ($items as $item) {
                $stock = StockItem::findOrFail($item['stockId']);
                $farmaciasIds[] = $stock->farmacia_id;
            }
            $farmaciasIds = array_unique($farmaciasIds);


        if ($metodoPagamento === 'express') {
                    $farmaciasSemExpress = Farmacia::whereIn('id', $farmaciasIds)
                        ->where(function ($query) {
                            $query->whereNull('numero_express')
                                ->orWhere('numero_express', '');
                        })->exists();

                if ($farmaciasSemExpress) {
                        throw new \Exception("Uma ou mais farmácias não possuem número Multicaixa Express configurado. Não é possível usar este método de pagamento.");
                    }
        }

        
        // if ($metodoPagamento === 'express' && empty($item->stock->farmacia->numero_express)) {
        //     throw new \Exception(" Seleccione uma fármacia para ter  accesso às coordenadas bancárias disponíveis .");
        // }

        return DB::transaction(function () use (
            $usuarioId,
            $items,
            $endereco,
            $latitude,
            $longitude,
            $metodoPagamento ,
            $prescricaoPath,
            $comprovativoExpress,
            $farmaciasIds,
            $distanciaKm,
            $taxaEntrega
        ) {
            
        $dataPedido = null;

        $pedido = Pedido::create([
                'user_id' => $usuarioId,
                // 'farmacia_id' => $farmacia->id,
                'status' => 'pendente',
                'total' => 0,
                'data_pedido' =>  now(),
                'endereco'=> $endereco,
                'latitude' =>  $latitude,
                'longitude' => $longitude ,
                'metodo_pagamento' => $metodoPagamento ,
                'comprovativo_express' => ($metodoPagamento === 'express') ? $comprovativoExpress : null,
                'prescricao_path' => $prescricaoPath,
                'distancia_km' => $distanciaKm,      
                'taxa_entrega' => $taxaEntrega,      

                ]);

            // Associar as farmácias ao pedido na tabela pivot (status inicial = 'pendente')
            $pivotData = [];
            foreach ($farmaciasIds as $fid) {
                $pivotData[$fid] = ['status' => 'pendente'];
            }
            $pedido->farmacias()->attach($pivotData);


            $total = 0;

            foreach ($items as $item) {
                $stock = StockItem::findOrFail($item['stockId']);

                if (!$stock->temStock($item['quantidade'])) {
                    throw new Exception(
                        "Stock insuficiente para {$stock->medicamento->name}"
                    );
                }

                $subtotal = $stock->medicamento->preco * $item['quantidade'];

                $pedido->items()->create([
                    'stock_items_id' => $stock->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $stock->preco,
                    'subtotal' => $subtotal,
                    'pedido_id' => $pedido->id,
                    'farmacia_id' => $stock->farmacia_id
                    // 'prescricao_path' => $prescricaoPath ?? null 
                    // 'medicamento_id' => $farmacia->medicamentos->id
                ]); 


                // $pedido->update(['status' => 'Aprovado']);

                
                $stock->baixarStock($item['quantidade']);
                
                $total += $subtotal;

                // Event(new EntregasEvent($pedido));
                
            }

            $pedido->update(['total' => $total]);


            return $pedido;
        });
    }

    public function getAllPedidosByPharmacy( $perPage ){
        return $this->repository->getAllPedidosByPharmacy($perPage);
    }

    public function getPedidosDeHojeByPharmacy($perPage){
        return $this->repository->getPedidosDeHojeByPharmacy($perPage);
    }

    public function getLastPedidosByPharmacy()
    {
        $farmaciaId = auth()->user()->farmacia_id;
        
        return Pedido::whereHas('farmacias', function ($query) use ($farmaciaId) {
                $query->where('farmacias.id', $farmaciaId);
            })
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
        
        // Buscar pedidos agrupados por data, filtrando pela farmácia via pivot
        $pedidos = Pedido::whereHas('farmacias', function ($query) use ($farmaciaId) {
                $query->where('farmacias.id', $farmaciaId);
            })
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

    // Observação: Se um mesmo pedido estiver associado a múltiplas farmácias, 
    // ele será contado para cada uma delas separadamente (cada farmácia vê o pedido como seu). Isso é o comportamento desejado.
        
    public function getOrigemPedidosByPharmacy($farmaciaId)
    {
        return Pedido::whereHas('farmacias', function ($query) use ($farmaciaId) {
                $query->where('farmacias.id', $farmaciaId);
            })
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