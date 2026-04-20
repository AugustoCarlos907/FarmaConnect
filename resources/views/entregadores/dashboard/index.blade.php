<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Dashboard Entregador</title>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    /* ========== ESTILOS (mantidos, apenas removido o CSS do mapa) ========== */
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --teal:       #0bbfcc;
      --teal-dim:   #08949f;
      --teal-glow:  rgba(11,191,204,.18);
      --teal-ultra: rgba(11,191,204,.06);
      --navy:       #09161a;
      --navy-2:     #0d1f24;
      --navy-3:     #132a30;
      --navy-4:     #1b3840;
      --surface:    #ffffff;
      --border:     rgba(255,255,255,.07);
      --border-light: #e8eff2;
      --text-main:  #0e2228;
      --text-mid:   #4a6e78;
      --text-dim:   #8fadb5;
      --green:      #1ec97a;
      --amber:      #f5a623;
      --red:        #f04e60;
      --r24:        24px;
      --r16:        16px;
      --r12:        12px;
      --shadow-sm:  0 2px 12px rgba(9,22,26,.06);
      --shadow-md:  0 8px 32px rgba(9,22,26,.10);
    }

    html { font-size: 13px; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: #f2f7f9;
      color: var(--text-main);
      min-height: 100vh;
    }

    .layout { display: flex; min-height: 100vh; }

    /* SIDEBAR (exatamente igual ao original, mantido) */
    .sidebar { width:260px; background:var(--navy); position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; overflow:hidden; z-index:100; }
    .sidebar::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 160% 60% at 50% -10%,rgba(11,191,204,.12) 0%,transparent 60%),radial-gradient(ellipse 80% 80% at 110% 110%,rgba(11,191,204,.07) 0%,transparent 60%); pointer-events:none; }
    .sidebar-top { padding:2rem 1.6rem 1.2rem; border-bottom:1px solid var(--border); }
    .logo { font-size:1.8rem; font-weight:700; margin-bottom:0; text-decoration:none; display:block; }
    .logo .farma { color:#0bbfcc; } .logo .connect { color:#e0f7f5; }
    .driver-strip { display:flex; align-items:center; gap:.9rem; padding:1rem 1.6rem; border-bottom:1px solid var(--border); }
    .driver-avatar { width:40px; height:40px; background:linear-gradient(135deg,var(--teal),var(--teal-dim)); border-radius:50%; display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:700; color:#fff; font-size:1.1rem; flex-shrink:0; box-shadow:0 4px 14px rgba(11,191,204,.35); }
    .driver-info { flex:1; min-width:0; }
    .driver-name { font-weight:600; color:#fff; font-size:.95rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .driver-id { font-size:.75rem; color:var(--text-dim); }
    .status-pill { display:flex; align-items:center; gap:.4rem; padding:.3rem .7rem; border-radius:50px; font-size:.72rem; font-weight:600; cursor:pointer; transition:all .2s; white-space:nowrap; }
    .status-pill.online  { background:rgba(30,201,122,.15); color:var(--green); border:1px solid rgba(30,201,122,.25); }
    .status-pill.offline { background:rgba(240,78,96,.12);  color:var(--red);   border:1px solid rgba(240,78,96,.2); }
    .status-dot { width:7px; height:7px; border-radius:50%; background:currentColor; animation:blink 2s infinite; }
    .sidebar-nav { flex:1; padding:1rem; overflow-y:auto; display:flex; flex-direction:column; gap:.15rem; }
    .sidebar-nav::-webkit-scrollbar { width:4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background:var(--navy-4); border-radius:4px; }
    .nav-label { font-size:.67rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--text-dim); padding:.8rem .8rem .3rem; }
    .nav-link { display:flex; align-items:center; gap:.85rem; padding:.72rem .9rem; border-radius:var(--r12); color:rgba(255,255,255,.5); text-decoration:none; font-size:.9rem; font-weight:500; transition:all .2s; position:relative; cursor:pointer; }
    .nav-link i { font-size:1.05rem; width:20px; text-align:center; flex-shrink:0; }
    .nav-link:hover { color:rgba(255,255,255,.85); background:rgba(255,255,255,.05); }
    .nav-link.active { color:#fff; background:linear-gradient(135deg,rgba(11,191,204,.25),rgba(11,191,204,.1)); border:1px solid rgba(11,191,204,.2); }
    .nav-link.active i { color:var(--teal); }
    .nav-link.active::before { content:''; position:absolute; left:0; top:20%; bottom:20%; width:3px; background:var(--teal); border-radius:0 4px 4px 0; }
    .nav-badge { margin-left:auto; padding:.18rem .55rem; border-radius:50px; font-size:.68rem; font-weight:700; }
    .nb-teal   { background:rgba(11,191,204,.2);  color:var(--teal); }
    .nb-green  { background:rgba(30,201,122,.15); color:var(--green); }
    .nb-amber  { background:rgba(245,166,35,.15); color:var(--amber); }
    .nav-divider { height:1px; background:var(--border); margin:.6rem 0; }

    /* MAIN */
    .main { flex:1; margin-left:260px; padding:1.6rem 1.8rem; min-width:0; animation:fadeUp .5s .1s cubic-bezier(.16,1,.3,1) both; }

    /* TOPBAR */
    .topbar { display:flex; align-items:center; justify-content:space-between; background:var(--surface); border-radius:var(--r24); padding:.9rem 1.4rem; box-shadow:var(--shadow-sm); border:1px solid var(--border-light); margin-bottom:1.5rem; gap:1rem; }
    .topbar-greeting { font-family:'Syne',sans-serif; font-size:1.4rem; font-weight:700; color:var(--text-main); line-height:1.1; }
    .topbar-sub { font-size:.8rem; color:var(--text-mid); margin-top:.1rem; }
    .topbar-right { display:flex; align-items:center; gap:.8rem; }
    .icon-btn { width:40px; height:40px; background:#f2f7f9; border:1px solid var(--border-light); border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all .2s; }
    .icon-btn:hover { background:var(--teal-ultra); border-color:var(--teal); }
    .icon-btn i { font-size:1.05rem; color:var(--text-mid); }
    .notif-dot { position:absolute; top:6px; right:7px; width:8px; height:8px; background:var(--red); border-radius:50%; border:2px solid #fff; }

    /* KPI ROW */
    .kpi-row { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1.2rem; }
    .kpi-card { background:var(--surface); border-radius:var(--r24); padding:1.3rem 1.4rem; border:1px solid var(--border-light); box-shadow:var(--shadow-sm); display:flex; gap:1rem; align-items:flex-start; transition:all .25s; position:relative; overflow:hidden; }
    .kpi-card::after { content:''; position:absolute; top:0; right:0; width:80px; height:80px; background:radial-gradient(circle at top right,var(--teal-ultra) 0%,transparent 70%); pointer-events:none; }
    .kpi-card:hover { transform:translateY(-3px); box-shadow:var(--shadow-md); border-color:rgba(11,191,204,.3); }
    .kpi-icon-wrap { width:46px; height:46px; flex-shrink:0; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
    .kpi-icon-wrap.teal  { background:rgba(11,191,204,.12); color:var(--teal); }
    .kpi-icon-wrap.green { background:rgba(30,201,122,.12); color:var(--green); }
    .kpi-icon-wrap.amber { background:rgba(245,166,35,.12); color:var(--amber); }
    .kpi-body { flex:1; min-width:0; }
    .kpi-value { font-family:'Syne',sans-serif; font-size:1.75rem; font-weight:700; line-height:1.1; color:var(--text-main); }
    .kpi-label { font-size:.8rem; color:var(--text-mid); margin-top:.15rem; }

    /* GRID */
    .grid-main { display:grid; grid-template-columns:1.4fr 1fr; gap:1rem; margin-bottom:1rem; }
    .grid-bottom { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

    /* CARDS */
    .card { background:var(--surface); border-radius:var(--r24); border:1px solid var(--border-light); box-shadow:var(--shadow-sm); overflow:hidden; }
    .card-head { display:flex; align-items:center; justify-content:space-between; padding:1.2rem 1.4rem .8rem; }
    .card-title { display:flex; align-items:center; gap:.5rem; font-family:'Syne',sans-serif; font-size:1rem; font-weight:700; color:var(--text-main); }
    .card-title-icon { width:30px; height:30px; background:var(--teal-ultra); border:1px solid rgba(11,191,204,.15); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:.85rem; color:var(--teal); }
    .card-link { font-size:.8rem; color:var(--teal); font-weight:600; text-decoration:none; }
    .card-body { padding:0 1.4rem 1.4rem; }

    /* LISTAS */
    .delivery-list { display:flex; flex-direction:column; gap:.6rem; }
    .delivery-item { display:flex; align-items:center; gap:.9rem; padding:.9rem 1rem; border-radius:var(--r16); background:#f7fbfc; border:1px solid transparent; transition:all .2s; }
    .delivery-item:hover { background:var(--teal-ultra); border-color:rgba(11,191,204,.2); }
    .di-icon { width:38px; height:38px; background:rgba(11,191,204,.1); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:.95rem; color:var(--teal); flex-shrink:0; }
    .di-body { flex:1; min-width:0; }
    .di-name { font-size:.88rem; font-weight:600; color:var(--text-main); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .di-sub  { font-size:.75rem; color:var(--text-mid); margin-top:.1rem; }
    .status-chip { padding:.28rem .75rem; border-radius:50px; font-size:.72rem; font-weight:700; white-space:nowrap; }
    .chip-green { background:rgba(30,201,122,.12); color:var(--green); }
    .chip-amber { background:rgba(245,166,35,.12);  color:var(--amber); }

    .history-list { display:flex; flex-direction:column; }
    .history-item { display:flex; align-items:center; gap:.9rem; padding:.8rem 1.4rem; border-bottom:1px solid var(--border-light); transition:background .15s; }
    .history-item:last-child { border-bottom:none; }
    .history-item:hover { background:#f7fbfc; }
    .hi-icon { width:34px; height:34px; background:rgba(30,201,122,.1); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:.85rem; color:var(--green); flex-shrink:0; }
    .hi-body { flex:1; min-width:0; }
    .hi-name { font-size:.86rem; font-weight:600; color:var(--text-main); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .hi-sub  { font-size:.73rem; color:var(--text-mid); }
    .hi-val  { font-size:.9rem; font-weight:700; color:var(--teal); white-space:nowrap; }

    .perf-stats { display:flex; gap:.6rem; margin:0 1.4rem .8rem; }
    .ps-item { flex:1; text-align:center; padding:.6rem .5rem; background:#f7fbfc; border-radius:var(--r12); border:1px solid var(--border-light); }
    .ps-val { font-family:'Syne',sans-serif; font-size:1.1rem; font-weight:700; color:var(--teal); }
    .ps-lbl { font-size:.7rem; color:var(--text-mid); margin-top:.1rem; }
    .chart-wrap { height:160px; padding:0 1.4rem 1.2rem; }

    .empty-state { text-align:center; padding:2rem; color:var(--text-dim); font-style:italic; }

    @keyframes fadeUp { from{transform:translateY(16px);opacity:0;} to{transform:translateY(0);opacity:1;} }
    @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:.4;} }

    @media (max-width:1200px) { .grid-main, .grid-bottom { grid-template-columns:1fr; } .kpi-row { grid-template-columns:repeat(2,1fr); } }
    @media (max-width:900px) { .sidebar { display:none; } .main { margin-left:0; } .kpi-row { grid-template-columns:1fr; } }
  </style>
</head>
<body>
<div class="layout">

  <!-- Sidebar (include) -->
  @include('entregadores.dashboard.sidebar')

  <main class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <div>
          <div class="topbar-greeting">Paínel Administrativo</div>
          <div class="topbar-sub">{{ Carbon\Carbon::now()->translatedFormat('l, d \d\e F \d\e Y') }}</div>
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
        <div class="kpi-icon-wrap teal"><i class="bi bi-truck"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ $entregasEmAndamento->count() }}</div>
          <div class="kpi-label">Entregas em andamento</div>
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap green"><i class="bi bi-cash-stack"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ number_format($ganhosHoje, 0, ',', '.') }} Kz</div>
          <div class="kpi-label">Ganhos hoje</div>
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap amber"><i class="bi bi-clock-history"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ $totalEntregas }}</div>
          <div class="kpi-label">Total de entregas</div>
        </div>
      </div>
    </div>

    <div class="grid-main">
      <!-- Entregas em Andamento (REAL) -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-activity"></i></div>
            Entregas em Andamento
          </div>
          <a href="{{ route('entregas.entregadores') }}" class="card-link">Ver todas</a>
        </div>
        <div class="card-body">
          @if($entregasEmAndamento->count())
            <div class="delivery-list">
              @foreach($entregasEmAndamento as $entrega)
                <div class="delivery-item">
                  <div class="di-icon"><i class="bi bi-shop"></i></div>
                  <div class="di-body">
                    <div class="di-name">{{ $entrega->pedido->farmacia->name ?? 'Farmácia' }} → {{ $entrega->endereco_entrega ?? '—' }}</div>
                    <div class="di-sub">Cliente: {{ $entrega->pedido->user->name ?? '—' }} · {{ $entrega->pedido->items->count() }} itens · {{ number_format($entrega->taxa_entrega, 0, ',', '.') }} Kz</div>
                  </div>
                  <span class="status-chip chip-green">Em andamento</span>
                </div>
              @endforeach
            </div>
          @else
            <div class="empty-state">Nenhuma entrega em andamento no momento.</div>
          @endif
        </div>
      </div>

      <!-- Resumo de Desempenho (em vez do mapa removido) -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-bar-chart-steps"></i></div>
            Desempenho Geral
          </div>
        </div>
        <div class="card-body">
          <div class="perf-stats" style="margin:0 0 1rem 0;">
            <div class="ps-item">
              <div class="ps-val">{{ $taxaConclusao }}%</div>
              <div class="ps-lbl">Taxa de sucesso</div>
            </div>
            <div class="ps-item">
              <div class="ps-val">{{ $totalConcluidas }}</div>
              <div class="ps-lbl">Entregas concluídas</div>
            </div>
          </div>
          <div class="chart-wrap">
            <canvas id="perfChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="grid-bottom">
      <!-- Últimas Entregas (REAL) -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-check2-circle"></i></div>
            Últimas Entregas
          </div>
          <a href="{{ route('entregas.entregadores') }}" class="card-link">Histórico</a>
        </div>
        <div class="scroller" style="max-height: 260px; overflow-y: auto;">
          <div class="history-list">
            @forelse($lastEntregas as $entrega)
              <div class="history-item">
                <div class="hi-icon"><i class="bi bi-check-lg"></i></div>
                <div class="hi-body">
                  <div class="hi-name">{{ $entrega->pedido->farmacia->name ?? 'Farmácia' }} → {{ $entrega->endereco_entrega ?? '—' }}</div>
                  <div class="hi-sub">{{ $entrega->data_entrega ? Carbon\Carbon::parse($entrega->data_entrega)->format('d/m · H:i') : 'Data pendente' }} · {{ $entrega->pedido->items->count() }} {{ Str::plural('item', $entrega->pedido->items->count()) }}</div>
                </div>
                <div class="hi-val">{{ number_format($entrega->taxa_entrega, 0, ',', '.') }} Kz</div>
              </div>
            @empty
              <div class="empty-state">Sem nenhuma entrega concluída.</div>
            @endforelse
          </div>
        </div>
      </div>

      <!-- Desempenho Semanal (gráfico com dados reais) -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-graph-up"></i></div>
            Evolução Semanal
          </div>
        </div>
        <div class="chart-wrap" style="height:200px;">
          <canvas id="weeklyChart"></canvas>
        </div>
      </div>
    </div>

  </main>
</div>

<script>
  // Gráfico de desempenho semanal (dados reais do backend)
  const semanas = @json($semanas);
  const percentuais = @json($percentuais);

  new Chart(document.getElementById('weeklyChart').getContext('2d'), {
    type: 'line',
    data: {
      labels: semanas,
      datasets: [{
        data: percentuais,
        borderColor: '#0bbfcc',
        backgroundColor: 'rgba(11,191,204,0.08)',
        borderWidth: 2,
        tension: .4,
        fill: true,
        pointBackgroundColor: '#0bbfcc',
        pointRadius: 4,
        pointBorderColor: '#fff',
        pointBorderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#09161a',
          titleColor: '#fff',
          bodyColor: 'rgba(255,255,255,.7)',
          callbacks: { label: (v) => ` ${v.raw}% de entregas concluídas` }
        }
      },
      scales: {
        y: {
          min: 0,
          max: 100,
          ticks: { callback: v => v + '%', font: { size: 10 }, color: '#8fadb5' },
          grid: { color: 'rgba(0,0,0,.04)' }
        },
        x: { ticks: { font: { size: 10 }, color: '#8fadb5' }, grid: { display: false } }
      }
    }
  });

  // (Opcional) Gráfico de desempenho anterior (mantido para compatibilidade, mas não usado)
  // Pode removê-lo se quiser, mas deixamos apenas o weeklyChart.
</script>

</body>
</html>