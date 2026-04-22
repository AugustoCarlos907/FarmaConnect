<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Relatório — FarmaConnect</title>
  <style>
    /*
     * DomPDF: CSS 2.1 + subconjunto de CSS3.
     * SEM: flexbox, grid, variáveis CSS, :hover, position:fixed.
     * Layout baseado em tabelas.
     */

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
      font-size: 10px;
      color: #1e293b;
      background: #ffffff;
      line-height: 1.5;
    }

    .page { width: 100%; }

    /* ─── HEADER ────────────────────────────── */
    .header {
      background: #0899a6 !important;
      padding: 24px 32px;
      min-height: 80px;
    }
    .header-table { width: 100%; border-collapse: collapse; }
    .header-logo  { font-size: 22px; font-weight: bold; color: #ffffff; letter-spacing: -0.5px; }
    .header-logo span { color: #000000; }
    .header-sub  { font-size: 9px; color: #d9f2f0; margin-top: 3px; }
    .header-meta { font-size: 8.5px; color: #d9f2f0; margin-top: 6px; }
    .header-id { font-size: 8px; color: rgba(255,255,255,0.7); margin-top: 5px; text-align: right; }

    /* ─── BANDA PERÍODO ─────────────────────── */
    .periodo-band { background-color: #05707a; padding: 10px 32px; }
    .periodo-table { width: 100%; border-collapse: collapse; }
    .periodo-lbl { font-size: 8px; color: #a8f0f4; text-transform: uppercase; letter-spacing: 0.06em; }
    .periodo-val { font-size: 11px; font-weight: bold; color: #ffffff; padding-top: 2px; }
    .periodo-sep { text-align: center; color: rgba(255,255,255,0.35); font-size: 18px; vertical-align: middle; }

    /* ─── SECTION TITLE ─────────────────────── */
    .section-title {
      font-size: 9px; font-weight: bold; text-transform: uppercase;
      letter-spacing: 0.08em; color: #64748b;
      border-bottom: 1px solid #e2e8f0;
      padding: 0 32px 6px 32px; margin-bottom: 14px; margin-top: 20px;
    }

    /* ─── KPI SECTION ───────────────────────── */
    .kpi-section { padding: 0 32px; margin-bottom: 22px; }
    .kpi-table   { width: 100%; border-collapse: separate; border-spacing: 8px 0; }
    .kpi-card {
      background-color: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 14px 16px;
      vertical-align: top;
      width: 25%;
    }
    .kpi-card-accent { border-left: 3px solid #0899a6; }
    .kpi-card-green  { border-left: 3px solid #16a34a; }
    .kpi-card-amber  { border-left: 3px solid #d97706; }
    .kpi-card-blue   { border-left: 3px solid #2563eb; }
    .kpi-label { font-size: 8px; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; }
    .kpi-value { font-size: 20px; font-weight: bold; color: #0f172a; line-height: 1; margin-bottom: 3px; }
    .kpi-sub   { font-size: 8px; color: #94a3b8; }

    /* ─── DATA TABLE ────────────────────────── */
    .table-section { padding: 0 32px; margin-bottom: 22px; }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 9px;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      overflow: hidden;
    }
    .data-table thead tr { background-color: #0899a6; }
    .data-table thead th {
      color: #ffffff;
      padding: 10px 12px;
      text-align: left;
      font-size: 8.5px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-right: 1px solid rgba(255,255,255,0.2);
    }
    .data-table thead th:last-child { border-right: none; text-align: right; }
    .data-table tbody tr { border-bottom: 1px solid #f1f5f9; }
    .data-table tbody tr.alt { background-color: #f8fafc; }
    .data-table tbody td {
      padding: 10px 12px;
      color: #334155;
      vertical-align: middle;
      border-right: 1px solid #f1f5f9;
    }
    .data-table tbody td:last-child { border-right: none; text-align: right; font-weight: bold; color: #0f172a; }
    .data-table tfoot tr { background-color: #0899a6; }
    .data-table tfoot td {
      padding: 10px 12px;
      color: #ffffff;
      font-weight: bold;
      font-size: 9.5px;
      border-top: 2px solid #ffffff;
    }
    .data-table tfoot td:last-child { text-align: right; color: #a8f0f4; }

    /* Status badges */
    .badge {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 20px;
      font-size: 7.5px;
      font-weight: bold;
      text-align: center;
      min-width: 65px;
    }
    .badge-concluido   { background-color: #dcfce7; color: #15803d; }
    .badge-pendente    { background-color: #fef3c7; color: #92400e; }
    .badge-cancelado   { background-color: #fdecea; color: #b91c1c; }
    .badge-processando { background-color: #e6f7f8; color: #05707a; }
    .badge-entrega     { background-color: #ede9fe; color: #5b21b6; }

    /* ─── SUMMARY BOX ───────────────────────── */
    .summary-section { padding: 0 32px; margin-bottom: 22px; }
    .summary-box {
      background-color: #0899a6;
      border-radius: 8px;
      padding: 16px 20px;
    }
    .summary-table {
      width: 100%;
      border-collapse: collapse;
    }
    .sum-lbl {
      color: rgba(255,255,255,0.7);
      font-size: 9px;
      padding: 6px 0;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      width: 70%;
    }
    .sum-val {
      text-align: right;
      color: #ffffff;
      font-size: 9px;
      font-weight: bold;
      padding: 6px 0;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .sum-lbl-t {
      color: #ffffff;
      font-size: 11px;
      font-weight: bold;
      padding: 12px 0 4px;
      border-bottom: none;
    }
    .sum-val-t {
      text-align: right;
      color: #ffffff;
      font-size: 14px;
      font-weight: bold;
      padding: 12px 0 4px;
      border-bottom: none;
    }

    /* ─── ASSINATURA ────────────────────────── */
    .sign-section { padding: 0 32px; margin-top: 28px; margin-bottom: 16px; }
    .sign-table { width: 100%; border-collapse: collapse; }
    .sign-cell { width: 45%; vertical-align: bottom; }
    .sign-line { border-top: 1px solid #334155; padding-top: 6px; font-size: 8.5px; color: #64748b; }
    .sign-name { font-weight: bold; color: #0f172a; font-size: 9px; margin-bottom: 2px; }
  </style>
</head>
<body>
<div class="page">

  @php
    $pedidos = $relatorio->pedidos ?? collect();
    $totalPedidos = $pedidos->count();

    // Corrigido: contar apenas status 'Concluido' (atenção ao acento)
    $nConcluidos = $pedidos->where('status', 'Concluído')->count();
    $nProcesso   = $pedidos->whereIn('status', ['Pendente', 'pago', 'Aprovado', 'Em Entrega'])->count();
    $nCancelados = $pedidos->whereIn('status', ['Cancelado', 'Rejeitado'])->count();

    $inicio   = \Carbon\Carbon::parse($relatorio->data_inicio);
    $fim      = \Carbon\Carbon::parse($relatorio->data_fim);
    $dias     = $inicio->diffInDays($fim) + 1;
    $ticket   = ($nConcluidos > 0) ? (int) round($relatorio->total_receitas / $nConcluidos) : 0;
    $mediaDia = ($dias > 0) ? (int) round($relatorio->total_receitas / $dias) : 0;

    $badgeMap = [
      'Concluído'  => 'badge-concluido',
      'Pendente'   => 'badge-pendente',
      'pago'       => 'badge-processando',
      'Aprovado'   => 'badge-processando',
      'Em Entrega' => 'badge-entrega',
      'Cancelado'  => 'badge-cancelado',
      'Rejeitado'  => 'badge-cancelado',
    ];
  @endphp

  <!-- ═══ HEADER ════════════════════════════════ -->
  <div class="header">
    <table class="header-table">
       <tr>
        <td style="width:60%; vertical-align:top">
          <div class="header-logo">Farma<span>Connect</span></div>
          <div class="header-sub">Plataforma de Gestão Farmacêutica · Angola</div>
          @if(isset($relatorio->farmacia))
            <div class="header-meta">
              {{ $relatorio->farmacia->name ?? '' }}
              @if($relatorio->farmacia->endereco ?? false)
                &nbsp;·&nbsp; {{ $relatorio->farmacia->endereco }}
              @endif
            </div>
          @endif
        </td>
        <td style="width:40%; vertical-align:top; text-align:right">
          <div class="header-id">
            Nº {{ str_pad($relatorio->id, 6, '0', STR_PAD_LEFT) }}
            &nbsp;·&nbsp;
            Gerado em {{ now()->format('d/m/Y H:i') }}
          </div>
        </td>
       </tr>
    </table>
  </div>

  <!-- ═══ BANDA PERÍODO ══════════════════════════ -->
  <div class="periodo-band">
    <table class="periodo-table">
       <tr>
        <td style="width:42%">
          <div class="periodo-lbl">Período analisado</div>
          <div class="periodo-val">{{ $inicio->format('d/m/Y') }} → {{ $fim->format('d/m/Y') }}</div>
        </td>
        <td class="periodo-sep" style="width:6%">⤚</td>
        <td style="width:22%">
          <div class="periodo-lbl">Duração</div>
          <div class="periodo-val">{{ $dias }} {{ $dias === 1 ? 'dia' : 'dias' }}</div>
        </td>
        <td style="width:30%; text-align:right">
          <div class="periodo-lbl">Gerado por</div>
          <div class="periodo-val">{{ auth()->user()->name ?? 'Sistema' }}</div>
        </td>
       </tr>
    </table>
  </div>

  <!-- ═══ KPIs ════════════════════════════════ -->
  <div class="section-title">Resumo executivo</div>
  <div class="kpi-section">
    <table class="kpi-table">
       <tr>
        <td class="kpi-card kpi-card-accent">
          <div class="kpi-label">Total de pedidos</div>
          <div class="kpi-value">{{ $totalPedidos }}</div>
          <div class="kpi-sub">No período seleccionado</div>
        </td>
        <td class="kpi-card kpi-card-green">
          <div class="kpi-label">Pedidos concluídos</div>
          <div class="kpi-value">{{ $nConcluidos }}</div>
          <div class="kpi-sub">
            {{ $totalPedidos > 0 ? round(($nConcluidos / $totalPedidos) * 100) : 0 }}% de conclusão
          </div>
        </td>
        <td class="kpi-card kpi-card-amber">
          <div class="kpi-label">Receita total</div>
          <div class="kpi-value">{{ number_format($relatorio->total_receitas, 0, ',', '.') }}</div>
          <div class="kpi-sub">Kwanzas (Kz)</div>
        </td>
        <td class="kpi-card kpi-card-blue">
          <div class="kpi-label">Ticket médio</div>
          <div class="kpi-value">{{ number_format($ticket, 0, ',', '.') }}</div>
          <div class="kpi-sub">Kz por pedido concluído</div>
        </td>
       </tr>
    </table>
  </div>

  <!-- ═══ TABELA DE PEDIDOS ═══════════════════ -->
  <div class="section-title">Detalhe dos pedidos</div>
  <div class="table-section">
    @if($pedidos->isEmpty())
      <p style="font-size:9px; color:#94a3b8; padding:12px 0">
        Nenhum pedido encontrado para o período seleccionado.
      </p>
    @else
      <table class="data-table">
        <thead>
           <tr>
            <th style="width:9%">Nº</th>
            <th style="width:18%">Cliente</th>
            <th style="width:11%">Data</th>
            <th style="width:11%">Estado</th>
            <th style="width:12%">Pagamento</th>
            <th style="width:12%">Total (Kz)</th>
           </tr>
        </thead>
        <tbody>
          @foreach($pedidos as $i => $pedido)
            @php
              $clienteNome = $pedido->user->name ?? $pedido->usuario->name ?? '—';
              $metodo = $pedido->pagamento?->metodo ?? '—';
              $metodoLabel = match($metodo) {
                'express'  => 'M. Express',
                'iban'     => 'IBAN',
                'dinheiro' => 'Numerário',
                default    => ucfirst($metodo),
              };
              $badgeCls = $badgeMap[$pedido->status] ?? 'badge-pendente';
              $totalLinha = $pedido->total ?? 0;
            @endphp
            <tr class="{{ $i % 2 === 1 ? 'alt' : '' }}">
              <td style="color:#0899a6; font-weight:bold">#{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</td>
              <td>{{ $clienteNome }}</td>
              <td>{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y') }}</td>
              <td><span class="badge {{ $badgeCls }}">{{ $pedido->status }}</span></td>
              <td>{{ $metodoLabel }}</td>
              <td>{{ number_format($totalLinha, 0, ',', '.') }} Kz</td>
            </tr>
          @endforeach
        </tbody>
        @php
        $farmaciaId = Auth::user()->farmacia_id;
        $totalGeral = DB::table('item_pedidos')
        ->join('pedidos', 'item_pedidos.pedido_id', '=', 'pedidos.id')
        ->where('item_pedidos.farmacia_id', $farmaciaId) // apenas itens da farmácia logada
        ->where('pedidos.status', 'Concluído') // ou outro status adequado
        ->sum('item_pedidos.subtotal');
        @endphp
        <tfoot>
           <tr>
            <td colspan="4" style="font-size:8px; text-transform:uppercase; letter-spacing:.05em">
              {{ $totalPedidos }} pedido{{ $totalPedidos !== 1 ? 's' : '' }} no período
            </td>
            <td style="font-size:8px; text-transform:uppercase">Total geral</td>
            <td style="text-align:right; color:#a8f0f4; font-size:11px">
              {{ number_format($totalGeral, 0, ',', '.') }} Kz
            </td>
           </tr>
        </tfoot>
      </table>
    @endif
  </div>

  <!-- ═══ SÍNTESE FINANCEIRA ════ -->
  <div class="section-title">Síntese financeira (Pedidos)</div>
  <div class="summary-section">
    <div class="summary-box">
      <table class="summary-table">
         <tr>
          <td class="sum-lbl">Pendentes / em processo</td>
          <td class="sum-val">{{ $nProcesso }}</td>
         </tr>
         <tr>
          <td class="sum-lbl">Cancelados / rejeitados</td>
          <td class="sum-val">{{ $nCancelados }}</td>
         </tr>
         <tr>
          <td class="sum-lbl">Receita média por dia</td>
          <td class="sum-val">{{ number_format($mediaDia, 0, ',', '.') }} Kz</td>
         </tr>
         <tr>
          <td class="sum-lbl-t">Receita total (concluídos)</td>
          <td class="sum-val-t">{{ number_format($totalGeral, 0, ',', '.') }} Kz</td>
         </tr>
      </table>
    </div>
  </div>

  <!-- ═══ ASSINATURA ══════════════════════════════ -->
  <div class="sign-section">
    <table class="sign-table">
       <tr>
        <td class="sign-cell">
          <div style="height:36px"></div>
          <div class="sign-line">
            <div class="sign-name">{{ auth()->user()->name ?? '—' }}</div>
            <div>Responsável · {{ auth()->user()->farmacia->name ?? 'Farmácia' }}</div>
          </div>
        </td>
        <td style="width:10%"></td>
        <td class="sign-cell" style="text-align:right">
          <div style="height:36px"></div>
          <div class="sign-line">
            <div class="sign-name">FarmaConnect · Sistema</div>
            <div>Gerado automaticamente em {{ now()->format('d/m/Y H:i') }}</div>
          </div>
        </td>
       </tr>
    </table>
  </div>

</div>{{-- /page --}}
</body>
</html>