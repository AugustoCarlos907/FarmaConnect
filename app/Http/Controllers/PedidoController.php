<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarPedidoRequest;
use App\Models\Pedido;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct(public PedidoService $service){}

     public function store(CriarPedidoRequest $request)
    {
        $pedido = $this->service->criarPedido(
            auth()->id(),
            $request->items,
            $request->endereco_entrega,
            $request->latitude,
            $request->longitude,
            $request->metodo_pagamento
        );

        return response()->json($pedido, 201);
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

    
}
