<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Dashboard</title>

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
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }

    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ─────────────────────────── */
    .sidebar {
      width: 220px; flex-shrink: 0;
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; height: 100vh;
      overflow-y: auto; overflow-x: hidden; z-index: 200;
    }

    .sidebar-header {
      height: var(--topbar-h); min-height: var(--topbar-h);
      flex-shrink: 0; display: flex; align-items: center;
      padding: 0 16px; border-bottom: 1px solid var(--border);
    }

    .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; }
    .logo-mark { width: 28px; height: 28px; background: var(--accent); border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo-mark svg { width: 14px; height: 14px; fill: #fff; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); }
    .logo-text .c { color: var(--text); }

    .sidebar-body { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 8px 0 12px; }
    .sidebar-body::-webkit-scrollbar { width: 0; }

    .nav-section { padding: 0 8px; }
    .nav-label { font-size: 0.67rem; font-weight: 600; color: var(--text-4); text-transform: uppercase; letter-spacing: .07em; padding: 10px 8px 4px; display: block; }

    .nav-item {
      display: flex; align-items: center; gap: 8px;
      padding: 6px 8px; border-radius: var(--r-md);
      font-size: 0.82rem; font-weight: 500; color: var(--text-3);
      cursor: pointer; transition: background .1s, color .1s;
      border: none; background: none; width: 100%;
      text-align: left; font-family: 'DM Sans', sans-serif;
      text-decoration: none; margin-bottom: 1px;
    }
    .nav-item i { font-size: 0.88rem; width: 15px; text-align: center; flex-shrink: 0; }
    .nav-item:hover { background: var(--surface-2); color: var(--text); }
    .nav-item.active { background: var(--accent-light); color: var(--accent); font-weight: 600; }
    .nav-item.active i { color: var(--accent); }

    .nav-badge { margin-left: auto; font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; line-height: 1.5; }
    .nb-red   { background: var(--danger-light); color: var(--danger); }
    .nb-amber { background: var(--warning-light); color: var(--warning); }
    .nb-teal  { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate { background: #f1f5f9; color: var(--text-3); }

    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .chevron { margin-left: auto; font-size: 0.68rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }
    .nav-divider { height: 1px; background: var(--border); margin: 6px 12px; }


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


    .sidebar-footer { flex-shrink: 0; padding: 8px; border-top: 1px solid var(--border); }
    .ph-card { padding: 10px 11px; background: var(--accent-light); border-radius: var(--r-lg); }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill { font-size: 0.62rem; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .pill-open { background: #dcfce7; color: #15803d; }
    .ph-meta { font-size: 0.7rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }

    /* ─── MAIN ────────────────────────────── */
    .main { flex: 1; margin-left: 220px; display: flex; flex-direction: column; min-height: 100vh; }

    .topbar {
      background: var(--surface); border-bottom: 1px solid var(--border);
      padding: 0 22px; height: var(--topbar-h); min-height: var(--topbar-h);
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100; flex-shrink: 0;
    }
    .tb-left { display: flex; align-items: center; gap: 10px; }
    .tb-left h1 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .tb-sep { color: var(--text-4); font-size: 0.75rem; }
    .tb-date { font-size: 0.75rem; color: var(--text-3); }
    .tb-right { display: flex; align-items: center; gap: 7px; }

    .ib { width: 30px; height: 30px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; color: var(--text-3); transition: all .1s; position: relative; }
    .ib:hover { background: var(--surface-2); color: var(--text); border-color: var(--border-strong); }
    .ib-dot { position: absolute; top: 5px; right: 5px; width: 5px; height: 5px; background: var(--danger); border-radius: 50%; border: 1.5px solid var(--surface); }

    .user-chip { display: flex; align-items: center; gap: 7px; padding: 3px 10px 3px 4px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); cursor: pointer; font-size: 0.77rem; transition: all .1s; }
    .user-chip:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .u-av { width: 22px; height: 22px; border-radius: 5px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; display: block; }
    .u-role { font-size: 0.67rem; color: var(--text-3); display: block; }

    /* ─── CONTENT ─────────────────────────── */
    .content { padding: 18px 22px; flex: 1; }

    .action-bar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
    .ab-left { display: flex; gap: 7px; }

    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; text-decoration: none; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); border-color: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }

    /* ─── KPIs ────────────────────────────── */
    .kpi-row { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 11px; margin-bottom: 14px; }

    .kpi { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 13px 15px; cursor: pointer; position: relative; overflow: hidden; transition: border-color .15s, box-shadow .15s, transform .1s; }
    .kpi::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; border-radius: var(--r-xl) 0 0 var(--r-xl); }
    .kpi:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .kpi.kpi-teal::before  { background: var(--accent); }
    .kpi.kpi-amber::before { background: var(--warning); }
    .kpi.kpi-red::before   { background: var(--danger); }
    .kpi.kpi-green::before { background: var(--success); }

    .kpi-head { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 9px; }
    .kpi-ico { width: 32px; height: 32px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; font-size: 0.88rem; }
    .kpi-ico.teal  { background: var(--accent-light); color: var(--accent); }
    .kpi-ico.amber { background: var(--warning-light); color: var(--warning); }
    .kpi-ico.red   { background: var(--danger-light); color: var(--danger); }
    .kpi-ico.green { background: var(--success-light); color: var(--success); }

    .kpi-delta { font-size: 0.65rem; font-weight: 700; padding: 2px 5px; border-radius: 20px; }
    .d-up   { background: var(--success-light); color: #15803d; }
    .d-down { background: var(--danger-light); color: var(--danger); }
    .d-flat { background: #f1f5f9; color: var(--text-3); }

    .kpi-val { font-family: 'Sora', sans-serif; font-size: 1.55rem; font-weight: 700; line-height: 1; margin-bottom: 2px; }
    .kpi-lbl { font-size: 0.72rem; font-weight: 500; color: var(--text-3); }
    .kpi-sub { font-size: 0.67rem; color: var(--text-4); margin-top: 7px; padding-top: 7px; border-top: 1px solid var(--border); }
    .kpi-bar-track { height: 3px; background: var(--border); border-radius: 10px; margin-top: 5px; }
    .kpi-bar-fill  { height: 3px; border-radius: 10px; }
    .kpi-bar-label { display: flex; justify-content: space-between; font-size: .65rem; color: var(--text-4); margin-top: 7px; padding-top: 7px; border-top: 1px solid var(--border); }

    /* ─── CARD ────────────────────────────── */
    .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 15px 17px; }
    .card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
    .card-head h3 { font-size: 0.82rem; font-weight: 600; color: var(--text); display: flex; align-items: center; gap: 6px; }
    .card-head h3 i { font-size: 0.82rem; color: var(--text-3); }
    .card-link { font-size: 0.72rem; font-weight: 600; color: var(--accent); background: none; border: none; cursor: pointer; font-family: 'DM Sans', sans-serif; padding: 0; }
    .card-link:hover { color: var(--accent-2); text-decoration: underline; }

    /* ─── TABELA ──────────────────────────── */
    .mini-table { width: 100%; font-size: 0.77rem; border-collapse: collapse; }
    .mini-table th { text-align: left; font-weight: 600; color: var(--text-3); font-size: 0.67rem; text-transform: uppercase; letter-spacing: .04em; padding: 0 6px 7px; border-bottom: 1px solid var(--border); }
    .mini-table td { padding: 7px 6px; border-bottom: 1px solid var(--border); color: var(--text-2); vertical-align: middle; }
    .mini-table tr:last-child td { border-bottom: none; }
    .mini-table tr:hover td { background: var(--surface-2); }
    .row-av { width: 26px; height: 26px; border-radius: 6px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .row-name { font-weight: 500; color: var(--text); }

    /* ─── TAGS ────────────────────────────── */
    .tag { display: inline-flex; align-items: center; font-size: 0.65rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; white-space: nowrap; }
    .tag::before { content: ''; width: 4px; height: 4px; border-radius: 50%; margin-right: 4px; }
    .tag-new   { background: var(--danger-light); color: var(--danger); }
    .tag-new::before   { background: var(--danger); }
    .tag-prep  { background: var(--warning-light); color: var(--warning); }
    .tag-prep::before  { background: var(--warning); }
    .tag-route { background: var(--accent-light); color: var(--accent-2); }
    .tag-route::before { background: var(--accent); }
    .tag-done  { background: var(--success-light); color: var(--success); }
    .tag-done::before  { background: var(--success); }

    /* ─── AVALIAÇÕES ──────────────────────── */
    .rat-row { display: flex; align-items: center; gap: 7px; padding: 2.5px 0; }
    .rat-lbl { font-size: 0.7rem; color: var(--text-3); width: 24px; }
    .rat-track { flex: 1; height: 5px; background: var(--border); border-radius: 10px; }
    .rat-fill  { height: 5px; border-radius: 10px; background: var(--warning); }
    .rat-num   { width: 22px; text-align: right; font-size: 0.67rem; color: var(--text-3); }

    /* ─── CHARTS ──────────────────────────── */
    .chart-wrap    { height: 158px; position: relative; }
    .chart-wrap-sm { height: 130px; position: relative; }
    .chart-wrap-md { height: 145px; position: relative; }

    /* ════════════════════════════════════════
       LAYOUT FINAL — 3 linhas

       LINHA 1  [ Pedidos (3fr) | Gráfico 7 dias (2fr) ]
         Tabela de pedidos é a info mais operacional.
         O gráfico semanal fica ao lado como contexto.

       LINHA 2  [ Avaliações (1.2fr) | Donut stock (1fr) | Origem (1.4fr) ]
         Avaliações tem mais conteúdo (score + barras),
         merece coluna ligeiramente maior.
         Donut é compacto por natureza, coluna menor.
         Origem (pizza) tem legenda lateral, precisa de mais espaço.

       NOTA: sem linha 3 separada — origem entra na linha 2,
       aproveitando o espaço deixado pela remoção do card de entregas.
    ════════════════════════════════════════ */

    .row-1 {
      display: grid;
      grid-template-columns: 3fr 2fr;
      gap: 12px; margin-bottom: 12px;
      align-items: stretch;
    }

    .row-2 {
      display: grid;
      grid-template-columns: 1.2fr 1fr 1.4fr;
      gap: 12px; margin-bottom: 12px;
      align-items: stretch;
    }

    /* Cards within rows fill the row height and use flex
       so inner content can grow/shrink to fill available space */
    .row-1 > .card,
    .row-2 > .card {
      display: flex;
      flex-direction: column;
    }

    /* Chart wrappers inside stretched cards grow to fill */
    .row-1 > .card .chart-wrap,
    .row-2 > .card .chart-wrap-sm,
    .row-2 > .card .chart-wrap-md {
      flex: 1;
      height: auto;
      min-height: 100px;
    }

    /* Table card: table wrapper grows */
    .row-1 > .card .mini-table-wrap {
      flex: 1;
      overflow: auto;
    }

    /* Ratings card inner content grows */
    .row-2 > .card .rat-wrap {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    /* ─── RESPONSIVE ──────────────────────── */
    @media (max-width: 1280px) {
      .kpi-row { grid-template-columns: repeat(2, 1fr); }
      .row-2   { grid-template-columns: 1fr 1fr; }
      .row-2 > .card:last-child { grid-column: 1 / -1; }
    }
    @media (max-width: 1024px) {
      .row-1 { grid-template-columns: 1fr; }
      .row-2 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .kpi-row { grid-template-columns: repeat(2, 1fr); }
      .row-1, .row-2 { grid-template-columns: 1fr; }
    }

    /* ─── MODAL ───────────────────────────── */
    .overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.48); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--r-xl); padding: 22px; width: 450px; max-width: 94vw; box-shadow: 0 20px 50px rgba(0,0,0,.18); animation: mIn .18s ease; }
    @keyframes mIn { from { transform:scale(.96); opacity:0; } to { transform:scale(1); opacity:1; } }
    .modal-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
    .modal-head h3 { font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 600; }
    .modal-close { background: none; border: none; cursor: pointer; color: var(--text-3); font-size: 0.85rem; width: 26px; height: 26px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .modal-close:hover { background: var(--surface-2); color: var(--text); }
    .form-grp { margin-bottom: 14px; }
    .form-grp label { display: block; font-size: 0.77rem; font-weight: 600; margin-bottom: 6px; color: var(--text-2); }
    .form-input { width: 100%; padding: 7px 11px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.8rem; font-family: 'DM Sans', sans-serif; color: var(--text); transition: border-color .1s; }
    .form-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .radio-row { display: flex; gap: 6px; flex-wrap: wrap; }
    .radio-opt { display: flex; align-items: center; gap: 5px; font-size: 0.77rem; cursor: pointer; padding: 4px 9px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); transition: all .1s; font-family: 'DM Sans', sans-serif; }
    .radio-opt input { accent-color: var(--accent); }
    .radio-opt:has(input:checked) { background: var(--accent-light); border-color: var(--accent-mid); }
    .check-grid { display: flex; flex-wrap: wrap; gap: 5px; }
    .check-opt { display: flex; align-items: center; gap: 5px; font-size: 0.75rem; cursor: pointer; padding: 3px 9px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); transition: all .1s; font-family: 'DM Sans', sans-serif; }
    .check-opt input { accent-color: var(--accent); }
    .check-opt:has(input:checked) { background: var(--accent-light); border-color: var(--accent-mid); }
    .modal-foot { display: flex; gap: 7px; justify-content: flex-end; margin-top: 18px; }
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
        <h1>Paínel Administrativo</h1>
        <span class="tb-sep">/</span>
        <span class="tb-date" id="topbar-date">—</span>
      </div>
      <div class="tb-right">
        <div class="ib" title="Pesquisar"><i class="bi bi-search"></i></div>
        <div class="ib" title="Notificações">
          <i class="bi bi-bell"></i>
          <span class="ib-dot"></span>
        </div>
        <div class="user-chip">
          <div class="u-av">FC</div>
              <div><span class="u-name">{{ Auth::user()->farmacia->name ?? 'UNKNOWN'  }}</span><span class="u-role">{{ Auth::user()->name ?? 'Dr. António Silva' }}</span></div>
        </div>
      </div>
    </header>

    <div class="content">



      @php
        $pedidosHoje = $data['pedidos_hoje'];
        $totalPedidosHoje = $pedidosHoje->count();
        $pedidosEmCurso = $pedidosHoje->whereIn('status', ['Pendente', 'Aprovado', 'pago', 'Em Entrega'])->count();
        $pedidosEntregues = $pedidosHoje->where('status', 'Concluído')->count();
        $percentualEmCurso = $totalPedidosHoje > 0 ? round(($pedidosEmCurso / $totalPedidosHoje) * 100) : 0;
        
        $totalProdutos = $data['produtoStock'] ?? 0;
        $totalAvaliacoes = $data['todas_avaliacoes']->count();
        $mediaAvaliacoes = number_format($data['media_avaliacoes'], 1);
        
        // Dados para gráfico de stock
        $stockNormal = 65; // Placeholder - ajustar conforme dados reais
        $stockBaixo = 25;
        $stockCritico = 10;
        
        // Dados para origem dos pedidos
        $origemPedidos = $data['origemPedidos'] ?? [
            'Ingombotas' => 42,
            'Maianga' => 38,
            'Alvalade' => 51,
            'Kilamba' => 27,
            'Talatona' => 33
        ];
        
        // Dados para avaliações por estrela
        $avaliacoes = $data['todas_avaliacoes'];
        $count5 = $avaliacoes->where('classificacao', 5)->count();
        $count4 = $avaliacoes->where('classificacao', 4)->count();
        $count3 = $avaliacoes->where('classificacao', 3)->count();
        $count2 = $avaliacoes->where('classificacao', 2)->count();
        $count1 = $avaliacoes->where('classificacao', 1)->count();
        $totalAval = max(1, $totalAvaliacoes);
        
        $ratings = [
            ['s' => '5 ★', 'n' => $count5, 'p' => round(($count5 / $totalAval) * 100)],
            ['s' => '4 ★', 'n' => $count4, 'p' => round(($count4 / $totalAval) * 100)],
            ['s' => '3 ★', 'n' => $count3, 'p' => round(($count3 / $totalAval) * 100)],
            ['s' => '2 ★', 'n' => $count2, 'p' => round(($count2 / $totalAval) * 100)],
            ['s' => '1 ★', 'n' => $count1, 'p' => round(($count1 / $totalAval) * 100)],
        ];
      @endphp

      <!-- ── KPIs ─────────────────────────────────── -->
      <div class="kpi-row">
        <div class="kpi kpi-teal">
          <div class="kpi-head">
            <div class="kpi-ico teal"><i class="bi bi-cart3"></i></div>
          </div>
          <div class="kpi-val">{{ $totalPedidosHoje }}</div>
          <div class="kpi-lbl">Pedidos hoje</div>
          <div class="kpi-bar-label"><span>{{ $pedidosEmCurso }} em curso</span><span>{{ $pedidosEntregues }} entregues</span></div>
        </div>
        <div class="kpi kpi-amber">
          <div class="kpi-head">
            <div class="kpi-ico amber"><i class="bi bi-cash-coin"></i></div>
          </div>
          <div class="kpi-val">{{ number_format($pedidosHoje->sum('total') ?? 0, 0, ',', '.') }} Kz</div>
          <div class="kpi-lbl">Faturação hoje</div>
        </div>
        <div class="kpi kpi-red">
          <div class="kpi-head">
            <div class="kpi-ico red"><i class="bi bi-archive"></i></div>
          </div>
          <div class="kpi-val">{{ $totalProdutos }}</div>
          <div class="kpi-lbl">Produtos em stock</div>
        </div>
        <div class="kpi kpi-green">
          <div class="kpi-head">
            <div class="kpi-ico green"><i class="bi bi-star-half"></i></div>
            <span class="kpi-delta d-flat">+{{ $totalAvaliacoes }} novas</span>
          </div>
          <div class="kpi-val">{{ $mediaAvaliacoes }}</div>
          <div class="kpi-lbl">Avaliação média</div>
          <div class="kpi-sub">De {{ $totalAvaliacoes }} avaliações totais</div>
        </div>
      </div>

      <!-- ══════════════════════════════════════════
           LINHA 1 — Pedidos (3fr) + Gráfico 7 dias (2fr)
      ══════════════════════════════════════════ -->
      <div class="row-1">

        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-list-check"></i> Pedidos recentes</h3>
            <button class="card-link" onclick="window.location.href='{{ route('pedidos.farmacias') }}'">Ver todos <i class="bi bi-arrow-right"></i></button>
          </div>
          <div class="mini-table-wrap">
            <table class="mini-table">
              <thead>
                <tr>
                  <th>Cliente</th>
                  {{-- <th>Medicamento</th> --}}
                  <th>Hora</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody id="orders-body">
                @forelse($data['ultimos_pedidos'] as $pedido)
                  @php
                    $cliente = $pedido->user;
                    $primeiroItem = $pedido->items->first();
                    // $medicamento = $primeiroItem ? ($primeiroItem->medicamento->nome ?? $primeiroItem->produto ?? 'Medicamento') : 'Medicamento';
                    $iniciais = $cliente ? implode('', array_map(function($n) { return $n[0] ?? ''; }, explode(' ', $cliente->name))) : '--';
                    
                    $statusMap = [
                        'Pendente' => 'tag-new',
                        'Aprovado' => 'tag-prep',
                        'pago' => 'tag-prep',
                        'Em Entrega' => 'tag-route',
                        'Concluído' => 'tag-done',
                        'Cancelado' => 'tag-canceled',
                        'Rejeitado' => 'tag-canceled',
                    ];
                    $statusClass = $statusMap[$pedido->status] ?? 'tag-new';
                    $statusLabel = $pedido->status;
                  @endphp
                  <tr>
                    <td>
                      <div style="display:flex;align-items:center;gap:6px">
                        <div class="row-av">{{ $iniciais }}</div>
                        <span class="row-name">{{ $cliente->name ?? 'Cliente' }}</span>
                      </div>
                    </td>
                    {{-- <td style="color:var(--text-3)">{{ $medicamento }}</td> --}}
                    <td style="color:var(--text-4)">{{ $pedido->data_pedido->format('H:i') }}</td>
                    <td><span class="tag {{ $statusClass }}">{{ $statusLabel }}</span></td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" style="text-align:center;padding:20px;color:var(--text-4)">Nenhum pedido recente</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-graph-up"></i> Pedidos — 7 dias</h3>
            <button class="card-link">Exportar</button>
          </div>
          <div class="chart-wrap">
            <canvas id="chartPedidos"></canvas>
          </div>
        </div>

      </div>

      <!-- ══════════════════════════════════════════
           LINHA 2 — Avaliações (1.2fr) | Donut stock (1fr) | Origem (1.4fr)
      ══════════════════════════════════════════ -->
      <div class="row-2">

        <!-- Avaliações -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-star"></i> Avaliações de clientes</h3>
            <button class="card-link">Ver todas</button>
          </div>
          <div class="rat-wrap">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px">
              <div style="text-align:center;flex-shrink:0">
                <div style="font-family:'Sora',sans-serif;font-size:2.1rem;font-weight:700;line-height:1;color:var(--text)">{{ $mediaAvaliacoes }}</div>
                <div style="color:var(--warning);font-size:.72rem;margin-top:3px">
                  @php
                    $estrelasInt = floor($data['media_avaliacoes']);
                    $estrelasHalf = ($data['media_avaliacoes'] - $estrelasInt) >= 0.5 ? 1 : 0;
                  @endphp
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $estrelasInt)
                      ★
                    @elseif($estrelasHalf && $i == $estrelasInt + 1)
                      ½
                    @else
                      ☆
                    @endif
                  @endfor
                </div>
                <div style="font-size:.62rem;color:var(--text-3);margin-top:2px">{{ $totalAvaliacoes }} avaliações</div>
              </div>
              <div style="flex:1" id="rat-bars">
                @foreach($ratings as $rating)
                  @if($rating['n'] > 0)
                    <div class="rat-row">
                      <span class="rat-lbl">{{ $rating['s'] }}</span>
                      <div class="rat-track"><div class="rat-fill" style="width:{{ $rating['p'] }}%"></div></div>
                      <span class="rat-num">{{ $rating['n'] }}</span>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <!-- Donut estado do stock -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-pie-chart"></i> Estado do stock</h3>
            <button class="card-link">Detalhes</button>
          </div>
          <div class="chart-wrap-sm">
            <canvas id="chartStock"></canvas>
          </div>
        </div>

        <!-- Origem dos pedidos -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-geo-alt"></i> Origem dos pedidos</h3>
            <button class="card-link">Ver mapa</button>
          </div>
          <div class="chart-wrap-md">
            <canvas id="chartOrigem"></canvas>
          </div>
        </div>

      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /layout -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
    const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
    const now = new Date();
    
    const topbarDate = document.getElementById('topbar-date');
    if (topbarDate) {
        topbarDate.textContent = `${DIAS[now.getDay()]}, ${now.getDate()} de ${MESES[now.getMonth()]} de ${now.getFullYear()}`;
    }
    
    // Configuração base
    const baseOptions = {
        responsive: true,
        maintainAspectRatio: false
    };
    
    // ========== GRÁFICO DE PEDIDOS ==========
    const chartPedidosElement = document.getElementById('chartPedidos');
    if (chartPedidosElement) {
        const pedidosLabels = {!! json_encode($data['pedidosLabels'] ?? ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom']) !!};
        const pedidosValues = {!! json_encode($data['pedidosValues'] ?? [0, 0, 0, 0, 0, 0, 0]) !!};
        
        console.log('Pedidos Data:', { pedidosLabels, pedidosValues });
        
        new Chart(chartPedidosElement, {
            type: 'line',
            data: {
                labels: pedidosLabels,
                datasets: [{ 
                    data: pedidosValues, 
                    borderColor: '#0899a6', 
                    backgroundColor: 'rgba(8,153,166,.06)', 
                    tension: 0.4, 
                    fill: true, 
                    pointBackgroundColor: '#0899a6', 
                    pointRadius: 3, 
                    pointHoverRadius: 5, 
                    borderWidth: 2 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false }, 
                    tooltip: { 
                        mode: 'index', 
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} pedidos`;
                            }
                        }
                    } 
                },
                scales: {
                    x: { 
                        grid: { display: false }, 
                        ticks: { 
                            font: { family: 'DM Sans', size: 10 }, 
                            color: '#94a3b8' 
                        } 
                    },
                    y: { 
                        grid: { color: '#f1f5f9' }, 
                        ticks: { 
                            font: { family: 'DM Sans', size: 10 }, 
                            color: '#94a3b8',
                            stepSize: 1,
                            callback: function(value) {
                                return value + ' pedidos';
                            }
                        }, 
                        beginAtZero: true 
                    }
                }
            }
        });
        console.log(' Gráfico de pedidos criado');
    } else {
        console.error(' Elemento chartPedidos não encontrado');
    }
    
    // ========== GRÁFICO DE STOCK ==========
    const chartStockElement = document.getElementById('chartStock');
    if (chartStockElement) {
        const stockData = @json($data['stock'] ?? ['normal' => 0, 'baixo' => 0, 'critico' => 0]);
        console.log('Stock Data:', stockData);
        
        if (stockData.normal > 0 || stockData.baixo > 0 || stockData.critico > 0) {
            new Chart(chartStockElement, {
                type: 'doughnut',
                data: { 
                    labels: ['Normal', 'Baixo', 'Crítico'], 
                    datasets: [{ 
                        data: [stockData.normal, stockData.baixo, stockData.critico],  
                        backgroundColor: ['#16a34a', '#d97706', '#d94040'], 
                        borderWidth: 2, 
                        borderColor: '#fff', 
                        hoverOffset: 4 
                    }] 
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '66%',
                    plugins: { 
                        legend: { 
                            display: true, 
                            position: 'bottom', 
                            labels: { 
                                font: { family: 'DM Sans', size: 10 }, 
                                boxWidth: 8, 
                                boxHeight: 8, 
                                padding: 10, 
                                color: '#64748b' 
                            } 
                        } 
                    } 
                }
            });
            console.log(' Gráfico de stock criado');
        } else {
            console.log('Sem dados de stock');
            chartStockElement.parentElement.innerHTML = '<div class="text-center text-muted p-5">Sem dados de stock disponíveis</div>';
        }
    } else {
        console.error(' Elemento chartStock não encontrado');
    }
    

    // ========== GRÁFICO DE ORIGEM ==========
    const chartOrigemElement = document.getElementById('chartOrigem');
    if (chartOrigemElement) {
        // Recebe os dados do PHP
        const origemDados = @json($data['origemPedidos'] ?? []);
        
        console.log('Origem Dados brutos:', origemDados);
        
        const origemLabels = [];
        const origemValues = [];
        
        // Processa os dados corretamente
        if (typeof origemDados === 'object' && origemDados !== null && Object.keys(origemDados).length > 0) {
            for (const [endereco, total] of Object.entries(origemDados)) {
                // Verifica se total é um número válido
                if (typeof total === 'number' && total > 0) {
                    let label = endereco;
                    if (label.length > 25) {
                        label = label.substring(0, 22) + '...';
                    }
                    origemLabels.push(label);
                    origemValues.push(total);
                }
            }
        }
        
        console.log('Origem Labels processados:', origemLabels);
        console.log('Origem Values processados:', origemValues);
        
        if (origemValues.length > 0 && origemValues.some(v => v > 0)) {
            try {
                // Cores para o gráfico
                const cores = ['#0899a6', '#4ec3b0', '#2c7a78', '#0f4e5a', '#94a3b8', '#f59e0b', '#ef4444', '#8b5cf6'];
                
                new Chart(chartOrigemElement, {
                    type: 'pie',
                    data: { 
                        labels: origemLabels, 
                        datasets: [{ 
                            data: origemValues, 
                            backgroundColor: cores.slice(0, origemValues.length), 
                            borderWidth: 2, 
                            borderColor: '#fff', 
                            hoverOffset: 4 
                        }] 
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { 
                                display: true, 
                                position: 'right', 
                                labels: { 
                                    font: { family: 'DM Sans', size: 10 }, 
                                    boxWidth: 8, 
                                    boxHeight: 8, 
                                    padding: 8, 
                                    color: '#64748b' 
                                } 
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                        return `${label}: ${value} pedido${value !== 1 ? 's' : ''} (${percentage}%)`;
                                    }
                                }
                            }
                        } 
                    }
                });
                console.log('Gráfico de origem criado com sucesso!');
            } catch (error) {
                console.error(' Erro ao criar gráfico de origem:', error);
                if (chartOrigemElement.parentElement) {
                    chartOrigemElement.parentElement.innerHTML = '<div class="text-center text-muted p-5">Erro ao carregar dados de origem</div>';
                }
            }
        } else {
            console.log(' Sem dados de origem para exibir');
            if (chartOrigemElement.parentElement) {
                chartOrigemElement.parentElement.innerHTML = '<div class="text-center text-muted p-5">Sem dados de origem disponíveis</div>';
            }
        }
    } else {
        console.error(' Elemento chartOrigem não encontrado');
    }
});


// Funções do sidebar
function setActive(el) {
    document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active'));
    el.classList.add('active');
}

function toggleSub(id) { 
    const element = document.getElementById(id);
    if (element) element.classList.toggle('open'); 
}

// Eventos do modal
const modalRel = document.getElementById('modal-rel');
if (modalRel) {
    modalRel.addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('open');
    });
}

document.querySelectorAll('input[name="periodo"]').forEach(r =>
    r.addEventListener('change', function() {
        const customDates = document.getElementById('custom-dates');
        if (customDates) {
            customDates.style.display = this.value === 'custom' ? 'block' : 'none';
        }
    })
);
</script>
</body>
</html>