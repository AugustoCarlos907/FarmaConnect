<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarPedidoRequest;
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

    public function index($perPage = 10)
    {
        $pedidos = $this->service->getAllPedidosByPharmacy($perPage);
        $countPedidos = $pedidos->count();

        return response()->json([
            'pedidos' => $pedidos,
            'count' => $countPedidos
        ]);
    }
}
