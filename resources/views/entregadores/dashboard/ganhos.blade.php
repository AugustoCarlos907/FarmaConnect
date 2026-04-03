<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Ganhos do Entregador</title>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    /* Mantém os mesmos estilos do original */
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --teal:       #0bbfcc;
      --teal-dim:   #08949f;
      --teal-ultra: rgba(11,191,204,.06);
      --surface:    #ffffff;
      --border-light:#e8eff2;
      --text-main:  #0e2228;
      --text-mid:   #4a6e78;
      --text-dim:   #8fadb5;
      --green:      #1ec97a;
      --amber:      #f5a623;
      --red:        #f04e60;
      --bg:         #f2f7f9;
      --r24: 24px; --r16: 16px; --r12: 12px;
      --shadow-sm:  0 2px 12px rgba(9,22,26,.06);
      --shadow-md:  0 8px 32px rgba(9,22,26,.10);
    }

    html { font-size: 13px; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text-main);
      min-height: 100vh;
    }

    .layout { display: flex; min-height: 100vh; }

    /* Sidebar (placeholder – será substituído pelo include) */
    .sidebar-placeholder {
      width: 260px;
      background: #09161a;
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      color: rgba(255,255,255,0.6);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-size: 0.9rem;
      z-index: 100;
    }
    .sidebar-placeholder p {
      text-align: center;
      background: rgba(255,255,255,0.1);
      padding: 1rem;
      border-radius: 12px;
      margin: 1rem;
    }
    .sidebar-placeholder i {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      display: block;
      color: #0bbfcc;
    }

    .main {
      flex: 1;
      margin-left: 260px;
      padding: 1.6rem 1.8rem;
      min-width: 0;
      animation: fadeUp .5s .1s cubic-bezier(.16,1,.3,1) both;
    }

    /* Topbar */
    .topbar {
      display: flex; align-items: center; justify-content: space-between;
      background: var(--surface); border-radius: var(--r24);
      padding: .9rem 1.4rem; box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-light); margin-bottom: 1.5rem; gap: 1rem;
    }
    .topbar-greeting { font-family: 'Syne', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--text-main); line-height: 1.1; }
    .topbar-sub { font-size: .8rem; color: var(--text-mid); margin-top: .1rem; }
    .topbar-right { display: flex; align-items: center; gap: .8rem; }

    .icon-btn {
      width: 40px; height: 40px;
      background: var(--bg); border: 1px solid var(--border-light);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; position: relative; transition: all .2s;
    }
    .icon-btn:hover { background: var(--teal-ultra); border-color: var(--teal); }
    .icon-btn i { font-size: 1.05rem; color: var(--text-mid); }
    .notif-dot {
      position: absolute; top: 6px; right: 7px;
      width: 8px; height: 8px; background: var(--red); border-radius: 50%;
      border: 2px solid #fff;
    }

    /* KPI row */
    .kpi-row {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    .kpi-card {
      background: var(--surface);
      border-radius: var(--r24);
      padding: 1.2rem;
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-sm);
      transition: all .25s;
      position: relative;
      overflow: hidden;
    }
    .kpi-card::after {
      content: ''; position: absolute; top: 0; right: 0;
      width: 80px; height: 80px;
      background: radial-gradient(circle at top right, var(--teal-ultra) 0%, transparent 70%);
      pointer-events: none;
    }
    .kpi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); border-color: rgba(11,191,204,.2); }
    .kpi-icon-wrap {
      width: 44px; height: 44px; border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.1rem; flex-shrink: 0;
      background: rgba(11,191,204,.12); color: var(--teal);
      margin-bottom: .8rem;
    }
    .kpi-value { font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 700; line-height: 1; color: var(--text-main); }
    .kpi-label { font-size: .75rem; color: var(--text-mid); margin-top: .25rem; }
    .kpi-trend {
      display: inline-flex; align-items: center; gap: .2rem;
      margin-top: .5rem;
      font-size: .68rem; font-weight: 600;
      padding: .12rem .5rem;
      border-radius: 50px;
    }
    .kpi-trend.up   { background: rgba(30,201,122,.12); color: var(--green); }
    .kpi-trend.down { background: rgba(240,78,96,.12);  color: var(--red); }

    /* Chart */
    .chart-card {
      background: var(--surface);
      border-radius: var(--r24);
      border: 1px solid var(--border-light);
      padding: 1.2rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-sm);
    }
    .chart-title {
      font-family: 'Syne', sans-serif;
      font-size: .9rem; font-weight: 700;
      margin-bottom: 1rem;
      display: flex; align-items: center; gap: .5rem;
    }
    .chart-title i { color: var(--teal); }
    .chart-wrap { height: 260px; position: relative; }

    /* Filter bar */
    .filter-bar {
      display: flex; align-items: center; gap: .5rem;
      background: var(--surface); border-radius: var(--r16);
      padding: .35rem; border: 1px solid var(--border-light);
      box-shadow: var(--shadow-sm);
      margin-bottom: 1.4rem;
      flex-wrap: wrap;
    }
    .filter-group {
      display: flex; align-items: center; gap: .5rem;
      padding: .25rem .5rem;
    }
    .filter-label { font-size: .78rem; color: var(--text-mid); font-weight: 600; }
    .filter-input {
      border: 1px solid var(--border-light);
      border-radius: 12px;
      padding: .4rem .8rem;
      font-size: .8rem;
      font-family: 'DM Sans', sans-serif;
      outline: none;
    }
    .filter-input:focus { border-color: var(--teal); }
    .btn-filter {
      background: var(--teal); color: #fff; border: none;
      border-radius: 50px; padding: .4rem 1rem;
      font-size: .8rem; font-weight: 600; cursor: pointer;
      transition: all .2s;
    }
    .btn-filter:hover { background: var(--teal-dim); transform: translateY(-1px); }
    .btn-reset {
      background: transparent; border: 1px solid var(--border-light);
      border-radius: 50px; padding: .4rem 1rem;
      font-size: .78rem; font-weight: 500; color: var(--text-mid);
      cursor: pointer;
    }
    .btn-reset:hover { border-color: var(--teal); color: var(--teal); }

    /* Delivery list */
    .deliveries-list { display: flex; flex-direction: column; gap: .6rem; }
    .delivery-card {
      background: var(--surface);
      border-radius: var(--r16);
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-sm);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: .9rem 1.2rem;
      transition: all .2s;
    }
    .delivery-card:hover { border-color: var(--teal); transform: translateY(-1px); }
    .delivery-info {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }
    .delivery-id {
      font-family: 'Syne', sans-serif;
      font-size: .9rem; font-weight: 700;
      color: var(--teal);
    }
    .delivery-date {
      font-size: .75rem; color: var(--text-mid);
      display: flex; align-items: center; gap: .3rem;
    }
    .delivery-details {
      display: flex;
      gap: 1rem;
      font-size: .78rem;
      color: var(--text-mid);
    }
    .delivery-amount {
      font-family: 'Syne', sans-serif;
      font-size: 1.1rem; font-weight: 700;
      color: var(--green);
    }
    .badge-concluida {
      background: rgba(30,201,122,.12);
      color: var(--green);
      padding: .2rem .7rem;
      border-radius: 50px;
      font-size: .7rem;
      font-weight: 600;
      white-space: nowrap;
    }

    /* Pagination */
    .pagination-fc {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: .4rem;
      margin-top: 1.5rem;
    }
    .pg-btn {
      width: 34px; height: 34px;
      border-radius: 10px; border: 1px solid var(--border-light);
      background: var(--surface);
      font-size: .8rem; font-weight: 600;
      color: var(--text-mid);
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: all .2s;
    }
    .pg-btn.active, .pg-btn:hover {
      background: var(--teal); color: #fff;
      border-color: var(--teal);
    }
    .pg-btn:disabled { opacity: .4; cursor: not-allowed; }

    /* Empty state */
    .empty-state {
      background: var(--surface);
      border-radius: var(--r24);
      border: 1px solid var(--border-light);
      padding: 3rem 2rem;
      text-align: center;
    }
    .empty-state i { font-size: 2rem; color: var(--teal); opacity: .3; display: block; margin-bottom: .8rem; }
    .empty-state h4 { font-size: .95rem; font-weight: 700; margin-bottom: .3rem; }
    .empty-state p  { font-size: .8rem; color: var(--text-mid); }

    @keyframes fadeUp {
      from { transform: translateY(16px); opacity: 0; }
      to   { transform: translateY(0);    opacity: 1; }
    }

    @media (max-width:1100px) { .kpi-row { grid-template-columns: repeat(2,1fr); } }
    @media (max-width:900px)  { .sidebar-placeholder { display: none; } .main { margin-left: 0; } }
  </style>
</head>
<body>
<div class="layout">

  <!-- Sidebar dinâmica -->
  <div class="sidebar-placeholder">
    @include('entregadores.dashboard.sidebar')
  </div>

  <main class="main">

    <!-- Topbar com data actual -->
    <div class="topbar">
      <div class="topbar-left">
        <div>
          <div class="topbar-sub">{{ \Carbon\Carbon::now()->translatedFormat('l, j \\d\\e F \\d\\e Y') }}</div>
        </div>
      </div>
      <div class="topbar-right">
        <div class="icon-btn" title="Notificações">
          <i class="bi bi-bell"></i>
          <span class="notif-dot"></span>
        </div>
      </div>
    </div>

    <!-- KPIs dinâmicos -->
    <div class="kpi-row">
      <div class="kpi-card">
        <div class="kpi-icon-wrap"><i class="bi bi-cash-stack"></i></div>
        <div class="kpi-value">{{ number_format($totalGanhos, 0, ',', '.') }} Kz</div>
        <div class="kpi-label">Total de ganhos</div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap"><i class="bi bi-calendar-week"></i></div>
        <div class="kpi-value">{{ number_format($ganhosEsteMes, 0, ',', '.') }} Kz</div>
        <div class="kpi-label">Ganhos este mês</div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap"><i class="bi bi-truck"></i></div>
        <div class="kpi-value">{{ $totalEntregasConcluidas }}</div>
        <div class="kpi-label">Entregas concluídas</div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap"><i class="bi bi-trophy"></i></div>
        <div class="kpi-value">{{ number_format($ganhosHoje, 0, ',', '.') }} Kz</div>
        <div class="kpi-label">Ganhos hoje</div>
      </div>
    </div>

    <!-- Gráfico de evolução (dados reais) -->
    <div class="chart-card">
      <div class="chart-title">
        <i class="bi bi-graph-up"></i> Evolução dos ganhos (últimos 30 dias)
      </div>
      <div class="chart-wrap">
        <canvas id="earningsChart"></canvas>
      </div>
    </div>

    <!-- Filtros (mock, mas pode ser transformado em GET posteriormente) -->
    <div class="filter-bar">
      <div class="filter-group">
        <span class="filter-label">Período</span>
        <select id="periodoSelect" class="filter-input" onchange="applyDateFilter()">
          <option value="mes">Últimos 30 dias</option>
          <option value="semana">Últimos 7 dias</option>
          <option value="hoje">Hoje</option>
        </select>
      </div>
      <div class="filter-group">
        <span class="filter-label">Data inicial</span>
        <input type="date" id="dataInicio" class="filter-input" value="{{ request('data_inicio', now()->subDays(30)->format('Y-m-d')) }}">
      </div>
      <div class="filter-group">
        <span class="filter-label">Data final</span>
        <input type="date" id="dataFim" class="filter-input" value="{{ request('data_fim', now()->format('Y-m-d')) }}">
      </div>
      <button class="btn-filter" onclick="applyDateFilter()"><i class="bi bi-funnel"></i> Filtrar</button>
      <button class="btn-reset" onclick="resetFilters()">Limpar</button>
    </div>

    <!-- Lista de entregas concluídas (paginação dinâmica) -->
    <div class="deliveries-list">
      @forelse($entregas as $entrega)
        @php
          $pedido = $entrega->pedido;
          $cliente = $pedido->user->name ?? '—';
          $dataEntrega = $entrega->data_entrega ? \Carbon\Carbon::parse($entrega->data_entrega)->format('d/m/Y à\s H:i') : '—';
          $distancia = $entrega->distancia_km ? number_format($entrega->distancia_km, 1, ',', '.') . ' km' : '—';
          $taxa = number_format($entrega->taxa_entrega, 0, ',', '.');
        @endphp
        <div class="delivery-card">
          <div class="delivery-info">
            <div class="delivery-id">Pedido #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</div>
            <div class="delivery-date"><i class="bi bi-calendar3"></i> {{ $dataEntrega }}</div>
            <div class="delivery-details">
              <span><i class="bi bi-signpost-2"></i> {{ $distancia }}</span>
              <span><i class="bi bi-person"></i> {{ $cliente }}</span>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 1rem;">
            <div class="delivery-amount">{{ $taxa }} Kz</div>
            <span class="badge-concluida">Concluída</span>
          </div>
        </div>
      @empty
        <div class="empty-state">
          <i class="bi bi-inbox"></i>
          <h4>Nenhuma entrega concluída</h4>
          <p>As suas entregas concluídas aparecerão aqui.</p>
        </div>
      @endforelse
    </div>

    <!-- Links de paginação personalizados (Bootstrap não usado, apenas estilos próprios) -->
    <div class="pagination-fc">
      {{ $entregas->appends(request()->query())->links('pagination::simple-tailwind') }}
    </div>

  </main>
</div>

<script>
  // Dados reais do gráfico vindos do controlador
  const labels = @json($labels);
  const values = @json($values);

  // Renderizar gráfico com dados reais
  const ctx = document.getElementById('earningsChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Ganhos (Kz)',
        data: values,
        borderColor: '#0bbfcc',
        backgroundColor: 'rgba(11,191,204,0.1)',
        borderWidth: 2,
        tension: 0.4,
        fill: true,
        pointBackgroundColor: '#0bbfcc',
        pointRadius: 3,
        pointHoverRadius: 6,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: (ctx) => `${ctx.raw.toLocaleString('pt-AO')} Kz`
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: (value) => value.toLocaleString('pt-AO') + ' Kz',
            font: { size: 10 }
          }
        },
        x: {
          ticks: {
            font: { size: 10 },
            maxRotation: 45,
            minRotation: 45
          }
        }
      }
    }
  });

  // Funções de filtro (recarregam a página com parâmetros GET)
  function applyDateFilter() {
    const inicio = document.getElementById('dataInicio').value;
    const fim = document.getElementById('dataFim').value;
    const periodo = document.getElementById('periodoSelect').value;
    let url = new URL(window.location.href);
    if (periodo === 'hoje') {
      url.searchParams.set('data_inicio', '{{ now()->format('Y-m-d') }}');
      url.searchParams.set('data_fim', '{{ now()->format('Y-m-d') }}');
    } else if (periodo === 'semana') {
      const hoje = new Date();
      const semanaAtras = new Date(hoje);
      semanaAtras.setDate(hoje.getDate() - 7);
      url.searchParams.set('data_inicio', semanaAtras.toISOString().split('T')[0]);
      url.searchParams.set('data_fim', hoje.toISOString().split('T')[0]);
    } else {
      url.searchParams.set('data_inicio', inicio);
      url.searchParams.set('data_fim', fim);
    }
    window.location.href = url.toString();
  }

  function resetFilters() {
    window.location.href = window.location.pathname;
  }
</script>
</body>
</html>