<?php 

namespace App\Services;

use App\Events\EntregasEvent;
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
        int $farmaciaId,
        array $items,
        \DateTime $dataPedido = null) {

        return DB::transaction(function () use (
            $usuarioId,
            $farmaciaId,
            $items,
        ) {
            
        $pedido = Pedido::create([
                'usuario_id' => $usuarioId,
                'farmacia_id' => $farmaciaId,
                'status' => 'pendente',
                'total' => 0,
                'data_pedido' => $dataPedido ?? now()]);

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

                Event(new EntregasEvent());

                $stock->baixarStock($item['quantidade']);

                $total += $subtotal;
            }

            $pedido->update(['total' => $total]);

            return $pedido;
        });
    }

    public function getAllPedidosByPharmacy( $perPage )
    {
        return $this->repository->getAllPedidosByPharmacy($perPage);
    }
}