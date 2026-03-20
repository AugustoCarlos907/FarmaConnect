<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Avaliações</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
      --purple:        #7c3aed;
      --purple-light:  #ede9fe;
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
    .content { padding: 18px 22px; flex: 1; }

    /* ─── BUTTONS ─────────────────────────── */
    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; white-space: nowrap; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-ghost { background: none; color: var(--text-3); border-color: transparent; }
    .btn-ghost:hover { background: var(--surface-2); color: var(--text); border-color: var(--border); }
    .btn-icon { padding: 5px 8px; }

    /* ─── KPI ROW ─────────────────────────── */
    .kpi-row { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 11px; margin-bottom: 18px; }
    .kpi { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 13px 15px; position: relative; overflow: hidden; transition: border-color .15s, box-shadow .15s, transform .1s; cursor: pointer; }
    .kpi::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; border-radius: var(--r-xl) 0 0 var(--r-xl); }
    .kpi:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .kpi.k-gold::before   { background: #f59e0b; }
    .kpi.k-teal::before   { background: var(--accent); }
    .kpi-head { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 9px; }
    .kpi-ico { width: 32px; height: 32px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; font-size: 0.88rem; }
    .kpi-ico.gold   { background: #fef3c7; color: #d97706; }
    .kpi-ico.teal   { background: var(--accent-light); color: var(--accent); }
    .kpi-val { font-family: 'Sora', sans-serif; font-size: 1.55rem; font-weight: 700; line-height: 1; margin-bottom: 2px; }
    .kpi-lbl { font-size: 0.72rem; font-weight: 500; color: var(--text-3); }

    /* ─── LAYOUT PRINCIPAL ────────────────── */
    .main-grid {
      display: grid;
      grid-template-columns: 340px 1fr;
      gap: 16px;
      align-items: start;
    }

    /* ─── PAINEL ESQUERDO ─────────────────── */
    .panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); overflow: hidden; }
    .panel-head { padding: 14px 16px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .panel-head h3 { font-size: 0.82rem; font-weight: 600; color: var(--text); display: flex; align-items: center; gap: 6px; }
    .panel-head h3 i { color: var(--text-3); }

    /* Score global */
    .score-block { padding: 18px 16px 14px; border-bottom: 1px solid var(--border); }
    .score-big { display: flex; align-items: flex-end; gap: 10px; margin-bottom: 10px; }
    .score-num { font-family: 'Sora', sans-serif; font-size: 3rem; font-weight: 700; color: var(--text); line-height: 1; }
    .score-stars { display: flex; gap: 3px; margin-bottom: 4px; }
    .score-stars i { font-size: 1.1rem; color: #f59e0b; }
    .score-count { font-size: 0.72rem; color: var(--text-3); }

    /* Barras de distribuição */
    .dist-block { padding: 12px 16px; border-bottom: 1px solid var(--border); }
    .dist-row { display: flex; align-items: center; gap: 8px; padding: 3px 0; }
    .dist-lbl { display: flex; align-items: center; gap: 3px; font-size: 0.72rem; color: var(--text-3); width: 32px; flex-shrink: 0; }
    .dist-lbl i { font-size: 0.6rem; color: #f59e0b; }
    .dist-track { flex: 1; height: 6px; background: var(--border); border-radius: 10px; overflow: hidden; }
    .dist-fill { height: 6px; border-radius: 10px; background: #f59e0b; transition: width .4s; }
    .dist-num { font-size: 0.7rem; color: var(--text-3); width: 28px; text-align: right; flex-shrink: 0; }

    /* Gráfico tendência */
    .trend-block { padding: 14px 16px; }
    .trend-block h4 { font-size: 0.75rem; font-weight: 600; color: var(--text-2); margin-bottom: 10px; }
    .chart-mini { height: 80px; position: relative; }

    /* ─── PAINEL DIREITO — lista ──────────── */
    .list-toolbar { display: flex; align-items: center; gap: 8px; padding: 12px 16px; border-bottom: 1px solid var(--border); flex-wrap: wrap; }

    .search-wrap { position: relative; flex: 1; min-width: 180px; }
    .search-wrap i { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--text-4); font-size: 0.82rem; pointer-events: none; }
    .search-input { width: 100%; padding: 5px 10px 5px 30px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text); transition: border-color .1s; }
    .search-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .search-input::placeholder { color: var(--text-4); }

    /* Star filter pills */
    .star-pills { display: flex; gap: 4px; }
    .sp { padding: 4px 9px; font-size: 0.73rem; font-weight: 600; color: var(--text-3); cursor: pointer; border: 1px solid var(--border); background: var(--surface); border-radius: var(--r-sm); transition: all .1s; white-space: nowrap; display: flex; align-items: center; gap: 3px; font-family: 'DM Sans', sans-serif; }
    .sp:hover { border-color: #f59e0b; color: #d97706; background: #fef3c7; }
    .sp.active { background: #f59e0b; border-color: #f59e0b; color: #fff; }
    .sp i { font-size: 0.65rem; }

    .filter-select { padding: 5px 26px 5px 9px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.77rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 8px center; color: var(--text-2); cursor: pointer; appearance: none; transition: border-color .1s; }
    .filter-select:focus { outline: none; border-color: var(--accent); }

    /* ─── REVIEW CARDS ────────────────────── */
    .reviews-list { padding: 12px 16px; display: flex; flex-direction: column; gap: 10px; }

    .review-card { background: var(--surface-2); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 14px; transition: border-color .15s, box-shadow .1s; }
    .review-card:hover { border-color: var(--border-strong); box-shadow: var(--shadow-md); }

    /* Cabeçalho do card */
    .rc-head { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px; }
    .rc-av { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Sora', sans-serif; font-size: 0.72rem; font-weight: 700; flex-shrink: 0; }
    .rc-info { flex: 1; min-width: 0; }
    .rc-name { font-weight: 600; font-size: 0.82rem; color: var(--text); margin-bottom: 2px; }
    .rc-meta { font-size: 0.68rem; color: var(--text-4); display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .rc-meta span { display: flex; align-items: center; gap: 3px; }
    .rc-stars { display: flex; gap: 2px; flex-shrink: 0; }
    .rc-stars i { font-size: 0.72rem; }
    .star-full  { color: #f59e0b; }
    .star-empty { color: var(--border); }

    /* Corpo do review */
    .rc-body { font-size: 0.8rem; color: var(--text-2); line-height: 1.55; margin-bottom: 0; }

    /* ─── EMPTY STATE ─────────────────────── */
    .empty-state { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 20px; color: var(--text-4); }
    .empty-ico { width: 52px; height: 52px; border-radius: var(--r-xl); background: var(--surface-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 12px; }
    .empty-state h3 { font-size: 0.9rem; font-weight: 600; color: var(--text-3); margin-bottom: 4px; }
    .empty-state p { font-size: 0.77rem; text-align: center; max-width: 240px; }

    /* ─── PAGINATION ──────────────────────── */
    .pagination-wrap { display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; border-top: 1px solid var(--border); background: var(--surface-2); font-size: 0.75rem; color: var(--text-3); flex-wrap: wrap; gap: 7px; }
    .pagination { display: flex; gap: 3px; }
    .pg-btn { min-width: 28px; height: 28px; padding: 0 6px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); font-size: 0.75rem; font-family: 'DM Sans', sans-serif; color: var(--text-3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .pg-btn:hover:not(:disabled) { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .pg-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
    .pg-btn:disabled { opacity: .35; cursor: default; }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    @media (max-width: 1280px) {
      .main-grid { grid-template-columns: 300px 1fr; }
      .kpi-row   { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width: 1024px) {
      .main-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .kpi-row { grid-template-columns: repeat(2,1fr); }
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
                    <div class="sub-item">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Stock baixo</span>
                    </div>
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
        <h1>Avaliações</h1>
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

      <!-- ─── KPIs ──────────────────────────────── -->
      @php
        $totalAvaliacoes = $avaliacoes->count();
        $mediaAvaliacoes = $totalAvaliacoes > 0 ? number_format($avaliacoes->avg('classificacao'), 1) : 0;
        
        $count5 = $avaliacoes->where('classificacao', 5)->count();
        $count4 = $avaliacoes->where('classificacao', 4)->count();
        $count3 = $avaliacoes->where('classificacao', 3)->count();
        $count2 = $avaliacoes->where('classificacao', 2)->count();
        $count1 = $avaliacoes->where('classificacao', 1)->count();
        
        $percent5 = $totalAvaliacoes > 0 ? round(($count5 / $totalAvaliacoes) * 100) : 0;
        $percent4 = $totalAvaliacoes > 0 ? round(($count4 / $totalAvaliacoes) * 100) : 0;
        $percent3 = $totalAvaliacoes > 0 ? round(($count3 / $totalAvaliacoes) * 100) : 0;
        $percent2 = $totalAvaliacoes > 0 ? round(($count2 / $totalAvaliacoes) * 100) : 0;
        $percent1 = $totalAvaliacoes > 0 ? round(($count1 / $totalAvaliacoes) * 100) : 0;
      @endphp

      <div class="kpi-row">
        <div class="kpi k-gold">
          <div class="kpi-head"><div class="kpi-ico gold"><i class="bi bi-star-fill"></i></div></div>
          <div class="kpi-val">{{ $mediaAvaliacoes }}</div>
          <div class="kpi-lbl">Nota média geral</div>
        </div>
        <div class="kpi k-teal">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-chat-left-text"></i></div></div>
          <div class="kpi-val">{{ $totalAvaliacoes }}</div>
          <div class="kpi-lbl">Total de avaliações</div>
        </div>
      </div>

      <!-- ─── LAYOUT PRINCIPAL ──────────────────── -->
      <div class="main-grid">

        <!-- ══ PAINEL ESQUERDO ════════════════════ -->
        <div style="display:flex;flex-direction:column;gap:14px">
          <div class="panel">
            <div class="panel-head">
              <h3><i class="bi bi-pie-chart"></i> Distribuição por estrelas</h3>
            </div>
            <div class="dist-block">
              <div class="dist-row">
                <span class="dist-lbl">5★</span>
                <div class="dist-track"><div class="dist-fill" style="width:{{ $percent5 }}%"></div></div>
                <span class="dist-num">{{ $count5 }}</span>
              </div>
              <div class="dist-row">
                <span class="dist-lbl">4★</span>
                <div class="dist-track"><div class="dist-fill" style="width:{{ $percent4 }}%"></div></div>
                <span class="dist-num">{{ $count4 }}</span>
              </div>
              <div class="dist-row">
                <span class="dist-lbl">3★</span>
                <div class="dist-track"><div class="dist-fill" style="width:{{ $percent3 }}%"></div></div>
                <span class="dist-num">{{ $count3 }}</span>
              </div>
              <div class="dist-row">
                <span class="dist-lbl">2★</span>
                <div class="dist-track"><div class="dist-fill" style="width:{{ $percent2 }}%"></div></div>
                <span class="dist-num">{{ $count2 }}</span>
              </div>
              <div class="dist-row">
                <span class="dist-lbl">1★</span>
                <div class="dist-track"><div class="dist-fill" style="width:{{ $percent1 }}%"></div></div>
                <span class="dist-num">{{ $count1 }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- ══ PAINEL DIREITO — lista ══════════════ -->
        <div class="panel" style="display:flex;flex-direction:column">
          <div class="list-toolbar">
            <div class="search-wrap">
              <i class="bi bi-search"></i>
              <input type="text" class="search-input" id="searchInput"
                     placeholder="Pesquisar avaliações…" oninput="filterReviews()">
            </div>

            <!-- Filtro por estrelas -->
            <div class="star-pills">
              <button class="sp active" data-stars="0" onclick="setStarFilter(this,0)">Todas</button>
              <button class="sp" data-stars="5" onclick="setStarFilter(this,5)">
                <i class="bi bi-star-fill"></i> 5
              </button>
              <button class="sp" data-stars="4" onclick="setStarFilter(this,4)">
                <i class="bi bi-star-fill"></i> 4
              </button>
              <button class="sp" data-stars="3" onclick="setStarFilter(this,3)">
                <i class="bi bi-star-fill"></i> 3
              </button>
              <button class="sp" data-stars="2" onclick="setStarFilter(this,2)">
                <i class="bi bi-star-fill"></i> ≤2
              </button>
            </div>

            <select class="filter-select" id="sortFilter" onchange="filterReviews()">
              <option value="newest">Mais recentes</option>
              <option value="oldest">Mais antigas</option>
              <option value="highest">Nota mais alta</option>
              <option value="lowest">Nota mais baixa</option>
            </select>
          </div>

          <!-- Lista de reviews -->
          <div class="reviews-list" id="reviewsList">
            @forelse($avaliacoes as $avaliacao)
              @php
                $user = $avaliacao->user;
                $iniciais = $user ? implode('', array_map(function($n) { return $n[0] ?? ''; }, explode(' ', $user->name))) : '--';
                $cores = ['#fdecea','#faeeda','#e6f7f8','#dcfce7','#ede9fe','#fce7f3','#fef3c7','#f1f5f9'];
                $cor = $cores[$avaliacao->id % count($cores)];
              @endphp
              <div class="review-card" data-id="{{ $avaliacao->id }}">
                <div class="rc-head">
                  <div class="rc-av" style="background:{{ $cor }};color:#334155">{{ $iniciais }}</div>
                  <div class="rc-info">
                    <div class="rc-name">{{ $user->name ?? 'Cliente' }}</div>
                    <div class="rc-meta">
                      <span><i class="bi bi-calendar3"></i>{{ $avaliacao->created_at->format('d M Y') }}</span>
                    </div>
                  </div>
                  <div class="rc-stars">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="bi bi-star{{ $i <= $avaliacao->classificacao ? '-fill' : '' }} {{ $i <= $avaliacao->classificacao ? 'star-full' : 'star-empty' }}"></i>
                    @endfor
                  </div>
                </div>
                <div class="rc-body">{{ $avaliacao->comentario ?? 'Sem comentário' }}</div>
              </div>
            @empty
              <div class="empty-state" style="display:flex">
                <div class="empty-ico"><i class="bi bi-star"></i></div>
                <h3>Nenhuma avaliação encontrada</h3>
                <p>Ainda não há avaliações para esta farmácia.</p>
              </div>
            @endforelse
          </div>

          <!-- Pagination -->
          <div class="pagination-wrap" id="paginationWrap">
            <span id="pageInfo">{{ $avaliacoes->firstItem() ?? 0 }}–{{ $avaliacoes->lastItem() ?? 0 }} de {{ $avaliacoes->total() }} avaliações</span>
            <div class="pagination" id="pagination">
              {{ $avaliacoes->links() }}
            </div>
          </div>
        </div>

      </div>{{-- /main-grid --}}

    </div>{{-- /content --}}
  </div>{{-- /main --}}
</div>{{-- /layout --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ══ DADOS DO BACKEND ═══════════════════════════ */
let allReviews = @json($avaliacoes->items()).map(a => ({
  id: a.id,
  cliente: a.user?.name || 'Cliente',
  iniciais: a.user?.name ? a.user.name.split(' ').map(n => n[0] || '').join('').substring(0,2).toUpperCase() : '--',
  stars: a.classificacao,
  texto: a.comentario || 'Sem comentário',
  data: a.created_at ? new Date(a.created_at).toLocaleDateString('pt-AO', {day:'2-digit', month:'short', year:'numeric'}) : '',
  daysAgo: a.created_at ? Math.floor((new Date() - new Date(a.created_at)) / (1000*60*60*24)) : 0,
}));

/* ══ STATE ══════════════════════════════════════════ */
let filtered    = [...allReviews];
let currentPage = 1;
let starFilter  = 0;
const RPP = 10;

/* ══ DATE ════════════════════════════════════════════ */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const now = new Date();
document.getElementById('topbar-date').textContent =
  `${DIAS[now.getDay()]}, ${now.getDate()} de ${MESES[now.getMonth()]} de ${now.getFullYear()}`;

/* ══ FILTROS ════════════════════════════════════════ */
function filterReviews() {
  const q      = document.getElementById('searchInput').value.trim().toLowerCase();
  const sort   = document.getElementById('sortFilter').value;

  filtered = allReviews.filter(r => {
    const mq   = !q || r.cliente.toLowerCase().includes(q) || (r.texto && r.texto.toLowerCase().includes(q));
    const mst  = starFilter === 0 || r.stars === starFilter;
    return mq && mst;
  });

  filtered.sort((a,b) => {
    if(sort === 'newest')  return a.daysAgo - b.daysAgo;
    if(sort === 'oldest')  return b.daysAgo - a.daysAgo;
    if(sort === 'highest') return b.stars - a.stars;
    if(sort === 'lowest')  return a.stars - b.stars;
    return 0;
  });

  currentPage = 1;
  render();
}

function setStarFilter(el, stars) {
  document.querySelectorAll('.sp').forEach(s => s.classList.remove('active'));
  el.classList.add('active');
  starFilter = stars;
  filterReviews();
}

/* ══ RENDER ═════════════════════════════════════════ */
function render() {
  const total = filtered.length;
  const pages = Math.max(1, Math.ceil(total/RPP));
  if(currentPage > pages) currentPage = pages;
  const start = (currentPage-1)*RPP;
  const slice = filtered.slice(start, start+RPP);

  const list = document.getElementById('reviewsList');
  const empty = document.getElementById('emptyState');

  if (total === 0) {
    list.style.display = 'none';
    empty.style.display = 'flex';
    document.getElementById('paginationWrap').style.display = 'none';
    return;
  }

  list.style.display = 'flex';
  empty.style.display = 'none';
  document.getElementById('paginationWrap').style.display = 'flex';

  list.innerHTML = slice.map(r => {
    const starsHtml = () => {
      let h = '';
      for(let i=1;i<=5;i++) {
        h += `<i class="bi bi-star${i<=r.stars?'-fill':''} ${i<=r.stars?'star-full':'star-empty'}"></i>`;
      }
      return h;
    };

    return `
      <div class="review-card" data-id="${r.id}">
        <div class="rc-head">
          <div class="rc-av" style="background:#e6f7f8;color:#334155">${r.iniciais}</div>
          <div class="rc-info">
            <div class="rc-name">${r.cliente}</div>
            <div class="rc-meta">
              <span><i class="bi bi-calendar3"></i>${r.data}</span>
            </div>
          </div>
          <div class="rc-stars">${starsHtml()}</div>
        </div>
        <div class="rc-body">${r.texto}</div>
      </div>`;
  }).join('');

  // Page info
  const end = Math.min(start+RPP, total);
  document.getElementById('pageInfo').textContent = total===0
    ? '0 resultados'
    : `${start+1}–${end} de ${total} avaliações`;
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
// Inicializa com os dados do backend
</script>
</body>
</html>