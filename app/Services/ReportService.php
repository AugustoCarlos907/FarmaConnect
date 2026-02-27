<?php 

namespace App\Services;

use App\Models\Pedido;
use App\Models\Relatorio;
use Carbon\Carbon;

class ReportService{


    public function gerarRelatorioPoPeriodo($farmaciaId,$dataInicio,$dataFim,$tipoRelatorio ){
        $dataInicio = Carbon::parse($dataInicio)->startOfDay();
        $dataFim    = Carbon::parse($dataFim)->endOfDay();

        $pedidos = Pedido::where(function ($query) use ($farmaciaId){
            $query->where( 'farmacia_id', $farmaciaId)
                  ->orWehere('status' , 'Concluido');
                  })->whereBetween('created_at', [$dataInicio, $dataFim])
                  ->get();
            
                    
        $totalVendas = $pedidos->count();
        $totalReceitas = $pedidos->sum('total');


        return Relatorio::create([
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim,
            'tipo_relatorio'  => $tipoRelatorio,
            'total_vendas' => $totalVendas,
            'total_receitas' => $totalReceitas
        ]);

    }
}