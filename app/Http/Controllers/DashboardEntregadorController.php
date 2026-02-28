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
}
