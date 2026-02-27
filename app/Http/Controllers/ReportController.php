<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function __construct( public ReportService $service){}

    public function gerarRelatorio (Request $request){
        $data = $request->validate([
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after_or_equal:data_inicio',
            'tipo_relatorio' => ['required', Rule::in(['csv', 'pdf'])]
        ]);

        $user = Auth::user();

        if ($user->role !== 'gestor_farmacia') {
            abort(403, 'Sem permissão.');
        }

        $relatorio = $this->service->gerarRelatorioPoPeriodo(
           $user->farmacia_id,
           $data['data_inicio'],
              $data['data_fim'],
        $data['tipo_relatorio'] );

        if($data['tipo_relatorio'] == 'pdf'){
            $pdf = Pdf::loadView('relatorios.pdf', ['relatorio' => $relatorio]);

            return $pdf->download('relatorio-'.$relatorio->id.'.pdf');
        }


    }
}
