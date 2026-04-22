<?php 

namespace App\Services;

use App\Models\Pedido;
use App\Models\Relatorio;
use App\Models\User;
use Carbon\Carbon;

class ReportService{

    // Relatório de entregas por período e farmácia
    public function relatorioEntregas($farmaciaId, $dataInicio, $dataFim)
    {
        $dataInicio = Carbon::parse($dataInicio)->startOfDay();
        $dataFim    = Carbon::parse($dataFim)->endOfDay();
        return \App\Models\Entrega::whereHas('pedido', function($q) use ($farmaciaId) {
                $q->where('farmacia_id', $farmaciaId);
            })
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->get();
    }

    // Relatório de avaliações por período e farmácia
    public function relatorioAvaliacoes($farmaciaId, $dataInicio, $dataFim)
    {
        $dataInicio = Carbon::parse($dataInicio)->startOfDay();
        $dataFim    = Carbon::parse($dataFim)->endOfDay();
        return \App\Models\Avaliacao::where('farmacia_id', $farmaciaId)
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->get();
    }

    // Relatório de stock por farmácia (snapshot atual)
    public function relatorioStock($farmaciaId)
    {
        return \App\Models\StockItem::whereHas('medicamento', function($q) use ($farmaciaId) {
                $q->where('farmacia_id', $farmaciaId);
            })
            ->get();
    }


    public function gerarRelatorioPoPeriodo( $dataInicio, $dataFim, $tipoRelatorio) {
        $dataInicio = Carbon::parse($dataInicio)->startOfDay();
        $dataFim    = Carbon::parse($dataFim)->endOfDay();

        $pedidos = Pedido::whereHas('farmacias', function($q) use($dataInicio , $dataFim){
                        $q->whereBetween('farmacia_pedido.created_at', [$dataInicio, $dataFim]);
                        })->get();
        
        $totalVendas = $pedidos->where('status', 'Concluido')->count();
        $totalReceitas = $pedidos->where('status', 'Concluido')->sum('total'); 

        $relatorioGeral = Relatorio::create([
            'data_inicio'    => $dataInicio,
            'data_fim'       => $dataFim,
            'tipo_relatorio' => $tipoRelatorio,
            'total_vendas'   => $totalVendas,
            'total_receitas' => $totalReceitas
        ]);

        $relatorioGeral->pedidos = $pedidos; 

        return $relatorioGeral;
    }


}