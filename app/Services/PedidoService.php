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
            throw new Exception('Nenhuma farmácia encontrada para os medicamentos selecionados.');
        }
         

        $pedido = Pedido::create([
                'usuario_id' => $usuarioId,
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
                    'stock_item_id' => $stock->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $stock->preco,
                    'subtotal' => $subtotal,
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

            $pagamento = $pedido->pagamento()->create([
                'metodo' => $metodoPagamento,
                'valor' => $total,
                'status' => 'pendente',
                'iban_destino' => $ibanDestino,
                'numero_express' => $numeroExpress,
            ]);

            return $pedido;
        });
    }

    public function getAllPedidosByPharmacy( $perPage )
    {
        return $this->repository->getAllPedidosByPharmacy($perPage);
    }

    private function encontrarFarmaciaComTodosItens(array $items, float $lat, float $lng)
{
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