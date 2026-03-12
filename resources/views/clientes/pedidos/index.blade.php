<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Meus Pedidos — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --accent:      #099aa7;
      --accent-dark: #067e8a;
      --heading:     #1f2f31;
      --text:        #363f40;
      --soft:        #dff3f0;
      --mint:        #eaf6f5;
      --muted:       #6c8285;
      --border:      #e4f0f0;
      --shadow:      0 8px 32px rgba(9,154,167,.08);
    }
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body {
      font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
      background:#f4f8f8; color:var(--text); overflow-x:hidden;
    }

    /* ===== HEADER ===== */
    .header {
      background:rgba(255,255,255,.97); backdrop-filter:blur(16px);
      box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06);
      padding:.75rem 0; z-index:1000; transition:box-shadow .3s;
    }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); }
    .sitename .s2 { color:var(--heading); }
    .header-search { flex:1; max-width:560px; }
    .header-search .ig {
      border:1.5px solid var(--border); border-radius:50px;
      background:#f6fbfb; overflow:hidden; display:flex; align-items:center;
      transition:border-color .2s,box-shadow .2s;
    }
    .header-search .ig:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .header-search .ig-icon { padding:.6rem 0 .6rem 1.1rem; color:#a0b9bc; }
    .header-search .ig input { flex:1; border:none; background:transparent; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; outline:none; font-family:inherit; }
    .header-search .ig input::placeholder { color:#b0c4c6; }
    .header-search .ig-btn { background:transparent; border:none; color:var(--accent); padding:.6rem 1rem; font-size:1.2rem; cursor:pointer; }
    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu li { margin:0 .15rem; }
    .navmenu a { color:var(--heading); font-weight:600; font-size:.88rem; padding:.42rem .85rem; border-radius:50px; text-decoration:none; transition:.2s; white-space:nowrap; }
    .navmenu a:hover,.navmenu a.active { background:var(--soft); color:var(--accent); }
    .hdr-icon { position:relative; color:var(--heading); font-size:1.3rem; text-decoration:none; transition:color .2s; }
    .hdr-icon:hover { color:var(--accent); }
    .hdr-badge { position:absolute; top:-6px; right:-8px; background:var(--accent); color:#fff; font-size:.6rem; font-weight:700; width:17px; height:17px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid #fff; }
    .profile-toggle { display:flex; align-items:center; gap:.5rem; text-decoration:none; color:var(--heading); }
    .profile-toggle img { border:2px solid var(--soft); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ===== PAGE TOPBAR ===== */
    .page-topbar {
      background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%);
      padding:2.5rem 0 4rem; position:relative; overflow:hidden;
    }
    .page-topbar::before {
      content:''; position:absolute; inset:0;
      background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .topbar-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:300px;height:300px;background:#fff;opacity:.08;top:-100px;right:-50px; }
    .tb2 { width:200px;height:200px;background:#a8ffd4;opacity:.06;bottom:-60px;left:10%; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; transition:color .2s; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.8rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .page-topbar p  { color:rgba(255,255,255,.68); font-size:.92rem; margin-top:.3rem; }

    /* Summary cards */
    .summary-cards {
      display:flex; gap:1rem; flex-wrap:wrap;
      margin-top:1.5rem; position:relative; z-index:2;
    }
    .sum-card {
      background:rgba(255,255,255,.13); backdrop-filter:blur(10px);
      border:1px solid rgba(255,255,255,.22); border-radius:18px;
      padding:.85rem 1.4rem; display:flex; align-items:center; gap:.9rem;
      flex:1; min-width:140px;
    }
    .sum-icon { font-size:1.5rem; }
    .sum-val  { font-size:1.4rem; font-weight:800; color:#fff; line-height:1; }
    .sum-lbl  { font-size:.72rem; color:rgba(255,255,255,.65); text-transform:uppercase; letter-spacing:.05em; }

    /* ===== MAIN LAYOUT ===== */
    .orders-wrap { margin-top:-2.5rem; padding-bottom:4rem; }

    /* ===== FILTER BAR ===== */
    .filter-bar {
      background:#fff; border-radius:20px; box-shadow:var(--shadow);
      padding:1rem 1.4rem; margin-bottom:1.5rem;
      display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
    }
    .filter-tabs { display:flex; gap:.35rem; flex-wrap:wrap; }
    .ftab {
      padding:.42rem 1rem; border-radius:50px; font-size:.83rem; font-weight:700;
      cursor:pointer; border:1.5px solid var(--border); background:#fff;
      color:var(--muted); transition:all .2s; display:flex; align-items:center; gap:.4rem;
    }
    .ftab:hover { border-color:var(--accent); color:var(--accent); background:var(--mint); }
    .ftab.active { background:var(--accent); color:#fff; border-color:var(--accent); }
    .ftab .fbadge { background:rgba(255,255,255,.25); border-radius:50px; padding:.1rem .45rem; font-size:.7rem; }
    .ftab.active .fbadge { background:rgba(255,255,255,.25); }
    .ftab:not(.active) .fbadge { background:var(--mint); color:var(--accent); }

    .filter-right { margin-left:auto; display:flex; align-items:center; gap:.7rem; }
    .search-orders {
      border:1.5px solid var(--border); border-radius:50px;
      padding:.42rem 1rem .42rem .9rem; font-size:.85rem; font-family:inherit;
      color:var(--heading); background:#f6fbfb; outline:none; width:200px;
      transition:border-color .2s,box-shadow .2s;
    }
    .search-orders:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); width:240px; }
    .sort-select {
      border:1.5px solid var(--border); border-radius:50px;
      padding:.42rem 1rem; font-size:.83rem; font-family:inherit;
      color:var(--heading); background:#f6fbfb; outline:none; cursor:pointer;
    }

    /* ===== ORDER CARD ===== */
    .order-card {
      background:#fff; border-radius:22px; box-shadow:var(--shadow);
      margin-bottom:1rem; overflow:hidden; border:1.5px solid transparent;
      transition:border-color .25s,box-shadow .25s;
    }
    .order-card:hover { border-color:var(--border); box-shadow:0 12px 40px rgba(9,154,167,.12); }

    /* Card header */
    .oc-header {
      padding:1.1rem 1.5rem; display:flex; align-items:center;
      gap:1rem; flex-wrap:wrap; cursor:pointer;
      border-bottom:1px solid transparent; transition:border-color .2s;
    }
    .order-card.open .oc-header { border-bottom-color:var(--border); }

    .oc-num { font-size:.78rem; font-weight:700; color:var(--muted); }
    .oc-num strong { color:var(--accent); font-size:.88rem; }
    .oc-date { font-size:.78rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; }
    .oc-farm {
      display:flex; align-items:center; gap:.6rem;
    }
    .oc-farm-icon {
      width:36px; height:36px; border-radius:10px; background:var(--soft);
      display:flex; align-items:center; justify-content:center;
      color:var(--accent); font-size:1rem; flex-shrink:0;
    }
    .oc-farm-name { font-size:.88rem; font-weight:700; color:var(--heading); }
    .oc-farm-loc  { font-size:.72rem; color:var(--muted); }

    /* Status badges */
    .status-badge {
      display:inline-flex; align-items:center; gap:.35rem;
      padding:.3rem .85rem; border-radius:50px;
      font-size:.78rem; font-weight:700; white-space:nowrap;
    }
    .status-badge::before { content:''; width:6px; height:6px; border-radius:50%; display:inline-block; }
    .sb-pendente   { background:#fff3cd; color:#856404; }
    .sb-pendente::before   { background:#f59e0b; }
    .sb-confirmado { background:#d1ecf1; color:#0c5460; }
    .sb-confirmado::before { background:#0ea5e9; }
    .sb-preparando { background:#e2d9f3; color:#5a189a; }
    .sb-preparando::before { background:#a855f7; }
    .sb-em_entrega { background:#d4f4e2; color:#155724; }
    .sb-em_entrega::before { background:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,.2); animation:pulse-dot 1.5s infinite; }
    .sb-entregue   { background:var(--soft); color:var(--accent-dark); }
    .sb-entregue::before   { background:var(--accent); }
    .sb-cancelado  { background:#f8d7da; color:#721c24; }
    .sb-cancelado::before  { background:#e74c3c; }
    @keyframes pulse-dot { 0%,100%{box-shadow:0 0 0 3px rgba(34,197,94,.2)} 50%{box-shadow:0 0 0 6px rgba(34,197,94,.05)} }

    .oc-total { font-size:1rem; font-weight:800; color:var(--heading); margin-left:auto; white-space:nowrap; }
    .oc-total small { font-size:.72rem; color:var(--muted); font-weight:500; display:block; text-align:right; }

    .oc-toggle { color:var(--muted); font-size:1rem; transition:transform .3s; flex-shrink:0; }
    .order-card.open .oc-toggle { transform:rotate(180deg); color:var(--accent); }

    /* Card body */
    .oc-body { display:none; }
    .order-card.open .oc-body { display:block; }

    /* Progress tracker */
    .progress-track {
      padding:1.4rem 1.5rem 1rem;
      border-bottom:1px solid var(--border);
    }
    .progress-track h6 { font-size:.78rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-bottom:1rem; }
    .steps-row { display:flex; align-items:flex-start; justify-content:space-between; position:relative; }
    .steps-row::before {
      content:''; position:absolute; top:18px; left:5%;
      width:90%; height:2px; background:var(--border); z-index:0;
    }
    .pstep { display:flex; flex-direction:column; align-items:center; gap:.4rem; flex:1; position:relative; z-index:1; }
    .pstep-dot {
      width:36px; height:36px; border-radius:50%;
      display:flex; align-items:center; justify-content:center;
      font-size:.95rem; border:2px solid var(--border);
      background:#fff; transition:all .3s;
    }
    .pstep.done   .pstep-dot { background:var(--accent); border-color:var(--accent); color:#fff; }
    .pstep.active .pstep-dot { background:#fff; border-color:var(--accent); color:var(--accent); box-shadow:0 0 0 4px rgba(9,154,167,.15); }
    .pstep.pending .pstep-dot { background:#f4f8f8; border-color:var(--border); color:#b0c4c6; }
    .pstep-label { font-size:.7rem; font-weight:600; color:var(--muted); text-align:center; white-space:nowrap; }
    .pstep.done   .pstep-label { color:var(--accent-dark); }
    .pstep.active .pstep-label { color:var(--accent); font-weight:700; }
    .pstep-time { font-size:.65rem; color:#b0c4c6; text-align:center; }
    .pstep.done .pstep-time { color:var(--muted); }

    /* Items list */
    .oc-items { padding:1.2rem 1.5rem; border-bottom:1px solid var(--border); }
    .oc-items h6 { font-size:.78rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-bottom:1rem; }
    .item-row { display:flex; align-items:center; gap:1rem; padding:.65rem 0; border-bottom:1px solid #f4f8f8; }
    .item-row:last-child { border-bottom:none; }
    .item-img { width:48px; height:48px; border-radius:12px; object-fit:cover; background:var(--mint); flex-shrink:0; }
    .item-info { flex:1; min-width:0; }
    .item-name { font-size:.88rem; font-weight:700; color:var(--heading); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .item-cat  { font-size:.72rem; color:var(--muted); }
    .item-qty  { font-size:.82rem; color:var(--muted); white-space:nowrap; }
    .item-price{ font-size:.92rem; font-weight:800; color:var(--heading); white-space:nowrap; }

    /* Footer totals */
    .oc-totals { padding:1.1rem 1.5rem; border-bottom:1px solid var(--border); }
    .tot-row { display:flex; justify-content:space-between; font-size:.85rem; color:var(--muted); margin-bottom:.4rem; }
    .tot-row.bold { color:var(--heading); font-weight:800; font-size:.95rem; margin-top:.6rem; padding-top:.6rem; border-top:1px dashed var(--border); }

    /* Actions */
    .oc-actions { padding:1rem 1.5rem; display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; }
    .oa-btn {
      display:inline-flex; align-items:center; gap:.45rem;
      padding:.5rem 1.1rem; border-radius:50px; font-size:.82rem;
      font-weight:700; cursor:pointer; border:none; font-family:inherit;
      transition:all .25s;
    }
    .oa-primary { background:var(--accent); color:#fff; }
    .oa-primary:hover { background:var(--accent-dark); transform:translateY(-1px); }
    .oa-outline { background:var(--soft); color:var(--accent); }
    .oa-outline:hover { background:var(--accent); color:#fff; }
    .oa-ghost { background:#f4f8f8; color:var(--muted); }
    .oa-ghost:hover { background:var(--border); color:var(--heading); }
    .oa-danger { background:#fde8e8; color:#c0392b; }
    .oa-danger:hover { background:#e74c3c; color:#fff; }

    /* Live tracking banner */
    .tracking-banner {
      background:linear-gradient(135deg,#046a76,#099aa7);
      border-radius:16px; padding:1rem 1.3rem;
      display:flex; align-items:center; gap:1rem;
      margin:1rem 1.5rem; position:relative; overflow:hidden;
    }
    .tracking-banner::after { content:''; position:absolute; right:-30px; top:-30px; width:100px; height:100px; background:rgba(255,255,255,.06); border-radius:50%; }
    .tb-dot { width:10px; height:10px; background:#a8ffd4; border-radius:50%; box-shadow:0 0 0 4px rgba(168,255,212,.3); animation:pulse-dot 1.5s infinite; flex-shrink:0; }
    .tb-text strong { color:#fff; font-size:.88rem; display:block; }
    .tb-text span   { color:rgba(255,255,255,.7); font-size:.75rem; }
    .tb-link { margin-left:auto; background:rgba(255,255,255,.15); color:#fff; border:1px solid rgba(255,255,255,.3); border-radius:50px; padding:.35rem .9rem; font-size:.78rem; font-weight:700; text-decoration:none; transition:background .2s; white-space:nowrap; }
    .tb-link:hover { background:rgba(255,255,255,.25); color:#fff; }

    /* ===== EMPTY STATE ===== */
    .empty-state {
      background:#fff; border-radius:22px; box-shadow:var(--shadow);
      padding:4rem 2rem; text-align:center; display:none;
    }
    .empty-icon { font-size:4rem; color:#b0d8dc; margin-bottom:1.2rem; }
    .empty-state h5 { font-size:1.2rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-state p  { color:var(--muted); font-size:.92rem; max-width:320px; margin:0 auto 1.5rem; }

    /* ===== PAGINATION ===== */
    .pagination-fc { display:flex; align-items:center; justify-content:center; gap:.4rem; margin-top:1.5rem; }
    .pg-btn {
      width:38px; height:38px; border-radius:10px; border:1.5px solid var(--border);
      background:#fff; color:var(--muted); font-size:.85rem; font-weight:600;
      cursor:pointer; display:flex; align-items:center; justify-content:center;
      transition:all .2s; font-family:inherit;
    }
    .pg-btn:hover { border-color:var(--accent); color:var(--accent); background:var(--mint); }
    .pg-btn.active { background:var(--accent); color:#fff; border-color:var(--accent); }
    .pg-btn:disabled { opacity:.4; cursor:not-allowed; }

    /* ===== MODAL ===== */
    .modal-content { border:none; border-radius:24px; box-shadow:0 20px 60px rgba(0,0,0,.15); overflow:hidden; }
    .modal-header { border-bottom:1px solid var(--border); padding:1.2rem 1.5rem; }
    .modal-body   { padding:1.5rem; }
    .modal-footer { border-top:1px solid var(--border); padding:1rem 1.5rem; }
    .btn-close-fc { background:var(--soft); color:var(--accent); border:none; border-radius:50px; padding:.5rem 1.2rem; font-size:.85rem; font-weight:700; cursor:pointer; transition:all .25s; font-family:inherit; }
    .btn-close-fc:hover { background:var(--accent); color:#fff; }

    /* Rating stars */
    .star-rate { display:flex; gap:.4rem; justify-content:center; margin:1rem 0; }
    .star-rate i { font-size:2rem; color:#e2e8f0; cursor:pointer; transition:color .15s; }
    .star-rate i.active { color:#f59e0b; }

    /* Toast */
    .toast-fc {
      position:fixed; bottom:28px; right:28px;
      background:var(--heading); color:#fff; border-radius:16px;
      padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem;
      box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999;
      transform:translateY(80px); opacity:0;
      transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px;
    }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span   { font-size:.78rem; color:rgba(255,255,255,.65); }

    /* Scroll top */
    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; text-decoration:none; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; transition:all .3s; box-shadow:0 6px 20px rgba(9,154,167,.35); }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    /* Responsive */
    @media(max-width:768px) {
      .header-search { display:none; }
      .filter-right  { margin-left:0; }
      .oc-total      { margin-left:0; }
      .steps-row::before { width:80%; left:10%; }
    }
    @media(max-width:576px) {
      .sum-card { min-width:calc(50% - .5rem); }
      .oc-header { gap:.6rem; }
    }
  </style>
</head>
<body>

<!-- ===== HEADER ===== -->
<header class="header fixed-top" id="mainHeader">
  <div class="container-xl">
    <div class="d-flex align-items-center gap-3">
      <a href="#" class="text-decoration-none me-2 flex-shrink-0">
        <h1 class="sitename"><span class="s1">Farma</span><span class="s2">Connect</span></h1>
      </a>
      <div class="header-search d-none d-md-block mx-auto">
        <div class="ig">
          <span class="ig-icon"><i class="bi bi-search"></i></span>
          <input type="text" placeholder="Pesquise medicamentos, farmácias...">
          <button class="ig-btn"><i class="bi bi-arrow-right-circle-fill"></i></button>
        </div>
      </div>
      <nav class="navmenu d-none d-lg-block flex-shrink-0">
        <ul>
          <li><a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a></li>
          <li><a href="{{ route('farmacias.list') }}"><i class="bi bi-hospital"></i> Farmácias</a></li>
          <li><a href="{{ route('produtos.clientes') }}" ><i class="bi bi-box-seam"></i> Produtos</a></li>
          <li><a class="active" href="{{ route('pedidos.clientes') }}"><i class="bi bi-clock-history"></i> Histórico</a></li>
        </ul>
      </nav>
      <div class="d-flex align-items-center gap-3 flex-shrink-0 ms-auto ms-lg-0">
        <a href="{{ route('carrinho.clientes') }}" class="hdr-icon d-none d-sm-inline-flex">
          <i class="bi bi-bag"></i><span class="hdr-badge">3</span>
        </a>
        <div class="dropdown">
          <a href="#" class="profile-toggle dropdown-toggle" id="pdrop" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&rounded=true&size=34" width="34" height="34" class="rounded-circle" alt="Perfil">
            <span class="pname d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
         <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('perfil.clientes') }}"><i class="bi bi-person me-2"></i>Minha Conta</a></li>
            <li><a class="dropdown-item" href="{{ route('pedidos.clientes') }}"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"></i>Favoritos</a></li>
            <li><hr class="dropdown-divider mx-2 my-1"></li>
            <li><a class="dropdown-item text-danger" href="{{ route('logout' , ['id'=>Auth()->user()->id]) }}"><i class="bi bi-box-arrow-right me-2"></i>Terminar Sessão</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ===== PAGE TOPBAR ===== -->
<div class="page-topbar mt-2" style="padding-top:64px;">
  <div class="topbar-blob tb1"></div>
  <div class="topbar-blob tb2"></div>
  <div class="container-xl" style="position:relative;z-index:2;">
    <div class="breadcrumb-fc">
      <a href="#"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem;"></i></span>
      <span class="cur">Meus Pedidos</span>
    </div>
    <h2>Meus Pedidos</h2>
    <p>Acompanhe todos os seus pedidos e histórico de compras</p>

    <div class="summary-cards">
      <div class="sum-card">
        <div><div class="sum-val">{{ Auth::user()->pedidos()->count() }}</div><div class="sum-lbl">Total pedidos</div></div>
      </div>
      <div class="sum-card">
        <div><div class="sum-val">{{ Auth::user()->pedidos()->where('status', 'Em Entrega')->count() }}</div><div class="sum-lbl">Em entrega</div></div>
      </div>
      <div class="sum-card">
        <div><div class="sum-val">{{ Auth::user()->pedidos()->where('status', 'Concluído')->count() }}</div><div class="sum-lbl">Entregues</div></div>
      </div>
      <div class="sum-card">
        <div><div class="sum-val">0</div><div class="sum-lbl">Total gasto</div></div>
      </div>
    </div>
  </div>
</div>

<!-- ===== ORDERS ===== -->
<div class="orders-wrap mt-5">
  <div class="container-xl">

    <!-- FILTER BAR -->
<div class="filter-tabs mb-2" id="filterTabs">
  <button class="ftab active" data-filter="todos" onclick="filterOrders(this,'todos')">
    Todos <span class="fbadge">{{ $totalPedidos }}</span>
  </button>
  <button class="ftab" data-filter="pendente" onclick="filterOrders(this,'pendente')">
    Pendente <span class="fbadge">{{ $pedidos->where('status','pendente')->count() }}</span>
  </button>
  <button class="ftab" data-filter="em_entrega" onclick="filterOrders(this,'em_entrega')">
    Em entrega <span class="fbadge">{{ $emEntrega }}</span>
  </button>
  <button class="ftab" data-filter="entregue" onclick="filterOrders(this,'entregue')">
    Entregues <span class="fbadge">{{ $entregues }}</span>
  </button>
  <button class="ftab" data-filter="cancelado" onclick="filterOrders(this,'cancelado')">
    Cancelados <span class="fbadge">{{ $pedidos->where('status','cancelado')->count() }}</span>
  </button>
</div>

    <!-- ORDERS LIST -->
<div id="ordersList">

  @forelse($pedidos as $pedido)
    @php
      $st        = $pedido->status; // pendente|confirmado|preparando|em_entrega|entregue|cancelado
      $numItens  = $pedido->items->count();
      $dataPedido = \Carbon\Carbon::parse($pedido->data_pedido)->format('d M Y, H:i');

      // Mapeamento status → label PT e classe CSS
      $statusMap = [
        'pendente'   => ['label' => 'Pendente',   'css' => 'sb-pendente'],
        'confirmado' => ['label' => 'Confirmado', 'css' => 'sb-confirmado'],
        'preparando' => ['label' => 'Preparando', 'css' => 'sb-preparando'],
        'em_entrega' => ['label' => 'Em entrega', 'css' => 'sb-em_entrega'],
        'entregue'   => ['label' => 'Entregue',   'css' => 'sb-entregue'],
        'cancelado'  => ['label' => 'Cancelado',  'css' => 'sb-cancelado'],
      ];
      $statusInfo = $statusMap[$st] ?? ['label' => ucfirst($st), 'css' => 'sb-pendente'];

      // Steps do progresso
      $steps = ['pendente','confirmado','preparando','em_entrega','entregue'];
      $currentIdx = array_search($st, $steps);
    @endphp

    <div class="order-card {{ $st === 'em_entrega' ? 'open' : '' }}"
         data-status="{{ $st }}"
         data-num="{{ $pedido->id }}"
         data-val="{{ $pedido->total }}">

      {{-- ── CABEÇALHO ── --}}
      <div class="oc-header" onclick="toggleCard(this)">
        <div>
          <div class="oc-num">Pedido <strong>#FC-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</strong></div>
          <div class="oc-date"><i class="bi bi-calendar3"></i> {{ $dataPedido }}</div>
        </div>

        <div class="oc-farm">
          <div class="oc-farm-icon"><i class="bi bi-hospital"></i></div>
          <div>
            <div class="oc-farm-name">{{ $pedido->farmacia->name ?? '—' }}</div>
            <div class="oc-farm-loc">
              <i class="bi bi-geo-alt"></i>
              {{ $pedido->farmacia->municipio ?? $pedido->farmacia->bairro ?? '' }}
            </div>
          </div>
        </div>

        <span class="status-badge {{ $statusInfo['css'] }}">{{ $statusInfo['label'] }}</span>

        <div class="oc-total">
          {{ number_format($pedido->total, 0, ',', ' ') }} Kz
          <small>{{ $numItens }} {{ $numItens === 1 ? 'item' : 'itens' }}</small>
        </div>

        <i class="bi bi-chevron-down oc-toggle"></i>
      </div>

      {{-- ── BODY ── --}}
      <div class="oc-body">

        {{-- Banner de rastreio (só em entrega) --}}
        @if($st === 'em_entrega')
          <div class="tracking-banner">
            <span class="tb-dot"></span>
            <div class="tb-text">
              <strong>O seu entregador está a caminho!</strong>
              <span>Previsão de entrega em breve</span>
            </div>
            <a href="#" class="tb-link"><i class="bi bi-map me-1"></i> Acompanhar</a>
          </div>
        @endif

        {{-- ── PROGRESSO ── --}}
        <div class="progress-track">
          <h6>Estado do pedido</h6>
          <div class="steps-row">

            @if($st === 'cancelado')
              {{-- Estado cancelado: steps diferentes --}}
              <div class="pstep done">
                <div class="pstep-dot"><i class="bi bi-check2"></i></div>
                <div class="pstep-label">Criado</div>
                <div class="pstep-time">{{ \Carbon\Carbon::parse($pedido->data_pedido)->format('H:i') }}</div>
              </div>
              <div class="pstep pending"><div class="pstep-dot"><i class="bi bi-bag-check"></i></div><div class="pstep-label">Confirmado</div><div class="pstep-time">—</div></div>
              <div class="pstep pending"><div class="pstep-dot"><i class="bi bi-truck"></i></div><div class="pstep-label">Em entrega</div><div class="pstep-time">—</div></div>
              <div class="pstep active">
                <div class="pstep-dot" style="background:#fde8e8;border-color:#e74c3c;color:#e74c3c;">
                  <i class="bi bi-x-lg"></i>
                </div>
                <div class="pstep-label" style="color:#e74c3c;">Cancelado</div>
                <div class="pstep-time">—</div>
              </div>

            @else
              {{-- Steps normais --}}
              @php
                $stepDefs = [
                  ['key'=>'pendente',   'icon'=>'bi-hourglass-split', 'label'=>'Pendente'],
                  ['key'=>'confirmado', 'icon'=>'bi-bag-check',       'label'=>'Confirmado'],
                  ['key'=>'em_entrega', 'icon'=>'bi-truck',           'label'=>'Em entrega'],
                  ['key'=>'entregue',   'icon'=>'bi-house',           'label'=>'Entregue'],
                ];
              @endphp

              @foreach($stepDefs as $i => $step)
                @php
                  $isDone   = $currentIdx > $i;
                  $isActive = $currentIdx === $i;
                  $cls      = $isDone ? 'done' : ($isActive ? 'active' : 'pending');
                @endphp
                <div class="pstep {{ $cls }}">
                  <div class="pstep-dot">
                    @if($isDone)
                      <i class="bi bi-check2"></i>
                    @else
                      <i class="bi {{ $step['icon'] }}"></i>
                    @endif
                  </div>
                  <div class="pstep-label">{{ $step['label'] }}</div>
                  <div class="pstep-time">
                    @if($isDone || $isActive)
                      {{ \Carbon\Carbon::parse($pedido->data_pedido)->addMinutes($i * 10)->format('H:i') }}
                    @else
                      —
                    @endif
                  </div>
                </div>
              @endforeach
            @endif

          </div>
        </div>

        {{-- ── ITENS ── --}}
        <div class="oc-items">
          <h6>Itens do pedido</h6>

          @foreach($pedido->items as $item)
            @php $med = $item->stockItem->medicamento ?? null; @endphp
            <div class="item-row">

              {{-- Imagem --}}
              @if($med && ($med->imagem ?? false))
                <img src="{{ asset('storage/'.$med->imagem) }}"
                     class="item-img" alt="{{ $med->name }}">
              @else
                <div class="item-img d-flex align-items-center justify-content-center"
                     style="font-size:1.5rem;">💊</div>
              @endif

              <div class="item-info">
                <div class="item-name">{{ $med->name ?? '—' }}</div>
                <div class="item-cat">
                  {{ $med->categoria->nome ?? '' }}
                  @if($med && $med->forma_farmaceutica)
                    · {{ $med->forma_farmaceutica }}
                  @endif
                </div>
              </div>

              <div class="item-qty">x{{ $item->quantidade }}</div>
              <div class="item-price">
                {{ number_format(($med->preco ?? 0) * $item->quantidade, 0, ',', ' ') }} Kz
              </div>

            </div>
          @endforeach

        </div>

        {{-- ── TOTAIS ── --}}
        <div class="oc-totals">
          <div class="tot-row">
            <span>Subtotal</span>
            <span>{{ number_format($pedido->total, 0, ',', ' ') }} Kz</span>
          </div>
          {{-- Taxa de entrega e desconto: adiciona ao fillable quando tiveres --}}
          {{-- <div class="tot-row"><span>Taxa de entrega</span><span>{{ $pedido->taxa_entrega }} Kz</span></div> --}}
          {{-- <div class="tot-row"><span>Desconto</span><span style="color:#22c55e;">— {{ $pedido->desconto }} Kz</span></div> --}}
          <div class="tot-row bold">
            <span>Total {{ $st === 'entregue' ? 'pago' : 'a pagar' }}</span>
            <span>{{ number_format($pedido->total, 0, ',', ' ') }} Kz</span>
          </div>
        </div>

        {{-- ── ACÇÕES (variam por status) ── --}}
        <div class="oc-actions">

          @if($st === 'em_entrega')
            <button class="oa-btn oa-primary"><i class="bi bi-map"></i> Rastrear entrega</button>
            <button class="oa-btn oa-outline"><i class="bi bi-telephone"></i> Ligar ao entregador</button>
            <button class="oa-btn oa-ghost"><i class="bi bi-receipt"></i> Ver factura</button>

          @elseif($st === 'entregue')
            <button class="oa-btn oa-primary" onclick="openRatingModal()">
              <i class="bi bi-star"></i> Avaliar pedido
            </button>
            <button class="oa-btn oa-outline" onclick="reorder()">
              <i class="bi bi-arrow-repeat"></i> Repetir pedido
            </button>
            <button class="oa-btn oa-ghost"><i class="bi bi-receipt"></i> Ver factura</button>
            <button class="oa-btn oa-ghost"><i class="bi bi-download"></i> Baixar PDF</button>

          @elseif($st === 'pendente')
            <button class="oa-btn oa-ghost"><i class="bi bi-receipt"></i> Ver detalhes</button>
            {{-- Cancelar via POST --}}
            <form action="{{ route('pedidos.cancelar', $pedido) }}" method="POST"
                  onsubmit="return confirm('Tem a certeza que deseja cancelar este pedido?')">
              @csrf
              @method('PATCH')
              <button type="submit" class="oa-btn oa-danger">
                <i class="bi bi-x-circle"></i> Cancelar pedido
              </button>
            </form>

          @elseif($st === 'cancelado')
            <button class="oa-btn oa-ghost"><i class="bi bi-receipt"></i> Ver detalhes</button>
            <button class="oa-btn oa-outline" onclick="reorder()">
              <i class="bi bi-arrow-repeat"></i> Repetir pedido
            </button>

          @else
            {{-- confirmado / preparando --}}
            <button class="oa-btn oa-ghost"><i class="bi bi-receipt"></i> Ver detalhes</button>
          @endif

        </div>

      </div>{{-- /oc-body --}}
    </div>{{-- /order-card --}}

  @empty
    <div class="empty-state" style="display:block;">
      <div class="empty-icon"><i class="bi bi-bag-x"></i></div>
      <h5>Ainda não tem pedidos</h5>
      <p>Explore as nossas farmácias e faça o seu primeiro pedido.</p>
      <a href="{{ route('produtos.clientes') }}" class="oa-btn oa-outline text-decoration-none">
        <i class="bi bi-box-seam"></i> Ver produtos
      </a>
    </div>
  @endforelse

</div>

    <!-- Empty state -->
    <div class="empty-state" id="emptyState">
      <div class="empty-icon"><i class="bi bi-bag-x"></i></div>
      <h5>Nenhum pedido encontrado</h5>
      <p>Não encontrámos pedidos com os filtros seleccionados.</p>
      <button class="oa-btn oa-outline" onclick="resetFilter()">Ver todos os pedidos</button>
    </div>

    <!-- Pagination -->
    <div class="pagination-fc" id="pagination">
      <button class="pg-btn" disabled><i class="bi bi-chevron-left"></i></button>
      <button class="pg-btn active">1</button>
      <button class="pg-btn">2</button>
      <button class="pg-btn">3</button>
      <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
    </div>

  </div>
</div>

<!-- ===== FOOTER MINI ===== -->
<footer style="background:#1f2f31;color:#fff;padding:2rem 0;margin-top:2rem;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
      <span style="font-size:1.3rem;font-weight:800;"><span style="color:#099aa7;">Farma</span>Connect</span>
      <span style="color:#6a8a8d;font-size:.85rem;">&copy; 2026 FarmaConnect · Todos os direitos reservados.</span>
      <div>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Privacidade</a>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Termos</a>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Suporte</a>
      </div>
    </div>
  </div>
</footer>

<!-- ===== RATING MODAL ===== -->
<div class="modal fade" id="ratingModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-weight:800;color:#1f2f31;">Avaliar pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div style="font-size:2.5rem;margin-bottom:.5rem;">💊</div>
        <p style="font-size:.9rem;color:#6c8285;margin-bottom:0;">Como foi a sua experiência com a <strong style="color:#1f2f31;">Farmácia Kilamba</strong>?</p>
        <div class="star-rate" id="starRate">
          <i class="bi bi-star-fill" data-val="1" onclick="rateStar(1)"></i>
          <i class="bi bi-star-fill" data-val="2" onclick="rateStar(2)"></i>
          <i class="bi bi-star-fill" data-val="3" onclick="rateStar(3)"></i>
          <i class="bi bi-star-fill" data-val="4" onclick="rateStar(4)"></i>
          <i class="bi bi-star-fill" data-val="5" onclick="rateStar(5)"></i>
        </div>
        <p id="starLabel" style="font-size:.82rem;color:#6c8285;margin-bottom:1rem;min-height:1.2em;"></p>
        <textarea class="fc-input" style="border-radius:14px;resize:none;font-family:inherit;font-size:.88rem;" rows="3" placeholder="Deixe um comentário (opcional)..."></textarea>
      </div>
      <div class="modal-footer gap-2">
        <button class="btn-close-fc" data-bs-dismiss="modal">Cancelar</button>
        <button class="oa-btn oa-primary" onclick="submitRating()"><i class="bi bi-send"></i> Enviar avaliação</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div>
    <strong id="toastTitle">Sucesso!</strong>
    <span id="toastMsg">Operação realizada com sucesso.</span>
  </div>
</div>

<!-- Scroll top -->
<a href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

  // ===== HEADER SCROLL =====
  const hdr = document.getElementById('mainHeader');
  window.addEventListener('scroll', () => hdr.classList.toggle('scrolled', scrollY > 50));
  const st = document.getElementById('scroll-top');
  window.addEventListener('scroll', () => st.style.display = scrollY > 320 ? 'flex' : 'none');

  // ===== TOGGLE CARD =====
  function toggleCard(header) {
    const card = header.closest('.order-card');
    card.classList.toggle('open');
  }

  // ===== FILTER =====
  function filterOrders(btn, status) {
    document.querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const cards = document.querySelectorAll('.order-card');
    let visible = 0;
    cards.forEach(c => {
      const show = status === 'todos' || c.dataset.status === status;
      c.style.display = show ? 'block' : 'none';
      if (show) visible++;
    });
    document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
    document.getElementById('pagination').style.display = visible === 0 ? 'none' : 'flex';
  }

  // ===== SEARCH =====
  function searchOrder(val) {
    const q = val.toLowerCase();
    const cards = document.querySelectorAll('.order-card');
    let visible = 0;
    cards.forEach(c => {
      const num = c.dataset.num.toLowerCase();
      const farm = c.querySelector('.oc-farm-name').textContent.toLowerCase();
      const items = [...c.querySelectorAll('.item-name')].map(i => i.textContent.toLowerCase()).join(' ');
      const show = !q || num.includes(q) || farm.includes(q) || items.includes(q);
      c.style.display = show ? 'block' : 'none';
      if (show) visible++;
    });
    document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
  }

  // ===== SORT =====
  function sortOrders(val) {
    const list = document.getElementById('ordersList');
    const cards = [...list.querySelectorAll('.order-card')];
    cards.sort((a, b) => {
      const va = parseInt(a.dataset.val), vb = parseInt(b.dataset.val);
      const da = a.querySelector('.oc-date').textContent;
      const db = b.querySelector('.oc-date').textContent;
      if (val === 'value_desc') return vb - va;
      if (val === 'value_asc')  return va - vb;
      if (val === 'oldest')     return da.localeCompare(db);
      return db.localeCompare(da); // recent
    });
    cards.forEach(c => list.appendChild(c));
  }

  function resetFilter() {
    document.querySelector('.ftab[data-filter="todos"]').click();
  }

  // ===== CANCEL ORDER =====
  function cancelOrder(btn) {
    if (!confirm('Tem a certeza que deseja cancelar este pedido?')) return;
    const card = btn.closest('.order-card');
    const badge = card.querySelector('.status-badge');
    badge.className = 'status-badge sb-cancelado';
    badge.textContent = 'Cancelado';
    card.dataset.status = 'cancelado';
    showToast('Pedido cancelado','O seu pedido foi cancelado com sucesso.');
    // remove cancel button
    btn.closest('.oc-actions').innerHTML = `
      <button class="oa-btn oa-ghost"><i class="bi bi-receipt"></i> Ver detalhes</button>
    `;
  }

  // ===== REORDER =====
  function reorder() {
    showToast('A adicionar ao carrinho...','Os itens foram adicionados ao seu carrinho.');
  }

  // ===== RATING MODAL =====
  let currentRating = 0;
  const starLabels = ['','Péssimo 😞','Mau 😕','Razoável 😐','Bom 😊','Excelente 🤩'];

  function openRatingModal() {
    currentRating = 0;
    document.querySelectorAll('#starRate i').forEach(s => s.classList.remove('active'));
    document.getElementById('starLabel').textContent = '';
    new bootstrap.Modal(document.getElementById('ratingModal')).show();
  }

  function rateStar(val) {
    currentRating = val;
    document.querySelectorAll('#starRate i').forEach((s, i) => {
      s.classList.toggle('active', i < val);
    });
    document.getElementById('starLabel').textContent = starLabels[val];
  }

  function submitRating() {
    if (currentRating === 0) { showToast('Atenção','Por favor, seleccione uma classificação.'); return; }
    bootstrap.Modal.getInstance(document.getElementById('ratingModal')).hide();
    showToast('Avaliação enviada! ⭐','Obrigada pelo seu feedback. Ajuda-nos a melhorar.');
  }

  // ===== TOAST =====
  function showToast(title, msg) {
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMsg').textContent   = msg;
    const t = document.getElementById('toastFc');
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3500);
  }

  // ===== PAGINATION =====
  document.querySelectorAll('.pg-btn').forEach((btn, i) => {
    if (!btn.querySelector('i')) {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.pg-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        window.scrollTo({top:0, behavior:'smooth'});
      });
    }
  });

</script>
</body>
</html>