<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarPedidoRequest;
use App\Jobs\NotifyUserOrderCompletedJob;
use App\Jobs\ProcessPendingDelivery;
use App\Models\Carrinho;
use App\Models\Factura;
use App\Models\Pagamento;
use App\Models\Pedido;
use App\Services\EntregaService;
use App\Services\PedidoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function __construct(
        public PedidoService $service,
        public EntregaService $entregaService
        ){}

     public function store(Request $request)
    {

        try {

        return DB::transaction(function () use ($request) {

        if (empty($request->items)) {
                throw new \Exception('Carrinho vazio.');
        }

        $farmacia = $this->service->encontrarFarmaciaComTodosItens($request->items, $request->latitude, $request->longitude);

        if (!$farmacia) {
        return back()->withErrors(['farmacia' => 'Medicamentos em múltiplas farmácias ou indisponíveis...']);
        }

        $comprovativoPath = null;
        if ($request->hasFile('comprovativo_express') && $request->metodo_pagamento === 'express') {
                $file = $request->file('comprovativo_express');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('comprovativos', $filename, 'public');
                $comprovativoPath = $path; 
        }

        $prescricaoPath = null;
        if ($request->hasFile('prescricao_path')) {
                $file = $request->file('prescricao_path');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('prescricoes', $filename, 'public');
                $prescricaoPath = $path; 
        }

        $pedido = $this->service->criarPedido(
            auth()->id(),
            $request->items,
            $request->endereco,
            $request->latitude ?? 0.0,
            $request->longitude ?? 0.0,
            $request->metodo_pagamento,
            $prescricaoPath,
            $comprovativoPath,
            
        );

        if (!$pedido) {
                throw new \Exception('Falha ao criar o pedido.');
        }

            Carrinho::where('user_id', Auth()->id())->delete();
            

            // return redirect()->route('pedido.confirmacao', $pedido->id)->with('entrega', $entrega);
            return redirect()->route('carrinho.clientes')->with('success' , 'Pedido enviado com sucesso');

        });
    }
        catch (\Exception $e) {
        //captura do erro do service
        return back()->withErrors(['entregador' => $e->getMessage()])->withInput();
    }
    }




    public function pedidos()
    {
        $user = auth()->user();

        $pedidos = Pedido::with(['farmacia', 'items.stockItem.medicamento.categoria'])
                        ->where('user_id', $user->id)
                        ->latest('data_pedido')
                        ->paginate(10);

        $col = $pedidos->getCollection();


       
        $totalPedidos  = $pedidos->count();
        $emEntrega    = $col->where('status', 'Em Entrega')->count();
        $entregues    = $col->where('status', 'Concluído')->count();  
        $totalGasto   = $col->whereIn('status', ['Concluído'])->sum('total');

        // $emEntrega     = $pedidos->where('status', 'Em Entrega')->count();
        // $entregues     = $pedidos->where('status', 'Concluído')->count();
        // $totalGasto    = $pedidos->whereIn('status', ['entregue'])->sum('total');

        return view('clientes.pedidos.index', compact(
            'pedidos', 'totalPedidos', 'emEntrega', 'entregues', 'totalGasto'
        ));
    }



    public function updateStatus($id, Request $request)
    {
        try {
            $request->validate([
                'status' => 'required|string|in:Aprovado,pago,Cancelado,Rejeitado'
            ]);

            $pedido = Pedido::findOrFail($id);

            DB::transaction(function () use ($pedido, $request) {
                
                $pedido->update([
                    'status' => $request->status
                ]);

                if ($pedido->status == 'pago') {
                        Pagamento::create([
                            'pedido_id'      => $pedido->id,
                            'status' => 'confirmado',
                            'metodo'     => $pedido->metodo_pagamento ,
                            'valor'    => $pedido->total,
                            'data_pagamento'=> now()
                        ]);
                }

                if ($pedido->status == 'pago' &&  !$pedido->factura()->exists() ) {
                        Factura::create([
                            'user_id'        => $pedido->user_id,
                            'pedido_id'      => $pedido->id,
                            'pagamento_id'   => $pedido->pagamento->id ?? 'UNKNOWN',
                            'numero_factura' => 'FAC-' . now()->format('Ymd') . '-' . strtoupper(uniqid()),
                            'valor_total'    => $pedido->total,
                            'IVA'            => $pedido->total * 0.14,
                            'emitida_em'     => now()
                        ]);
                }

                if (in_array($pedido->status, ['pago', 'Aprovado']) && $pedido->entrega && $pedido->entrega->taxa_entrega > 0 ) {
                        try {
                            $entrega = $this->entregaService->criarEntrega($pedido);
                            $pedido->update(['status' => 'Em Entrega']);

                            $pedido->load(['user', 'items.stockItem.medicamento']);

                            NotifyUserOrderCompletedJob::dispatch($pedido, $entrega);

                        } catch (\Exception $e) {
                            // Se não houver entregador, agendamos para tentar mais tarde
                            ProcessPendingDelivery::dispatch($pedido);
                        }
                }
            });
                return redirect()->back()->with('success', 'Status do pedido atualizado para ' . $request->status);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
    public function cancelar($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'status' => 'Cancelado'
        ]);

        return back()->with('success' , 'Pedido Cancelado');
    }

    // public function confirmacao($id){
    // $pedido = Pedido::with(['farmacia', 'items.stockItem.medicamento', 'entrega'])
    //     ->findOrFail($id);

    // // Garante que o pedido pertence ao utilizador autenticado
    // if ($pedido->user_id !== auth()->id()) {
    //     abort(403);
    // }

    // $entrega = $pedido->entrega; // relação hasOne

    // return view('clientes.dashboard.pedido_confirmacao', compact('pedido', 'entrega'));
    // }
    
}
