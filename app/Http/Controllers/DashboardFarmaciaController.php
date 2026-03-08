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


    public function dashboard()
    {
        $user = auth()->user();
        $avaliacoes = $this->avaliacaoService->allAvaliacoesByFarmacia($user->farmacia_id);
        $totalAvaliacoes = $avaliacoes->count();
        $mediaAvaliacoes = $totalAvaliacoes > 0 ? $avaliacoes->sum('classificacao') / $totalAvaliacoes : 0;
        $data = [
            'pedidos_hoje' => $this->pedidoService->getPedidosDeHojeByPharmacy(10),
            'ultimos_pedidos' => $this->pedidoService->getLastPedidosByPharmacy(),
            // 'pedidos_por_status' => $this->pedidoService->getPedidosPorStatus(),
            'ultimas_avaliacoes' => $this->avaliacaoService->latestAvaliacoes(3),
            'todas_avaliacoes' => $this->avaliacaoService->allAvaliacoesByFarmacia($user->farmacia_id),
            'media_avaliacoes' => $mediaAvaliacoes,
            // 'entregas' => $this->entregaService->getEntregasRecentes(),
            // 'relatorios' => $this->reportService->getRelatoriosRecentes(),
            // 'stock_alerts' => $this->stockService->getStockAlerts(),
        ];

        return view('farmacias.dashboard.index', compact('data'));
    }
}
