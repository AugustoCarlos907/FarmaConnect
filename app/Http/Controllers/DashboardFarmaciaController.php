<?php

namespace App\Http\Controllers;

use App\Services\AvaliacaoService;
use App\Services\EntregaService;
use App\Services\PedidoService;
use App\Services\ReportService;
use App\Services\StockService;
use Illuminate\Http\Request;

class DashboardFarmaciaController extends Controller
{
    public function __construct(
        public PedidoService $pedidoService,
        public AvaliacaoService $avaliacaoService,
        public EntregaService $entregaService,
        public ReportService  $reportService,
        public StockService $stockService

    ){}


}
