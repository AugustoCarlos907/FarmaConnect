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
            $request->farmacia_id,
            $request->items
            
            // $request->endereco_entrega
        );

        // return response()->json($pedido, 201);
    }

    public function index($perPage = 10)
    {
        $this->service->getAllPedidosByPharmacy($perPage);

        // return response()->json($pedidos);
    }
}
