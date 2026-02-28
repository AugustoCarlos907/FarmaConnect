<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EntregaService;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct(
        public PedidoService $pedidoService,
        public EntregaService $entregaService,
        // public FarmaciaService $farmaciaService
        // public UserService $userService
        
    ){}
}
