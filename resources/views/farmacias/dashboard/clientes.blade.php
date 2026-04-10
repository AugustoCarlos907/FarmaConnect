<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Clientes</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:        #0899a6;
      --accent-2:      #05707a;
      --accent-light:  #e6f7f8;
      --accent-mid:    #b2e8ec;
      --danger:        #d94040;
      --danger-light:  #fdecea;
      --warning:       #d97706;
      --warning-light: #fef3c7;
      --success:       #16a34a;
      --success-light: #dcfce7;
      --bg:            #f1f5f9;
      --surface:       #ffffff;
      --surface-2:     #f8fafc;
      --border:        #e2e8f0;
      --border-strong: #cbd5e1;
      --text:          #0f172a;
      --text-2:        #334155;
      --text-3:        #64748b;
      --text-4:        #94a3b8;
      --shadow-md:     0 4px 16px rgba(0,0,0,.08);
      --topbar-h:      52px;
      --r-sm: 6px; --r-md: 10px; --r-lg: 14px; --r-xl: 18px;
    }

    html { font-size: 13px; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; -webkit-font-smoothing: antialiased; }
    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ─────────────────────────── */
    .sidebar { width: 220px; flex-shrink: 0; background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; z-index: 200; }
    .sidebar-header { height: var(--topbar-h); min-height: var(--topbar-h); flex-shrink: 0; display: flex; align-items: center; padding: 0 16px; border-bottom: 1px solid var(--border); }
    .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; }
    .logo-mark { width: 28px; height: 28px; background: var(--accent); border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo-mark svg { width: 14px; height: 14px; fill: #fff; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); } .logo-text .c { color: var(--text); }

    .sidebar-body { flex: 1; overflow-y: auto; padding: 8px 0 12px; }
    .sidebar-body::-webkit-scrollbar { width: 0; }
    .nav-section { padding: 0 8px; }
    .nav-label { font-size: 0.67rem; font-weight: 600; color: var(--text-4); text-transform: uppercase; letter-spacing: .07em; padding: 10px 8px 4px; display: block; }
    .nav-item { display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: var(--r-md); font-size: 0.82rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: background .1s, color .1s; border: none; background: none; width: 100%; text-align: left; font-family: 'DM Sans', sans-serif; text-decoration: none; margin-bottom: 1px; }
    .nav-item i { font-size: 0.88rem; width: 15px; text-align: center; flex-shrink: 0; }
    .nav-item:hover { background: var(--surface-2); color: var(--text); }
    .nav-item.active { background: var(--accent-light); color: var(--accent); font-weight: 600; }
    .nav-item.active i { color: var(--accent); }
    .nav-badge { margin-left: auto; font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; line-height: 1.5; }
    .nb-red { background: var(--danger-light); color: var(--danger); }
    .nb-amber { background: var(--warning-light); color: var(--warning); }
    .nb-teal { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate { background: #f1f5f9; color: var(--text-3); }
    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .chevron { margin-left: auto; font-size: 0.68rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }
    .nav-divider { height: 1px; background: var(--border); margin: 6px 12px; }
    .sidebar-footer { flex-shrink: 0; padding: 8px; border-top: 1px solid var(--border); }
    .ph-card { padding: 10px 11px; background: var(--accent-light); border-radius: var(--r-lg); }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill { font-size: 0.62rem; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .pill-open { background: #dcfce7; color: #15803d; }
    .ph-meta { font-size: 0.7rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }

    /* Logout button */
    .logout-form {
        margin-top: 12px;
    }

    .logout-btn {
        color: var(--danger);
    }

    .logout-btn i {
        color: var(--danger);
    }

    .logout-btn:hover {
        background: var(--danger-light);
        color: var(--danger);
    }

    .logout-btn:hover i {
        color: var(--danger);
    }
    /* ─── MAIN ────────────────────────────── */
    .main { flex: 1; margin-left: 220px; display: flex; flex-direction: column; min-height: 100vh; }
    .topbar { background: var(--surface); border-bottom: 1px solid var(--border); padding: 0 22px; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; flex-shrink: 0; }
    .tb-left { display: flex; align-items: center; gap: 8px; }
    .tb-left h1 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .tb-sep { color: var(--text-4); }
    .tb-sub { font-size: 0.78rem; color: var(--text-3); }
    .tb-right { display: flex; align-items: center; gap: 7px; }
    .ib { width: 30px; height: 30px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; color: var(--text-3); transition: all .1s; position: relative; }
    .ib:hover { background: var(--surface-2); color: var(--text); }
    .ib-dot { position: absolute; top: 5px; right: 5px; width: 5px; height: 5px; background: var(--danger); border-radius: 50%; border: 1.5px solid var(--surface); }
    .user-chip { display: flex; align-items: center; gap: 7px; padding: 3px 10px 3px 4px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); cursor: pointer; font-size: 0.77rem; }
    .u-av { width: 22px; height: 22px; border-radius: 5px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; display: block; }
    .u-role { font-size: 0.67rem; color: var(--text-3); display: block; }

    /* ─── CONTENT ─────────────────────────── */
    .content { padding: 18px 22px; flex: 1; display: flex; flex-direction: column; }

    /* ─── BUTTONS ─────────────────────────── */
    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; white-space: nowrap; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-icon { padding: 5px 8px; }

    /* ─── KPI ROW ─────────────────────────── */
    .kpi-row { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 11px; margin-bottom: 16px; }
    .kpi { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 13px 15px; position: relative; overflow: hidden; transition: border-color .15s, box-shadow .15s, transform .1s; }
    .kpi::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; border-radius: var(--r-xl) 0 0 var(--r-xl); }
    .kpi.k-teal::before   { background: var(--accent); }
    .kpi:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .kpi-head { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 9px; }
    .kpi-ico { width: 32px; height: 32px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; font-size: 0.88rem; }
    .kpi-ico.teal   { background: var(--accent-light); color: var(--accent); }
    .kpi-val { font-family: 'Sora', sans-serif; font-size: 1.55rem; font-weight: 700; line-height: 1; margin-bottom: 2px; }
    .kpi-lbl { font-size: 0.72rem; font-weight: 500; color: var(--text-3); }

    /* ─── TOOLBAR ─────────────────────────── */
    .toolbar { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; flex-wrap: wrap; }
    .toolbar-left { display: flex; align-items: center; gap: 7px; flex: 1; min-width: 0; flex-wrap: wrap; }
    .toolbar-right { display: flex; align-items: center; gap: 7px; flex-shrink: 0; }

    .search-wrap { position: relative; min-width: 220px; max-width: 320px; flex: 1; }
    .search-wrap i { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--text-4); font-size: 0.82rem; pointer-events: none; }
    .search-input { width: 100%; padding: 5px 10px 5px 30px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text); transition: border-color .1s; }
    .search-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .search-input::placeholder { color: var(--text-4); }

    .filter-select { padding: 5px 26px 5px 9px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.77rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 8px center; color: var(--text-2); cursor: pointer; appearance: none; }

    /* ─── TABLE ───────────────────────────── */
    .table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); overflow: hidden; display: flex; flex-direction: column; flex: 1; }
    .table-scroll { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 0.78rem; min-width: 700px; }
    thead tr { background: var(--surface-2); }
    th { padding: 9px 12px; text-align: left; font-size: 0.66rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); white-space: nowrap; }
    th:first-child { padding-left: 16px; }
    th:last-child { padding-right: 16px; }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .07s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface-2); }
    td { padding: 10px 12px; vertical-align: middle; color: var(--text-2); }
    td:first-child { padding-left: 16px; }
    td:last-child { padding-right: 16px; }

    /* Client cell */
    .c-cell { display: flex; align-items: center; gap: 10px; }
    .c-av { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.67rem; font-weight: 700; flex-shrink: 0; font-family: 'Sora', sans-serif; background: var(--accent-light); color: var(--accent-2); }
    .c-name { font-weight: 600; color: var(--text); margin-bottom: 1px; }

    /* Spend bar */
    .spend-bar-wrap { width: 70px; height: 4px; background: var(--border); border-radius: 10px; margin-top: 3px; }
    .spend-bar { height: 4px; border-radius: 10px; background: var(--accent); }

    /* ─── TABLE FOOTER ────────────────────── */
    .table-footer { display: flex; align-items: center; justify-content: space-between; padding: 9px 16px; border-top: 1px solid var(--border); background: var(--surface-2); font-size: 0.75rem; color: var(--text-3); flex-shrink: 0; flex-wrap: wrap; gap: 7px; }
    .tf-info { display: flex; align-items: center; gap: 9px; }
    .rows-sel { padding: 2px 20px 2px 7px; border: 1px solid var(--border); border-radius: var(--r-sm); font-size: 0.73rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 6px center; appearance: none; color: var(--text-2); cursor: pointer; }
    .pagination { display: flex; align-items: center; gap: 3px; }
    .pg-btn { min-width: 27px; height: 27px; padding: 0 5px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); font-size: 0.75rem; font-family: 'DM Sans', sans-serif; color: var(--text-3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .pg-btn:hover:not(:disabled) { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .pg-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
    .pg-btn:disabled { opacity: .35; cursor: default; }

    /* ─── EMPTY STATE ─────────────────────── */
    .empty-state { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 20px; color: var(--text-4); }
    .empty-ico { width: 50px; height: 50px; border-radius: var(--r-xl); background: var(--surface-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 10px; }
    .empty-state h3 { font-size: 0.88rem; font-weight: 600; color: var(--text-3); margin-bottom: 4px; }
    .empty-state p { font-size: 0.77rem; text-align: center; max-width: 240px; }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    @media (max-width: 1024px) { .kpi-row { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .kpi-row { grid-template-columns: repeat(2,1fr); }
      .toolbar { flex-direction: column; align-items: stretch; }
    }
  </style>
</head>
<body>
<div class="layout">

  <!-- ══ SIDEBAR ══════════════════════════════════ -->
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="logo">
            <div class="logo-mark">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 13v-2H9v-2h2V9h2v2h2v2h-2v2h-2z"/></svg>
            </div>
            <span class="logo-text"><span class="f">Farma</span><span class="c">Connect</span></span>
        </a>
    </div>

    <div class="sidebar-body">
        <div class="nav-section">
            <span class="nav-label">Principal</span>
            
            <!-- Dashboard -->
            <a href="{{ route('index.farmacias') }}" class="nav-item {{ request()->routeIs('index.farmacias') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <!-- Stock com submenu -->
            <div class="has-sub {{ request()->routeIs('medicamentos.farmacias') ? 'open' : '' }}" id="sub-stock">
                <div class="nav-item" onclick="toggleSub('sub-stock')">
                    <i class="bi bi-archive"></i>
                    <span>Stock</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <a href="{{ route('medicamentos.farmacias') }}" class="sub-item {{ request()->routeIs('medicamentos.farmacias') ? 'active-sub' : '' }}">
                        <i class="bi bi-list-ul"></i>
                        <span>Lista de produtos</span>
                    </a>
                    {{-- <div class="sub-item">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Stock baixo</span>
                    </div> --}}
                </div>
            </div>

            <!-- Pedidos -->
            <a href="{{ route('pedidos.farmacias') }}" class="nav-item {{ request()->routeIs('pedidos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Pedidos</span>

            </a>

            <!-- Entregadores -->
            <a href="{{ route('entregadores.farmacias') }}" class="nav-item {{ request()->routeIs('entregadores.farmacias') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Entregadores</span>

            </a>

            <!-- Clientes -->
            <a href="{{ route('clientes.farmacias') }}" class="nav-item {{ request()->routeIs('clientes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>

            <!-- Avaliações -->
            <a href="{{ route('avaliacoes.farmacias') }}" class="nav-item {{ request()->routeIs('avaliacoes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-star"></i>
                <span>Avaliações</span>

            </a>

            <span class="nav-label">Gestão</span>

            <!-- Documentos -->
            <a href="{{ route('documentos.farmacias') }}" class="nav-item {{ request()->routeIs('documentos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Documentos</span>
            </a>

            <!-- Configurações com submenu -->
            <div class="has-sub" id="sub-cfg">
                <div class="nav-item" onclick="toggleSub('sub-cfg')">
                    <i class="bi bi-gear"></i>
                    <span>Configurações</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <div class="sub-item">
                        <i class="bi bi-person"></i>
                        <span>Perfil</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-shop"></i>
                        <span>Farmácia</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-clock"></i>
                        <span>Horário</span>
                    </div>
                </div>
            </div>

            <!-- Sair -->
            <form action="{{ route('logout', ['id'=>Auth::user()->id]) }}" method="post" class="logout-form">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </div>

    <div class="sidebar-footer">
        @php
            $farmacia = Auth::user()->farmacia;
        @endphp
        <div class="ph-card">
            <div class="ph-row">
                <span class="ph-name">{{ $farmacia->name ?? 'Farmácia' }}</span>
                <span class="ph-pill pill-open">{{ $farmacia->status ?? 'Aberta' }}</span>
            </div>
            <p class="ph-meta"><i class="bi bi-geo-alt"></i> {{ $farmacia->endereco ?? '—' }}</p>
            <p class="ph-meta"><i class="bi bi-clock"></i> {{ $farmacia->horario_abertura ?? '08:00' }} - {{ $farmacia->horario_fechamento ?? '22:00' }}</p>
            <p class="ph-meta" style="opacity:.55;font-size:.65rem;margin-top:2px"><i class="bi bi-building"></i> {{ $farmacia->company ?? 'FarmaConnect' }}</p>
        </div>
    </div>
</aside>
  <!-- ══ MAIN ══════════════════════════════════════ -->
  <div class="main">
    <header class="topbar">
      <div class="tb-left">
        <h1>Clientes</h1>
        <span class="tb-sep">/</span>
        <span class="tb-sub" id="topbar-date">—</span>
      </div>
      <div class="tb-right">
        <div class="ib"><i class="bi bi-search"></i></div>
        <div class="ib"><i class="bi bi-bell"></i><span class="ib-dot"></span></div>
        <div class="user-chip">
          <div class="u-av">FC</div>
          <div><span class="u-name">{{Auth::user()->farmacia->name ?? 'FC'}}</span><span class="u-role">{{Auth::user()->name ?? 'Farmacêutico'}}</span></div>
        </div>
      </div>
    </header>

    <div class="content">

      @php
        $totalClientes = $clientes->total();
        $totalPedidos = $clientes->sum(function($cliente) {
            return $cliente->pedidos->where('farmacia_id' , Auth::user()->farmacia->id)->count();
        });
        $totalGasto = $clientes->sum(function($cliente) {
            return $cliente->pedidos->sum('total');
        });
      @endphp

      <!-- ─── KPIs ──────────────────────────────── -->
      <div class="kpi-row">
        <div class="kpi k-teal">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-people"></i></div></div>
          <div class="kpi-val">{{ $totalClientes }}</div>
          <div class="kpi-lbl">Total de clientes</div>
        </div>
        <div class="kpi k-teal">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-cart"></i></div></div>
          <div class="kpi-val">{{ $totalPedidos }}</div>
          <div class="kpi-lbl">Total de pedidos</div>
        </div>
        <div class="kpi k-teal">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-cash-stack"></i></div></div>
          <div class="kpi-val">{{ number_format($totalGasto, 0, ',', '.') }} Kz</div>
          <div class="kpi-lbl">Gasto total</div>
        </div>
        <div class="kpi k-teal">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-calculator"></i></div></div>
          <div class="kpi-val">{{ $totalClientes > 0 ? number_format($totalGasto / $totalClientes, 0, ',', '.') : 0 }} Kz</div>
          <div class="kpi-lbl">Gasto médio/cliente</div>
        </div>
      </div>

      <!-- ─── TOOLBAR ───────────────────────────── -->
      <div class="toolbar">
        <div class="toolbar-left">
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Pesquisar por nome…" oninput="filterClients()">
          </div>
        </div>
        <div class="toolbar-right">
          <select class="filter-select" id="sortSel" onchange="filterClients()">
            <option value="name">Nome A→Z</option>
            <option value="pedidos-desc">Mais pedidos</option>
            <option value="gasto-desc" selected>Maior gasto</option>
          </select>
          {{-- <button class="btn btn-outline btn-icon" style="background-color: #0899a6;color:white " title="Exportar" onclick="alert('Exportar clientes — integrar API')"><i class="bi bi-download"></i>Imprimir Relatório</button> --}}
        </div>
      </div>

      <!-- ─── TABLE ─────────────────────────────── -->
      <div class="table-wrap" id="tableWrap">
        <div class="table-scroll">
          <table>
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Nº Pedidos</th>
                <th>Gasto Total</th>
                <th>Endereço</th>
              </tr>
            </thead>
            <tbody id="clientsBody">
              @forelse($clientes as $cliente)
                @php
                  $pedidos = $cliente->pedidos ?? collect();
                  $totalPedidosCliente = $cliente->pedidos->where('farmacia_id', Auth::user()->farmacia->id)->count();
                  $totalGastoCliente = $pedidos->sum('total');
                  $endereco = $pedidos->first()->endereco ?? '—';
                  $iniciais = implode('', array_map(function($n) { return $n[0] ?? ''; }, explode(' ', $cliente->name)));
                  $maxGasto = $clientes->max(function($c) { return $c->pedidos->sum('total'); }) ?: 1;
                  $barPct = $maxGasto > 0 ? min(100, round(($totalGastoCliente / $maxGasto) * 100)) : 0;
                @endphp
                <tr>
                  <td>
                    <div class="c-cell">
                      <div class="c-av">{{ $iniciais }}</div>
                      <div class="c-name">{{ $cliente->name }}</div>
                    </div>
                  </td>
                  <td>
                    <span style="font-family:'Sora',sans-serif;font-weight:700;font-size:.85rem">{{ $totalPedidosCliente }}</span>
                  </td>
                  <td>
                    <div style="font-family:'Sora',sans-serif;font-weight:600;font-size:.82rem">{{ number_format($totalGastoCliente, 0, ',', '.') }} Kz</div>
                    <div class="spend-bar-wrap"><div class="spend-bar" style="width:{{ $barPct }}%"></div></div>
                  </td>
                  <td style="color:var(--text-3);font-size:.77rem">{{ $cliente->endereco }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" style="text-align:center;padding:32px;color:var(--text-4)">
                    Nenhum cliente encontrado
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="table-footer">
          <div class="tf-info">
            <span>Mostrar</span>
            <select class="rows-sel" id="rowsPerPage" onchange="changePage(1)">
              <option value="15">15</option>
              <option value="25" selected>25</option>
              <option value="50">50</option>
            </select>
            <span>por página &nbsp;·&nbsp; <span id="pageInfo">{{ $clientes->firstItem() ?? 0 }}–{{ $clientes->lastItem() ?? 0 }} de {{ $clientes->total() }}</span></span>
          </div>
          <div class="pagination" id="pagination">
            {{ $clientes->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ══ DADOS DO BACKEND ═══════════════════════════ */
let allClients = @json($clientes->items()).map(c => ({
  id: c.id,
  nome: c.name,
  iniciais: c.name ? c.name.split(' ').map(n => n[0] || '').join('').substring(0,2).toUpperCase() : '--',
  pedidos: c.pedidos || [],
  totalPedidos: (c.pedidos || []).length,
  totalGasto: (c.pedidos || []).reduce((sum, p) => sum + (p.total || 0), 0),
  endereco: c.pedidos && c.pedidos.length > 0 ? c.pedidos[0].endereco : '—'
}));

/* ══ STATE ══════════════════════════════════════════ */
let filtered    = [...allClients];
let currentPage = 1;
let currentSort = { key: 'gasto', dir: 'desc' };

/* ══ DATE ════════════════════════════════════════════ */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const now = new Date();
document.getElementById('topbar-date').textContent = `${DIAS[now.getDay()]}, ${now.getDate()} de ${MESES[now.getMonth()]} de ${now.getFullYear()}`;

/* ══ FILTER & SORT ══════════════════════════════════ */
function filterClients() {
  const q = document.getElementById('searchInput').value.trim().toLowerCase();
  const sort = document.getElementById('sortSel').value;
  
  filtered = allClients.filter(c => {
    return !q || c.nome.toLowerCase().includes(q);
  });

  filtered.sort((a, b) => {
    if (sort === 'name') return a.nome.localeCompare(b.nome);
    if (sort === 'pedidos-desc') return b.totalPedidos - a.totalPedidos;
    if (sort === 'gasto-desc') return b.totalGasto - a.totalGasto;
    return 0;
  });

  currentPage = 1;
  render();
}

function getRPP() { return parseInt(document.getElementById('rowsPerPage').value); }

function render() {
  const rpp = getRPP();
  const total = filtered.length;
  const pages = Math.max(1, Math.ceil(total / rpp));
  if (currentPage > pages) currentPage = pages;
  const start = (currentPage - 1) * rpp;
  const slice = filtered.slice(start, start + rpp);

  const tbody = document.getElementById('clientsBody');
  tbody.innerHTML = '';

  const maxGasto = Math.max(...allClients.map(c => c.totalGasto), 1);

  slice.forEach(c => {
    const barPct = Math.min(100, Math.round((c.totalGasto / maxGasto) * 100));
    
    tbody.innerHTML += `
      <tr>
        <td>
          <div class="c-cell">
            <div class="c-av">${c.iniciais}</div>
            <div class="c-name">${c.nome}</div>
          </div>
        </td>
        <td>
          <span style="font-family:'Sora',sans-serif;font-weight:700;font-size:.85rem">${c.totalPedidos}</span>
        </td>
        <td>
          <div style="font-family:'Sora',sans-serif;font-weight:600;font-size:.82rem">${c.totalGasto.toLocaleString('pt-AO')} Kz</div>
          <div class="spend-bar-wrap"><div class="spend-bar" style="width:${barPct}%"></div></div>
        </td>
        <td style="color:var(--text-3);font-size:.77rem">${c.endereco}</td>
      </tr>`;
  });

  const end = Math.min(start + rpp, total);
  document.getElementById('pageInfo').textContent = total === 0 
    ? '0 resultados' 
    : `${start+1}–${end} de ${total}`;
}

function changePage(p) { currentPage = p; render(); }

/* ══ SIDEBAR ════════════════════════════════════════ */
function setActive(el) {
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}

function toggleSub(id) { 
  document.getElementById(id).classList.toggle('open'); 
}

/* ══ INIT ════════════════════════════════════════════ */
render();
</script>
</body>
</html>