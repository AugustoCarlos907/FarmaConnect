<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function __construct( public ReportService $service){}

    public function relatorioEntregas(Request $request)
    {
        $data = $request->validate([
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after_or_equal:data_inicio',
        ]);
        $user = Auth::user();
        if ($user->role !== 'gestor_farmacia') {
            abort(403, 'Sem permissão.');
        }
        $entregas = $this->service->relatorioEntregas($user->farmacia_id, $data['data_inicio'], $data['data_fim']);
        return response()->json($entregas);
    }

    public function relatorioAvaliacoes(Request $request)
    {
        $data = $request->validate([
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after_or_equal:data_inicio',
        ]);
        $user = Auth::user();
        if ($user->role !== 'gestor_farmacia') {
            abort(403, 'Sem permissão.');
        }
        $avaliacoes = $this->service->relatorioAvaliacoes($user->farmacia_id, $data['data_inicio'], $data['data_fim']);
        return response()->json($avaliacoes);
    }

    public function relatorioStock(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'gestor_farmacia') {
            abort(403, 'Sem permissão.');
        }
        $stock = $this->service->relatorioStock($user->farmacia_id);
        return response()->json($stock);
    }

    public function gerarRelatorioPedidos (Request $request){
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
        //    $user->farmacia_id,
           $data['data_inicio'] ?? Carbon::now(),
           $data['data_fim'] ?? Carbon::now(),
           $data['tipo_relatorio'] ?? 'pdf'
        );

        if($data['tipo_relatorio'] == 'pdf'){
            $pdf = Pdf::loadView('farmacias.relatorios.pedidos_pdf', ['relatorio' => $relatorio]);

            return $pdf->download('RELATORIO-FARMACONNECT'.$relatorio->id.'.pdf');
        }
    }

}
