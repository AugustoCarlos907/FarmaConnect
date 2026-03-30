<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Farmácias — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

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
    body { font-family:'Inter',-apple-system,sans-serif; background:#f4f8f8; color:var(--text); overflow-x:hidden; }

    /* ── HEADER ── */
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }
    .hdr-search { flex:1; max-width:560px; }
    .hdr-search .ig { border:1.5px solid var(--border); border-radius:50px; background:#f6fbfb; overflow:hidden; display:flex; align-items:center; transition:border-color .2s,box-shadow .2s; }
    .hdr-search .ig:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .hdr-search .ig-icon { padding:.6rem 0 .6rem 1.1rem; color:#a0b9bc; }
    .hdr-search .ig input { flex:1; border:none; background:transparent; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; outline:none; font-family:inherit; }
    .hdr-search .ig input::placeholder { color:#b0c4c6; }
    .hdr-search .ig-btn { background:transparent; border:none; color:var(--accent); padding:.6rem 1rem; font-size:1.2rem; cursor:pointer; }
    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu li { margin:0 .15rem; }
    .navmenu a { color:var(--heading); font-weight:600; font-size:.88rem; padding:.42rem .85rem; border-radius:50px; text-decoration:none; transition:.2s; white-space:nowrap; }
    .navmenu a:hover,.navmenu a.active { background:var(--soft); color:var(--accent); }
    .hdr-icon { position:relative; color:var(--heading); font-size:1.3rem; text-decoration:none; transition:color .2s; }
    .hdr-icon:hover { color:var(--accent); }
    .hdr-badge { position:absolute; top:-6px; right:-8px; background:var(--accent); color:#fff; font-size:.6rem; font-weight:700; width:17px; height:17px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid #fff; }
    .profile-toggle { display:flex; align-items:center; gap:.5rem; text-decoration:none; color:var(--heading); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ── TOPBAR ── */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:2.5rem 0 4.5rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:320px;height:320px;background:#fff;opacity:.08;top:-120px;right:-60px; }
    .tb2 { width:220px;height:220px;background:#a8ffd4;opacity:.06;bottom:-80px;left:8%; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.9rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .page-topbar p  { color:rgba(255,255,255,.68); font-size:.92rem; margin-top:.3rem; }
    .hero-search-bar { margin-top:1.6rem; max-width:520px; }
    .hsb-inner { background:rgba(255,255,255,.15); backdrop-filter:blur(14px); border:1.5px solid rgba(255,255,255,.25); border-radius:50px; display:flex; align-items:center; padding:.4rem .4rem .4rem 1.2rem; gap:.5rem; transition:all .25s; }
    .hsb-inner:focus-within { background:rgba(255,255,255,.22); border-color:rgba(255,255,255,.5); }
    .hsb-inner input { flex:1; background:none; border:none; outline:none; color:#fff; font-size:.9rem; font-family:inherit; min-width:0; }
    .hsb-inner input::placeholder { color:rgba(255,255,255,.55); }
    .hsb-btn { background:#fff; color:var(--accent); border:none; border-radius:50px; padding:.55rem 1.3rem; font-size:.86rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.4rem; transition:all .22s; white-space:nowrap; flex-shrink:0; }
    .hsb-btn:hover { background:var(--soft); }
    .quick-filters { display:flex; gap:.5rem; flex-wrap:wrap; margin-top:1rem; }
    .qf-tag { background:rgba(255,255,255,.15); color:#fff; border:1px solid rgba(255,255,255,.28); padding:.28rem .85rem; border-radius:50px; font-size:.78rem; font-weight:600; cursor:pointer; transition:background .2s; }
    .qf-tag:hover,.qf-tag.active { background:#fff; color:var(--accent); }

    /* ── STATS STRIP ── */
    .stats-strip { background:#fff; border-bottom:1px solid var(--border); }
    .stat-item { display:flex; align-items:center; gap:.7rem; padding:1rem 0; border-right:1px solid var(--border); flex:1; justify-content:center; }
    .stat-item:last-child { border-right:none; }
    .stat-icon { width:40px; height:40px; background:var(--soft); border-radius:12px; display:flex; align-items:center; justify-content:center; color:var(--accent); font-size:1.1rem; flex-shrink:0; }
    .stat-val  { font-size:1.3rem; font-weight:800; color:var(--heading); line-height:1; }
    .stat-lbl  { font-size:.7rem; color:var(--muted); text-transform:uppercase; letter-spacing:.05em; }

    /* ── PAGE WRAP ── */
    .page-wrap { margin-top:-2rem; padding-bottom:4rem; }

    /* ── SIDEBAR ── */
    .filter-sidebar { position:sticky; top:80px; }
    .fbox { background:#fff; border-radius:20px; box-shadow:var(--shadow); overflow:hidden; margin-bottom:1rem; }
    .fbox-header { padding:.9rem 1.3rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .fbox-header h6 { font-size:.85rem; font-weight:800; color:var(--heading); margin:0; }
    .fbox-clear { font-size:.75rem; color:var(--accent); cursor:pointer; font-weight:600; border:none; background:none; font-family:inherit; }
    .fbox-body  { padding:1rem 1.3rem; }

    /* Checkboxes */
    .fcheck-list { display:flex; flex-direction:column; gap:.45rem; }
    .fcheck-item { display:flex; align-items:center; justify-content:space-between; cursor:pointer; padding:.25rem 0; }
    .fcheck-left { display:flex; align-items:center; gap:.6rem; }
    .fcheck-item input[type=checkbox] { width:16px; height:16px; accent-color:var(--accent); cursor:pointer; flex-shrink:0; }
    .fcheck-item label { font-size:.86rem; color:var(--text); cursor:pointer; }
    .fcheck-count { font-size:.72rem; background:var(--mint); color:var(--accent); padding:.1rem .5rem; border-radius:50px; font-weight:700; }

    /* Rating stars filter */
    .rating-filter { display:flex; flex-direction:column; gap:.4rem; }
    .rf-item { display:flex; align-items:center; gap:.6rem; cursor:pointer; padding:.25rem 0; border-radius:8px; transition:background .12s; }
    .rf-item:hover { background:var(--mint); padding-left:.4rem; }
    .rf-item input[type=radio] { width:15px; height:15px; accent-color:var(--accent); cursor:pointer; flex-shrink:0; }
    .rf-stars { display:flex; align-items:center; gap:.25rem; }
    .rf-stars i { color:#f59e0b; font-size:.82rem; }
    .rf-stars i.empty { color:#e4f0f0; }
    .rf-stars span { font-size:.78rem; color:var(--muted); margin-left:.15rem; }

    /* Distance slider */
    .dist-slider { width:100%; accent-color:var(--accent); }
    .dist-val { font-size:.82rem; font-weight:700; color:var(--accent); }

    /* Active filters bar */
    .active-filters { display:flex; gap:.4rem; flex-wrap:wrap; margin-bottom:.8rem; }
    .af-tag { display:inline-flex; align-items:center; gap:.3rem; background:var(--soft); color:var(--accent); border:1px solid var(--accent); border-radius:50px; padding:.2rem .7rem; font-size:.75rem; font-weight:700; cursor:pointer; }
    .af-tag:hover { background:var(--accent); color:#fff; }
    .af-tag i { font-size:.65rem; }

    /* ── MAPA ── */
    #pharmacyMap { width:100%; height:340px; border-radius:18px; border:1.5px solid var(--border); z-index:1; }
    .map-container { background:#fff; border-radius:20px; box-shadow:var(--shadow); overflow:hidden; margin-bottom:1rem; }
    .map-header { padding:.85rem 1.2rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .map-header h6 { font-size:.85rem; font-weight:800; color:var(--heading); margin:0; display:flex; align-items:center; gap:.5rem; }
    .map-header h6 i { color:var(--accent); }
    .map-body { padding:.8rem; }
    .map-toggle-btn { font-size:.75rem; font-weight:700; color:var(--accent); background:var(--soft); border:none; border-radius:50px; padding:.28rem .8rem; cursor:pointer; font-family:inherit; transition:all .2s; }
    .map-toggle-btn:hover { background:var(--accent); color:#fff; }

    /* ── TOOLBAR ── */
    .results-toolbar { background:#fff; border-radius:16px; box-shadow:var(--shadow); padding:.85rem 1.3rem; margin-bottom:1.2rem; display:flex; align-items:center; gap:.8rem; flex-wrap:wrap; }
    .results-count { font-size:.88rem; color:var(--muted); }
    .results-count strong { color:var(--heading); }
    .view-toggle { display:flex; gap:.3rem; margin-left:auto; }
    .vt-btn { width:34px; height:34px; border:1.5px solid var(--border); background:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:var(--muted); transition:all .2s; font-size:.9rem; }
    .vt-btn.active,.vt-btn:hover { background:var(--accent); color:#fff; border-color:var(--accent); }
    .sort-sel { border:1.5px solid var(--border); border-radius:50px; padding:.38rem 1rem; font-size:.83rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; cursor:pointer; }

    /* ── CARD GRID ── */
    .ph-card { background:#fff; border-radius:22px; overflow:hidden; box-shadow:var(--shadow); transition:all .3s; height:100%; border:2px solid transparent; display:flex; flex-direction:column; }
    .ph-card:hover { transform:translateY(-6px); border-color:var(--accent); box-shadow:0 20px 44px rgba(9,154,167,.15); }
    .ph-img-wrap { position:relative; height:165px; overflow:hidden; }
    .ph-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .ph-card:hover .ph-img-wrap img { transform:scale(1.06); }
    .ph-img-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,transparent 40%,rgba(0,0,0,.35)); }
    .ph-badge-top { position:absolute; top:10px; left:12px; display:flex; gap:.4rem; flex-wrap:wrap; }
    .ph-badge { font-size:.7rem; font-weight:700; padding:.22rem .7rem; border-radius:50px; backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,.3); }
    .ph-open   { background:rgba(34,197,94,.85); color:#fff; }
    .ph-closed { background:rgba(231,76,60,.85); color:#fff; }
    .ph-fav-btn { position:absolute; top:10px; right:12px; width:32px; height:32px; background:rgba(255,255,255,.88); border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:.95rem; color:#b0c4c6; transition:all .2s; backdrop-filter:blur(8px); border:none; }
    .ph-fav-btn:hover,.ph-fav-btn.active { color:#e74c3c; transform:scale(1.15); }
    .ph-body { padding:1.1rem; flex:1; display:flex; flex-direction:column; }
    .ph-name { font-size:.98rem; font-weight:800; color:var(--heading); margin-bottom:.2rem; }
    .ph-loc  { font-size:.78rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.55rem; }
    .ph-rating { display:flex; align-items:center; gap:.25rem; font-size:.78rem; font-weight:700; color:var(--heading); margin-bottom:.65rem; }
    .ph-rating i { color:#f59e0b; font-size:.8rem; }
    .ph-reviews { font-size:.7rem; color:var(--muted); font-weight:400; }
    .ph-delivery { font-size:.76rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.9rem; }
    .ph-delivery strong { color:var(--heading); }
    .ph-actions { display:flex; gap:.5rem; margin-top:auto; }
    .ph-btn { flex:1; padding:.5rem; text-align:center; border-radius:50px; text-decoration:none; font-weight:700; font-size:.8rem; transition:all .25s; cursor:pointer; border:none; font-family:inherit; display:flex; align-items:center; justify-content:center; gap:.35rem; }
    .ph-view  { background:var(--soft); color:var(--accent); }
    .ph-order { background:var(--accent); color:#fff; }
    .ph-view:hover  { background:var(--accent); color:#fff; }
    .ph-order:hover { background:var(--accent-dark); }

    /* ── LIST VIEW ── */
    .ph-list-card { background:#fff; border-radius:18px; box-shadow:var(--shadow); border:2px solid transparent; transition:all .3s; overflow:hidden; display:none; align-items:stretch; margin-bottom:.85rem; }
    .ph-list-card:hover { border-color:var(--accent); box-shadow:0 14px 38px rgba(9,154,167,.13); transform:translateY(-2px); }
    .ph-list-img { width:150px; flex-shrink:0; overflow:hidden; }
    .ph-list-img img { width:100%; height:100%; object-fit:cover; }
    .ph-list-body { flex:1; padding:1rem 1.2rem; display:flex; flex-direction:column; justify-content:center; }
    .ph-list-actions { display:flex; flex-direction:column; justify-content:center; gap:.5rem; padding:.9rem 1.1rem; border-left:1px solid var(--border); min-width:150px; }

    /* View modes */
    body.list-mode  .ph-grid-item { display:none !important; }
    body.list-mode  .ph-list-card { display:flex !important; }
    body.grid-mode  .ph-grid-item { display:block !important; }
    body.grid-mode  .ph-list-card { display:none !important; }

    /* Destaque */
    .featured-section { background:var(--mint); border-radius:20px; padding:1.4rem; margin-bottom:1.4rem; }
    .featured-section h6 { font-size:.8rem; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
    .featured-scroll { display:flex; gap:1rem; overflow-x:auto; padding-bottom:.5rem; scrollbar-width:none; }
    .featured-scroll::-webkit-scrollbar { display:none; }
    .feat-card { background:#fff; border-radius:16px; padding:.85rem 1rem; min-width:190px; flex-shrink:0; display:flex; align-items:center; gap:.8rem; cursor:pointer; transition:all .25s; border:1.5px solid transparent; }
    .feat-card:hover { border-color:var(--accent); box-shadow:0 8px 24px rgba(9,154,167,.12); }
    .feat-img { width:42px; height:42px; border-radius:12px; object-fit:cover; flex-shrink:0; }
    .feat-name { font-size:.86rem; font-weight:700; color:var(--heading); line-height:1.2; }
    .feat-meta { font-size:.72rem; color:var(--muted); }

    /* Empty */
    .empty-ph { background:#fff; border-radius:20px; box-shadow:var(--shadow); padding:3.5rem 2rem; text-align:center; display:none; }
    .empty-ph i { font-size:3.5rem; color:#b0d8dc; display:block; margin-bottom:1rem; }
    .empty-ph h5 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-ph p  { color:var(--muted); font-size:.9rem; max-width:280px; margin:0 auto 1.2rem; }

    /* Pagination */
    .pagination-fc { display:flex; align-items:center; justify-content:center; gap:.4rem; margin-top:1.8rem; }
    .pg-btn { width:38px; height:38px; border-radius:10px; border:1.5px solid var(--border); background:#fff; color:var(--muted); font-size:.85rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s; font-family:inherit; }
    .pg-btn:hover { border-color:var(--accent); color:var(--accent); }
    .pg-btn.active { background:var(--accent); color:#fff; border-color:var(--accent); }
    .pg-btn:disabled { opacity:.4; cursor:not-allowed; }

    /* ── MODAL ── */
    .modal-content { border:none; border-radius:24px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,.14); }
    .modal-ph-banner { height:200px; overflow:hidden; position:relative; }
    .modal-ph-banner img { width:100%; height:100%; object-fit:cover; }
    .modal-ph-banner::after { content:''; position:absolute; inset:0; background:linear-gradient(to bottom,transparent 30%,rgba(0,0,0,.4)); }
    .modal-header { border-bottom:1px solid var(--border); padding:1.2rem 1.5rem; }
    .modal-body   { padding:1.5rem; }
    .modal-footer { border-top:1px solid var(--border); padding:1rem 1.5rem; }
    .info-row { display:flex; align-items:flex-start; gap:.75rem; padding:.65rem 0; border-bottom:1px solid #f4f8f8; font-size:.88rem; }
    .info-row:last-child { border-bottom:none; }
    .info-row i { color:var(--accent); font-size:1rem; width:18px; flex-shrink:0; margin-top:.05rem; }
    .hours-table { width:100%; font-size:.82rem; }
    .hours-table td { padding:.3rem .2rem; color:var(--muted); }
    .hours-table td:first-child { font-weight:600; color:var(--heading); width:100px; }
    .hours-table tr.today td { color:var(--accent); font-weight:700; }

    /* Stars inline */
    .star-inline { color:#f59e0b; font-size:.82rem; }
    .star-inline.empty { color:#e4f0f0; }

    /* Toast */
    .toast-fc { position:fixed; bottom:28px; right:28px; background:var(--heading); color:#fff; border-radius:16px; padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem; box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px; pointer-events:none; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span   { font-size:.78rem; color:rgba(255,255,255,.65); }

    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; text-decoration:none; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; transition:all .3s; box-shadow:0 6px 20px rgba(9,154,167,.35); }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    /* Leaflet popup */
    .lf-popup { font-family:'Inter',sans-serif; min-width:160px; }
    .lf-popup strong { font-size:.88rem; color:var(--heading); display:block; margin-bottom:.2rem; }
    .lf-popup span { font-size:.76rem; color:var(--muted); }
    .lf-popup .lf-btn { display:inline-block; margin-top:.5rem; background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.3rem .85rem; font-size:.75rem; font-weight:700; cursor:pointer; font-family:inherit; }

    @media(max-width:991px) { .filter-sidebar { display:none; } }
    @media(max-width:768px) { .hdr-search{display:none;} .ph-list-img{width:110px;} .ph-list-actions{min-width:120px;} }
    @media(max-width:576px) { .ph-list-actions{display:none;} }
  </style>
</head>
<body class="grid-mode">

@include('clientes.dashboard.header')

<!-- ── TOPBAR ── -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl" style="position:relative;z-index:2;">
    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem;"></i></span>
      <span class="cur">Farmácias</span>
    </div>
    <h2>Farmácias em Luanda</h2>
    <p>Encontre a farmácia mais próxima e faça o seu pedido agora</p>

    <div class="hero-search-bar">
      <form action="{{ route('farmacias.search') }}" method="GET">
        <div class="hsb-inner">
          <i class="bi bi-hospital" style="color:rgba(255,255,255,.6);flex-shrink:0"></i>
          <input type="text" name="query" placeholder="Nome ou bairro da farmácia…"
                 value="{{ request('query') }}">
          <button type="submit" class="hsb-btn"><i class="bi bi-search"></i> Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="quick-filters">
      <span class="qf-tag active"   id="qf-all"    onclick="quickFilter(this,'all')">Todas</span>
      <span class="qf-tag"          id="qf-open"   onclick="quickFilter(this,'open')">Abertas agora</span>
      <span class="qf-tag"          id="qf-closed" onclick="quickFilter(this,'closed')">Fechadas</span>
    </div>
  </div>
</div>

<!-- ── STATS STRIP ── -->
<div class="stats-strip">
  <div class="container-xl">
    <div class="d-flex">
      <div class="stat-item">
        <div class="stat-icon"><i class="bi bi-hospital"></i></div>
        <div><div class="stat-val" id="statTotal">{{ $farmacias->count() }}</div><div class="stat-lbl">Farmácias</div></div>
      </div>
      <div class="stat-item">
        <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
        <div>
          <div class="stat-val">
            @php
              $horaAtual = now()->format('H:i');
              $abertas = $farmacias->filter(fn($f) =>
                ($f->horario_abertura ?? '08:00') <= $horaAtual &&
                $horaAtual <= ($f->horario_fechamento ?? '22:00')
              )->count();
            @endphp
            {{ $abertas }}
          </div>
          <div class="stat-lbl">Abertas agora</div>
        </div>
      </div>
      <div class="stat-item d-none d-md-flex">
        <div class="stat-icon"><i class="bi bi-capsule-pill"></i></div>
        <div><div class="stat-val">5 000+</div><div class="stat-lbl">Medicamentos</div></div>
      </div>
      <div class="stat-item d-none d-lg-flex">
        <div class="stat-icon"><i class="bi bi-star-fill" style="color:#f59e0b"></i></div>
        <div>
          <div class="stat-val">
            {{ number_format($farmacias->avg(fn($f) => $f->avaliacoes->avg('classificacao') ?? 0), 1) }}★
          </div>
          <div class="stat-lbl">Avaliação média</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ── PAGE CONTENT ── -->
<div class="page-wrap">
  <div class="container-xl">
    <div class="row g-4">

      <!-- ════ SIDEBAR ════ -->
      <div class="col-lg-3 d-none d-lg-block">
        <div class="filter-sidebar mt-4">

          <!-- MAPA -->
          <div class="map-container">
            <div class="map-header">
              <h6><i class="bi bi-map"></i> Mapa de farmácias</h6>
              <button class="map-toggle-btn" id="mapToggleBtn" onclick="toggleMap()">
                <i class="bi bi-chevron-up"></i> Ocultar
              </button>
            </div>
            <div class="map-body" id="mapBody">
              <div id="pharmacyMap"></div>
            </div>
          </div>

          <!-- ESTADO DE ABERTURA -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-clock me-1" style="color:var(--accent)"></i>Estado</h6>
              <button class="fbox-clear" onclick="clearFilter('status')">Limpar</button>
            </div>
            <div class="fbox-body">
              <div class="fcheck-list">
                <label class="fcheck-item">
                  <div class="fcheck-left">
                    <input type="checkbox" id="chk-open" value="open" onchange="applyFilters()">
                    <label for="chk-open">Abertas agora</label>
                  </div>
                  <span class="fcheck-count">{{ $abertas }}</span>
                </label>
                <label class="fcheck-item">
                  <div class="fcheck-left">
                    <input type="checkbox" id="chk-closed" value="closed" onchange="applyFilters()">
                    <label for="chk-closed">Fechadas</label>
                  </div>
                  <span class="fcheck-count">{{ $farmacias->count() - $abertas }}</span>
                </label>
              </div>
            </div>
          </div>

          <!-- AVALIAÇÃO -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-star me-1" style="color:var(--accent)"></i>Avaliação mínima</h6>
              <button class="fbox-clear" onclick="clearFilter('rating')">Limpar</button>
            </div>
            <div class="fbox-body">
              <div class="rating-filter">
                @foreach([5,4,3,2] as $stars)
                  <label class="rf-item">
                    <input type="radio" name="ratingFilter" value="{{ $stars }}" onchange="applyFilters()">
                    <div class="rf-stars">
                      @for($s = 1; $s <= 5; $s++)
                        <i class="bi bi-star{{ $s <= $stars ? '-fill' : '' }}{{ $s > $stars ? ' empty' : '' }}"></i>
                      @endfor
                      <span>{{ $stars }}+ estrelas</span>
                    </div>
                  </label>
                @endforeach
              </div>
            </div>
          </div>

          <!-- DISTÂNCIA -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-pin-map me-1" style="color:var(--accent)"></i>Distância máx.</h6>
            </div>
            <div class="fbox-body">
              <div class="d-flex justify-content-between mb-2">
                <span style="font-size:.78rem;color:var(--muted);">0 km</span>
                <span class="dist-val" id="distVal">Qualquer</span>
              </div>
              <input type="range" class="dist-slider" id="distSlider"
                     min="0" max="30" value="0"
                     oninput="onDistChange(this.value)">
              <div style="font-size:.72rem;color:var(--muted);margin-top:.4rem">
                <i class="bi bi-info-circle" style="color:var(--accent)"></i>
                Requer activar a sua localização
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ════ MAIN ════ -->
      <div class="col-lg-9">

        <!-- Destaque -->
        <div class="featured-section mt-4">
          <h6><i class="bi bi-lightning-charge-fill" style="color:#f59e0b;"></i> Farmácias em destaque</h6>
          <div class="featured-scroll">
            @foreach($farmaDestaque as $farma)
              <div class="feat-card" onclick="openModal({{ $farma->id }})">
                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=88&auto=format&fit=crop"
                     class="feat-img" alt="{{ $farma->name }}">
                <div>
                  <div class="feat-name">{{ $farma->name }}</div>
                  <div class="feat-meta">
                    {{ $farma->bairro }}
                    · {{ number_format($farma->avaliacoes_avg_classificacao ?? 0, 1) }}★
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Filtros activos -->
        <div class="active-filters" id="activeFilters"></div>

        <!-- Toolbar -->
        <div class="results-toolbar">
          <span class="results-count">
            Mostrando <strong id="countVisible">{{ $farmacias->count() }}</strong>
            de <strong>{{ $farmacias->count() }}</strong> farmácias
          </span>
          <select class="sort-sel" id="sortSel" onchange="sortCards()">
            <option value="relevance">Relevância</option>
            <option value="rating">Melhor avaliação</option>
            <option value="name">Nome A→Z</option>
          </select>
          <div class="view-toggle">
            <button class="vt-btn active" id="gridBtn" onclick="setView('grid')" title="Grelha"><i class="bi bi-grid"></i></button>
            <button class="vt-btn"        id="listBtn" onclick="setView('list')" title="Lista"><i class="bi bi-list-ul"></i></button>
          </div>
        </div>

        <!-- GRID VIEW -->
        <div class="row g-4" id="gridContainer">
          @forelse($farmacias as $farmacia)
            @php
              $rating  = round($farmacia->avaliacoes->avg('classificacao') ?? 0, 1);
              $nRev    = $farmacia->avaliacoes->count();
              $hora    = now()->format('H:i');
              $aberta  = ($farmacia->horario_abertura ?? '08:00') <= $hora
                      && $hora <= ($farmacia->horario_fechamento ?? '22:00');
            @endphp
            <div class="col-md-6 col-xl-4 ph-grid-item"
                 data-name="{{ strtolower($farmacia->name) }}"
                 data-bairro="{{ strtolower($farmacia->bairro ?? '') }}"
                 data-status="{{ $aberta ? 'open' : 'closed' }}"
                 data-rating="{{ $rating }}"
                 data-lat="{{ $farmacia->latitude ?? '' }}"
                 data-lng="{{ $farmacia->longitude ?? '' }}">
              <div class="ph-card">
                <div class="ph-img-wrap">
                  <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=500&auto=format&fit=crop" alt="{{ $farmacia->name }}">
                  <div class="ph-img-overlay"></div>
                  <div class="ph-badge-top">
                    <span class="ph-badge {{ $aberta ? 'ph-open' : 'ph-closed' }}">
                      <i class="bi bi-circle-fill" style="font-size:.42rem;"></i>
                      {{ $aberta ? 'Aberta' : 'Fechada' }}
                    </span>
                  </div>
                  <button class="ph-fav-btn" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
                </div>
                <div class="ph-body">
                  <div class="ph-name">{{ $farmacia->name }}</div>
                  <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i>{{ $farmacia->bairro ?? '—' }}</div>
                  <div class="ph-rating">
                    @for($s = 1; $s <= 5; $s++)
                      <i class="bi bi-star{{ $s <= round($rating) ? '-fill star-inline' : ' star-inline empty' }}" style="color:{{ $s <= round($rating) ? '#f59e0b' : '#e4f0f0' }}"></i>
                    @endfor
                    <span style="margin-left:.2rem">{{ number_format($rating,1) }}</span>
                    <span class="ph-reviews">({{ $nRev }})</span>
                  </div>
                  <div class="ph-delivery">
                    <i class="bi bi-clock"></i> Seg-Dom:
                    <strong>{{ $farmacia->horario_abertura ?? '08:00' }} – {{ $farmacia->horario_fechamento ?? '22:00' }}</strong>
                  </div>
                  <div class="ph-actions">
                    <button class="ph-btn ph-view" onclick="openModal({{ $farmacia->id }})">
                      <i class="bi bi-eye"></i> Ver
                    </button>
                    <a href="{{ route('produtos.clientes', ['farmacia_id' => $farmacia->id]) }}"
                       class="ph-btn ph-order">
                      <i class="bi bi-bag-plus"></i> Encomendar
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12">
              <div class="empty-ph" style="display:block;">
                <i class="bi bi-hospital"></i>
                <h5>Nenhuma farmácia encontrada</h5>
                <p>Tente ajustar os filtros ou pesquisar por outro bairro.</p>
              </div>
            </div>
          @endforelse
        </div>

        <!-- LIST VIEW -->
        <div id="listContainer">
          @foreach($farmacias as $farmacia)
            @php
              $rating = round($farmacia->avaliacoes->avg('classificacao') ?? 0, 1);
              $nRev   = $farmacia->avaliacoes->count();
              $hora   = now()->format('H:i');
              $aberta = ($farmacia->horario_abertura ?? '08:00') <= $hora
                     && $hora <= ($farmacia->horario_fechamento ?? '22:00');
            @endphp
            <div class="ph-list-card"
                 data-name="{{ strtolower($farmacia->name) }}"
                 data-bairro="{{ strtolower($farmacia->bairro ?? '') }}"
                 data-status="{{ $aberta ? 'open' : 'closed' }}"
                 data-rating="{{ $rating }}"
                 data-lat="{{ $farmacia->latitude ?? '' }}"
                 data-lng="{{ $farmacia->longitude ?? '' }}">
              <div class="ph-list-img">
                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=320&auto=format&fit=crop" alt="{{ $farmacia->name }}">
              </div>
              <div class="ph-list-body">
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                  <span style="font-size:.95rem;font-weight:800;color:var(--heading)">{{ $farmacia->name }}</span>
                  <span class="ph-badge {{ $aberta ? 'ph-open' : 'ph-closed' }}"
                        style="font-size:.68rem;padding:.18rem .6rem;border-radius:50px;border:none">
                    <i class="bi bi-circle-fill" style="font-size:.4rem"></i>
                    {{ $aberta ? 'Aberta' : 'Fechada' }}
                  </span>
                </div>
                <div class="ph-loc mb-1"><i class="bi bi-geo-alt-fill"></i> {{ $farmacia->bairro ?? '—' }}</div>
                <div class="ph-rating" style="margin-bottom:.4rem">
                  @for($s = 1; $s <= 5; $s++)
                    <i class="bi bi-star{{ $s <= round($rating) ? '-fill' : '' }}"
                       style="color:{{ $s <= round($rating) ? '#f59e0b' : '#e4f0f0' }};font-size:.8rem"></i>
                  @endfor
                  <span style="margin-left:.2rem;font-size:.78rem;font-weight:700">{{ number_format($rating,1) }}</span>
                  <span class="ph-reviews">({{ $nRev }})</span>
                </div>
                <div style="font-size:.76rem;color:var(--muted)">
                  <i class="bi bi-clock"></i>
                  {{ $farmacia->horario_abertura ?? '08:00' }} – {{ $farmacia->horario_fechamento ?? '22:00' }}
                </div>
              </div>
              <div class="ph-list-actions">
                <button class="ph-btn ph-view" style="width:100%" onclick="openModal({{ $farmacia->id }})">
                  <i class="bi bi-eye"></i> Ver
                </button>
                <a href="{{ route('produtos.clientes', ['farmacia_id' => $farmacia->id]) }}"
                   class="ph-btn ph-order" style="width:100%;text-decoration:none">
                  <i class="bi bi-bag-plus"></i> Encomendar
                </a>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Empty state (filtros JS) -->
        <div class="empty-ph" id="emptyState">
          <i class="bi bi-hospital"></i>
          <h5>Nenhuma farmácia encontrada</h5>
          <p>Tente ajustar os filtros ou pesquisar por outro bairro.</p>
          <button class="ph-btn ph-order" style="display:inline-flex;max-width:200px;margin:0 auto" onclick="resetAll()">
            Ver todas as farmácias
          </button>
        </div>

        <!-- Paginação -->
        <div class="pagination-fc" id="paginationBar">
          {{ $farmacias->links() }}
        </div>

      </div><!-- /col-lg-9 -->
    </div><!-- /row -->
  </div>
</div>

<!-- ── MODAL FARMÁCIA ── -->
<div class="modal fade" id="pharmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-ph-banner">
        <img id="modalImg" src="" alt="">
      </div>
      <div class="modal-header">
        <div>
          <h5 class="modal-title" id="modalName" style="font-weight:800;color:var(--heading);margin:0;"></h5>
          <div style="display:flex;align-items:center;gap:.8rem;margin-top:.3rem;flex-wrap:wrap;">
            <span id="modalBadge" style="font-size:.72rem;font-weight:700;padding:.2rem .65rem;border-radius:50px;"></span>
            <span id="modalRatingStars" style="font-size:.8rem;color:#f59e0b;"></span>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-md-6">
            <h6 style="font-size:.78rem;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.8rem;">Informações</h6>
            <div class="info-row"><i class="bi bi-geo-alt-fill"></i>   <span id="mAddr"></span></div>
            <div class="info-row"><i class="bi bi-telephone-fill"></i> <span id="mPhone"></span></div>
            <div class="info-row"><i class="bi bi-envelope-fill"></i>  <span id="mEmail"></span></div>
            <div class="info-row"><i class="bi bi-credit-card"></i>    <span>Multicaixa Express · Cartão · Numerário</span></div>
          </div>
          <div class="col-md-6">
            <h6 style="font-size:.78rem;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.8rem;">Horário</h6>
            <table class="hours-table" id="mHours"></table>
          </div>
        </div>
      </div>
      <div class="modal-footer gap-2">
        <button type="button" data-bs-dismiss="modal"
                style="background:var(--soft);color:var(--accent);border:none;border-radius:50px;padding:.5rem 1.2rem;font-size:.85rem;font-weight:700;cursor:pointer;">
          Fechar
        </button>
        <a id="modalOrderBtn" href="#"
           style="background:var(--accent);color:#fff;border:none;border-radius:50px;padding:.5rem 1.4rem;font-size:.85rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:.4rem;">
          <i class="bi bi-bag-plus"></i> Encomendar
        </a>
      </div>
    </div>
  </div>
</div>

@include('clientes.dashboard.footer')

<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle">Sucesso</strong><span id="toastMsg"></span></div>
</div>
<a href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>

const farmaciasData = {
  @foreach($farmacias as $farmacia)
  @php
    $rating = round($farmacia->avaliacoes->avg('classificacao') ?? 0, 1);
    $nRev   = $farmacia->avaliacoes->count();
    $hora   = now()->format('H:i');
    $aberta = ($farmacia->horario_abertura ?? '08:00') <= $hora
           && $hora <= ($farmacia->horario_fechamento ?? '22:00');
  @endphp
  {{ $farmacia->id }}: {
    id:        {{ $farmacia->id }},
    name:      @json($farmacia->name),
    bairro:    @json($farmacia->bairro ?? ''),
    endereco:  @json($farmacia->endereco ?? ''),
    telefone:  @json($farmacia->telefone ?? ''),
    email:     @json($farmacia->email ?? ''),
    abertura:  @json($farmacia->horario_abertura  ?? '08:00'),
    fechamento:@json($farmacia->horario_fechamento ?? '22:00'),
    rating:    {{ $rating }},
    reviews:   {{ $nRev }},
    aberta:    {{ $aberta ? 'true' : 'false' }},
    lat:       {{ $farmacia->latitude  ?? 'null' }},
    lng:       {{ $farmacia->longitude ?? 'null' }},
    img:       "https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=800&auto=format&fit=crop",
  },
  @endforeach
};

/* ══════════════════════════════════════════════════════════
   MAPA LEAFLET
══════════════════════════════════════════════════════════ */
const map = L.map('pharmacyMap').setView([-8.8383, 13.2344], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  maxZoom: 19,
}).addTo(map);

/* Ícone personalizado */
const makeIcon = (aberta) => L.divIcon({
  className: '',
  html: `<div style="
    width:30px;height:30px;
    background:${aberta ? '#16a34a' : '#d94040'};
    border:3px solid #fff;
    border-radius:50% 50% 50% 0;
    transform:rotate(-45deg);
    box-shadow:0 3px 10px rgba(0,0,0,.3);
  "></div>`,
  iconSize:   [30, 30],
  iconAnchor: [15, 30],
  popupAnchor:[0, -32],
});

const mapMarkers = {};

Object.values(farmaciasData).forEach(f => {
  if (!f.lat || !f.lng) return;
  const marker = L.marker([f.lat, f.lng], { icon: makeIcon(f.aberta) })
    .addTo(map)
    .bindPopup(`
      <div class="lf-popup">
        <strong>${f.name}</strong>
        <span>${f.bairro}</span><br>
        <span style="color:${f.aberta ? '#16a34a' : '#d94040'};font-weight:700;font-size:.75rem;">
          ${f.aberta ? '● Aberta' : '● Fechada'}
        </span>
        &nbsp;·&nbsp;
        <span style="color:#f59e0b;font-size:.75rem;">★ ${f.rating}</span><br>
        <button class="lf-btn" onclick="openModal(${f.id})">Ver detalhes</button>
      </div>`);
  mapMarkers[f.id] = marker;
});

/* Colapsar/expandir mapa */
function toggleMap() {
  const body = document.getElementById('mapBody');
  const btn  = document.getElementById('mapToggleBtn');
  const hidden = body.style.display === 'none';
  body.style.display  = hidden ? '' : 'none';
  btn.innerHTML = hidden
    ? '<i class="bi bi-chevron-up"></i> Ocultar'
    : '<i class="bi bi-chevron-down"></i> Mostrar mapa';
  if (hidden) setTimeout(() => map.invalidateSize(), 100);
}

/* ══════════════════════════════════════════════════════════
   ESTADO DOS FILTROS
══════════════════════════════════════════════════════════ */
let filterStatus  = 'all';   // 'all' | 'open' | 'closed'
let filterRating  = 0;       // mínimo de estrelas (0 = sem filtro)
let filterDistKm  = 0;       // 0 = sem filtro de distância
let userLat       = null;
let userLng       = null;

/* ── Localização do utilizador (para filtro de distância) ── */
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(pos => {
    userLat = pos.coords.latitude;
    userLng = pos.coords.longitude;
    L.marker([userLat, userLng], {
      icon: L.divIcon({
        className:'',
        html:'<div style="width:16px;height:16px;background:#099aa7;border-radius:50%;border:3px solid #fff;box-shadow:0 0 0 4px rgba(9,154,167,.25)"></div>',
        iconSize:[16,16], iconAnchor:[8,8],
      })
    }).addTo(map).bindPopup('<strong>A sua localização</strong>');
  }, () => {});
}

/* ══════════════════════════════════════════════════════════
   FILTRO PRINCIPAL — actua sobre os elementos do DOM
══════════════════════════════════════════════════════════ */
function applyFilters() {
  /* Ler estado actual dos controlos */
  const chkOpen   = document.getElementById('chk-open').checked;
  const chkClosed = document.getElementById('chk-closed').checked;
  const ratingEl  = document.querySelector('input[name="ratingFilter"]:checked');
  filterRating    = ratingEl ? parseInt(ratingEl.value) : 0;
  filterDistKm    = parseInt(document.getElementById('distSlider').value) || 0;

  /* Status: se ambos marcados ou nenhum → mostrar todos */
  if ((chkOpen && chkClosed) || (!chkOpen && !chkClosed)) filterStatus = 'all';
  else if (chkOpen)   filterStatus = 'open';
  else                filterStatus = 'closed';

  let visible = 0;

  const allGrid = document.querySelectorAll('.ph-grid-item');
  const allList = document.querySelectorAll('.ph-list-card');

  allGrid.forEach((el, i) => {
    const show = matchesFilters(el);
    el.style.display = show ? '' : 'none';
    if (show) visible++;
    /* Sincroniza na lista */
    if (allList[i]) allList[i].style.display = show ? 'flex' : 'none';
    /* Sincroniza marcadores no mapa */
    const id = getFarmaciaIdFromEl(el);
    if (mapMarkers[id]) {
      if (show) mapMarkers[id].addTo(map);
      else      map.removeLayer(mapMarkers[id]);
    }
  });

  document.getElementById('countVisible').textContent = visible;
  document.getElementById('emptyState').style.display  = visible === 0 ? 'block' : 'none';
  document.getElementById('paginationBar').style.display = visible === 0 ? 'none' : '';

  renderActiveFilters();
}

function matchesFilters(el) {
  const status = el.dataset.status;
  const rating = parseFloat(el.dataset.rating) || 0;
  const lat    = parseFloat(el.dataset.lat);
  const lng    = parseFloat(el.dataset.lng);

  /* Filtro de estado */
  if (filterStatus !== 'all' && status !== filterStatus) return false;

  /* Filtro de avaliação */
  if (filterRating > 0 && rating < filterRating) return false;

  /* Filtro de distância */
  if (filterDistKm > 0 && userLat && userLng && lat && lng) {
    const dist = haversine(userLat, userLng, lat, lng);
    if (dist > filterDistKm) return false;
  }

  return true;
}

function getFarmaciaIdFromEl(el) {
  /* Extrai o id do onclick do botão Ver dentro do card */
  const btn = el.querySelector('[onclick*="openModal"]');
  if (!btn) return null;
  const m = btn.getAttribute('onclick').match(/\d+/);
  return m ? parseInt(m[0]) : null;
}

/* Haversine */
function haversine(lat1, lng1, lat2, lng2) {
  const R = 6371;
  const dLat = (lat2-lat1) * Math.PI/180;
  const dLng = (lng2-lng1) * Math.PI/180;
  const a = Math.sin(dLat/2)**2 + Math.cos(lat1*Math.PI/180)*Math.cos(lat2*Math.PI/180)*Math.sin(dLng/2)**2;
  return R * 2 * Math.asin(Math.sqrt(a));
}

/* ── Tags de filtros activos ── */
function renderActiveFilters() {
  const af = document.getElementById('activeFilters');
  const tags = [];

  if (filterStatus === 'open')   tags.push(['Abertas',   () => { document.getElementById('chk-open').checked=false; applyFilters(); }]);
  if (filterStatus === 'closed') tags.push(['Fechadas',  () => { document.getElementById('chk-closed').checked=false; applyFilters(); }]);
  if (filterRating > 0)          tags.push([filterRating+'★+', () => { document.querySelector('input[name="ratingFilter"]:checked').checked=false; applyFilters(); }]);
  if (filterDistKm > 0)          tags.push([filterDistKm+' km', () => { document.getElementById('distSlider').value=0; onDistChange(0); }]);

  af.innerHTML = tags.map(([label, fn], i) =>
    `<span class="af-tag" onclick="activeFilterFns[${i}]()">
       <i class="bi bi-x-circle-fill"></i> ${label}
     </span>`
  ).join('');

  window.activeFilterFns = tags.map(t => t[1]);
}

/* ── Filtro de distância ── */
function onDistChange(val) {
  const v = parseInt(val);
  document.getElementById('distVal').textContent = v === 0 ? 'Qualquer' : v + ' km';
  filterDistKm = v;
  applyFilters();
}

/* ── Quick filters (pills no topbar) ── */
function quickFilter(el, val) {
  document.querySelectorAll('.qf-tag').forEach(t => t.classList.remove('active'));
  el.classList.add('active');

  const chkOpen   = document.getElementById('chk-open');
  const chkClosed = document.getElementById('chk-closed');

  if (val === 'open')   { chkOpen.checked=true;  chkClosed.checked=false; }
  else if(val==='closed'){ chkOpen.checked=false; chkClosed.checked=true; }
  else                  { chkOpen.checked=false;  chkClosed.checked=false; }

  applyFilters();
}

/* ── Limpar filtros individuais ── */
function clearFilter(type) {
  if (type === 'status') {
    document.getElementById('chk-open').checked   = false;
    document.getElementById('chk-closed').checked = false;
    filterStatus = 'all';
    document.querySelectorAll('.qf-tag').forEach(t => t.classList.remove('active'));
    document.getElementById('qf-all').classList.add('active');
  }
  if (type === 'rating') {
    const checked = document.querySelector('input[name="ratingFilter"]:checked');
    if (checked) checked.checked = false;
    filterRating = 0;
  }
  applyFilters();
}

function resetAll() {
  clearFilter('status');
  clearFilter('rating');
  document.getElementById('distSlider').value = 0;
  onDistChange(0);
}

/* ══════════════════════════════════════════════════════════
   ORDENAÇÃO
══════════════════════════════════════════════════════════ */
function sortCards() {
  const val = document.getElementById('sortSel').value;
  const grid = document.getElementById('gridContainer');
  const list = document.getElementById('listContainer');

  const getSortVal = (el) => {
    if (val === 'rating') return -parseFloat(el.dataset.rating || 0);
    if (val === 'name')   return el.dataset.name || '';
    return 0;
  };

  const sortEls = (container, selector) => {
    const items = [...container.querySelectorAll(selector)];
    items.sort((a, b) => {
      const va = getSortVal(a), vb = getSortVal(b);
      return va < vb ? -1 : va > vb ? 1 : 0;
    });
    items.forEach(el => container.appendChild(el));
  };

  sortEls(grid, '.ph-grid-item');
  sortEls(list, '.ph-list-card');
}

/* ══════════════════════════════════════════════════════════
   VIEW TOGGLE
══════════════════════════════════════════════════════════ */
function setView(mode) {
  document.body.className = mode + '-mode';
  document.getElementById('gridBtn').classList.toggle('active', mode === 'grid');
  document.getElementById('listBtn').classList.toggle('active', mode === 'list');
  localStorage.setItem('farmView', mode);
}
const _sv = localStorage.getItem('farmView');
if (_sv === 'list') setView('list');

/* ══════════════════════════════════════════════════════════
   MODAL
══════════════════════════════════════════════════════════ */
function openModal(id) {
  const d = farmaciasData[id];
  if (!d) return;

  document.getElementById('modalImg').src = d.img;
  document.getElementById('modalName').textContent = d.name;
  document.getElementById('mAddr').textContent     = d.endereco || 'Endereço não disponível';
  document.getElementById('mPhone').textContent    = d.telefone  || 'Telefone não disponível';
  document.getElementById('mEmail').textContent    = d.email     || 'Email não disponível';

  /* Badge de estado */
  const badge = document.getElementById('modalBadge');
  badge.textContent = d.aberta ? '● Aberta' : '● Fechada';
  badge.style.background = d.aberta ? '#dcfce7' : '#fdecea';
  badge.style.color      = d.aberta ? '#15803d' : '#c0392b';

  /* Estrelas no modal */
  let stars = '';
  for (let s = 1; s <= 5; s++) {
    stars += `<i class="bi bi-star${s <= Math.round(d.rating) ? '-fill' : ''}"
               style="color:${s <= Math.round(d.rating) ? '#f59e0b' : '#e4f0f0'}"></i>`;
  }
  document.getElementById('modalRatingStars').innerHTML =
    stars + ` <span style="color:var(--muted);font-size:.82rem;margin-left:.25rem">${d.rating} (${d.reviews} avaliações)</span>`;

  /* Horário */
  const days = ['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
  const todayIdx = (new Date().getDay() + 6) % 7;
  document.getElementById('mHours').innerHTML = days.map((day, i) =>
    `<tr class="${i === todayIdx ? 'today' : ''}">
       <td>${day}</td>
       <td>${d.abertura} – ${d.fechamento}${i === todayIdx ? ' <strong style="color:var(--accent)">(hoje)</strong>' : ''}</td>
     </tr>`
  ).join('');

  /* Botão encomendar */
  document.getElementById('modalOrderBtn').href =
    `{{ route('produtos.clientes') }}?farmacia_id=${id}`;

  /* Centrar mapa no marcador */
  if (d.lat && d.lng) {
    map.flyTo([d.lat, d.lng], 15, { duration: 1 });
    mapMarkers[id]?.openPopup();
  }

  new bootstrap.Modal(document.getElementById('pharmModal')).show();
}

/* ══════════════════════════════════════════════════════════
   FAVORITO
══════════════════════════════════════════════════════════ */
function toggleFav(btn) {
  const on = btn.classList.toggle('active');
  btn.innerHTML = on ? '<i class="bi bi-heart-fill"></i>' : '<i class="bi bi-heart"></i>';
  showToast(on ? 'Adicionado aos favoritos' : 'Removido dos favoritos', '');
}

/* ══════════════════════════════════════════════════════════
   HEADER SCROLL + SCROLL TOP
══════════════════════════════════════════════════════════ */
const _hdr = document.getElementById('mainHeader');
const _st  = document.getElementById('scroll-top');
window.addEventListener('scroll', () => {
  _hdr?.classList.toggle('scrolled', scrollY > 50);
  _st.style.display = scrollY > 320 ? 'flex' : 'none';
});

/* ══════════════════════════════════════════════════════════
   TOAST
══════════════════════════════════════════════════════════ */
function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = msg ? ' ' + msg : '';
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3200);
}

/* ── Init ── */
map.invalidateSize();

</script>
</body>
</html>