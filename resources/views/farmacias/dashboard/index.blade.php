<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Dashboard</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    /* ─── RESET & BASE ───────────────────────────── */
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
      --neutral:       #64748b;
      --white:         #ffffff;
      --bg:            #f1f5f9;
      --surface:       #ffffff;
      --surface-2:     #f8fafc;
      --border:        #e2e8f0;
      --border-strong: #cbd5e1;
      --text:          #0f172a;
      --text-2:        #334155;
      --text-3:        #64748b;
      --text-4:        #94a3b8;
      --shadow-xs:     0 1px 2px rgba(0,0,0,.06);
      --shadow-sm:     0 2px 8px rgba(0,0,0,.07);
      --shadow-md:     0 4px 16px rgba(0,0,0,.08);
      --r-sm:          6px;
      --r-md:          10px;
      --r-lg:          14px;
      --r-xl:          18px;
    }

    html { font-size: 13px; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }

    /* ─── LAYOUT ─────────────────────────────────── */
    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ────────────────────────────────── */
    .sidebar {
      width: 220px;
      flex-shrink: 0;
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      overflow-y: auto;
      overflow-x: hidden;
      z-index: 200;
      padding-bottom: 16px;
    }

    .sidebar-top {
      padding: 18px 16px 10px;
      border-bottom: 1px solid var(--border);
      margin-bottom: 8px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      margin-bottom: 0;
    }
    .logo-mark {
      width: 30px; height: 30px;
      background: var(--accent);
      border-radius: var(--r-sm);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .logo-mark svg { width: 16px; height: 16px; fill: white; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.2rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); }
    .logo-text .c { color: var(--text); }

    /* Nav */
    .nav-section { padding: 0 8px; margin-bottom: 4px; }
    .nav-label {
      font-size: 0.69rem;
      font-weight: 600;
      color: var(--text-4);
      text-transform: uppercase;
      letter-spacing: .07em;
      padding: 10px 8px 4px;
      display: block;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 7px 9px;
      border-radius: var(--r-md);
      font-size: 0.85rem;
      font-weight: 500;
      color: var(--text-3);
      cursor: pointer;
      transition: background .12s, color .12s;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      font-family: 'DM Sans', sans-serif;
      text-decoration: none;
      margin-bottom: 1px;
    }
    .nav-item i { font-size: 0.95rem; width: 16px; text-align: center; flex-shrink: 0; }
    .nav-item:hover { background: var(--surface-2); color: var(--text); }
    .nav-item.active {
      background: var(--accent-light);
      color: var(--accent);
      font-weight: 600;
    }
    .nav-item.active i { color: var(--accent); }

    /* Badge */
    .nav-badge {
      margin-left: auto;
      font-size: 0.65rem;
      font-weight: 700;
      padding: 1px 5px;
      border-radius: 20px;
      line-height: 1.5;
    }
    .nb-red    { background: var(--danger-light); color: var(--danger); }
    .nb-amber  { background: var(--warning-light); color: var(--warning); }
    .nb-teal   { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate  { background: #f1f5f9; color: var(--text-3); }

    /* Submenu */
    .has-sub .sub { display: none; padding-left: 22px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item {
      display: flex; align-items: center; gap: 8px;
      padding: 5px 9px; border-radius: var(--r-sm);
      font-size: 0.8rem; font-weight: 500; color: var(--text-3);
      cursor: pointer; transition: background .1s, color .1s;
      text-decoration: none;
    }
    .sub-item i { font-size: 0.8rem; width: 14px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .chevron { margin-left: auto; font-size: 0.7rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }

    /* Nav divider */
    .nav-divider { height: 1px; background: var(--border); margin: 8px 16px; }

    /* Pharmacy info */
    .ph-card {
      margin: 8px;
      padding: 11px 12px;
      background: var(--accent-light);
      border-radius: var(--r-lg);
      margin-top: auto;
    }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.8rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill {
      font-size: 0.65rem; font-weight: 700;
      padding: 2px 7px; border-radius: 20px;
    }
    .pill-open   { background: #dcfce7; color: #15803d; }
    .pill-closed { background: #fee2e2; color: #991b1b; }
    .ph-meta { font-size: 0.72rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }

    /* ─── MAIN ───────────────────────────────────── */
    .main {
      flex: 1;
      margin-left: 220px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Topbar */
    .topbar {
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0 24px;
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .topbar-left { display: flex; align-items: center; gap: 12px; }
    .topbar-left h1 { font-family: 'Sora', sans-serif; font-size: 1.05rem; font-weight: 600; }
    .breadcrumb-sep { color: var(--text-4); }
    .topbar-date { font-size: 0.78rem; color: var(--text-3); }
    .topbar-right { display: flex; align-items: center; gap: 8px; }

    .ib {
      width: 32px; height: 32px;
      border-radius: var(--r-md);
      border: 1px solid var(--border);
      background: var(--surface);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; font-size: 0.9rem; color: var(--text-3);
      transition: all .12s; position: relative;
    }
    .ib:hover { background: var(--surface-2); color: var(--text); border-color: var(--border-strong); }
    .ib-dot {
      position: absolute; top: 5px; right: 5px;
      width: 6px; height: 6px;
      background: var(--danger); border-radius: 50%;
      border: 1.5px solid var(--surface);
    }

    .user-chip {
      display: flex; align-items: center; gap: 7px;
      padding: 4px 10px 4px 5px;
      border-radius: var(--r-md);
      border: 1px solid var(--border);
      background: var(--surface);
      cursor: pointer; font-size: 0.8rem;
      transition: all .12s;
    }
    .user-chip:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .u-avatar {
      width: 24px; height: 24px;
      border-radius: 6px;
      background: var(--accent-light);
      color: var(--accent-2);
      font-size: 0.65rem; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
    }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; }
    .u-role { font-size: 0.7rem; color: var(--text-3); }

    /* ─── CONTENT ────────────────────────────────── */
    .content { padding: 20px 24px; flex: 1; }

    /* Alert */
    .alert {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 14px;
      border-radius: var(--r-md);
      font-size: 0.8rem;
      border: 1px solid;
      margin-bottom: 16px;
      animation: fadeIn .3s ease;
    }
    @keyframes fadeIn { from { opacity:0; transform:translateY(-4px); } to { opacity:1; transform:translateY(0); } }
    .alert-danger  { background: var(--danger-light); border-color: #fca5a5; color: #7f1d1d; }
    .alert-warning { background: var(--warning-light); border-color: #fde68a; color: #78350f; }
    .alert i { font-size: 0.9rem; flex-shrink: 0; }
    .alert strong { font-weight: 600; }
    .alert-close {
      margin-left: auto; background: none; border: none;
      cursor: pointer; color: inherit; opacity: .6; font-size: 0.85rem;
      transition: opacity .1s;
    }
    .alert-close:hover { opacity: 1; }
    .alert-link {
      background: none; border: none; cursor: pointer;
      font-size: 0.8rem; font-weight: 600; color: var(--accent);
      font-family: 'DM Sans', sans-serif; padding: 0; margin-left: 6px;
    }
    .alert-link:hover { text-decoration: underline; }

    /* ─── ACTION BAR ─────────────────────────────── */
    .action-bar {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 16px;
    }
    .action-bar-left { display: flex; gap: 8px; flex-wrap: wrap; }

    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 6px 14px; border-radius: var(--r-md);
      font-size: 0.8rem; font-weight: 600;
      cursor: pointer; transition: all .12s;
      border: 1px solid; font-family: 'DM Sans', sans-serif;
      text-decoration: none;
    }
    .btn i { font-size: 0.85rem; }
    .btn-primary {
      background: var(--accent); color: white;
      border-color: var(--accent);
    }
    .btn-primary:hover { background: var(--accent-2); border-color: var(--accent-2); }
    .btn-outline {
      background: var(--surface); color: var(--text-2);
      border-color: var(--border);
    }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-danger-outline {
      background: var(--surface); color: var(--danger);
      border-color: #fca5a5;
    }
    .btn-danger-outline:hover { background: var(--danger-light); }

    /* ─── KPI ROW ────────────────────────────────── */
    .kpi-row {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
      margin-bottom: 16px;
    }

    .kpi {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--r-xl);
      padding: 14px 16px;
      cursor: pointer;
      transition: border-color .15s, box-shadow .15s, transform .12s;
      position: relative;
      overflow: hidden;
    }
    .kpi::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      border-radius: 0 0 var(--r-xl) var(--r-xl);
      opacity: 0;
      transition: opacity .2s;
    }
    .kpi:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .kpi:hover::after { opacity: 1; }
    .kpi.kpi-teal::after   { background: var(--accent); }
    .kpi.kpi-amber::after  { background: var(--warning); }
    .kpi.kpi-red::after    { background: var(--danger); }
    .kpi.kpi-green::after  { background: var(--success); }

    .kpi-head { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }
    .kpi-ico {
      width: 34px; height: 34px;
      border-radius: var(--r-md);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.95rem;
    }
    .kpi-ico.teal   { background: var(--accent-light); color: var(--accent); }
    .kpi-ico.amber  { background: var(--warning-light); color: var(--warning); }
    .kpi-ico.red    { background: var(--danger-light); color: var(--danger); }
    .kpi-ico.green  { background: var(--success-light); color: var(--success); }

    .kpi-delta {
      font-size: 0.68rem; font-weight: 700;
      padding: 2px 6px; border-radius: 20px;
    }
    .d-up   { background: var(--success-light); color: #15803d; }
    .d-down { background: var(--danger-light); color: var(--danger); }
    .d-flat { background: #f1f5f9; color: var(--text-3); }

    .kpi-val { font-family: 'Sora', sans-serif; font-size: 1.6rem; font-weight: 700; line-height: 1; margin-bottom: 3px; }
    .kpi-lbl { font-size: 0.75rem; font-weight: 500; color: var(--text-3); }
    .kpi-sub {
      font-size: 0.7rem; color: var(--text-4);
      margin-top: 8px; padding-top: 8px;
      border-top: 1px solid var(--border);
    }

    /* Progress bar inside KPI */
    .kpi-bar { margin-top: 8px; }
    .kpi-bar-track {
      height: 3px; background: var(--border); border-radius: 10px; margin-top: 4px;
    }
    .kpi-bar-fill { height: 3px; border-radius: 10px; transition: width .4s ease; }

    /* ─── GRID SISTEMA ───────────────────────────── */
    .grid-5-5   { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px; }
    .grid-6-4   { display: grid; grid-template-columns: 1.5fr 1fr; gap: 14px; margin-bottom: 14px; }
    .grid-4-4-4 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 14px; }
    .grid-4-8   { display: grid; grid-template-columns: 1fr 2fr; gap: 14px; margin-bottom: 14px; }
    .grid-3-cols { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 14px; margin-bottom: 14px; }

    /* ─── CARD ───────────────────────────────────── */
    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--r-xl);
      padding: 16px 18px;
    }
    .card-head {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 14px;
    }
    .card-head h3 {
      font-size: 0.85rem; font-weight: 600;
      color: var(--text); display: flex; align-items: center; gap: 6px;
    }
    .card-head h3 i { font-size: 0.85rem; color: var(--text-3); }
    .card-link {
      font-size: 0.75rem; font-weight: 600; color: var(--accent);
      background: none; border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif; padding: 0; transition: color .1s;
    }
    .card-link:hover { color: var(--accent-2); }

    /* ─── STATUS TAG ─────────────────────────────── */
    .tag {
      display: inline-flex; align-items: center;
      font-size: 0.68rem; font-weight: 600;
      padding: 2px 8px; border-radius: 20px;
      white-space: nowrap;
    }
    .tag::before { content: ''; width: 5px; height: 5px; border-radius: 50%; margin-right: 4px; }
    .tag-new     { background: var(--danger-light); color: var(--danger); }
    .tag-new::before { background: var(--danger); }
    .tag-prep    { background: var(--warning-light); color: var(--warning); }
    .tag-prep::before { background: var(--warning); }
    .tag-route   { background: var(--accent-light); color: var(--accent-2); }
    .tag-route::before { background: var(--accent); }
    .tag-done    { background: var(--success-light); color: var(--success); }
    .tag-done::before { background: var(--success); }
    .tag-canceled { background: #f1f5f9; color: var(--text-3); }
    .tag-canceled::before { background: var(--text-4); }

    /* ─── LIST ROWS ──────────────────────────────── */
    .list-row {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 0;
      border-bottom: 1px solid var(--border);
      font-size: 0.8rem;
    }
    .list-row:last-child { border-bottom: none; padding-bottom: 0; }
    .list-row:first-child { padding-top: 0; }

    .row-avatar {
      width: 28px; height: 28px;
      border-radius: 7px;
      background: var(--accent-light);
      color: var(--accent-2);
      font-size: 0.65rem; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .row-name { font-weight: 500; color: var(--text); margin-bottom: 1px; }
    .row-sub  { font-size: 0.72rem; color: var(--text-3); }

    /* ─── STATUS DOT ─────────────────────────────── */
    .dot {
      width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0;
    }
    .dot-online  { background: var(--success); box-shadow: 0 0 0 2px var(--success-light); }
    .dot-busy    { background: var(--warning); box-shadow: 0 0 0 2px var(--warning-light); }
    .dot-offline { background: var(--text-4); }

    /* ─── STOCK BAR ──────────────────────────────── */
    .sbar-wrap { width: 56px; height: 4px; background: var(--border); border-radius: 10px; flex-shrink: 0; }
    .sbar-fill { height: 4px; border-radius: 10px; }

    /* ─── RATINGS ────────────────────────────────── */
    .rat-row { display: flex; align-items: center; gap: 7px; padding: 2.5px 0; }
    .rat-lbl { font-size: 0.72rem; color: var(--text-3); width: 26px; }
    .rat-track { flex: 1; height: 5px; background: var(--border); border-radius: 10px; }
    .rat-fill  { height: 5px; border-radius: 10px; background: var(--warning); transition: width .5s; }
    .rat-num   { width: 24px; text-align: right; font-size: 0.7rem; color: var(--text-3); }

    /* ─── PRICE COMPARE ──────────────────────────── */
    .price-row { margin-bottom: 9px; }
    .price-head {
      display: flex; justify-content: space-between;
      font-size: 0.78rem; margin-bottom: 4px;
    }
    .price-track { height: 6px; background: var(--border); border-radius: 10px; }
    .price-fill  { height: 6px; border-radius: 10px; transition: width .5s; }

    /* ─── CHART ──────────────────────────────────── */
    .chart-wrap { height: 160px; position: relative; }
    .chart-wrap-sm { height: 130px; position: relative; }

    /* ─── QUICK ACTIONS ──────────────────────────── */
    .qa-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; }
    .qa-item {
      display: flex; align-items: center; gap: 8px;
      padding: 8px 10px;
      border: 1px solid var(--border);
      border-radius: var(--r-md);
      background: var(--surface);
      cursor: pointer; font-size: 0.78rem; font-weight: 500;
      color: var(--text-2); transition: all .12s;
      font-family: 'DM Sans', sans-serif;
    }
    .qa-item i { font-size: 0.85rem; color: var(--text-3); width: 16px; text-align: center; }
    .qa-item:hover { background: var(--accent-light); border-color: var(--accent-mid); color: var(--accent-2); }
    .qa-item:hover i { color: var(--accent); }

    /* ─── MINI INFO BOX ──────────────────────────── */
    .info-box {
      background: var(--surface-2);
      border: 1px solid var(--border);
      border-radius: var(--r-md);
      padding: 10px 12px;
      font-size: 0.78rem;
    }
    .info-box-title { font-weight: 600; color: var(--text); margin-bottom: 3px; font-size: 0.8rem; }
    .info-box p { color: var(--text-3); line-height: 1.4; }

    /* ─── TABLE SIMPLES ──────────────────────────── */
    .mini-table { width: 100%; font-size: 0.78rem; border-collapse: collapse; }
    .mini-table th {
      text-align: left; font-weight: 600; color: var(--text-3);
      font-size: 0.7rem; text-transform: uppercase; letter-spacing: .04em;
      padding: 0 6px 8px; border-bottom: 1px solid var(--border);
    }
    .mini-table td { padding: 7px 6px; border-bottom: 1px solid var(--border); color: var(--text-2); vertical-align: middle; }
    .mini-table tr:last-child td { border-bottom: none; }
    .mini-table tr:hover td { background: var(--surface-2); }

    /* ─── BRANCH BADGE ───────────────────────────── */
    .branch-badge {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px;
      background: var(--accent-light);
      border-radius: var(--r-md);
      margin-bottom: 12px;
    }
    .branch-ico {
      width: 32px; height: 32px;
      background: white; border-radius: var(--r-sm);
      display: flex; align-items: center; justify-content: center;
      color: var(--accent); font-size: 0.9rem; flex-shrink: 0;
      border: 1px solid var(--accent-mid);
    }
    .branch-badge p { font-size: 0.72rem; color: var(--accent-2); margin: 0; }
    .branch-badge strong { font-size: 0.82rem; color: var(--accent-2); display: block; }

    /* ─── EMPTY STATE ────────────────────────────── */
    .empty-state {
      text-align: center; padding: 20px;
      color: var(--text-4);
    }
    .empty-state i { font-size: 2rem; display: block; margin-bottom: 8px; }
    .empty-state p { font-size: 0.8rem; }

    /* ─── MODAL ──────────────────────────────────── */
    .overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(15,23,42,.5);
      z-index: 1000; align-items: center; justify-content: center;
      backdrop-filter: blur(2px);
    }
    .overlay.open { display: flex; }
    .modal-box {
      background: var(--surface);
      border-radius: var(--r-xl);
      padding: 24px;
      width: 460px; max-width: 95vw;
      box-shadow: 0 20px 50px rgba(0,0,0,.18);
      animation: modalIn .2s ease;
    }
    @keyframes modalIn { from { transform:scale(.96); opacity:0; } to { transform:scale(1); opacity:1; } }
    .modal-head {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px;
    }
    .modal-head h3 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .modal-close {
      background: none; border: none; cursor: pointer;
      color: var(--text-3); font-size: 0.9rem;
      width: 28px; height: 28px; border-radius: var(--r-sm);
      display: flex; align-items: center; justify-content: center;
      transition: all .1s;
    }
    .modal-close:hover { background: var(--surface-2); color: var(--text); }
    .form-grp { margin-bottom: 16px; }
    .form-grp label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 6px; color: var(--text-2); }
    .form-input {
      width: 100%; padding: 8px 12px;
      border: 1px solid var(--border); border-radius: var(--r-md);
      font-size: 0.82rem; font-family: 'DM Sans', sans-serif;
      color: var(--text); background: var(--surface);
      transition: border-color .12s;
    }
    .form-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(8,153,166,.1); }
    .radio-row { display: flex; gap: 8px; flex-wrap: wrap; }
    .radio-opt {
      display: flex; align-items: center; gap: 5px;
      font-size: 0.8rem; cursor: pointer;
      padding: 5px 10px; border-radius: var(--r-sm);
      border: 1px solid var(--border); background: var(--surface);
      transition: all .12s; font-family: 'DM Sans', sans-serif;
    }
    .radio-opt input { accent-color: var(--accent); }
    .radio-opt:has(input:checked) { background: var(--accent-light); border-color: var(--accent-mid); }
    .check-grid { display: flex; flex-wrap: wrap; gap: 6px; }
    .check-opt {
      display: flex; align-items: center; gap: 5px;
      font-size: 0.78rem; cursor: pointer;
      padding: 4px 10px; border-radius: var(--r-sm);
      border: 1px solid var(--border); background: var(--surface);
      transition: all .12s; font-family: 'DM Sans', sans-serif;
    }
    .check-opt input { accent-color: var(--accent); }
    .check-opt:has(input:checked) { background: var(--accent-light); border-color: var(--accent-mid); }
    .modal-foot { display: flex; gap: 8px; justify-content: flex-end; margin-top: 20px; }

    /* ─── SCROLL ─────────────────────────────────── */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    /* ─── RESPONSIVE ─────────────────────────────── */
    @media (max-width: 1280px) {
      .grid-4-4-4 { grid-template-columns: 1fr 1fr; }
      .kpi-row    { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 1024px) {
      .grid-6-4, .grid-5-5, .grid-4-8 { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .grid-4-4-4, .kpi-row { grid-template-columns: 1fr 1fr; }
    }
  </style>
</head>
<body>

<div class="layout">

  <!-- ══ SIDEBAR ════════════════════════════════════════ -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <a href="#" class="logo">
        <div class="logo-mark">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 13v-2H9v-2h2V9h2v2h2v2h-2v2h-2z"/>
          </svg>
        </div>
        <span class="logo-text"><span class="f">Farma</span><span class="c">Connect</span></span>
      </a>
    </div>

    <nav>
      <div class="nav-section">
        <span class="nav-label">Menu</span>

        <button class="nav-item active" onclick="setActive(this)">
          <i class="bi bi-grid-1x2"></i> Dashboard
        </button>

        <!-- Stock -->
        <div class="has-sub" id="sub-stock">
          <button class="nav-item" onclick="toggleSub('sub-stock')">
            <i class="bi bi-archive"></i> Stock
            <span class="nav-badge nb-amber">3</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-list-ul"></i> Lista de produtos</div>
            <div class="sub-item"><i class="bi bi-plus-circle"></i> Adicionar produto</div>
            <div class="sub-item"><i class="bi bi-upload"></i> Importar CSV</div>
            <div class="sub-item"><i class="bi bi-exclamation-triangle"></i> Stock baixo <span class="nav-badge nb-red" style="margin-left:4px">3</span></div>
          </div>
        </div>

        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-truck"></i> Pedidos
          <span class="nav-badge nb-red">12</span>
        </button>

        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-person-badge"></i> Entregadores
          <span class="nav-badge nb-teal">4</span>
        </button>

        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-people"></i> Clientes
        </button>

        <span class="nav-label">Análise</span>

        <!-- Relatórios -->
        <div class="has-sub" id="sub-rel">
          <button class="nav-item" onclick="toggleSub('sub-rel')">
            <i class="bi bi-bar-chart-line"></i> Relatórios
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-cash-stack"></i> Vendas</div>
            <div class="sub-item"><i class="bi bi-archive"></i> Stock</div>
            <div class="sub-item"><i class="bi bi-truck"></i> Entregas</div>
            <div class="sub-item"><i class="bi bi-star"></i> Avaliações</div>
          </div>
        </div>

        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-star"></i> Avaliações
          <span class="nav-badge nb-amber">8</span>
        </button>

        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-arrow-left-right"></i> Comparar Preços
        </button>

        <span class="nav-label">Gestão</span>

        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-file-earmark-text"></i> Documentos
          <span class="nav-badge nb-slate">2</span>
        </button>

        <!-- Configurações -->
        <div class="has-sub" id="sub-cfg">
          <button class="nav-item" onclick="toggleSub('sub-cfg')">
            <i class="bi bi-gear"></i> Configurações
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-person"></i> Perfil</div>
            <div class="sub-item"><i class="bi bi-shop"></i> Farmácia</div>
            <div class="sub-item"><i class="bi bi-clock"></i> Horário</div>
            <div class="sub-item"><i class="bi bi-bell"></i> Notificações</div>
          </div>
        </div>

        <div class="nav-divider"></div>

        <button class="nav-item" style="color:var(--danger)">
          <i class="bi bi-box-arrow-right" style="color:var(--danger)"></i> Sair
        </button>
      </div>
    </nav>

    <div class="ph-card">
      <div class="ph-row">
        <span class="ph-name">Farmácia Central</span>
        <span class="ph-pill pill-open">Aberta</span>
      </div>
      <p class="ph-meta"><i class="bi bi-geo-alt"></i> Ingombotas, Luanda</p>
      <p class="ph-meta"><i class="bi bi-clock"></i> 08:00 – 22:00</p>
      <p class="ph-meta" style="opacity:.6;font-size:.68rem;margin-top:3px"><i class="bi bi-building"></i> Farmácias Unidas de Angola</p>
    </div>
  </aside>

  <!-- ══ MAIN ═══════════════════════════════════════════ -->
  <div class="main">

    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-left">
        <h1>Dashboard</h1>
        <span class="breadcrumb-sep"><i class="bi bi-slash-lg"></i></span>
        <span class="topbar-date" id="topbar-date">—</span>
      </div>
      <div class="topbar-right">
        <div class="ib" title="Pesquisar"><i class="bi bi-search"></i></div>
        <div class="ib" title="Notificações">
          <i class="bi bi-bell"></i>
          <span class="ib-dot"></span>
        </div>
        <div class="user-chip">
          <div class="u-avatar">FC</div>
          <div>
            <span class="u-name">Farmácia Central</span>
            <span class="u-role">Dr. António Silva</span>
          </div>
        </div>
      </div>
    </header>

    <div class="content">

      <!-- Alerta crítico -->
      {{-- <div class="alert alert-danger" id="alert-stock">
        <i class="bi bi-exclamation-circle"></i>
        <span><strong>Stock crítico:</strong> Paracetamol 500mg e Amoxicilina 250mg têm menos de 10 unidades.</span>
        <button class="alert-link">Ver stock</button>
        <button class="alert-close" onclick="document.getElementById('alert-stock').remove()"><i class="bi bi-x"></i></button>
      </div> --}}

      <!-- Action bar -->
      <div class="action-bar">
        <div class="action-bar-left">
          <button class="btn btn-primary" onclick="document.getElementById('modal-rel').classList.add('open')">
            <i class="bi bi-file-earmark-arrow-down"></i> Gerar Relatório
          </button>
          {{-- <button class="btn btn-outline">
            <i class="bi bi-plus-lg"></i> Novo Pedido
          </button> --}}
          {{-- <button class="btn btn-outline">
            <i class="bi bi-plus-lg"></i> Adicionar Produto
          </button> --}}
        </div>
        <div>
          <button class="btn btn-outline">
            <i class="bi bi-upload"></i> Importar CSV
          </button>
        </div>
      </div>

      <!-- ── KPIs ─────────────────────────────────────── -->
      <div class="kpi-row">
        <div class="kpi kpi-teal">
          <div class="kpi-head">
            <div class="kpi-ico teal"><i class="bi bi-cart3"></i></div>
            <span class="kpi-delta d-up"><i class="bi bi-arrow-up"></i> 18%</span>
          </div>
          <div class="kpi-val" id="kv-pedidos">24</div>
          <div class="kpi-lbl">Pedidos hoje</div>
          <div class="kpi-bar">
            <div style="display:flex;justify-content:space-between;font-size:.68rem;color:var(--text-4)">
              <span>19 em curso</span><span>5 entregues</span>
            </div>
            <div class="kpi-bar-track">
              <div class="kpi-bar-fill" style="width:79%;background:var(--accent)"></div>
            </div>
          </div>
        </div>

        <div class="kpi kpi-amber">
          <div class="kpi-head">
            <div class="kpi-ico amber"><i class="bi bi-cash-coin"></i></div>
            <span class="kpi-delta d-up"><i class="bi bi-arrow-up"></i> 12%</span>
          </div>
          <div class="kpi-val" id="kv-fat">142k Kz</div>
          <div class="kpi-lbl">Faturação hoje</div>
          <div class="kpi-bar">
            <div style="display:flex;justify-content:space-between;font-size:.68rem;color:var(--text-4)">
              <span>Meta: 200k Kz</span><span>71%</span>
            </div>
            <div class="kpi-bar-track">
              <div class="kpi-bar-fill" style="width:71%;background:var(--warning)"></div>
            </div>
          </div>
        </div>

        <div class="kpi kpi-red">
          <div class="kpi-head">
            <div class="kpi-ico red"><i class="bi bi-archive"></i></div>
            <span class="kpi-delta d-down"><i class="bi bi-exclamation"></i> 3 crítico</span>
          </div>
          <div class="kpi-val" id="kv-stock">248</div>
          <div class="kpi-lbl">Produtos em stock</div>
          <div class="kpi-sub">65% normal &nbsp;·&nbsp; 25% baixo &nbsp;·&nbsp; 10% crítico</div>
        </div>

        <div class="kpi kpi-green">
          <div class="kpi-head">
            <div class="kpi-ico green"><i class="bi bi-star-half"></i></div>
            <span class="kpi-delta d-flat">+8 novas</span>
          </div>
          <div class="kpi-val" id="kv-aval">4.7</div>
          <div class="kpi-lbl">Avaliação média</div>
          <div class="kpi-sub">De 312 avaliações totais</div>
        </div>
      </div>

      <!-- ── LINHA A: Pedidos recentes + Gráfico semanal ── -->
      <div class="grid-6-4">

        <!-- Pedidos recentes (tabela) -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-list-check"></i> Pedidos recentes</h3>
            <button class="card-link">Ver todos <i class="bi bi-arrow-right"></i></button>
          </div>
          <table class="mini-table" id="orders-table">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Medicamento</th>
                <th>Hora</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody id="orders-body"></tbody>
          </table>
        </div>

        <!-- Gráfico semanal de pedidos -->
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

      <!-- ── LINHA B: Stock crítico + Entregadores + Estado stock ── -->
      <div class="grid-4-4-4">

        <!-- Stock crítico -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-exclamation-triangle"></i> Stock crítico</h3>
            <button class="card-link">Repor</button>
          </div>
          <div id="stock-list"></div>
        </div>

        <!-- Entregadores -->
        {{-- <div class="card"> --}}
          {{-- <div class="card-head">
            <h3><i class="bi bi-person-badge"></i> Entregadores</h3>
            <button class="card-link">Gerir</button>
          </div> --}}
          {{-- <div id="del-list"></div> --}}
        {{-- </div> --}}

        <!-- Gráfico doughnut stock -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-pie-chart"></i> Estado do stock</h3>
            <button class="card-link">Detalhes</button>
          </div>
          <div class="chart-wrap-sm">
            <canvas id="chartStock"></canvas>
          </div>
        </div>
      </div>

      <!-- ── LINHA C: Avaliações + Comparação preços + Ações rápidas ── -->
      <div class="grid-4-4-4">

        <!-- Avaliações -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-star"></i> Avaliações de clientes</h3>
            <button class="card-link">Ver todas</button>
          </div>
          <div style="display:flex;align-items:center;gap:14px;margin-bottom:12px">
            <div style="text-align:center;flex-shrink:0">
              <div style="font-family:'Sora',sans-serif;font-size:2.2rem;font-weight:700;line-height:1;color:var(--text)">4.7</div>
              <div style="font-size:.65rem;color:var(--text-3);margin-top:3px">312 avaliações</div>
              <div style="color:var(--warning);font-size:.75rem;margin-top:4px">★★★★★</div>
            </div>
            <div style="flex:1" id="rat-bars"></div>
          </div>
          <div class="info-box" style="border-left:3px solid var(--warning)">
            <p style="font-size:.72rem;font-style:italic;color:var(--text-2)">"Entrega rápida e produto em bom estado. Recomendo!"</p>
            <p style="font-size:.68rem;color:var(--text-4);margin-top:4px">— Ana M. · Hoje, 10:23</p>
          </div>
        </div>


        <!-- Ações rápidas + próxima entrega -->
 
      </div>

      <!-- ── LINHA D: Gráfico entregadores + Origem pedidos + Documentos ── -->
      <div class="grid-4-4-4">

        <!-- Entregas por entregador -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-bar-chart"></i> Entregas por entregador</h3>
            <button class="card-link">Detalhes</button>
          </div>
          <div class="chart-wrap-sm">
            <canvas id="chartEntregadores"></canvas>
          </div>
        </div>

        <!-- Origem dos pedidos -->
        <div class="card">
          <div class="card-head">
            <h3><i class="bi bi-geo-alt"></i> Origem dos pedidos</h3>
            <button class="card-link">Mapa</button>
          </div>
          <div class="chart-wrap-sm">
            <canvas id="chartOrigem"></canvas>
          </div>
        </div>


      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /layout -->

<!-- ══ MODAL RELATÓRIO ════════════════════════════════════ -->
<div class="overlay" id="modal-rel">
  <div class="modal-box">
    <div class="modal-head">
      <h3>Gerar Relatório</h3>
      <button class="modal-close" onclick="document.getElementById('modal-rel').classList.remove('open')">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>

    <div class="form-grp">
      <label>Período</label>
      <div class="radio-row">
        <label class="radio-opt"><input type="radio" name="periodo" value="hoje" checked> Hoje</label>
        <label class="radio-opt"><input type="radio" name="periodo" value="semana"> 7 dias</label>
        <label class="radio-opt"><input type="radio" name="periodo" value="mes"> 30 dias</label>
        <label class="radio-opt"><input type="radio" name="periodo" value="custom"> Personalizado</label>
      </div>
    </div>

    <div id="custom-dates" style="display:none">
      <div class="form-grp">
        <label>Data inicial</label>
        <input type="date" class="form-input" id="dt-ini">
      </div>
      <div class="form-grp">
        <label>Data final</label>
        <input type="date" class="form-input" id="dt-fim">
      </div>
    </div>

    <div class="form-grp">
      <label>Formato</label>
      <div class="radio-row">
        <label class="radio-opt"><input type="radio" name="formato" value="pdf" checked> PDF</label>
        <label class="radio-opt"><input type="radio" name="formato" value="excel"> Excel</label>
      </div>
    </div>

    <div class="form-grp">
      <label>Secções a incluir</label>
      <div class="check-grid">
        <label class="check-opt"><input type="checkbox" checked> Pedidos</label>
        <label class="check-opt"><input type="checkbox" checked> Faturação</label>
        <label class="check-opt"><input type="checkbox" checked> Stock</label>
        <label class="check-opt"><input type="checkbox" checked> Entregadores</label>
        <label class="check-opt"><input type="checkbox" checked> Avaliações</label>
        <label class="check-opt"><input type="checkbox"> Comparação de preços</label>
      </div>
    </div>

    <div class="modal-foot">
      <button class="btn btn-outline" onclick="document.getElementById('modal-rel').classList.remove('open')">Cancelar</button>
      <button class="btn btn-primary" onclick="gerarRelatorio()"><i class="bi bi-download"></i> Gerar</button>
    </div>
  </div>
</div>

<script>
/* ──────────────────────────────────────────────
   DADOS (substituir por Blade / fetch API)
────────────────────────────────────────────── */
const PEDIDOS = [
  { init:'AS', nome:'Ana Santos',     med:'Paracetamol · Vitamina C', hora:'10:42', status:'tag-route',  label:'Em rota' },
  { init:'MC', nome:'Manuel Costa',   med:'Amoxicilina 500mg',         hora:'10:18', status:'tag-prep',   label:'A preparar' },
  { init:'LF', nome:'Lúcia Ferreira', med:'Insulina · Seringas',        hora:'09:55', status:'tag-new',    label:'Novo' },
  { init:'JP', nome:'João Pedro',     med:'Ibuprofeno 400mg',           hora:'09:30', status:'tag-done',   label:'Entregue' },
  { init:'CB', nome:'Catarina B.',    med:'Omeprazol · Antácido',       hora:'09:10', status:'tag-prep',   label:'A preparar' },
  { init:'FM', nome:'Fernando Mata',  med:'Loratadina 10mg',            hora:'08:50', status:'tag-done',   label:'Entregue' },
];

const STOCK_CRITICO = [
  { nome:'Paracetamol 500mg',   qty:4,  max:50 },
  { nome:'Amoxicilina 250mg',   qty:7,  max:50 },
  { nome:'Soro Fisiológico 1L', qty:12, max:50 },
  { nome:'Ibuprofeno 400mg',    qty:18, max:50 },
  { nome:'Metformina 850mg',    qty:31, max:50 },
];

const ENTREGADORES = [
  { nome:'João Augusto',    estado:'dot-busy',    info:'2 em rota',          badge:'nb-amber', lbl:'Ocupado' },
  { nome:'Maria Conceição', estado:'dot-online',  info:'Disponível · 8 hoje',badge:'nb-teal',  lbl:'Livre' },
  { nome:'Pedro Nzinga',    estado:'dot-busy',    info:'1 em rota',          badge:'nb-amber', lbl:'Ocupado' },
  { nome:'Ana Kavindele',   estado:'dot-online',  info:'Disponível · 12 hj', badge:'nb-teal',  lbl:'Livre' },
  { nome:'Carlos Mbemba',   estado:'dot-offline', info:'Folga',              badge:'nb-slate', lbl:'Off' },
];

const RATINGS = [
  { s:'5 ★', n:225, p:72 },
  { s:'4 ★', n:56,  p:18 },
  { s:'3 ★', n:19,  p:6  },
  { s:'2 ★', n:7,   p:2  },
  { s:'1 ★', n:5,   p:2  },
];

const PRECOS = [
  { nome:'Farmácia Central (você)', p:850, pct:68, self:true  },
  { nome:'Farmácia Kilamba',         p:920, pct:74, self:false },
  { nome:'Farmácia Talatona',        p:980, pct:78, self:false },
  { nome:'Farmácia Maianga',         p:790, pct:63, self:false },
];

/* ──────────────────────────────────────────────
   DATA
────────────────────────────────────────────── */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const now   = new Date();
document.getElementById('topbar-date').textContent =
  `${DIAS[now.getDay()]}, ${now.getDate()} de ${MESES[now.getMonth()]} de ${now.getFullYear()}`;

/* ──────────────────────────────────────────────
   RENDER: PEDIDOS
────────────────────────────────────────────── */
const tbody = document.getElementById('orders-body');
PEDIDOS.forEach(p => {
  tbody.innerHTML += `
    <tr>
      <td>
        <div style="display:flex;align-items:center;gap:7px">
          <div class="row-avatar">${p.init}</div>
          <span class="row-name">${p.nome}</span>
        </div>
      </td>
      <td style="color:var(--text-3)">${p.med}</td>
      <td style="color:var(--text-4)">${p.hora}</td>
      <td><span class="tag ${p.status}">${p.label}</span></td>
    </tr>`;
});

/* ──────────────────────────────────────────────
   RENDER: STOCK
────────────────────────────────────────────── */
const stockEl = document.getElementById('stock-list');
STOCK_CRITICO.forEach(s => {
  const pct = Math.round((s.qty / s.max) * 100);
  const col  = pct < 15 ? 'var(--danger)' : pct < 35 ? 'var(--warning)' : 'var(--success)';
  stockEl.innerHTML += `
    <div class="list-row">
      <div style="flex:1">
        <div class="row-name">${s.nome}</div>
        <div class="row-sub">${s.qty} un. restantes</div>
      </div>
      <div class="sbar-wrap"><div class="sbar-fill" style="width:${pct}%;background:${col}"></div></div>
    </div>`;
});

/* ──────────────────────────────────────────────
   RENDER: ENTREGADORES
────────────────────────────────────────────── */


/* ──────────────────────────────────────────────
   RENDER: RATINGS
────────────────────────────────────────────── */
const ratEl = document.getElementById('rat-bars');
RATINGS.forEach(r => {
  ratEl.innerHTML += `
    <div class="rat-row">
      <span class="rat-lbl">${r.s}</span>
      <div class="rat-track"><div class="rat-fill" style="width:${r.p}%"></div></div>
      <span class="rat-num">${r.n}</span>
    </div>`;
});



/* ──────────────────────────────────────────────
   CHARTS
────────────────────────────────────────────── */
const chartOpts = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: { legend: { display: false } },
};

// Pedidos linha
new Chart(document.getElementById('chartPedidos'), {
  type: 'line',
  data: {
    labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    datasets: [{
      label: 'Pedidos',
      data: [12, 19, 15, 17, 24, 23, 10],
      borderColor: '#0899a6',
      backgroundColor: 'rgba(8,153,166,.07)',
      tension: 0.4, fill: true,
      pointBackgroundColor: '#0899a6',
      pointRadius: 3, pointHoverRadius: 5,
      borderWidth: 2,
    }]
  },
  options: {
    ...chartOpts,
    scales: {
      x: { grid: { display:false }, ticks: { font:{ family:'DM Sans', size:10 }, color:'#94a3b8' } },
      y: { grid: { color:'#f1f5f9' }, ticks: { font:{ family:'DM Sans', size:10 }, color:'#94a3b8' }, beginAtZero:true }
    },
    plugins: { legend:{ display:false }, tooltip:{ mode:'index', intersect:false } }
  }
});

// Stock donut
new Chart(document.getElementById('chartStock'), {
  type: 'doughnut',
  data: {
    labels: ['Normal', 'Baixo', 'Crítico'],
    datasets: [{
      data: [65, 25, 10],
      backgroundColor: ['#16a34a', '#d97706', '#d94040'],
      borderWidth: 2, borderColor: '#fff', hoverOffset: 4,
    }]
  },
  options: {
    ...chartOpts,
    cutout: '65%',
    plugins: {
      legend: {
        display: true, position: 'bottom',
        labels: { font:{ family:'DM Sans', size:10 }, boxWidth:8, boxHeight:8, padding:10, color:'#64748b' }
      }
    }
  }
});

// Entregadores bar
new Chart(document.getElementById('chartEntregadores'), {
  type: 'bar',
  data: {
    labels: ['João A.', 'Maria C.', 'Pedro N.', 'Ana K.'],
    datasets: [{
      label: 'Entregas',
      data: [18, 8, 7, 12],
      backgroundColor: 'rgba(8,153,166,.8)',
      borderRadius: 5, borderSkipped: false,
    }]
  },
  options: {
    ...chartOpts,
    scales: {
      x: { grid:{ display:false }, ticks:{ font:{ family:'DM Sans', size:10 }, color:'#94a3b8' } },
      y: { grid:{ color:'#f1f5f9' }, ticks:{ font:{ family:'DM Sans', size:10 }, color:'#94a3b8' }, beginAtZero:true }
    }
  }
});

// Origem pizza
new Chart(document.getElementById('chartOrigem'), {
  type: 'pie',
  data: {
    labels: ['Ingombotas', 'Maianga', 'Alvalade', 'Kilamba', 'Talatona'],
    datasets: [{
      data: [42, 38, 51, 27, 33],
      backgroundColor: ['#0899a6','#4ec3b0','#2c7a78','#0f4e5a','#94a3b8'],
      borderWidth: 2, borderColor: '#fff', hoverOffset: 4,
    }]
  },
  options: {
    ...chartOpts,
    plugins: {
      legend: {
        display: true, position: 'right',
        labels: { font:{ family:'DM Sans', size:10 }, boxWidth:8, boxHeight:8, padding:8, color:'#64748b' }
      }
    }
  }
});

/* ──────────────────────────────────────────────
   SIDEBAR
────────────────────────────────────────────── */
function setActive(el) {
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}
function toggleSub(id) {
  document.getElementById(id).classList.toggle('open');
}

/* ──────────────────────────────────────────────
   MODAL
────────────────────────────────────────────── */
document.querySelectorAll('input[name="periodo"]').forEach(r =>
  r.addEventListener('change', function() {
    document.getElementById('custom-dates').style.display = this.value === 'custom' ? 'block' : 'none';
  })
);

document.getElementById('modal-rel').addEventListener('click', function(e) {
  if (e.target === this) this.classList.remove('open');
});

function gerarRelatorio() {
  const periodo = document.querySelector('input[name="periodo"]:checked').value;
  const formato = document.querySelector('input[name="formato"]:checked').value;
  if (periodo === 'custom') {
    const i = document.getElementById('dt-ini').value;
    const f = document.getElementById('dt-fim').value;
    if (!i || !f) { alert('Selecione as datas de início e fim.'); return; }
  }
  alert(`Relatório em geração\nPeríodo: ${periodo} · Formato: ${formato.toUpperCase()}\n\n(Integrar com API Laravel para gerar o ficheiro real.)`);
  document.getElementById('modal-rel').classList.remove('open');
}
</script>
</body>
</html>