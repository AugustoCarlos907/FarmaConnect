<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Entregas</title>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

  <style>
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

    :root {
      --teal:        #0bbfcc;
      --teal-dim:    #08949f;
      --teal-glow:   rgba(11,191,204,.18);
      --teal-ultra:  rgba(11,191,204,.06);
      --navy:        #09161a;
      --navy-2:      #0d1f24;
      --navy-3:      #132a30;
      --navy-4:      #1b3840;
      --surface:     #ffffff;
      --border:      rgba(255,255,255,.07);
      --border-light:#e8eff2;
      --text-main:   #0e2228;
      --text-mid:    #4a6e78;
      --text-dim:    #8fadb5;
      --green:       #1ec97a;
      --amber:       #f5a623;
      --red:         #f04e60;
      --r24:24px; --r16:16px; --r12:12px;
      --shadow-sm:   0 2px 12px rgba(9,22,26,.06);
      --shadow-md:   0 8px 32px rgba(9,22,26,.10);
      --shadow-lg:   0 20px 60px rgba(9,22,26,.14);
      --shadow-teal: 0 8px 32px rgba(11,191,204,.20);
    }

    html { font-size:13px; }
    body { font-family:'DM Sans',sans-serif; background:#f2f7f9; color:var(--text-main); min-height:100vh; }
    .layout { display:flex; min-height:100vh; }

    /* ── SIDEBAR ── */
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
    .nb-teal  { background:rgba(11,191,204,.2);  color:var(--teal); }
    .nb-green { background:rgba(30,201,122,.15); color:var(--green); }
    .nb-amber { background:rgba(245,166,35,.15); color:var(--amber); }
    .nav-divider { height:1px; background:var(--border); margin:.6rem 0; }

    /* ── MAIN ── */
    .main { flex:1; margin-left:260px; padding:1.6rem 1.8rem; min-width:0; }

    /* ── TOPBAR ── */
    .topbar { display:flex; align-items:center; justify-content:space-between; background:var(--surface); border-radius:var(--r24); padding:.9rem 1.4rem; box-shadow:var(--shadow-sm); border:1px solid var(--border-light); margin-bottom:1.5rem; gap:1rem; }
    .topbar-left { display:flex; align-items:center; gap:1rem; }
    .topbar-greeting { font-family:'Syne',sans-serif; font-size:1.2rem; font-weight:700; color:var(--text-main); }
    .topbar-sub { font-size:.8rem; color:var(--text-mid); }
    .topbar-right { display:flex; align-items:center; gap:.8rem; }
    .icon-btn { width:40px; height:40px; background:#f2f7f9; border:1px solid var(--border-light); border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; position:relative; transition:all .2s; }
    .icon-btn:hover { background:var(--teal-ultra); border-color:var(--teal); }
    .icon-btn i { font-size:1.05rem; color:var(--text-mid); }
    .notif-dot { position:absolute; top:6px; right:7px; width:8px; height:8px; background:var(--red); border-radius:50%; border:2px solid #fff; }

    /* ── KPI ROW ── */
    .kpi-row { display:grid; grid-template-columns:repeat(5,1fr); gap:1rem; margin-bottom:1.3rem; }
    .kpi-card { background:var(--surface); border-radius:var(--r24); padding:1.1rem 1.2rem; border:1px solid var(--border-light); box-shadow:var(--shadow-sm); display:flex; gap:.9rem; align-items:flex-start; transition:all .25s; position:relative; overflow:hidden; }
    .kpi-card::after { content:''; position:absolute; top:0; right:0; width:70px; height:70px; background:radial-gradient(circle at top right,var(--teal-ultra) 0%,transparent 70%); pointer-events:none; }
    .kpi-card:hover { transform:translateY(-3px); box-shadow:var(--shadow-md); border-color:rgba(11,191,204,.3); }
    .kpi-icon-wrap { width:42px; height:42px; border-radius:13px; display:flex; align-items:center; justify-content:center; font-size:1.05rem; flex-shrink:0; }
    .kpi-icon-wrap.teal  { background:rgba(11,191,204,.12); color:var(--teal); }
    .kpi-icon-wrap.amber { background:rgba(245,166,35,.12);  color:var(--amber); }
    .kpi-icon-wrap.green { background:rgba(30,201,122,.12);  color:var(--green); }
    .kpi-icon-wrap.red   { background:rgba(240,78,96,.12);   color:var(--red); }
    .kpi-body { flex:1; min-width:0; }
    .kpi-value { font-family:'Syne',sans-serif; font-size:1.5rem; font-weight:700; line-height:1; color:var(--text-main); }
    .kpi-label { font-size:.72rem; color:var(--text-mid); margin-top:.2rem; }

    /* ── FILTER BAR ── */
    .filter-bar { display:flex; align-items:center; background:var(--surface); border-radius:var(--r16); padding:.35rem; border:1px solid var(--border-light); box-shadow:var(--shadow-sm); margin-bottom:1.3rem; gap:.2rem; flex-wrap:wrap; }
    .ftab { display:flex; align-items:center; gap:.4rem; padding:.52rem 1.05rem; border-radius:12px; font-size:.82rem; font-weight:600; color:var(--text-mid); border:none; background:none; cursor:pointer; transition:all .2s; white-space:nowrap; font-family:'DM Sans',sans-serif; }
    .ftab:hover { color:var(--teal); background:var(--teal-ultra); }
    .ftab.active { background:var(--teal); color:#fff; box-shadow:0 3px 12px rgba(11,191,204,.3); }
    .ftab .cnt { padding:.1rem .45rem; border-radius:50px; font-size:.68rem; font-weight:700; }
    .ftab.active .cnt { background:rgba(255,255,255,.25); color:#fff; }
    .ftab:not(.active) .cnt { background:#edf1f3; color:var(--text-mid); }
    .search-wrap { margin-left:auto; display:flex; align-items:center; gap:.5rem; background:#f2f7f9; border:1px solid var(--border-light); border-radius:12px; padding:.42rem .9rem; }
    .search-wrap i { color:var(--text-dim); font-size:.9rem; flex-shrink:0; }
    .search-wrap input { border:none; background:none; outline:none; font-family:'DM Sans',sans-serif; font-size:.82rem; color:var(--text-main); width:180px; }
    .search-wrap input::placeholder { color:var(--text-dim); }

    /* ── DELIVERY CARDS ── */
    .cards-grid { display:flex; flex-direction:column; gap:.85rem; margin-bottom:1.3rem; }
    .delivery-card { background:var(--surface); border-radius:var(--r24); border:1px solid var(--border-light); box-shadow:var(--shadow-sm); overflow:hidden; transition:all .25s; display:flex; }
    .delivery-card:hover { box-shadow:var(--shadow-md); border-color:rgba(11,191,204,.22); transform:translateY(-1px); }
    .card-accent { width:5px; flex-shrink:0; }
    .ca-em_transito { background:var(--teal); }
    .ca-concluida   { background:var(--green); }
    .ca-cancelada   { background:var(--red); }
    .card-inner { flex:1; display:flex; padding:1.1rem 1.3rem; gap:1rem; min-width:0; }
    .card-icon-col { flex-shrink:0; }
    .card-icon { width:44px; height:44px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
    .ci-em_transito { background:rgba(11,191,204,.12);  color:var(--teal); }
    .ci-concluida   { background:rgba(30,201,122,.12);  color:var(--green); }
    .ci-cancelada   { background:rgba(240,78,96,.12);   color:var(--red); }
    .card-body { flex:1; min-width:0; }
    .card-top { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; margin-bottom:.55rem; }
    .card-id { font-size:.7rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--teal); margin-bottom:.12rem; }
    .card-client { font-family:'Syne',sans-serif; font-size:.98rem; font-weight:700; color:var(--text-main); }
    .card-pharma { font-size:.75rem; color:var(--text-dim); margin-top:.05rem; }
    .card-earnings { text-align:right; flex-shrink:0; }
    .earn-val { font-family:'Syne',sans-serif; font-size:1.15rem; font-weight:800; color:var(--teal); line-height:1; }
    .earn-lbl { font-size:.68rem; color:var(--text-dim); margin-top:.1rem; }
    .card-meta { display:flex; flex-wrap:wrap; gap:.4rem 1rem; margin-bottom:.8rem; }
    .meta-item { display:flex; align-items:center; gap:.35rem; font-size:.78rem; color:var(--text-mid); }
    .meta-item i { font-size:.8rem; color:var(--text-dim); }
    .card-footer { display:flex; align-items:center; justify-content:space-between; gap:.8rem; flex-wrap:wrap; }
    .status-chip { display:inline-flex; align-items:center; gap:.3rem; padding:.28rem .72rem; border-radius:50px; font-size:.72rem; font-weight:700; }
    .sch-em_transito { background:rgba(11,191,204,.12);  color:var(--teal); }
    .sch-concluida   { background:rgba(30,201,122,.12);  color:var(--green); }
    .sch-cancelada   { background:rgba(240,78,96,.12);   color:var(--red); }
    .itens-pill { display:inline-flex; align-items:center; gap:.3rem; font-size:.73rem; color:var(--text-dim); }
    .card-actions { display:flex; gap:.5rem; }
    .btn-detail { padding:.48rem .95rem; border-radius:50px; border:1.5px solid var(--border-light); background:none; font-family:'DM Sans',sans-serif; font-size:.8rem; font-weight:600; color:var(--text-mid); cursor:pointer; transition:all .2s; }
    .btn-detail:hover { border-color:var(--teal); color:var(--teal); background:var(--teal-ultra); }
    .btn-concluir { padding:.48rem 1.1rem; border-radius:50px; border:none; background:var(--green); font-family:'DM Sans',sans-serif; font-size:.8rem; font-weight:700; color:#fff; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:.35rem; box-shadow:0 3px 12px rgba(30,201,122,.3); }
    .btn-concluir:hover { filter:brightness(1.1); transform:translateY(-1px); }
    .btn-cancelar { padding:.48rem 1.1rem; border-radius:50px; border:1.5px solid rgba(240,78,96,.3); background:rgba(240,78,96,.08); font-family:'DM Sans',sans-serif; font-size:.8rem; font-weight:700; color:var(--red); cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:.35rem; }
    .btn-cancelar:hover { background:rgba(240,78,96,.15); }

    /* ── MAPA ── */
    .map-card { background:var(--surface); border-radius:var(--r24); border:1px solid var(--border-light); overflow:hidden; box-shadow:var(--shadow-sm); }
    .map-head { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.2rem; border-bottom:1px solid var(--border-light); }
    .map-head h6 { font-family:'Syne',sans-serif; font-size:.9rem; font-weight:700; display:flex; align-items:center; gap:.5rem; margin:0; }
    .map-head h6 i { color:var(--teal); }
    #deliveryMap { height:380px; width:100%; z-index:1; }

    /* Location button (novo) */
.location-btn {
  background: rgba(11,191,204,.15);
  border: 1px solid rgba(11,191,204,.3);
  border-radius: 40px;
  padding: .3rem .7rem;
  font-size: .75rem;
  font-weight: 600;
  color: #22c2d1;
  cursor: pointer;
  transition: all .2s;
  display: inline-flex;
  align-items: center;
  gap: .4rem;
  white-space: nowrap;
}
.location-btn:hover {
  background: rgba(11,191,204,.25);
  transform: translateY(-1px);
}
    /* Legenda do mapa */
    .map-legend { display:flex; align-items:center; gap:1.2rem; padding:.65rem 1.2rem; border-top:1px solid var(--border-light); flex-wrap:wrap; }
    .ml-item { display:flex; align-items:center; gap:.4rem; font-size:.75rem; color:var(--text-mid); font-weight:500; }
    .ml-dot  { width:10px; height:10px; border-radius:50%; border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,.2); flex-shrink:0; }

    /* Popup Leaflet com design FarmaConnect */
    .leaflet-popup-content-wrapper { border-radius:12px !important; box-shadow:var(--shadow-md) !important; border:1px solid var(--border-light); font-family:'DM Sans',sans-serif; }
    .leaflet-popup-content { font-size:.82rem !important; color:var(--text-main); line-height:1.5; }
    .lp-tipo { font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.2rem; }
    .lp-nome { font-weight:700; font-size:.88rem; color:var(--text-main); }
    .lp-sub  { font-size:.75rem; color:var(--text-mid); margin-top:.1rem; }
    .lp-step { display:inline-flex; align-items:center; gap:.3rem; font-size:.7rem; font-weight:600; padding:.15rem .5rem; border-radius:50px; margin-top:.3rem; }

    /* ── MODAL DETALHES ── */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(9,22,26,.55); backdrop-filter:blur(4px); z-index:500; align-items:center; justify-content:center; }
    .modal-overlay.open { display:flex; }
    .modal-box { background:var(--surface); border-radius:var(--r24); width:90%; max-width:520px; box-shadow:var(--shadow-lg); animation:fadeUp .3s cubic-bezier(.16,1,.3,1); overflow:hidden; }
    .modal-hd { display:flex; align-items:center; justify-content:space-between; padding:1.2rem 1.4rem; border-bottom:1px solid var(--border-light); }
    .modal-hd h3 { font-family:'Syne',sans-serif; font-size:1rem; font-weight:700; margin:0; }
    .modal-close { background:#f2f7f9; border:none; width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:1rem; color:var(--text-mid); transition:all .2s; }
    .modal-close:hover { background:var(--teal-ultra); color:var(--teal); }
    .modal-body { padding:1.3rem 1.4rem; }
    .modal-ft { display:flex; justify-content:flex-end; gap:.8rem; padding:.9rem 1.4rem; border-top:1px solid var(--border-light); background:#f9fbfc; }
    .detail-row { display:flex; align-items:flex-start; gap:.7rem; padding:.65rem 0; border-bottom:1px solid #f0f5f7; font-size:.85rem; }
    .detail-row:last-child { border-bottom:none; }
    .detail-row i { color:var(--teal); font-size:.95rem; width:18px; flex-shrink:0; margin-top:.05rem; }
    .detail-row span { color:var(--text-mid); }
    .detail-row strong { color:var(--text-main); }
    .cancel-textarea { width:100%; padding:.65rem .85rem; border:1.5px solid var(--border-light); border-radius:12px; font-family:'DM Sans',sans-serif; font-size:.82rem; resize:none; min-height:80px; outline:none; margin-top:1rem; }
    .cancel-textarea:focus { border-color:var(--teal); }
    .btn-modal-cancel { padding:.6rem 1.2rem; border-radius:50px; background:#eef3f5; border:none; font-family:'DM Sans',sans-serif; font-size:.8rem; font-weight:600; color:var(--text-mid); cursor:pointer; }
    .btn-modal-confirm { padding:.6rem 1.3rem; border-radius:50px; background:var(--teal); border:none; font-family:'DM Sans',sans-serif; font-size:.8rem; font-weight:600; color:#fff; cursor:pointer; box-shadow:0 4px 14px rgba(11,191,204,.3); }
    .btn-modal-danger  { padding:.6rem 1.3rem; border-radius:50px; background:var(--red); border:none; font-family:'DM Sans',sans-serif; font-size:.8rem; font-weight:600; color:#fff; cursor:pointer; }

    /* ── EMPTY STATE ── */
    .empty-state { background:var(--surface); border-radius:var(--r24); border:1px solid var(--border-light); padding:3rem 2rem; text-align:center; }
    .empty-state i { font-size:2.5rem; color:var(--teal); opacity:.2; display:block; margin-bottom:.8rem; }
    .empty-state h3 { font-family:'Syne',sans-serif; font-size:.95rem; font-weight:700; margin-bottom:.3rem; }
    .empty-state p  { font-size:.8rem; color:var(--text-mid); }

    /* ── TOAST ── */
    .toast-fc { position:fixed; bottom:24px; right:24px; background:var(--navy); color:#fff; border-radius:16px; padding:.9rem 1.3rem; display:flex; align-items:center; gap:.7rem; box-shadow:var(--shadow-lg); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:340px; pointer-events:none; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.2rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.88rem; display:block; }
    .toast-fc span { font-size:.76rem; color:rgba(255,255,255,.6); }

    /* ── ANIMS ── */
    @keyframes fadeUp { from{transform:translateY(14px);opacity:0;}to{transform:translateY(0);opacity:1;} }
    @keyframes blink  { 0%,100%{opacity:1;} 50%{opacity:.4;} }

    @media(max-width:1100px) { .kpi-row{grid-template-columns:repeat(3,1fr);} }
    @media(max-width:900px)  { .sidebar{display:none;} .main{margin-left:0;} }
    @media(max-width:700px)  { .kpi-row{grid-template-columns:repeat(2,1fr);} }
    @media(max-width:480px)  { .kpi-row{grid-template-columns:1fr;} .card-top{flex-direction:column;} }
  </style>
</head>
<body>
<div class="layout">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <a href="#" class="logo">
        <span class="farma">Farma</span><span class="connect">Connect</span>
      </a>
    </div>
    <div class="driver-strip">
      @php $iniciais = strtoupper(substr(Auth::user()->name, 0, 1)); @endphp
      <div class="driver-avatar">{{ $iniciais }}</div>
      <div class="driver-info">
        <div class="driver-name">{{ Auth::user()->name }}</div>
        <div class="driver-id">ID · ENT-{{ str_pad($entregador->id, 3, '0', STR_PAD_LEFT) }}</div>
      </div>
      <div class="status-pill {{ $entregador->status === 'Ativo' ? 'online' : 'offline' }}"
           id="statusPill" onclick="toggleStatus()">
        <span class="status-dot"></span>
        <span id="statusLabel">{{ $entregador->status === 'Ativo' ? 'Online' : 'Offline' }}</span>
      </div>

     <!-- Botão de actualização de localização -->
    <button class="location-btn" id="btnAtualizarLocalizacao">
      <i class="bi bi-geo-alt-fill"></i> 
    </button>
    <span id="statusLocalizacao" class="ms-1" style="font-size: 0.7rem; color: #a0c4c8;"></span>

    </div>
    <nav class="sidebar-nav">
      <span class="nav-label">Principal</span>
      <a href="{{ route('index.entregadores') }}"   class="nav-link"><i class="bi bi-speedometer2"></i> Paínel Administrativo</a>
      <a href="{{ route('entregas.entregadores') }}" class="nav-link active"><i class="bi bi-truck"></i> Entregas
        @if($totalEmTransito > 0)
          <span class="nav-badge nb-teal">{{ $totalEmTransito }}</span>
        @endif
      </a>
      <a href="{{ route('ganhos.entregadores') }}"  class="nav-link"><i class="bi bi-cash-stack"></i> Ganhos</a>

      <a href="{{ route('avaliacao.entregadores') }}" 
        class="nav-link {{ request()->routeIs('avaliacao.entregadores') ? 'active' : '' }}">
        <i class="bi bi-star"></i>
        <span>Avaliações</span>
      </a>

      <span class="nav-label">Conta</span>
      <a href="{{ route('perfil.entregadores', ['id' => Auth::user()->id]) }}" class="nav-link">
        <i class="bi bi-person-circle"></i> Perfil
      </a>


      <div class="nav-divider"></div>
    <a href="#" class="nav-link" style="color:rgba(240,78,96,.7)" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sair</span>
    </a>

    <form id="logout-form" action="{{ route('logout', ['id' => Auth::user()->id]) }}" method="POST" style="display: none;">
      @csrf
    </form>
    </nav>
  </aside>

  <!-- ── MAIN ── -->
  <main class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <div>
          <div class="topbar-greeting">Entregas</div>
          <div class="topbar-sub" id="topbarDate">—</div>
        </div>
      </div>
      <div class="topbar-right">
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
          <div class="kpi-value">{{ $totalEntregas }}</div>
          <div class="kpi-label">Total de entregas</div>
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap teal"><i class="bi bi-arrow-repeat"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ $totalEmTransito }}</div>
          <div class="kpi-label">Em andamento</div>
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap green"><i class="bi bi-check-circle"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ $totalConcluidas }}</div>
          <div class="kpi-label">Concluídas</div>
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap amber"><i class="bi bi-cash-stack"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ number_format($ganhosTotais, 0, ',', '.') }} Kz</div>
          <div class="kpi-label">Ganhos totais</div>
        </div>
      </div>
      <div class="kpi-card">
        <div class="kpi-icon-wrap teal"><i class="bi bi-signpost-2"></i></div>
        <div class="kpi-body">
          <div class="kpi-value">{{ number_format($distanciaTotal, 1, ',', '.') }} km</div>
          <div class="kpi-label">Distância percorrida</div>
        </div>
      </div>
    </div>

    <!-- Filter bar -->
    <div class="filter-bar">
      <button class="ftab active" data-filter="all">
        Todas <span class="cnt">{{ $totalEntregas }}</span>
      </button>
      <button class="ftab" data-filter="em_transito">
        Em andamento <span class="cnt">{{ $totalEmTransito }}</span>
      </button>
      <button class="ftab" data-filter="concluida">
        Concluídas <span class="cnt">{{ $totalConcluidas }}</span>
      </button>
      <button class="ftab" data-filter="cancelada">
        Canceladas <span class="cnt">{{ $totalCanceladas }}</span>
      </button>
      <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput" placeholder="Cliente, pedido, endereço...">
      </div>
    </div>

    <!-- Cards de entrega -->
    <div class="cards-grid" id="cardsGrid">

      @php
        /*
         * Merge de todas as colecções numa só, ordenadas por created_at desc.
         * Desta forma o filtro JS actua sobre um único conjunto de elementos DOM.
         */
        $todasEntregas = $emTransito
          ->merge($concluidas)
          ->merge($canceladas)
          ->sortByDesc('created_at');

        $statusCfg = [
          'em_transito' => ['label'=>'Em andamento', 'icon'=>'bi-arrow-repeat', 'chip'=>'sch-em_transito', 'card'=>'ci-em_transito', 'acc'=>'ca-em_transito'],
          'concluida'   => ['label'=>'Concluída',    'icon'=>'bi-check-circle', 'chip'=>'sch-concluida',   'card'=>'ci-concluida',   'acc'=>'ca-concluida'],
          'entregue'    => ['label'=>'Concluída',    'icon'=>'bi-check-circle', 'chip'=>'sch-concluida',   'card'=>'ci-concluida',   'acc'=>'ca-concluida'],
          'cancelada'   => ['label'=>'Cancelada',    'icon'=>'bi-x-circle',     'chip'=>'sch-cancelada',   'card'=>'ci-cancelada',   'acc'=>'ca-cancelada'],
        ];
      @endphp

      @forelse($todasEntregas as $i => $entrega)
        @php
          $pedido         = $entrega->pedido;
          $cliente        = $pedido->user;
          $farmaciasList  = $pedido->farmacias ?? collect(); // suporte a multi-farmácia
          $farmacia       = $farmaciasList->first();         // primeira para exibição
          $farmaciaNome   = $farmacia?->name ?? ($pedido->farmacia?->name ?? '—');
          if ($farmaciasList->count() > 1) {
              $farmaciaNome .= ' +' . ($farmaciasList->count() - 1) . ' outra(s)';
          }
          $cfg       = $statusCfg[$entrega->status] ?? $statusCfg['em_transito'];
          $rotaArray = $entrega->rota_array ?? []; // injectado pelo controller

          /* Medicamentos — nomes dos itens do pedido */
          $meds = $pedido->items
            ->map(fn($it) => optional(optional($it->stockItem)->medicamento)->name ?? '—')
            ->take(3)
            ->implode(', ');
          if ($pedido->items->count() > 3)
            $meds .= ' +'.($pedido->items->count() - 3);
        @endphp

        <div class="delivery-card"
             data-status="{{ $entrega->status }}"
             data-search="{{ strtolower($cliente->name ?? '') }} {{ strtolower($pedido->id) }} {{ strtolower($entrega->endereco_entrega ?? '') }}"
             style="animation-delay:{{ $i * 0.05 }}s">

          <div class="card-accent {{ $cfg['acc'] }}"></div>

          <div class="card-inner">
            <div class="card-icon-col">
              <div class="card-icon {{ $cfg['card'] }}">
                <i class="bi {{ $cfg['icon'] }}"></i>
              </div>
            </div>

            <div class="card-body">
              <div class="card-top">
                <div>
                  <div class="card-id">Pedido #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</div>
                  <div class="card-client">{{ $cliente->name ?? '—' }}</div>
                  <div class="card-pharma">{{ $farmacia->name ?? '—' }}</div>
                </div>
                <div class="card-earnings">
                  <div class="earn-val">
                    {{ $entrega->taxa_entrega ? number_format($entrega->taxa_entrega, 0, ',', '.') : '—' }} Kz
                  </div>
                  <div class="earn-lbl">Taxa de entrega</div>
                </div>
              </div>

              <div class="card-meta">
                <div class="meta-item">
                  <i class="bi bi-geo-alt"></i>
                  {{ Str::limit($entrega->endereco_entrega ?? '—', 55) }}
                </div>
                @if($entrega->distancia_km)
                  <div class="meta-item">
                    <i class="bi bi-signpost-2"></i>
                    {{ number_format($entrega->distancia_km, 1, ',', '.') }} km
                  </div>
                @endif
                @if($entrega->data_saida)
                  <div class="meta-item">
                    <i class="bi bi-clock"></i>
                    Saída: {{ \Carbon\Carbon::parse($entrega->data_saida)->format('H:i') }}
                  </div>
                @endif
                @if($entrega->data_entrega)
                  <div class="meta-item">
                    <i class="bi bi-flag-fill" style="color:var(--green)"></i>
                    Entregue: {{ \Carbon\Carbon::parse($entrega->data_entrega)->format('H:i') }}
                  </div>
                @endif
              </div>

              <div class="card-footer">
                <div style="display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;">
                  <span class="status-chip {{ $cfg['chip'] }}">
                    <i class="bi {{ $cfg['icon'] }}"></i> {{ $cfg['label'] }}
                  </span>
                  @if($meds)
                    <span class="itens-pill"><i class="bi bi-bag"></i> {{ $meds }}</span>
                  @endif
                </div>
                <div class="card-actions">
                  <button class="btn-detail"
                          onclick="openDetail({{ $entrega->id }})">
                    Detalhes
                  </button>
                  @if($entrega->status === 'em_transito')
                  <form action="{{ route('concluir.entrega' , ['id'=>$entrega->id]) }}" method="post">
                    @csrf
                      <button class="btn-concluir"
                              type="submit">
                        <i class="bi bi-check2-circle"></i> Concluir
                      </button>
                      {{-- <button class="btn-cancelar"
                              onclick="abrirCancelar({{ $entrega->id }})">
                        <i class="bi bi-x-circle"></i>
                      </button> --}}
                    </form>
                  @endif
                </div>
              </div>
            </div>
          </div>

        </div>
      @empty
        <div class="empty-state">
          <i class="bi bi-inbox"></i>
          <h3>Nenhuma entrega registada</h3>
          <p>As suas entregas aparecerão aqui assim que forem atribuídas.</p>
        </div>
      @endforelse

    </div>

    <!-- Mapa -->
    <div class="map-card">
      <div class="map-head">
        <h6><i class="bi bi-geo-alt-fill"></i> Entregas em tempo real</h6>
        <span style="font-size:.78rem;color:var(--text-dim)">
          {{ $totalEmTransito }} em andamento
        </span>
      </div>
      <div id="deliveryMap"></div>
      <div class="map-legend">
        <div class="ml-item"><div class="ml-dot" style="background:#3b82f6"></div> Entregador</div>
        <div class="ml-item"><div class="ml-dot" style="background:#f5a623"></div> Farmácia</div>
        <div class="ml-item"><div class="ml-dot" style="background:#1ec97a"></div> Cliente</div>
        <div class="ml-item" style="margin-left:auto;color:var(--text-dim);font-size:.72rem">
          <i class="bi bi-info-circle"></i> Linha a tracejado = rota optimizada
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ── MODAL DETALHES ── -->
<div class="modal-overlay" id="modalDetail">
  <div class="modal-box">
    <div class="modal-hd">
      <h3 id="mdTitle">Detalhe da entrega</h3>
      <button class="modal-close" onclick="closeModal('modalDetail')"><i class="bi bi-x"></i></button>
    </div>
    <div class="modal-body" id="mdBody"></div>
    <div class="modal-ft">
      <button class="btn-modal-cancel" onclick="closeModal('modalDetail')">Fechar</button>
    </div>
  </div>
</div>

<!-- ── MODAL CANCELAR ── -->
<div class="modal-overlay" id="modalCancelar">
  <div class="modal-box">
    <div class="modal-hd">
      <h3>Cancelar entrega</h3>
      <button class="modal-close" onclick="closeModal('modalCancelar')"><i class="bi bi-x"></i></button>
    </div>
    <div class="modal-body">
      <p style="font-size:.85rem;color:var(--text-mid)">
        Confirme o cancelamento e indique o motivo (opcional).
      </p>
      <textarea class="cancel-textarea" id="motivoCancel" placeholder="Motivo do cancelamento..."></textarea>
    </div>
    <div class="modal-ft">
      <button class="btn-modal-cancel" onclick="closeModal('modalCancelar')">Voltar</button>
      <button class="btn-modal-danger" onclick="confirmarCancelamento()">
        <i class="bi bi-x-circle me-1"></i> Cancelar entrega
      </button>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle"></strong><span id="toastMsg"></span></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>

/* ═══════════════════════════════════════════════════
   DADOS DO BACKEND — injectados via json
═══════════════════════════════════════════════════ */
@php
/* Serialização segura para JS — inclui rota_array com todos os waypoints */
$entregasJs = $todasEntregas->map(function($e) {
    $pedido   = $e->pedido;
    $farms    = $pedido->farmacias ?? collect();
    $farmNome = $farms->count() > 0
        ? $farms->first()->name . ($farms->count() > 1 ? ' +'.($farms->count()-1) : '')
        : ($pedido->farmacia->name ?? '—');
    return [
        'id'           => $e->id,
        'pedido_id'    => $e->pedido_id,
        'status'       => $e->status,
        'endereco'     => $e->endereco_entrega ?? '—',
        'taxa'         => (float) ($e->taxa_entrega ?? 0),
        'distancia'    => (float) ($e->distancia_km ?? 0),
        'data_saida'   => $e->data_saida,
        'data_entrega' => $e->data_entrega,
        'observacoes'  => $e->observacoes,
        'cliente'      => optional(optional($e->pedido)->user)->name ?? '—',
        'farmacia'     => $farmNome,
        'codigo_confirmacao' => $e->codigo_confirmacao ?? '—',
        /* rota_array = waypoints completos { lat, lng, tipo, nome, endereco }
         * Injectado pelo EntregasController via ->each(fn($e) => $e->rota_array = ...) */
        'rota'         => $e->rota_array ?? [],
    ];
});
@endphp
const ENTREGAS_DATA = @json($entregasJs);

/* ═══════════════════════════════════════════════════
   DATA NO TOPBAR
═══════════════════════════════════════════════════ */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const _d = new Date();
document.getElementById('topbarDate').textContent =
  `${DIAS[_d.getDay()]}, ${_d.getDate()} de ${MESES[_d.getMonth()]} de ${_d.getFullYear()}`;

/* ═══════════════════════════════════════════════════
   FILTRO DE CARDS — actua no DOM directamente
═══════════════════════════════════════════════════ */
let currentFilter = 'all';
let searchTerm    = '';

function applyFilters() {
  let visible = 0;
  document.querySelectorAll('.delivery-card').forEach(card => {
    const status = card.dataset.status;
    const search = card.dataset.search;
    const matchF = currentFilter === 'all' || status === currentFilter;
    const matchS = !searchTerm || search.includes(searchTerm.toLowerCase());
    const show   = matchF && matchS;
    card.style.display = show ? '' : 'none';
    if (show) visible++;
  });

  /* Empty state */
  const empty = document.getElementById('emptyDom');
  if (empty) empty.style.display = visible === 0 ? 'block' : 'none';
}

document.querySelectorAll('.ftab').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentFilter = btn.dataset.filter;
    applyFilters();
  });
});

document.getElementById('searchInput').addEventListener('input', function () {
  searchTerm = this.value.trim();
  applyFilters();
});

/* ═══════════════════════════════════════════════════════════════════════
   MAPA LEAFLET — rotas optimizadas com waypoints reais
   Os waypoints vêm de Entrega.rota (JSON) guardado pelo EntregaService.
   Estrutura de cada waypoint: { lat, lng, tipo, nome, endereco? }
═══════════════════════════════════════════════════════════════════════ */
const map = L.map('deliveryMap', { zoomControl: true, attributionControl: false })
             .setView([-8.8383, 13.2344], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
  { maxZoom: 19 }).addTo(map);

/* ── Ícones por tipo de waypoint ───────────────────────────────────── */
const TIPO_COR = {
  entregador: '#3b82f6',  // azul
  farmacia:   '#f5a623',  // laranja
  cliente:    '#1ec97a',  // verde
};
const TIPO_LABEL = {
  entregador: '📍 Entregador',
  farmacia:   '🏥 Farmácia',
  cliente:    '👤 Cliente',
};

function criarPin(cor, tamanho = 14) {
  return L.divIcon({
    className: '',
    html: `<div style="
      width:${tamanho}px;height:${tamanho}px;
      background:${cor};border-radius:50%;
      border:2.5px solid #fff;
      box-shadow:0 2px 8px rgba(0,0,0,.28)"></div>`,
    iconSize:   [tamanho, tamanho],
    iconAnchor: [tamanho/2, tamanho/2],
  });
}

function popupHtml(ponto, stepNum, total) {
  const cor   = TIPO_COR[ponto.tipo] || '#0bbfcc';
  const label = TIPO_LABEL[ponto.tipo] || ponto.tipo;
  const step  = stepNum != null
    ? `<div class="lp-step" style="background:${cor}22;color:${cor}">
         Passo ${stepNum} de ${total}
       </div>`
    : '';
  return `
    <div class="lp-tipo" style="color:${cor}">${label}</div>
    <div class="lp-nome">${ponto.nome || '—'}</div>
    ${ponto.endereco ? `<div class="lp-sub">${ponto.endereco}</div>` : ''}
    ${step}`;
}

/* ── Desenhar rotas ────────────────────────────────────────────────── */
const todosOsLayer = [];

ENTREGAS_DATA.forEach(entrega => {
  const waypoints = entrega.rota; // array de { lat, lng, tipo, nome, endereco }
  if (!waypoints || waypoints.length < 2) return;

  /* Cor da linha conforme estado */
  const corLinha = entrega.status === 'em_transito'  ? '#0bbfcc'
                 : entrega.status === 'entregue'      ? '#1ec97a'
                 : entrega.status === 'concluida'     ? '#1ec97a'
                 : '#94a3b8'; /* cancelada */

  const coords = waypoints.map(p => [p.lat, p.lng]);

  /* Polyline tracejada */
  const linha = L.polyline(coords, {
    color:     corLinha,
    weight:    4,
    opacity:   0.75,
    dashArray: entrega.status === 'em_transito' ? '8 6' : '4 4',
    lineJoin:  'round',
    lineCap:   'round',
  }).addTo(map);

  todosOsLayer.push(linha);

  /* Marcadores em cada waypoint */
  waypoints.forEach((ponto, idx) => {
    const cor     = TIPO_COR[ponto.tipo] || '#0bbfcc';
    const isFirst = idx === 0;
    const isLast  = idx === waypoints.length - 1;
    /* Entregador e cliente ligeiramente maiores */
    const tam     = (isFirst || isLast) ? 16 : 13;
    const stepNum = idx === 0 ? null : idx;           // 1-based para farms/cliente
    const stepTot = waypoints.length - 1;

    L.marker([ponto.lat, ponto.lng], { icon: criarPin(cor, tam) })
     .addTo(map)
     .bindPopup(popupHtml(ponto, stepNum, stepTot), {
       className: '',
       maxWidth: 200,
     });

    todosOsLayer.push(L.marker([ponto.lat, ponto.lng]));
  });
});

/* ── Ajustar zoom para mostrar todas as rotas ─────────────────────── */
if (todosOsLayer.length > 0) {
  try {
    const grupo = L.featureGroup(todosOsLayer);
    map.fitBounds(grupo.getBounds().pad(0.12));
  } catch (_) {
    map.setView([-8.8383, 13.2344], 12);
  }
}

/* ── Info quando não há entregas em trânsito ──────────────────────── */
const semTransito = ENTREGAS_DATA.filter(e => e.status === 'em_transito').length === 0;
if (semTransito) {
  const info = L.control({ position: 'bottomright' });
  info.onAdd = function () {
    const div = L.DomUtil.create('div');
    div.style.cssText = 'background:#fff;padding:6px 12px;border-radius:20px;font-size:12px;box-shadow:0 2px 8px rgba(0,0,0,.14);font-family:DM Sans,sans-serif;color:#4a6e78';
    div.textContent = 'Nenhuma entrega em andamento';
    return div;
  };
  info.addTo(map);
}

/* ═══════════════════════════════════════════════════
   MODAL DETALHES
═══════════════════════════════════════════════════ */
function openDetail(id) {
  const e = ENTREGAS_DATA.find(x => x.id === id);
  if (!e) return;

  document.getElementById('mdTitle').textContent = `Entrega #${String(e.pedido_id).padStart(4,'0')}`;

  const statusLabel = {
    em_transito: 'Em andamento',
    concluida:   'Concluída',
    cancelada:   'Cancelada',
  }[e.status] || e.status;

  document.getElementById('mdBody').innerHTML = `
    <div class="detail-row"><i class="bi bi-person-fill"></i><div><span>Cliente</span><br><strong>${e.cliente}</strong></div></div>
    <div class="detail-row"><i class="bi bi-hospital"></i><div><span>Farmácia</span><br><strong>${e.farmacia}</strong></div></div>
    <div class="detail-row"><i class="bi bi-geo-alt-fill"></i><div><span>Endereço de entrega</span><br><strong>${e.endereco}</strong></div></div>
    ${e.distancia ? `<div class="detail-row"><i class="bi bi-signpost-2"></i><div><span>Distância</span><br><strong>${parseFloat(e.distancia).toFixed(1)} km</strong></div></div>` : ''}
    ${e.taxa ? `<div class="detail-row"><i class="bi bi-cash-stack"></i><div><span>Taxa de entrega</span><br><strong>${parseFloat(e.taxa).toLocaleString('pt-AO')} Kz</strong></div></div>` : ''}
    ${e.data_saida ? `<div class="detail-row"><i class="bi bi-clock"></i><div><span>Saída</span><br><strong>${new Date(e.data_saida).toLocaleString('pt-PT')}</strong></div></div>` : ''}
    ${e.data_entrega ? `<div class="detail-row"><i class="bi bi-flag-fill"></i><div><span>Entregue em</span><br><strong>${new Date(e.data_entrega).toLocaleString('pt-PT')}</strong></div></div>` : ''}
    <div class="detail-row"><i class="bi bi-info-circle"></i><div><span>Estado</span><br><strong>${statusLabel}</strong></div></div>
    ${e.observacoes ? `<div class="detail-row"><i class="bi bi-chat-text"></i><div><span>Observações</span><br><strong>${e.observacoes}</strong></div></div>` : ''}
    <div class="detail-row"><i class="bi bi-barcode"></i><div><span>Código de Confirmação</span><br><strong>${e.codigo_confirmacao ?? '—'}</strong></div></div>
  `;

  document.getElementById('modalDetail').classList.add('open');
}

/* ═══════════════════════════════════════════════════
   CONCLUIR ENTREGA
═══════════════════════════════════════════════════ */
function concluirEntrega(id, btn) {
  if (!confirm('Marcar esta entrega como concluída?')) return;
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';

  fetch(`/entregadores/entregas/${id}/concluir`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
    },
  })
  .then(r => r.json())
  .then(d => {
    if (d.ok) {
      showToast('Entrega concluída!', 'O pedido foi marcado como entregue.');
      setTimeout(() => location.reload(), 1500);
    } else {
      btn.disabled = false;
      btn.innerHTML = '<i class="bi bi-check2-circle"></i> Concluir';
      showToast('Erro', 'Não foi possível concluir a entrega.');
    }
  })
  .catch(() => {
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-check2-circle"></i> Concluir';
    showToast('Erro de rede', 'Verifique a ligação e tente novamente.');
  });
}

/* ═══════════════════════════════════════════════════
   CANCELAR ENTREGA
═══════════════════════════════════════════════════ */
let cancelTargetId = null;

function abrirCancelar(id) {
  cancelTargetId = id;
  document.getElementById('motivoCancel').value = '';
  document.getElementById('modalCancelar').classList.add('open');
}

function confirmarCancelamento() {
  if (!cancelTargetId) return;
  const motivo = document.getElementById('motivoCancel').value.trim();

  fetch(`/entregadores/entregas/${cancelTargetId}/cancelar`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
    },
    body: JSON.stringify({ motivo }),
  })
  .then(r => r.json())
  .then(d => {
    closeModal('modalCancelar');
    if (d.ok) {
      showToast('Entrega cancelada', 'A entrega foi cancelada com sucesso.');
      setTimeout(() => location.reload(), 1500);
    } else {
      showToast('Erro', 'Não foi possível cancelar a entrega.');
    }
  })
  .catch(() => showToast('Erro de rede', 'Verifique a ligação.'));
}

/* ═══════════════════════════════════════════════════
   STATUS ONLINE/OFFLINE (toggle visual)
═══════════════════════════════════════════════════ */
let _isOnline = {{ $entregador->status === 'Ativo' ? 'true' : 'false' }};

function toggleStatus() {
  _isOnline = !_isOnline;
  const pill  = document.getElementById('statusPill');
  const label = document.getElementById('statusLabel');
  pill.className = 'status-pill ' + (_isOnline ? 'online' : 'offline');
  label.textContent = _isOnline ? 'Online' : 'Offline';

  /* Actualiza no backend */
  fetch(`/entregadores/status`, {
    method: 'POST',
    headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}' },
    body: JSON.stringify({ status: _isOnline ? 'Ativo' : 'Ocupado', disponivel: _isOnline }),
  });
}

/* ═══════════════════════════════════════════════════
   UTILITÁRIOS
═══════════════════════════════════════════════════ */
function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}
document.querySelectorAll('.modal-overlay').forEach(m =>
  m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); })
);

function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = msg ? ' ' + msg : '';
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3500);
}


/* ── LOCALIZAÇÃO (manual + automática a cada 30 min) ── */
  function enviarLocalizacao() {
    const statusSpan = document.getElementById('statusLocalizacao');
    if (!statusSpan) return;
    statusSpan.innerHTML = '<i class="bi bi-hourglass-split"></i>';
    statusSpan.style.opacity = '1';

    if (!navigator.geolocation) {
      statusSpan.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Não suportado';
      setTimeout(() => statusSpan.innerHTML = '', 3000);
      return;
    }

    navigator.geolocation.getCurrentPosition(
      function(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        fetch('{{ route("entregador.localizacao") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ latitude: lat, longitude: lng })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            statusSpan.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
            setTimeout(() => statusSpan.innerHTML = '', 3000);
          } else {
            statusSpan.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
            setTimeout(() => statusSpan.innerHTML = '', 3000);
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          statusSpan.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
          setTimeout(() => statusSpan.innerHTML = '', 3000);
        });
      },
      function(error) {
        let msg = '';
        switch(error.code) {
          case error.PERMISSION_DENIED: msg = 'Permissão negada'; break;
          case error.POSITION_UNAVAILABLE: msg = 'Indisponível'; break;
          case error.TIMEOUT: msg = 'Tempo esgotado'; break;
          default: msg = 'Erro';
        }
        statusSpan.innerHTML = '<i class="bi bi-exclamation-triangle"></i> ' + msg;
        setTimeout(() => statusSpan.innerHTML = '', 4000);
      },
      { enableHighAccuracy: true, timeout: 10000 }
    );
  }

  // Botão manual
  const btnLoc = document.getElementById('btnAtualizarLocalizacao');
  if (btnLoc) {
    btnLoc.addEventListener('click', enviarLocalizacao);
  }

  // Envio automático a cada 30 minutos (1800000 ms)
  setInterval(enviarLocalizacao, 1800000);

  // Opcional: enviar ao carregar a página (após 2 segundos)
  window.addEventListener('load', function() {
    setTimeout(enviarLocalizacao, 2000);
  });

/* Flash de sessão */
@if(session('success'))
  showToast('{{ session("success") }}', '');
@endif

</script>
</body>
</html>