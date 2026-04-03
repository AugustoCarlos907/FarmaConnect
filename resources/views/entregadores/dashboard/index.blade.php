<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Dashboard Entregador</title>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
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
      --shadow-lg:  0 20px 60px rgba(9,22,26,.14);
      --shadow-teal:0 8px 32px rgba(11,191,204,.20);
    }

    html { font-size: 13px; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: #f2f7f9;
      color: var(--text-main);
      min-height: 100vh;
    }

    /* ─── LAYOUT ─────────────────────────────── */
    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ────────────────────────────── */
    .sidebar {
      width: 260px;
      background: var(--navy);
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      padding: 0;
      overflow: hidden;
      z-index: 100;
      animation: slideInLeft .5s cubic-bezier(.16,1,.3,1) both;
    }

    /* subtle background texture */
    .sidebar::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 160% 60% at 50% -10%, rgba(11,191,204,.12) 0%, transparent 60%),
        radial-gradient(ellipse 80% 80% at 110% 110%, rgba(11,191,204,.07) 0%, transparent 60%);
      pointer-events: none;
    }

    .sidebar-top {
      padding: 2rem 1.6rem 1.2rem;
      border-bottom: 1px solid var(--border);
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 2.5rem;
      text-decoration: none;
      display: block;
    }
    .logo .farma { color: var(--accent); }
    .logo .connect { color: #e0f7f5; }

    /* Deliverer profile strip */
    .driver-strip {
      display: flex;
      align-items: center;
      gap: .9rem;
      padding: 1rem 1.6rem;
      border-bottom: 1px solid var(--border);
    }
    .driver-avatar {
      width: 40px; height: 40px;
      background: linear-gradient(135deg, var(--teal), var(--teal-dim));
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      color: #fff;
      font-size: 1.1rem;
      flex-shrink: 0;
      box-shadow: 0 4px 14px rgba(11,191,204,.35);
    }
    .driver-info { flex: 1; min-width: 0; }
    .driver-name { font-weight: 600; color: #fff; font-size: .95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .driver-id { font-size: .75rem; color: var(--text-dim); }

    /* Status pill */
    .status-pill {
      display: flex;
      align-items: center;
      gap: .4rem;
      padding: .3rem .7rem;
      border-radius: 50px;
      font-size: .72rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }
    .status-pill.online  { background: rgba(30,201,122,.15); color: var(--green); border: 1px solid rgba(30,201,122,.25); }
    .status-pill.offline { background: rgba(240,78,96,.12);  color: var(--red);   border: 1px solid rgba(240,78,96,.2); }
    .status-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; animation: blink 2s infinite; }

    /* Nav */
    .sidebar-nav {
      flex: 1;
      padding: 1rem 1rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: .15rem;
    }
    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--navy-4); border-radius: 4px; }

    .nav-label {
      font-size: .67rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--text-dim);
      padding: .8rem .8rem .3rem;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: .85rem;
      padding: .72rem .9rem;
      border-radius: var(--r12);
      color: rgba(255,255,255,.5);
      text-decoration: none;
      font-size: .9rem;
      font-weight: 500;
      transition: all .2s;
      position: relative;
      cursor: pointer;
    }
    .nav-link i { font-size: 1.05rem; width: 20px; text-align: center; flex-shrink: 0; }
    .nav-link:hover { color: rgba(255,255,255,.85); background: rgba(255,255,255,.05); }
    .nav-link.active {
      color: #fff;
      background: linear-gradient(135deg, rgba(11,191,204,.25), rgba(11,191,204,.1));
      border: 1px solid rgba(11,191,204,.2);
    }
    .nav-link.active i { color: var(--teal); }
    .nav-link.active::before {
      content: '';
      position: absolute;
      left: 0; top: 20%; bottom: 20%;
      width: 3px;
      background: var(--teal);
      border-radius: 0 4px 4px 0;
    }

    .nav-badge {
      margin-left: auto;
      padding: .18rem .55rem;
      border-radius: 50px;
      font-size: .68rem;
      font-weight: 700;
    }
    .nb-teal   { background: rgba(11,191,204,.2);  color: var(--teal); }
    .nb-green  { background: rgba(30,201,122,.15); color: var(--green); }
    .nb-amber  { background: rgba(245,166,35,.15); color: var(--amber); }
    .nb-red    { background: rgba(240,78,96,.15);  color: var(--red); }

    .nav-divider { height: 1px; background: var(--border); margin: .6rem 0; }

    /* ─── MAIN ───────────────────────────────── */
    .main {
      flex: 1;
      margin-left: 260px;
      padding: 1.6rem 1.8rem;
      min-width: 0;
      animation: fadeUp .5s .1s cubic-bezier(.16,1,.3,1) both;
    }

    /* ─── TOPBAR ─────────────────────────────── */
    .topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--surface);
      border-radius: var(--r24);
      padding: .9rem 1.4rem;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-light);
      margin-bottom: 1.5rem;
      gap: 1rem;
    }
    .topbar-left { display: flex; align-items: center; gap: 1rem; }
    .topbar-greeting { font-family: 'Syne', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--text-main); line-height: 1.1; }
    .topbar-sub { font-size: .8rem; color: var(--text-mid); margin-top: .1rem; }

    .topbar-right { display: flex; align-items: center; gap: .8rem; }

    .btn-report {
      display: flex; align-items: center; gap: .5rem;
      background: var(--teal);
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: .6rem 1.2rem;
      font-size: .85rem;
      font-weight: 600;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      transition: all .25s;
      box-shadow: 0 4px 16px rgba(11,191,204,.3);
    }
    .btn-report:hover { background: var(--teal-dim); transform: translateY(-1px); box-shadow: var(--shadow-teal); }

    .icon-btn {
      width: 40px; height: 40px;
      background: #f2f7f9;
      border: 1px solid var(--border-light);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      position: relative;
      transition: all .2s;
    }
    .icon-btn:hover { background: var(--teal-ultra); border-color: var(--teal); }
    .icon-btn i { font-size: 1.05rem; color: var(--text-mid); }
    .notif-dot {
      position: absolute; top: 6px; right: 7px;
      width: 8px; height: 8px;
      background: var(--red); border-radius: 50%;
      border: 2px solid #fff;
    }

    /* ─── KPI ROW ─────────────────────────────── */
    .kpi-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
      margin-bottom: 1.2rem;
    }

    .kpi-card {
      background: var(--surface);
      border-radius: var(--r24);
      padding: 1.3rem 1.4rem;
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-sm);
      display: flex;
      gap: 1rem;
      align-items: flex-start;
      transition: all .25s;
      position: relative;
      overflow: hidden;
    }
    .kpi-card::after {
      content: '';
      position: absolute;
      top: 0; right: 0;
      width: 80px; height: 80px;
      background: radial-gradient(circle at top right, var(--teal-ultra) 0%, transparent 70%);
      pointer-events: none;
    }
    .kpi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); border-color: rgba(11,191,204,.3); }

    .kpi-icon-wrap {
      width: 46px; height: 46px; flex-shrink: 0;
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem;
    }
    .kpi-icon-wrap.teal  { background: rgba(11,191,204,.12); color: var(--teal); }
    .kpi-icon-wrap.green { background: rgba(30,201,122,.12); color: var(--green); }
    .kpi-icon-wrap.amber { background: rgba(245,166,35,.12); color: var(--amber); }

    .kpi-body { flex: 1; min-width: 0; }
    .kpi-value { font-family: 'Syne', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.1; color: var(--text-main); }
    .kpi-label { font-size: .8rem; color: var(--text-mid); margin-top: .15rem; }
    .kpi-trend {
      display: inline-flex; align-items: center; gap: .2rem;
      margin-top: .4rem;
      font-size: .72rem; font-weight: 600;
      padding: .15rem .5rem;
      border-radius: 50px;
    }
    .kpi-trend.up   { background: rgba(30,201,122,.12); color: var(--green); }
    .kpi-trend.down { background: rgba(240,78,96,.12);  color: var(--red); }

    /* ─── GRID AREAS ─────────────────────────── */
    .grid-main {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .grid-bottom {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    /* ─── CARD SHELL ─────────────────────────── */
    .card {
      background: var(--surface);
      border-radius: var(--r24);
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
      transition: box-shadow .25s;
    }
    .card:hover { box-shadow: var(--shadow-md); }

    .card-head {
      display: flex; align-items: center; justify-content: space-between;
      padding: 1.2rem 1.4rem .8rem;
    }
    .card-title {
      display: flex; align-items: center; gap: .5rem;
      font-family: 'Syne', sans-serif;
      font-size: 1rem; font-weight: 700;
      color: var(--text-main);
    }
    .card-title-icon {
      width: 30px; height: 30px;
      background: var(--teal-ultra);
      border: 1px solid rgba(11,191,204,.15);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: .85rem; color: var(--teal);
    }
    .card-link { font-size: .8rem; color: var(--teal); font-weight: 600; text-decoration: none; }
    .card-link:hover { color: var(--teal-dim); }

    .card-body { padding: 0 1.4rem 1.4rem; }

    /* ─── DELIVERIES LIST ────────────────────── */
    .delivery-list { display: flex; flex-direction: column; gap: .6rem; }
    .delivery-item {
      display: flex;
      align-items: center;
      gap: .9rem;
      padding: .9rem 1rem;
      border-radius: var(--r16);
      background: #f7fbfc;
      border: 1px solid transparent;
      transition: all .2s;
      cursor: pointer;
    }
    .delivery-item:hover { background: var(--teal-ultra); border-color: rgba(11,191,204,.2); }

    .di-icon {
      width: 38px; height: 38px; flex-shrink: 0;
      background: rgba(11,191,204,.1);
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: .95rem; color: var(--teal);
    }
    .di-body { flex: 1; min-width: 0; }
    .di-name { font-size: .88rem; font-weight: 600; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .di-sub  { font-size: .75rem; color: var(--text-mid); margin-top: .1rem; }

    .status-chip {
      padding: .28rem .75rem;
      border-radius: 50px;
      font-size: .72rem; font-weight: 700;
      white-space: nowrap;
    }
    .chip-green { background: rgba(30,201,122,.12); color: var(--green); }
    .chip-amber { background: rgba(245,166,35,.12);  color: var(--amber); }
    .chip-red   { background: rgba(240,78,96,.12);   color: var(--red); }

    /* ─── MAP ────────────────────────────────── */
    .map-wrap {
      height: 200px;
      border-radius: var(--r16);
      overflow: hidden;
      border: 1px solid var(--border-light);
      margin: 0 1.4rem;
    }
    #deliveryMap { height: 100%; width: 100%; }

    .map-footer {
      display: flex;
      justify-content: space-between;
      padding: .7rem 1.4rem 1.2rem;
    }
    .map-pill {
      display: flex; align-items: center; gap: .35rem;
      font-size: .75rem; color: var(--text-mid); font-weight: 500;
    }
    .map-pill i { font-size: .8rem; color: var(--teal); }

    /* ─── HISTORY LIST ───────────────────────── */
    .history-list { display: flex; flex-direction: column; }
    .history-item {
      display: flex; align-items: center; gap: .9rem;
      padding: .8rem 1.4rem;
      border-bottom: 1px solid var(--border-light);
      transition: background .15s;
      cursor: pointer;
    }
    .history-item:last-child { border-bottom: none; }
    .history-item:hover { background: #f7fbfc; }

    .hi-icon {
      width: 34px; height: 34px; flex-shrink: 0;
      background: rgba(30,201,122,.1);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: .85rem; color: var(--green);
    }
    .hi-body { flex: 1; min-width: 0; }
    .hi-name { font-size: .86rem; font-weight: 600; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .hi-sub  { font-size: .73rem; color: var(--text-mid); }
    .hi-val  { font-size: .9rem; font-weight: 700; color: var(--teal); white-space: nowrap; }

    /* ─── CHART CARD ─────────────────────────── */
    .perf-stats {
      display: flex; gap: .6rem;
      margin: 0 1.4rem .8rem;
    }
    .ps-item {
      flex: 1;
      text-align: center;
      padding: .6rem .5rem;
      background: #f7fbfc;
      border-radius: var(--r12);
      border: 1px solid var(--border-light);
    }
    .ps-val { font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--teal); }
    .ps-lbl { font-size: .7rem; color: var(--text-mid); margin-top: .1rem; }

    .chart-wrap {
      height: 160px;
      padding: 0 1.4rem 1.2rem;
    }

    /* ─── ANIMATIONS ─────────────────────────── */
    @keyframes slideInLeft {
      from { transform: translateX(-20px); opacity: 0; }
      to   { transform: translateX(0);     opacity: 1; }
    }
    @keyframes fadeUp {
      from { transform: translateY(16px); opacity: 0; }
      to   { transform: translateY(0);    opacity: 1; }
    }
    @keyframes blink {
      0%,100% { opacity: 1; }
      50%      { opacity: .4; }
    }
    @keyframes pulse-ring {
      0%   { box-shadow: 0 0 0 0 rgba(11,191,204,.4); }
      70%  { box-shadow: 0 0 0 8px rgba(11,191,204,0); }
      100% { box-shadow: 0 0 0 0 rgba(11,191,204,0); }
    }

    /* ─── MODAL ──────────────────────────────── */
    .modal-overlay {
      display: none;
      position: fixed; inset: 0;
      background: rgba(9,22,26,.55);
      backdrop-filter: blur(4px);
      z-index: 500;
      align-items: center; justify-content: center;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
      background: var(--surface);
      border-radius: var(--r24);
      width: 90%; max-width: 480px;
      box-shadow: var(--shadow-lg);
      animation: fadeUp .3s cubic-bezier(.16,1,.3,1);
      overflow: hidden;
    }
    .modal-hd {
      display: flex; align-items: center; justify-content: space-between;
      padding: 1.4rem 1.6rem;
      border-bottom: 1px solid var(--border-light);
    }
    .modal-hd h3 { font-family: 'Syne', sans-serif; font-size: 1.05rem; font-weight: 700; color: var(--text-main); }
    .modal-close {
      background: #f2f7f9; border: none;
      width: 32px; height: 32px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; font-size: 1rem; color: var(--text-mid);
      transition: all .2s;
    }
    .modal-close:hover { background: var(--teal-ultra); color: var(--teal); }
    .modal-body { padding: 1.4rem 1.6rem; }
    .modal-ft {
      display: flex; justify-content: flex-end; gap: .8rem;
      padding: 1rem 1.6rem;
      border-top: 1px solid var(--border-light);
      background: #f9fbfc;
    }

    .form-label { font-size: .82rem; font-weight: 600; color: var(--text-main); display: block; margin-bottom: .5rem; }
    .form-group { margin-bottom: 1.1rem; }
    .radio-row { display: flex; flex-wrap: wrap; gap: .5rem; }
    .radio-chip {
      display: flex; align-items: center; gap: .4rem;
      padding: .45rem .9rem;
      border-radius: 50px;
      border: 1.5px solid var(--border-light);
      font-size: .82rem; font-weight: 500; color: var(--text-mid);
      cursor: pointer; transition: all .2s;
    }
    .radio-chip input[type=radio] { display: none; }
    .radio-chip:has(input:checked) {
      border-color: var(--teal);
      background: var(--teal-ultra);
      color: var(--teal-dim);
      font-weight: 600;
    }
    .form-input {
      width: 100%; padding: .7rem .9rem;
      border: 1.5px solid var(--border-light);
      border-radius: var(--r12);
      font-family: 'DM Sans', sans-serif;
      font-size: .87rem; color: var(--text-main);
      outline: none; transition: border-color .2s;
    }
    .form-input:focus { border-color: var(--teal); }

    .btn-cancel {
      padding: .65rem 1.3rem;
      border-radius: 50px;
      background: #eef3f5;
      border: none;
      font-family: 'DM Sans', sans-serif;
      font-size: .85rem; font-weight: 600; color: var(--text-mid);
      cursor: pointer; transition: all .2s;
    }
    .btn-cancel:hover { background: #e2eaed; }
    .btn-primary {
      padding: .65rem 1.4rem;
      border-radius: 50px;
      background: var(--teal);
      border: none;
      font-family: 'DM Sans', sans-serif;
      font-size: .85rem; font-weight: 600; color: #fff;
      cursor: pointer; transition: all .2s;
      box-shadow: 0 4px 14px rgba(11,191,204,.3);
    }
    .btn-primary:hover { background: var(--teal-dim); transform: translateY(-1px); }

    /* ─── SCROLLBAR ──────────────────────────── */
    .scroller { overflow-y: auto; max-height: 260px; }
    .scroller::-webkit-scrollbar { width: 4px; }
    .scroller::-webkit-scrollbar-track { background: transparent; }
    .scroller::-webkit-scrollbar-thumb { background: #d4e4e8; border-radius: 4px; }

    /* Estado vazio */
    .empty-state {
        text-align: center;
        padding: 20px;
        color: #999;
        font-style: italic;

    /* ─── RESPONSIVE ─────────────────────────── */
    @media (max-width:1200px) {
      .grid-main, .grid-bottom { grid-template-columns: 1fr; }
      .kpi-row { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width:900px) {
      .sidebar { display: none; }
      .main { margin-left: 0; }
      .kpi-row { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
<div class="layout">

  <!-- ══════════════ SIDEBAR ══════════════ -->
  @include('entregadores.dashboard.sidebar')

  <!-- ══════════════ MAIN ══════════════ -->
  <main class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <div>
          {{-- <div class="topbar-greeting">Bom dia, João 👋</div> --}}
          <div class="topbar-sub">Terça-feira, 31 de Março de 2026</div>
        </div>
      </div>
      <div class="topbar-right">
        {{-- <button class="btn-report" onclick="openModal()">
          <i class="bi bi-file-earmark-arrow-down"></i>
          Relatório
        </button> --}}
        <div class="icon-btn" title="Notificações">
          <i class="bi bi-bell"></i>
          <span class="notif-dot"></span>
        </div>
      </div>
    </div>

    <!-- KPIs -->
    <div class="kpi-row">
      <div class="kpi-card">
        <div class="kpi-icon-wrap teal"><i class="bi bi-truck"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ $entregasHoje->count() }}</div>
          <div class="kpi-label">Entregas hoje</div>
          {{-- <div class="kpi-trend up"><i class="bi bi-arrow-up-short"></i>+2 vs ontem</div> --}}
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap green"><i class="bi bi-cash-stack"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">
              {{ number_format($entregasHoje->sum(fn($e) => $e->pedido->total), 0, ',', '.') }}
              <span style="font-size:1rem;font-weight:500;color:var(--text-mid)"> KZ</span>
          </div>

          {{-- <div class="kpi-value">{{ $entregasHoje->pedido->sum('total') }}<span style="font-size:1rem;font-weight:500;color:var(--text-mid)"> KZ</span></div> --}}
          <div class="kpi-label">Ganhos hoje</div>
          {{-- <div class="kpi-trend up"><i class="bi bi-arrow-up-short"></i>+12% esta semana</div> --}}
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap amber"><i class="bi bi-clock-history"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ $entregaTotal }}</div>
          <div class="kpi-label">Total de entregas</div>
          {{-- <div class="kpi-trend up"><i class="bi bi-arrow-up-short"></i>98.4% concluídas</div> --}}
        </div>
      </div>
    </div>

    <!-- Main grid -->
    <div class="grid-main">

      <!-- Entregas em Andamento -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-activity"></i></div>
            Entregas em Andamento
          </div>
          <a href="#" class="card-link">Ver todas</a>
        </div>
        <div class="card-body">
          <div class="delivery-list">
            <div class="delivery-item">
              <div class="di-icon"><i class="bi bi-shop"></i></div>
              <div class="di-body">
                <div class="di-name">Farmácia Central → Ingombotas</div>
                <div class="di-sub">Cliente: Maria S. · 2 itens · 1.200 KZ</div>
              </div>
              <span class="status-chip chip-green">Em andamento</span>
            </div>
            <div class="delivery-item">
              <div class="di-icon"><i class="bi bi-shop"></i></div>
              <div class="di-body">
                <div class="di-name">Farmácia Talatona → Benfica</div>
                <div class="di-sub">Cliente: Ana P. · 1 item · 800 KZ</div>
              </div>
              <span class="status-chip chip-amber">A caminho</span>
            </div>
            <div class="delivery-item">
              <div class="di-icon"><i class="bi bi-shop"></i></div>
              <div class="di-body">
                <div class="di-name">Farmácia Kilamba → Talatona</div>
                <div class="di-sub">Cliente: Carlos M. · 3 itens · 2.200 KZ</div>
              </div>
              <span class="status-chip chip-green">Em andamento</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Mapa -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-geo-alt"></i></div>
            Entrega Atual
          </div>
          <a href="#" class="card-link">Detalhes</a>
        </div>
        <div class="map-wrap">
          <div id="deliveryMap"></div>
        </div>
        <div class="map-footer">
          <div class="map-pill"><i class="bi bi-shop"></i> Farmácia Central</div>
          <div class="map-pill"><i class="bi bi-person"></i> Maria S.</div>
          <div class="map-pill"><i class="bi bi-clock"></i> ~10 min</div>
        </div>
      </div>
    </div>

    <!-- Bottom grid -->
    <div class="grid-bottom">

      <!-- Últimas entregas -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-check2-circle"></i></div>
            Últimas Entregas
          </div>
          <a href="#" class="card-link">Histórico</a>
        </div>
        
      <div class="scroller">
          <div class="history-list">
              @forelse ($lastEntregas as $entrega)
                  <div class="history-item">
                      <div class="hi-icon"><i class="bi bi-check-lg"></i></div>
                      <div class="hi-body">
                          <div class="hi-name">
                              {{ $entrega->pedido->farmacia->name }} → {{ $entrega->pedido->farmacia->bairro }}
                          </div>
                          <div class="hi-sub">
                              {{ $entrega->data_entrega ? \Carbon\Carbon::parse($entrega->data_entrega)->format('d/m · H:i') : 'Data pendente' }} 
                              · {{ $entrega->pedido->items->count() }} {{ Str::plural('item', $entrega->pedido->items->count()) }}
                          </div>
                      </div>
                      <div class="hi-val">
                          {{ number_format($entrega->pedido->total + $entrega->taxa_entrega, 2, ',', '.') }} €
                      </div>
                  </div>
              @empty
                  <div class="empty-state">Sem nenhuma entrega realizada.</div>
              @endforelse
          </div>
      </div>

      </div>

      <!-- Desempenho -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">
            <div class="card-title-icon"><i class="bi bi-graph-up"></i></div>
            Desempenho Semanal
          </div>
          <a href="#" class="card-link">Detalhes</a>
        </div>
        <div class="perf-stats">
          <div class="ps-item">
            <div class="ps-val">98.4%</div>
            <div class="ps-lbl">Taxa atual</div>
          </div>
          <div class="ps-item">
            <div class="ps-val" style="color:var(--green)">+2.1%</div>
            <div class="ps-lbl">vs mês anterior</div>
          </div>
          <div class="ps-item">
            <div class="ps-val" style="color:var(--amber)">4.9 ⭐</div>
            <div class="ps-lbl">Avaliação</div>
          </div>
        </div>
        <div class="chart-wrap">
          <canvas id="perfChart"></canvas>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- ══════════════ MODAL ══════════════ -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <div class="modal-hd">
      <h3>Gerar Relatório de Entregas</h3>
      <button class="modal-close" onclick="closeModal()"><i class="bi bi-x"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Período</label>
        <div class="radio-row">
          <label class="radio-chip"><input type="radio" name="periodo" value="hoje" checked> Hoje</label>
          <label class="radio-chip"><input type="radio" name="periodo" value="semana"> Últimos 7 dias</label>
          <label class="radio-chip"><input type="radio" name="periodo" value="mes"> Últimos 30 dias</label>
          <label class="radio-chip"><input type="radio" name="periodo" value="custom"> Personalizado</label>
        </div>
      </div>
      <div id="customDates" style="display:none">
        <div class="form-group">
          <label class="form-label">Data inicial</label>
          <input type="date" class="form-input" id="dInicio">
        </div>
        <div class="form-group">
          <label class="form-label">Data final</label>
          <input type="date" class="form-input" id="dFim">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Formato</label>
        <div class="radio-row">
          <label class="radio-chip"><input type="radio" name="formato" value="pdf" checked> PDF</label>
          <label class="radio-chip"><input type="radio" name="formato" value="excel"> Excel</label>
        </div>
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
      <button class="btn-primary" onclick="generateReport()"><i class="bi bi-download me-1"></i> Gerar Relatório</button>
    </div>
  </div>
</div>

<script>
  /* ── STATUS TOGGLE ── */
  let isOnline = true;
  function toggleStatus() {
    isOnline = !isOnline;
    const pill  = document.getElementById('statusPill');
    const label = document.getElementById('statusLabel');
    pill.className  = 'status-pill ' + (isOnline ? 'online' : 'offline');
    label.textContent = isOnline ? 'Online' : 'Offline';
  }

  /* ── MODAL ── */
  function openModal()  { document.getElementById('modalOverlay').classList.add('open'); }
  function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }
  document.getElementById('modalOverlay').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });

  document.querySelectorAll('input[name="periodo"]').forEach(r => {
    r.addEventListener('change', function() {
      document.getElementById('customDates').style.display = this.value === 'custom' ? 'block' : 'none';
    });
  });

  function generateReport() {
    const periodo = document.querySelector('input[name="periodo"]:checked').value;
    const formato = document.querySelector('input[name="formato"]:checked').value;
    if (periodo === 'custom') {
      if (!document.getElementById('dInicio').value || !document.getElementById('dFim').value) {
        alert('Selecione as datas de início e fim.'); return;
      }
    }
    closeModal();
    alert(`✅ Relatório ${formato.toUpperCase()} gerado com sucesso!\nPeríodo: ${periodo}`);
  }

  /* ── MAP ── */
  const map = L.map('deliveryMap', { zoomControl: false, attributionControl: false })
               .setView([-8.8383, 13.2344], 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

  const tealIcon = L.divIcon({
    html: '<div style="background:#0bbfcc;width:14px;height:14px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(11,191,204,.5)"></div>',
    iconSize: [14, 14], iconAnchor: [7, 7]
  });
  L.marker([-8.8183, 13.2320], { icon: tealIcon }).addTo(map)
   .bindPopup('<b>Farmácia Central → Ingombotas</b><br>~10 minutos').openPopup();

  /* ── PERFORMANCE CHART ── */
  new Chart(document.getElementById('perfChart').getContext('2d'), {
    type: 'line',
    data: {
      labels: ['Sem 1','Sem 2','Sem 3','Sem 4','Sem 5','Sem 6'],
      datasets: [{
        data: [96.2, 96.8, 97.5, 98.0, 98.2, 98.4],
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
      maintainAspectRatio: false,
      plugins: { legend: { display: false }, tooltip: {
        backgroundColor: '#09161a',
        titleColor: '#fff',
        bodyColor: 'rgba(255,255,255,.7)',
        callbacks: { label: v => ' ' + v.raw + '%' }
      }},
      scales: {
        y: { min: 95, max: 100, ticks: { callback: v => v + '%', font: { size: 10 }, color: '#8fadb5' }, grid: { color: 'rgba(0,0,0,.04)' } },
        x: { ticks: { font: { size: 10 }, color: '#8fadb5' }, grid: { display: false } }
      }
    }
  });
</script>
</body>
</html>