<?php

namespace App\Http\Controllers;

use App\Services\AvaliacaoService;
use App\Services\EntregaService;
use App\Services\MedicamentoService;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class ClientHomePageController extends Controller
{
    public function __construct(
        public MedicamentoService $medicamentoService,
        public PedidoService $pedidoService,
        public EntregaService $entregaService,
        public AvaliacaoService $avaliacaoService
    ){}





    public function perfil()
    {
        $user = auth()->user();

        return view('clientes.perfil.index', ['user' => $user]);
    }

    public function pedidos()
    {
        $user = auth()->user();
        // $pedidos = $this->pedidoService->getPedidosByUser($user->id);

        return view('clientes.pedidos.index');
}

}