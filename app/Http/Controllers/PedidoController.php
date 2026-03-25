<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarPedidoRequest;
use App\Models\Carrinho;
use App\Models\Pedido;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct(public PedidoService $service){}

     public function store(Request $request)
    {
        $pedido = $this->service->criarPedido(
            auth()->id(),
            $request->items,
            $request->endereco,
            $request->latitude,
            $request->longitude,
            $request->metodo_pagamento
        );

        if($pedido){
            Carrinho::where('user_id', auth()->id())->delete();
        }

        return redirect()->route('carrinho.clientes')->with('success', 'Pedido confirmado com sucesso!');
    }




    public function pedidos()
    {
        $user = auth()->user();

        $pedidos = Pedido::with(['farmacia', 'items.stockItem.medicamento'])
                        ->where('user_id', $user->id)
                        ->latest('data_pedido')
                        ->get();

       
        $totalPedidos  = $pedidos->count();
        $emEntrega     = $pedidos->where('status', 'em_entrega')->count();
        $entregues     = $pedidos->where('status', 'entregue')->count();
        $totalGasto    = $pedidos->whereIn('status', ['entregue'])->sum('total');

        return view('clientes.pedidos.index', compact(
            'pedidos', 'totalPedidos', 'emEntrega', 'entregues', 'totalGasto'
        ));
    }

    public function updateStatus($id , Request $request){

        $request->validate([
            'status' => 'required|string'
        ]);

        $pedido = Pedido::findOrFail($id);

        $statusPermitidos = ['Aprovado', 'Pago', 'Cancelado', 'Rejeitado'];

        if (in_array($request->status, $statusPermitidos)) {
        $pedido->update([
            'status' => $request->status
        ]);
    }

        return redirect()->route('pedidos.farmacias');
        
    }
    
}
