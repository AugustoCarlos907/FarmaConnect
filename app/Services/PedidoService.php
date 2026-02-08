<?php 

namespace App\Services;

use App\Models\Pedido;
use App\Models\FarmaciaMedicamento;
use App\Models\StockItem;
use Illuminate\Support\Facades\DB;
use Exception;

class PedidoService
{
    public function criarPedido(int $usuarioId,int $farmaciaId,array $items,\DateTime $dataPedido = null) {

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
                $stock = StockItem::findOrFail($item['stock_id']);

                if (! $stock->temStock($item['quantidade'])) {
                    throw new Exception(
                        "Stock insuficiente para {$stock->medicamento->nome}"
                    );
                }

                $subtotal = $stock->preco * $item['quantidade'];

                $pedido->items()->create([
                    'farmacia_medicamento_id' => $stock->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $stock->preco,
                    'subtotal' => $subtotal,
                ]);

                $stock->baixarStock($item['quantidade']);

                $total += $subtotal;
            }

            $pedido->update(['total' => $total]);

            return $pedido;
        });
    }
}