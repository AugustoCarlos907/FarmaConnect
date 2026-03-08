<?php

namespace App\Http\Controllers;

use App\Services\EntregaService;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class DashboardEntregadorController extends Controller
{
    public function __construct(
        public EntregaService $entregadorService,
        public PedidoService $pedidoService
    
    ){}

    public function dashboard()
    {
        $user = auth()->user();

        // if($user->role !== 'entregador') {
        //     abort(403);
        // }

        $ganhosHoje = $this->entregadorService->getEntregasDeHojeByEntregador($user->id, 10)->sum('taxa_entrega');
        $data = [
            'entregas_hoje' => $this->entregadorService->getEntregasDeHojeByEntregador($user->id  , 10 ),
            'ultimas_entregas' => $this->entregadorService->getLastEntregasByEntregador($user->id , 3),
            'total_entregas' => $this->entregadorService->getAllEntregasByEntregador(10)->count(),
            'ganhos_hoje' => $ganhosHoje,
            // 'pedidos_pendentes' => $this->pedidoService->getPedidosPendentesByEntregador($user->id),
        ];

        return view('entregadores.dashboard.index', compact('data'));
    }
}
