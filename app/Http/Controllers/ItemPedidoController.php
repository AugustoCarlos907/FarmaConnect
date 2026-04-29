<?php

namespace App\Http\Controllers;

use App\Jobs\NotifyUserOrderCompletedJob;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Services\EntregaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPedidoController extends Controller
{
    public function __construct(public EntregaService $entregaService)
    {}
    public function updateStatus($itemId, Request $request)
    {
            $request->validate([
                'status' => 'required|string|in:aprovado,rejeitado'
            ]);

            $item = ItemPedido::with('stockItem')->findOrFail($itemId);

            $farmaciaId = Auth::user()->farmacia_id; 
            if ($item->stockItem->farmacia_id != $farmaciaId) {
                abort(403, 'Este item não pertence à sua farmácia.');
            }

            
            if ($item->status_item !== 'Pendente') {
                return back()->withErrors('Este item já foi processado.');
            }

            DB::transaction(function () use ($item, $request) {

                $item->update(['status_item' => $request->status]);

                
                $this->atualizarStatusGlobal($item->pedido_id);

                $pedido = Pedido::find($item->pedido_id);
                
                if ($pedido->status === 'Aprovado' && !$pedido->entrega) {
                        // Cria a entrega apenas uma vez, quando o pedido fica aprovado
                        $entrega = $this->entregaService->criarEntrega($pedido);

                         $pedido->update([
                                'status' => 'Em Entrega',
                                'codigo_confirmacao' => $entrega->codigo_confirmacao
                            ]);


                        $pedido->load(['user', 'items.stockItem.medicamento']);

                        NotifyUserOrderCompletedJob::dispatch($pedido, $entrega);

                    }
            });

            //  $item->refresh();
            // return response()->json([
            //     'success' => true,
            //     'status'  => $item->status_item,
            //     'item_id' => $item->id
            // ]);
            return back()->with('success', 'Item ' . $request->status . ' com sucesso.');
    }

    private function atualizarStatusGlobal($pedidoId)
    {
        $pedido = Pedido::with('items')->find($pedidoId);
        $items = $pedido->items;

        $todosAprovados = $items->every(fn($i) => $i->status_item === 'aprovado');
        $algumRejeitado = $items->contains(fn($i) => $i->status_item === 'rejeitado');
        $algumPendente = $items->contains(fn($i) => $i->status_item === 'Pendente');

        if ($todosAprovados) {
            $novoStatus = 'Aprovado';
        } elseif ($algumRejeitado && !$algumPendente) {
            $novoStatus = 'Rejeitado';
        } elseif ($algumRejeitado && $algumPendente) {
            $novoStatus = 'Pendente';
        } elseif (!$algumRejeitado && $algumPendente) {
            $novoStatus = 'Pendente'; 
        } else {
            $novoStatus = 'Pendente';
        }

        $pedido->update(['status' => $novoStatus]);
    }

    // private function verificarEAcionarEntregaPorFarmacia($pedidoId, $farmaciaId)
    // {
    //     $pedido = Pedido::with('items.stockItem')->find($pedidoId);
    //     $itensDaFarmacia = $pedido->items->filter(fn($i) => $i->stockItem->farmacia_id == $farmaciaId);
    //     $todosAprovados = $itensDaFarmacia->every(fn($i) => $i->status_item === 'aprovado');

    //     if ($todosAprovados) {
    //         // Chama serviço de entrega para esta farmácia
    //         app(\App\Services\EntregaService::class)->criarEntrega($pedido);
    //     }
    // }
}
