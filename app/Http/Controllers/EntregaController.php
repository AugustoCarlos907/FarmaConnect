<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Services\EntregaService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class EntregaController extends Controller
{

    public function __construct(public EntregaService $service){}


    public function concluidasPorEntregador($entregadorId)
    {
        $entregas = $this->service->entregasConcluidasPorEntregador($entregadorId);
        return response()->json($entregas);
    }

    public function emTransitoPorEntregador($entregadorId)
    {
        $entregas = $this->service->entregasEmTransitoPorEntregador($entregadorId);
        return response()->json($entregas);
    }

    public function canceladasPorEntregador($entregadorId)
    {
        $entregas = $this->service->entregasCanceladasPorEntregador($entregadorId);
        return response()->json($entregas);
    }



    public function dashboard()
    {
        $entregador = Auth::user()->entregador;
        if (!$entregador) {
            abort(403, 'Perfil de entregador não encontrado.');
        }
        $entregadorId = $entregador->id;

        // ---------- Entregas em andamento (em_transito) ----------
        $entregasEmAndamento = Entrega::with(['pedido.user', 'pedido.farmacia'])
            ->where('entregador_id', $entregadorId)
            ->where('status', 'em_transito')
            ->latest()
            ->take(5)
            ->get();

        // ---------- Total de entregas (todas) ----------
        $totalEntregas = Entrega::where('entregador_id', $entregadorId)->count();

        // ---------- Total de entregas concluídas ----------
        $totalConcluidas = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->count();

        // ---------- Ganhos de hoje (soma das taxas de entregas concluídas no dia) ----------
        $ganhosHoje = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->whereDate('data_entrega', Carbon::today())
            ->sum('taxa_entrega');

        // ---------- Últimas entregas (já existia, mas com eager loading) ----------
        $lastEntregas = Entrega::with(['pedido.user', 'pedido.farmacia', 'pedido.items'])
            ->where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->latest()
            ->take(4)
            ->get();

        // ---------- Taxa de conclusão geral ----------
        $taxaConclusao = $totalEntregas > 0
            ? round(($totalConcluidas / $totalEntregas) * 100, 1)
            : 0;

        // ---------- Dados para o gráfico de desempenho semanal (últimas 6 semanas) ----------
        $semanas = [];
        $percentuais = [];

        for ($i = 5; $i >= 0; $i--) {
            $inicioSemana = Carbon::now()->subWeeks($i)->startOfWeek();
            $fimSemana    = Carbon::now()->subWeeks($i)->endOfWeek();

            $totalSemana = Entrega::where('entregador_id', $entregadorId)
                ->whereBetween('created_at', [$inicioSemana, $fimSemana])
                ->count();

            $concluidasSemana = Entrega::where('entregador_id', $entregadorId)
                ->where('status', 'entregue')
                ->whereBetween('created_at', [$inicioSemana, $fimSemana])
                ->count();

            $percentual = $totalSemana > 0 ? round(($concluidasSemana / $totalSemana) * 100, 1) : 0;
            $semanas[] = 'Sem ' . ($i + 1);
            $percentuais[] = $percentual;
        }

    return view('entregadores.dashboard.index', compact(
        'entregador',
        'entregasEmAndamento',
        'totalEntregas',
        'totalConcluidas',
        'ganhosHoje',
        'lastEntregas',
        'taxaConclusao',
        'semanas',
        'percentuais'
    ));
}
        
    //     public function dashboard(){
    //         $entregadorId = Auth::user()->id;

    //         $entregasHoje = $this->service->getEntregasDeHojeByEntregador($entregadorId);
            
    //         $entregaTotal = $this->service->getAllEntregasByEntregador()->count();

    //         $lastEntregas = $this->service->getLastEntregasByEntregador($entregadorId);

    //     return view('entregadores.dashboard.index' ,compact('entregasHoje' ,'entregaTotal' , 'lastEntregas' ));
    // }

    //     public function entregas(){
    //     $entregadorId = Auth::user()->id;

    //     $entregas = $this->service->entregasEmTransitoPorEntregador($entregadorId);

    //     $entregaTotal = $this->service->getAllEntregasByEntregador()->count();

    //     $entregas = $this->service->entregasConcluidasPorEntregador($entregadorId);

        
    //     return view('entregadores.dashboard.entregas');
    // }

  
    public function entregas()
    {
        /*
         * O Entregador está ligado ao User via user_id.
         * Auth::user() devolve o User; Auth::user()->entregador devolve o Entregador.
         */
        $user      = Auth::user();
        $entregador = $user->entregador; // relação belongsTo no modelo User, ou hasOne

        if (!$entregador) {
            abort(403, 'Conta de entregador não encontrada.');
        }

        $entregadorId = $entregador->id;

        /* ── Entregas em trânsito (activas) ─────────────────────────── */
        $emTransito = Entrega::with([
                'pedido.user',
                'pedido.farmacia',
                'pedido.items.stockItem.medicamento',
            ])
            ->where('entregador_id', $entregadorId)
            ->where('status', 'em_transito')
            ->latest()
            ->get();

        /* ── Entregas concluídas ─────────────────────────────────────── */
        $concluidas = Entrega::with([
                'pedido.user',
                'pedido.farmacia',
                'pedido.items.stockItem.medicamento',
            ])
            ->where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->latest()
            ->take(20)
            ->get();

        /* ── Entregas canceladas ─────────────────────────────────────── */
        $canceladas = Entrega::with(['pedido.user', 'pedido.farmacia'])
            ->where('entregador_id', $entregadorId)
            ->where('status', 'cancelada')
            ->latest()
            ->take(10)
            ->get();

        /* ── Todas (para contagens) ──────────────────────────────────── */
        $todas = Entrega::where('entregador_id', $entregadorId)->get();

        /* ── KPIs ────────────────────────────────────────────────────── */
        $totalEntregas   = $todas->count();
        $totalEmTransito = $todas->where('status', 'em_transito')->count();
        $totalConcluidas = $todas->where('status', 'entregue')->count();
        $totalCanceladas = $todas->where('status', 'cancelada')->count();

        /* Ganhos totais = soma das taxas das entregas concluídas */
        $ganhosTotais = $todas
            ->where('status', 'entregue')
            ->sum('taxa_entrega');

        /* Distância total percorrida */
        $distanciaTotal = $todas
            ->where('status', 'entregue')
            ->sum('distancia_km');

        return view('entregadores.dashboard.entregas', compact(
            'entregador',
            'emTransito',
            'concluidas',
            'canceladas',
            'totalEntregas',
            'totalEmTransito',
            'totalConcluidas',
            'totalCanceladas',
            'ganhosTotais',
            'distanciaTotal',
        ));
    }

    /* ── Marcar entrega como concluída (chamada via fetch) ───────────── */
    public function concluir(Request $request, $id)
    {
        $entrega = Entrega::findOrFail($id);
        $entregador = Auth::user()->entregador;

        // if (!$entregador || $entrega->entregador_id !== $entregador->id) {
        //     abort(403);
        // }

        $entrega->update([
            'status'       => 'entregue',
            'data_entrega' => now(),
        ]);

        /* Actualiza o pedido */
        $entrega->pedido?->update(['status' => 'Concluído']);

        /* Liberta o entregador */
        $entregador->update(['status' => 'Ativo', 'disponivel' => true]);

        return back()->with('success' , 'Entrega Concluída');
    }

    /* ── Cancelar entrega ────────────────────────────────────────────── */
    public function cancelar(Request $request, Entrega $entrega)
    {
        $entregador = Auth::user()->entregador;

        if (!$entregador || $entrega->entregador_id !== $entregador->id) {
            abort(403);
        }

        $entrega->update([
            'status'      => 'cancelada',
            'observacoes' => $request->input('motivo'),
        ]);

        $entrega->pedido?->update(['status' => 'Cancelado']);
        $entregador->update(['status' => 'Ativo', 'disponivel' => true]);

        return response()->json(['ok' => true]);
    }



    public function ganhos()
    {
        $user = Auth::user();
        $entregador = $user->entregador;

        if (!$entregador) {
            abort(403, 'Conta de entregador não encontrada.');
        }

        $entregadorId = $entregador->id;

        // ---------- KPI básicos ----------
        // Total de ganhos (entregas concluídas)
        $totalGanhos = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->sum('taxa_entrega');

        // Ganhos deste mês (data_entrega no mês atual)
        $ganhosEsteMes = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->whereMonth('data_entrega', Carbon::now()->month)
            ->whereYear('data_entrega', Carbon::now()->year)
            ->sum('taxa_entrega');

        // Total de entregas concluídas
        $totalEntregasConcluidas = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->count();

        // Ganhos de hoje
        $ganhosHoje = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->whereDate('data_entrega', Carbon::today())
            ->sum('taxa_entrega');

        // ---------- Dados para o gráfico (últimos 30 dias) ----------
        $startDate = Carbon::today()->subDays(29); // últimos 30 dias incluindo hoje
        $endDate = Carbon::today();

        // Buscar soma das taxas agrupadas por data
        $earningsByDate = Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->whereBetween('data_entrega', [$startDate, $endDate->endOfDay()])
            ->select(DB::raw('DATE(data_entrega) as date'), DB::raw('SUM(taxa_entrega) as total'))
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        // Preencher os últimos 30 dias com zero onde não houver ganhos
        $labels = [];
        $values = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateKey = $date->toDateString();
            $labels[] = $date->format('d/m');
            $values[] = $earningsByDate[$dateKey] ?? 0;
        }

        // ---------- Lista de entregas concluídas com paginação ----------
        $entregas = Entrega::with(['pedido.user', 'pedido.farmacia'])
            ->where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->orderBy('data_entrega', 'desc')
            ->paginate(10); // 10 por página

        // Retornar a view com todos os dados
        return view('entregadores.dashboard.ganhos', compact(
            'entregador',
            'totalGanhos',
            'ganhosEsteMes',
            'totalEntregasConcluidas',
            'ganhosHoje',
            'labels',
            'values',
            'entregas'
        ));
    }
}