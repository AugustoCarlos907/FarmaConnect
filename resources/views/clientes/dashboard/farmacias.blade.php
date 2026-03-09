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

    /* ===== HEADER ===== */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; z-index:1000; transition:box-shadow .3s; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
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
    .profile-toggle img { border:2px solid var(--soft); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ===== TOPBAR ===== */
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

    /* Hero search inside topbar */
    .topbar-search {
      margin-top:1.8rem; position:relative; z-index:2;
    }
    .ts-box {
      background:#fff; border-radius:20px;
      box-shadow:0 20px 50px rgba(0,0,0,.18);
      padding:1.2rem 1.5rem;
      display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
    }
    .ts-field { flex:1; min-width:180px; position:relative; }
    .ts-field i { position:absolute; left:.95rem; top:50%; transform:translateY(-50%); color:var(--accent); font-size:.95rem; pointer-events:none; }
    .ts-field input, .ts-field select {
      width:100%; border:1.5px solid var(--border); border-radius:50px;
      padding:.7rem 1rem .7rem 2.6rem; font-size:.9rem; font-family:inherit;
      color:var(--heading); background:#fafefe; outline:none; transition:border-color .2s;
    }
    .ts-field input:focus, .ts-field select:focus { border-color:var(--accent); }
    .ts-sep { width:1px; height:36px; background:var(--border); flex-shrink:0; }
    .ts-btn { background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.72rem 1.8rem; font-size:.92rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.5rem; transition:all .25s; white-space:nowrap; }
    .ts-btn:hover { background:var(--accent-dark); transform:scale(1.03); }

    /* Quick filters */
    .quick-filters { display:flex; gap:.5rem; flex-wrap:wrap; margin-top:1rem; }
    .qf-tag { background:rgba(255,255,255,.15); color:#fff; border:1px solid rgba(255,255,255,.28); padding:.28rem .85rem; border-radius:50px; font-size:.78rem; font-weight:600; cursor:pointer; transition:background .2s; }
    .qf-tag:hover,.qf-tag.active { background:#fff; color:var(--accent); }

    /* ===== STATS BAR ===== */
    .stats-strip { background:#fff; border-bottom:1px solid var(--border); }
    .stat-item { display:flex; align-items:center; gap:.7rem; padding:1rem 0; border-right:1px solid var(--border); flex:1; justify-content:center; }
    .stat-item:last-child { border-right:none; }
    .stat-icon { width:40px; height:40px; background:var(--soft); border-radius:12px; display:flex; align-items:center; justify-content:center; color:var(--accent); font-size:1.1rem; flex-shrink:0; }
    .stat-val  { font-size:1.3rem; font-weight:800; color:var(--heading); line-height:1; }
    .stat-lbl  { font-size:.7rem; color:var(--muted); text-transform:uppercase; letter-spacing:.05em; }

    /* ===== MAIN LAYOUT ===== */
    .page-wrap { margin-top:-2rem; padding-bottom:4rem; }

    /* ===== SIDEBAR FILTERS ===== */
    .filter-sidebar { position:sticky; top:80px; }
    .fbox { background:#fff; border-radius:20px; box-shadow:var(--shadow); overflow:hidden; margin-bottom:1rem; }
    .fbox-header { padding:1rem 1.3rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .fbox-header h6 { font-size:.85rem; font-weight:800; color:var(--heading); margin:0; }
    .fbox-clear { font-size:.75rem; color:var(--accent); cursor:pointer; font-weight:600; border:none; background:none; }
    .fbox-body  { padding:1.1rem 1.3rem; }

    /* Check list */
    .fcheck-list { display:flex; flex-direction:column; gap:.5rem; }
    .fcheck-item { display:flex; align-items:center; justify-content:space-between; cursor:pointer; padding:.3rem 0; }
    .fcheck-left { display:flex; align-items:center; gap:.6rem; }
    .fcheck-item input[type=checkbox] { width:16px; height:16px; accent-color:var(--accent); cursor:pointer; flex-shrink:0; }
    .fcheck-item label { font-size:.87rem; color:var(--text); cursor:pointer; }
    .fcheck-count { font-size:.72rem; background:var(--mint); color:var(--accent); padding:.1rem .5rem; border-radius:50px; font-weight:700; }

    /* Rating filter */
    .rating-filter { display:flex; flex-direction:column; gap:.4rem; }
    .rf-item { display:flex; align-items:center; gap:.5rem; cursor:pointer; padding:.25rem 0; }
    .rf-item input { width:16px; height:16px; accent-color:var(--accent); cursor:pointer; }
    .rf-stars i { color:#f59e0b; font-size:.85rem; }
    .rf-stars span { font-size:.78rem; color:var(--muted); }

    /* Distance slider */
    .dist-slider { width:100%; accent-color:var(--accent); }
    .dist-val { font-size:.82rem; font-weight:700; color:var(--accent); }

    /* ===== TOOLBAR ===== */
    .results-toolbar {
      background:#fff; border-radius:16px; box-shadow:var(--shadow);
      padding:.9rem 1.3rem; margin-bottom:1.2rem;
      display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
    }
    .results-count { font-size:.88rem; color:var(--muted); }
    .results-count strong { color:var(--heading); }
    .view-toggle { display:flex; gap:.3rem; margin-left:auto; }
    .vt-btn { width:34px; height:34px; border:1.5px solid var(--border); background:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:var(--muted); transition:all .2s; font-size:.9rem; }
    .vt-btn.active,.vt-btn:hover { background:var(--accent); color:#fff; border-color:var(--accent); }
    .sort-sel { border:1.5px solid var(--border); border-radius:50px; padding:.38rem 1rem; font-size:.83rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; cursor:pointer; }

    /* ===== PHARMACY CARD (GRID) ===== */
    .ph-card {
      background:#fff; border-radius:22px; overflow:hidden;
      box-shadow:var(--shadow); transition:all .3s; height:100%;
      border:2px solid transparent; display:flex; flex-direction:column;
    }
    .ph-card:hover { transform:translateY(-6px); border-color:var(--accent); box-shadow:0 20px 44px rgba(9,154,167,.15); }

    .ph-img-wrap { position:relative; height:170px; overflow:hidden; }
    .ph-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .ph-card:hover .ph-img-wrap img { transform:scale(1.06); }
    .ph-img-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,transparent 40%,rgba(0,0,0,.35)); }
    .ph-badge-top { position:absolute; top:10px; left:12px; display:flex; gap:.4rem; flex-wrap:wrap; }
    .ph-badge { font-size:.7rem; font-weight:700; padding:.22rem .7rem; border-radius:50px; backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,.3); }
    .ph-open   { background:rgba(34,197,94,.85); color:#fff; }
    .ph-closed { background:rgba(231,76,60,.85);  color:#fff; }
    .ph-24h    { background:rgba(9,154,167,.85);   color:#fff; }
    .ph-new    { background:rgba(245,158,11,.9);   color:#fff; }
    .ph-fav-btn {
      position:absolute; top:10px; right:12px;
      width:32px; height:32px; background:rgba(255,255,255,.88);
      border-radius:50%; display:flex; align-items:center; justify-content:center;
      cursor:pointer; font-size:.95rem; color:#b0c4c6; transition:all .2s;
      backdrop-filter:blur(8px); border:none;
    }
    .ph-fav-btn:hover,.ph-fav-btn.active { color:#e74c3c; transform:scale(1.15); }
    .ph-dist { position:absolute; bottom:10px; right:12px; background:rgba(255,255,255,.88); backdrop-filter:blur(8px); border-radius:50px; padding:.2rem .65rem; font-size:.72rem; font-weight:700; color:var(--heading); display:flex; align-items:center; gap:.25rem; }

    .ph-body { padding:1.2rem; flex:1; display:flex; flex-direction:column; }
    .ph-name { font-size:1rem; font-weight:800; color:var(--heading); margin-bottom:.2rem; }
    .ph-loc  { font-size:.78rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.7rem; }
    .ph-meta { display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; margin-bottom:.9rem; }
    .ph-rating { display:flex; align-items:center; gap:.3rem; font-size:.78rem; font-weight:700; color:var(--heading); }
    .ph-rating i { color:#f59e0b; font-size:.82rem; }
    .ph-reviews { font-size:.72rem; color:var(--muted); }
    .ph-tag { background:#f0f5f5; color:var(--muted); font-size:.72rem; padding:.2rem .6rem; border-radius:50px; font-weight:600; }
    .ph-delivery { font-size:.78rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.9rem; }
    .ph-delivery strong { color:var(--heading); }

    /* Specialties pills */
    .ph-specs { display:flex; gap:.3rem; flex-wrap:wrap; margin-bottom:1rem; }
    .ph-spec { background:var(--mint); color:var(--accent); font-size:.68rem; font-weight:700; padding:.18rem .55rem; border-radius:50px; }

    .ph-actions { display:flex; gap:.5rem; margin-top:auto; }
    .ph-btn { flex:1; padding:.52rem; text-align:center; border-radius:50px; text-decoration:none; font-weight:700; font-size:.82rem; transition:all .25s; cursor:pointer; border:none; font-family:inherit; display:flex; align-items:center; justify-content:center; gap:.35rem; }
    .ph-view  { background:var(--soft); color:var(--accent); }
    .ph-order { background:var(--accent); color:#fff; }
    .ph-view:hover  { background:var(--accent); color:#fff; }
    .ph-order:hover { background:var(--accent-dark); }

    /* ===== LIST VIEW ===== */
    .ph-list-card {
      background:#fff; border-radius:18px; box-shadow:var(--shadow);
      border:2px solid transparent; transition:all .3s; overflow:hidden;
      display:none; align-items:stretch; margin-bottom:.85rem;
    }
    .ph-list-card:hover { border-color:var(--accent); box-shadow:0 14px 38px rgba(9,154,167,.13); transform:translateY(-2px); }
    .ph-list-img { width:160px; flex-shrink:0; overflow:hidden; position:relative; }
    .ph-list-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .ph-list-card:hover .ph-list-img img { transform:scale(1.06); }
    .ph-list-body { flex:1; padding:1.1rem 1.3rem; display:flex; flex-direction:column; justify-content:center; }
    .ph-list-actions { display:flex; flex-direction:column; justify-content:center; align-items:flex-end; gap:.5rem; padding:1rem 1.2rem; border-left:1px solid var(--border); min-width:160px; }
    .ph-list-open { display:flex; align-items:center; gap:.5rem; }

    /* View modes */
    body.list-mode .ph-grid-item { display:none !important; }
    body.list-mode .ph-list-card { display:flex !important; }
    body.grid-mode .ph-grid-item { display:block !important; }
    body.grid-mode .ph-list-card { display:none !important; }

    /* ===== FEATURED SECTION ===== */
    .featured-section { background:var(--mint); border-radius:20px; padding:1.5rem; margin-bottom:1.5rem; }
    .featured-section h6 { font-size:.8rem; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
    .featured-scroll { display:flex; gap:1rem; overflow-x:auto; padding-bottom:.5rem; scrollbar-width:none; }
    .featured-scroll::-webkit-scrollbar { display:none; }
    .feat-card { background:#fff; border-radius:16px; padding:.9rem 1.1rem; min-width:200px; flex-shrink:0; display:flex; align-items:center; gap:.85rem; cursor:pointer; transition:all .25s; border:1.5px solid transparent; }
    .feat-card:hover { border-color:var(--accent); box-shadow:0 8px 24px rgba(9,154,167,.12); }
    .feat-img { width:44px; height:44px; border-radius:12px; object-fit:cover; flex-shrink:0; }
    .feat-name { font-size:.88rem; font-weight:700; color:var(--heading); line-height:1.2; }
    .feat-meta { font-size:.72rem; color:var(--muted); }
    .feat-badge { font-size:.65rem; font-weight:700; background:var(--soft); color:var(--accent); padding:.1rem .5rem; border-radius:50px; }

    /* ===== MAP TOGGLE ===== */
    .map-toggle-bar {
      background:#fff; border-radius:16px; box-shadow:var(--shadow);
      padding:1rem 1.3rem; margin-bottom:1.2rem;
      display:flex; align-items:center; gap:1rem;
    }
    .map-preview-thumb {
      width:100%; height:180px; border-radius:14px; overflow:hidden;
      background:linear-gradient(135deg,#eaf6f5,#dff3f0);
      display:flex; align-items:center; justify-content:center;
      position:relative; cursor:pointer; margin-bottom:1.2rem;
    }
    .map-preview-thumb img { width:100%; height:100%; object-fit:cover; }
    .map-overlay-btn {
      position:absolute; inset:0; background:rgba(9,154,167,.15);
      display:flex; align-items:center; justify-content:center;
      transition:background .2s;
    }
    .map-overlay-btn:hover { background:rgba(9,154,167,.25); }
    .map-overlay-btn span { background:#fff; color:var(--accent); font-weight:700; font-size:.85rem; padding:.65rem 1.4rem; border-radius:50px; box-shadow:0 8px 24px rgba(0,0,0,.14); display:flex; align-items:center; gap:.45rem; }

    /* ===== EMPTY STATE ===== */
    .empty-ph { background:#fff; border-radius:20px; box-shadow:var(--shadow); padding:3.5rem 2rem; text-align:center; display:none; }
    .empty-ph i { font-size:3.5rem; color:#b0d8dc; display:block; margin-bottom:1rem; }
    .empty-ph h5 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-ph p  { color:var(--muted); font-size:.9rem; max-width:280px; margin:0 auto 1.2rem; }

    /* ===== PAGINATION ===== */
    .pagination-fc { display:flex; align-items:center; justify-content:center; gap:.4rem; margin-top:1.8rem; }
    .pg-btn { width:38px; height:38px; border-radius:10px; border:1.5px solid var(--border); background:#fff; color:var(--muted); font-size:.85rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s; font-family:inherit; }
    .pg-btn:hover { border-color:var(--accent); color:var(--accent); }
    .pg-btn.active { background:var(--accent); color:#fff; border-color:var(--accent); }
    .pg-btn:disabled { opacity:.4; cursor:not-allowed; }

    /* ===== MODAL FARMÁCIA ===== */
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
    .info-row span { color:var(--text); }
    .info-row strong { color:var(--heading); }

    /* Hours table */
    .hours-table { width:100%; font-size:.82rem; }
    .hours-table td { padding:.3rem .2rem; color:var(--muted); }
    .hours-table td:first-child { font-weight:600; color:var(--heading); width:100px; }
    .hours-table tr.today td { color:var(--accent); font-weight:700; }

    /* Toast */
    .toast-fc { position:fixed; bottom:28px; right:28px; background:var(--heading); color:#fff; border-radius:16px; padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem; box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span   { font-size:.78rem; color:rgba(255,255,255,.65); }

    /* Scroll top */
    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; text-decoration:none; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; transition:all .3s; box-shadow:0 6px 20px rgba(9,154,167,.35); }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    /* Responsive */
    @media(max-width:991px) { .filter-sidebar { display:none; } }
    @media(max-width:768px) { .hdr-search{display:none;} .ph-list-img{width:110px;} .ph-list-actions{min-width:120px;} }
    @media(max-width:576px) { .ph-list-actions{display:none;} .ts-sep{display:none;} }
  </style>
</head>
<body class="grid-mode">

<!-- ===== HEADER ===== -->
<header class="header fixed-top" id="mainHeader">
  <div class="container-xl">
    <div class="d-flex align-items-center gap-3">
      <a href="#" class="text-decoration-none me-2 flex-shrink-0">
        <h1 class="sitename"><span class="s1">Farma</span><span class="s2">Connect</span></h1>
      </a>
      <div class="hdr-search d-none d-md-block mx-auto">
        <div class="ig">
          <span class="ig-icon"><i class="bi bi-search"></i></span>
          <input type="text" placeholder="Pesquise medicamentos, farmácias..." id="hdrSearch">
          <button class="ig-btn"><i class="bi bi-arrow-right-circle-fill"></i></button>
        </div>
      </div>
      <nav class="navmenu d-none d-lg-block flex-shrink-0">
        <ul>
          <li><a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a></li>
          <li><a class="active" href="{{ route('farmacias.list') }}"><i class="bi bi-hospital"></i> Farmácias</a></li>
          <li><a href="{{ route('produtos.clientes') }}" ><i class="bi bi-box-seam"></i> Produtos</a></li>
          <li><a href="{{ route('pedidos.clientes') }}"><i class="bi bi-clock-history"></i> Histórico</a></li>
        </ul>
      </nav>
      <div class="d-flex align-items-center gap-3 flex-shrink-0 ms-auto ms-lg-0">
        <a href="{{ route('carrinho.clientes') }}" class="hdr-icon d-none d-sm-inline-flex" onclick="openCart();return false;">
          <i class="bi bi-bag"></i>
          <span class="hdr-badge" id="cartBadge">0</span>
        </a>        
        <div class="dropdown">
          <a href="#" class="profile-toggle dropdown-toggle" id="pdrop" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&rounded=true&size=34" width="34" height="34" class="rounded-circle" alt="">
            <span class="pname d-none d-md-inline">Ana Costa</span>
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

<!-- ===== TOPBAR ===== -->
<div class="page-topbar mt-2" style="padding-top:64px;">
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

    <!-- Search box -->
    <div class="topbar-search">
      <div class="ts-box">
        <div class="ts-field" style="flex:2;">
          <i class="bi bi-hospital"></i>
          <input type="text" id="searchPharm" placeholder="Nome da farmácia " oninput="filterPharmacies()">
        </div>
        <div class="ts-sep d-none d-md-block"></div>
        <div class="ts-sep d-none d-md-block"></div>
        <div class="ts-field">
          <i class="bi bi-clock"></i>
          <select id="filterStatus" onchange="filterPharmacies()">
            <option value="">Qualquer horário</option>
            <option value="open">Abertas agora</option>
            <option value="24h">Abertas 24h</option>
          </select>
        </div>
        <button class="ts-btn" onclick="filterPharmacies()"><i class="bi bi-search"></i> Pesquisar</button>
      </div>
      <div class="quick-filters" id="quickFilters">
        <span class="qf-tag active" onclick="quickFilter(this,'')"> Todas</span>
        <span class="qf-tag" onclick="quickFilter(this,'open')">Abertas agora</span>
        <span class="qf-tag" onclick="quickFilter(this,'24h')"> 24 horas</span>
        {{-- <span class="qf-tag" onclick="quickFilter(this,'new')"> Recentes</span> --}}
        <span class="qf-tag" onclick="quickFilter(this,'fav')"> Favoritas</span>
      </div>
    </div>
  </div>
</div>

<!-- ===== STATS STRIP ===== -->
<div class="stats-strip">
  <div class="container-xl">
    <div class="d-flex">
      <div class="stat-item">
        <div class="stat-icon"><i class="bi bi-hospital"></i></div>
        <div><div class="stat-val">50+</div><div class="stat-lbl">Farmácias</div></div>
      </div>
      <div class="stat-item">
        <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
        <div><div class="stat-val">38</div><div class="stat-lbl">Abertas agora</div></div>
      </div>
      <div class="stat-item">
        <div class="stat-icon"><i class="bi bi-moon-stars"></i></div>
        <div><div class="stat-val">8</div><div class="stat-lbl">Abertas 24h</div></div>
      </div>
      {{-- <div class="stat-item d-none d-md-flex">
        <div class="stat-icon"><i class="bi bi-truck"></i></div>
        <div><div class="stat-val">30 min</div><div class="stat-lbl">Entrega média</div></div>
      </div> --}}
      <div class="stat-item d-none d-lg-flex">
        <div class="stat-icon"><i class="bi bi-capsule-pill"></i></div>
        <div><div class="stat-val">5 000+</div><div class="stat-lbl">Medicamentos</div></div>
      </div>
    </div>
  </div>
</div>

<!-- ===== PAGE CONTENT ===== -->
<div class="page-wrap">
  <div class="container-xl">
    <div class="row g-4">

      <!-- SIDEBAR -->
      <div class="col-lg-3 d-none d-lg-block">
        <div class="filter-sidebar">

          <!-- Map preview -->
          <div class="map-preview-thumb mb-3" style="border-radius:20px;height:160px;">
            <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=600&auto=format&fit=crop" alt="Mapa Luanda" style="filter:saturate(.8);">
            <div class="map-overlay-btn">
              <span><i class="bi bi-map"></i> Ver no mapa</span>
            </div>
          </div>

          <!-- Status filter -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-clock me-1" style="color:var(--accent);"></i>Estado</h6>
              <button class="fbox-clear" onclick="clearFilter('status')">Limpar</button>
            </div>
            <div class="fbox-body">
              <div class="fcheck-list">
                <label class="fcheck-item">
                  <div class="fcheck-left"><input type="checkbox" checked> <label>Abertas agora</label></div>
                  <span class="fcheck-count">38</span>
                </label>
                <label class="fcheck-item">
                  <div class="fcheck-left"><input type="checkbox"> <label>Abertas 24h</label></div>
                  <span class="fcheck-count">8</span>
                </label>
                <label class="fcheck-item">
                  <div class="fcheck-left"><input type="checkbox"> <label>Fechadas</label></div>
                  <span class="fcheck-count">12</span>
                </label>
              </div>
            </div>
          </div>

          <!-- Bairro filter -->
          {{-- <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-geo-alt me-1" style="color:var(--accent);"></i>Bairro</h6>
              <button class="fbox-clear" onclick="clearFilter('bairro')">Limpar</button>
            </div>
            <div class="fbox-body">
              <div class="fcheck-list">
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Ingombotas</label></div><span class="fcheck-count">7</span></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Kilamba</label></div><span class="fcheck-count">6</span></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Talatona</label></div><span class="fcheck-count">5</span></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Maianga</label></div><span class="fcheck-count">5</span></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Alvalade</label></div><span class="fcheck-count">4</span></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Benfica</label></div><span class="fcheck-count">3</span></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Viana</label></div><span class="fcheck-count">3</span></label>
              </div>
            </div>
          </div> --}}

          <!-- Avaliação -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-star me-1" style="color:var(--accent);"></i>Avaliação</h6>
              <button class="fbox-clear" onclick="clearFilter('rating')">Limpar</button>
            </div>
            <div class="fbox-body">
              <div class="rating-filter">
                <label class="rf-item"><input type="radio" name="rating"> <div class="rf-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i> <span>5 estrelas</span></div></label>
                <label class="rf-item"><input type="radio" name="rating"> <div class="rf-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i> <span>4+ estrelas</span></div></label>
                <label class="rf-item"><input type="radio" name="rating"> <div class="rf-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i> <span>3+ estrelas</span></div></label>
              </div>
            </div>
          </div>

          <!-- Distância -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-pin-map me-1" style="color:var(--accent);"></i>Distância máx.</h6>
            </div>
            <div class="fbox-body">
              <div class="d-flex justify-content-between mb-2">
                <span style="font-size:.78rem;color:var(--muted);">0 km</span>
                <span class="dist-val" id="distVal">10 km</span>
              </div>
              <input type="range" class="dist-slider" min="1" max="30" value="10" oninput="document.getElementById('distVal').textContent=this.value+' km'">
            </div>
          </div>

          <!-- Especialidades -->
          <div class="fbox">
            <div class="fbox-header">
              <h6><i class="bi bi-capsule me-1" style="color:var(--accent);"></i>Especialidade</h6>
              <button class="fbox-clear" onclick="clearFilter('spec')">Limpar</button>
            </div>
            <div class="fbox-body">
              <div class="fcheck-list">
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Medicamentos gerais</label></div></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Dermatologia</label></div></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Pediatria</label></div></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Cardiovascular</label></div></label>
                <label class="fcheck-item"><div class="fcheck-left"><input type="checkbox"> <label>Ortopedia</label></div></label>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- MAIN -->
      <div class="col-lg-9">

        <!-- Featured / Destaque -->
        <div class="featured-section">
          <h6><i class="bi bi-lightning-charge-fill" style="color:#f59e0b;"></i> Farmácias em destaque</h6>
          <div class="featured-scroll">
            <div class="feat-card" onclick="openModal('central')">
              <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=88&auto=format&fit=crop" class="feat-img" alt="">
              <div><div class="feat-name">Farmácia Central</div><div class="feat-meta">Ingombotas · 4.9★ <span class="feat-badge">Patrocinado</span></div></div>
            </div>
            <div class="feat-card" onclick="openModal('kilamba')">
              <img src="https://images.unsplash.com/photo-1576671081837-49000212a370?w=88&auto=format&fit=crop" class="feat-img" alt="">
              <div><div class="feat-name">Farmácia Kilamba</div><div class="feat-meta">Kilamba · 4.7★ <span class="feat-badge">Popular</span></div></div>
            </div>
            <div class="feat-card" onclick="openModal('talatona')">
              <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=88&auto=format&fit=crop" class="feat-img" alt="">
              <div><div class="feat-name">Farmácia Talatona</div><div class="feat-meta">Talatona · 4.9★ <span class="feat-badge">Top rated</span></div></div>
            </div>
            <div class="feat-card">
              <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?w=88&auto=format&fit=crop" class="feat-img" alt="">
              <div><div class="feat-name">FarmaMaianga</div><div class="feat-meta">Maianga · 4.5★ <span class="feat-badge">24h</span></div></div>
            </div>
            <div class="feat-card">
              <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=88&auto=format&fit=crop" class="feat-img" alt="">
              <div><div class="feat-name">Farmácia Benfica</div><div class="feat-meta">Benfica · 4.6★ <span class="feat-badge">Novo</span></div></div>
            </div>
          </div>
        </div>

        <!-- Toolbar -->
        <div class="results-toolbar">
          <span class="results-count">Mostrando <strong id="countVisible">6</strong> de <strong>50</strong> farmácias</span>
          <select class="sort-sel" onchange="sortPharmacies(this.value)">
            <option value="relevance">Relevância</option>
            <option value="rating">Melhor avaliação</option>
            <option value="distance">Mais próximas</option>
            <option value="delivery">Entrega mais rápida</option>
          </select>
          <div class="view-toggle ms-auto">
            <button class="vt-btn active" id="gridBtn" onclick="setView('grid')" title="Grelha"><i class="bi bi-grid"></i></button>
            <button class="vt-btn" id="listBtn" onclick="setView('list')" title="Lista"><i class="bi bi-list-ul"></i></button>
          </div>
        </div>

        <!-- GRID VIEW -->
        <div class="row g-4" id="gridContainer">

          <!-- Card 1 -->
          <div class="col-md-6 col-xl-4 ph-grid-item" data-name="farmácia central" data-bairro="ingombotas" data-status="open" data-fav="false">
            <div class="ph-card">
              <div class="ph-img-wrap">
                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=500&auto=format&fit=crop" alt="">
                <div class="ph-img-overlay"></div>
                <div class="ph-badge-top">
                  <span class="ph-badge ph-open"><i class="bi bi-circle-fill" style="font-size:.45rem;"></i> Aberta</span>
                </div>
                <button class="ph-fav-btn" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
                <div class="ph-dist"><i class="bi bi-geo-alt"></i> 1.2 km</div>
              </div>
              <div class="ph-body">
                <div class="ph-name">Farmácia Central</div>
                <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i> Ingombotas, Rua Ho Chi Min</div>
                <div class="ph-meta">
                  <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.9 <span class="ph-reviews">(312)</span></div>
                  <span class="ph-tag"><i class="bi bi-truck"></i> 25 min</span>
                  <span class="ph-tag">Entrega 800 Kz</span>
                </div>
                <div class="ph-specs">
                  <span class="ph-spec">Geral</span><span class="ph-spec">Derma</span><span class="ph-spec">Pediátrico</span>
                </div>
                <div class="ph-delivery"><i class="bi bi-clock"></i> Seg-Dom: <strong>08h00 — 22h00</strong></div>
                <div class="ph-actions">
                  <button class="ph-btn ph-view" onclick="openModal('central')"><i class="bi bi-eye"></i> Ver</button>
                  {{-- <button class="ph-btn ph-order"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col-md-6 col-xl-4 ph-grid-item" data-name="farmácia kilamba" data-bairro="kilamba" data-status="open" data-fav="false">
            <div class="ph-card">
              <div class="ph-img-wrap">
                <img src="https://images.unsplash.com/photo-1576671081837-49000212a370?w=500&auto=format&fit=crop" alt="">
                <div class="ph-img-overlay"></div>
                <div class="ph-badge-top">
                  <span class="ph-badge ph-open"><i class="bi bi-circle-fill" style="font-size:.45rem;"></i> Aberta</span>
                  <span class="ph-badge ph-24h">24h</span>
                </div>
                <button class="ph-fav-btn active" onclick="toggleFav(this)"><i class="bi bi-heart-fill"></i></button>
                <div class="ph-dist"><i class="bi bi-geo-alt"></i> 3.8 km</div>
              </div>
              <div class="ph-body">
                <div class="ph-name">Farmácia Kilamba</div>
                <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i> Kilamba, Rua dos Combates</div>
                <div class="ph-meta">
                  <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.7 <span class="ph-reviews">(198)</span></div>
                  <span class="ph-tag"><i class="bi bi-truck"></i> 30 min</span>
                  <span class="ph-tag">Entrega 1 000 Kz</span>
                </div>
                <div class="ph-specs">
                  <span class="ph-spec">Geral</span><span class="ph-spec">Cardiovascular</span>
                </div>
                <div class="ph-delivery"><i class="bi bi-clock"></i> <strong>Aberta 24 horas</strong></div>
                <div class="ph-actions">
                  <button class="ph-btn ph-view" onclick="openModal('kilamba')"><i class="bi bi-eye"></i> Ver</button>
                  {{-- <button class="ph-btn ph-order"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col-md-6 col-xl-4 ph-grid-item" data-name="farmácia talatona" data-bairro="talatona" data-status="open" data-fav="false">
            <div class="ph-card">
              <div class="ph-img-wrap">
                <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=500&auto=format&fit=crop" alt="">
                <div class="ph-img-overlay"></div>
                <div class="ph-badge-top">
                  <span class="ph-badge ph-open"><i class="bi bi-circle-fill" style="font-size:.45rem;"></i> Aberta</span>
                </div>
                <button class="ph-fav-btn" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
                <div class="ph-dist"><i class="bi bi-geo-alt"></i> 7.1 km</div>
              </div>
              <div class="ph-body">
                <div class="ph-name">Farmácia Talatona</div>
                <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i> Talatona, Belas Shopping</div>
                <div class="ph-meta">
                  <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.9 <span class="ph-reviews">(421)</span></div>
                  <span class="ph-tag"><i class="bi bi-truck"></i> 35 min</span>
                  <span class="ph-tag">Entrega 1 200 Kz</span>
                </div>
                <div class="ph-specs">
                  <span class="ph-spec">Geral</span><span class="ph-spec">Ortopedia</span><span class="ph-spec">Derma</span>
                </div>
                <div class="ph-delivery"><i class="bi bi-clock"></i> Seg-Dom: <strong>08h00 — 23h00</strong></div>
                <div class="ph-actions">
                  <button class="ph-btn ph-view" onclick="openModal('talatona')"><i class="bi bi-eye"></i> Ver</button>
                  {{-- <button class="ph-btn ph-order"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="col-md-6 col-xl-4 ph-grid-item" data-name="farma maianga" data-bairro="maianga" data-status="24h" data-fav="false">
            <div class="ph-card">
              <div class="ph-img-wrap">
                <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?w=500&auto=format&fit=crop" alt="">
                <div class="ph-img-overlay"></div>
                <div class="ph-badge-top">
                  <span class="ph-badge ph-open"><i class="bi bi-circle-fill" style="font-size:.45rem;"></i> Aberta</span>
                  <span class="ph-badge ph-24h">24h</span>
                </div>
                <button class="ph-fav-btn" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
                <div class="ph-dist"><i class="bi bi-geo-alt"></i> 2.5 km</div>
              </div>
              <div class="ph-body">
                <div class="ph-name">FarmaMaianga</div>
                <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i> Maianga, Av. 4 de Fevereiro</div>
                <div class="ph-meta">
                  <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.5 <span class="ph-reviews">(156)</span></div>
                  <span class="ph-tag"><i class="bi bi-truck"></i> 28 min</span>
                  <span class="ph-tag">Entrega 900 Kz</span>
                </div>
                <div class="ph-specs">
                  <span class="ph-spec">Geral</span><span class="ph-spec">Pediatria</span>
                </div>
                <div class="ph-delivery"><i class="bi bi-clock"></i> <strong>Aberta 24 horas</strong></div>
                <div class="ph-actions">
                  <button class="ph-btn ph-view"><i class="bi bi-eye"></i> Ver</button>
                  {{-- <button class="ph-btn ph-order"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- Card 5 -->
          <div class="col-md-6 col-xl-4 ph-grid-item" data-name="farmácia benfica" data-bairro="benfica" data-status="open" data-new="true" data-fav="false">
            <div class="ph-card">
              <div class="ph-img-wrap">
                <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=500&auto=format&fit=crop" alt="">
                <div class="ph-img-overlay"></div>
                <div class="ph-badge-top">
                  <span class="ph-badge ph-open"><i class="bi bi-circle-fill" style="font-size:.45rem;"></i> Aberta</span>
                  <span class="ph-badge ph-new">Novo</span>
                </div>
                <button class="ph-fav-btn" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
                <div class="ph-dist"><i class="bi bi-geo-alt"></i> 5.3 km</div>
              </div>
              <div class="ph-body">
                <div class="ph-name">Farmácia Benfica</div>
                <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i> Benfica, Estrada de Catete</div>
                <div class="ph-meta">
                  <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.6 <span class="ph-reviews">(43)</span></div>
                  <span class="ph-tag"><i class="bi bi-truck"></i> 40 min</span>
                  <span class="ph-tag">Entrega 1 000 Kz</span>
                </div>
                <div class="ph-specs">
                  <span class="ph-spec">Geral</span><span class="ph-spec">Cardiovascular</span>
                </div>
                <div class="ph-delivery"><i class="bi bi-clock"></i> Seg-Sáb: <strong>08h00 — 21h00</strong></div>
                <div class="ph-actions">
                  <button class="ph-btn ph-view"><i class="bi bi-eye"></i> Ver</button>
                  {{-- <button class="ph-btn ph-order"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- Card 6 -->
          <div class="col-md-6 col-xl-4 ph-grid-item" data-name="farmácia viana" data-bairro="viana" data-status="closed" data-fav="false">
            <div class="ph-card">
              <div class="ph-img-wrap">
                <img src="https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=500&auto=format&fit=crop" alt="">
                <div class="ph-img-overlay"></div>
                <div class="ph-badge-top">
                  {{-- <span class="ph-badge ph-closed"><i class="bi bi-circle-fill" style="font-size:.45rem;"></i> Fechada</span> --}}
                </div>
                <button class="ph-fav-btn" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
                <div class="ph-dist"><i class="bi bi-geo-alt"></i> 12.4 km</div>
              </div>
              <div class="ph-body">
                <div class="ph-name">Farmácia Viana</div>
                <div class="ph-loc"><i class="bi bi-geo-alt-fill"></i> Viana, Centralidade do Kilamba</div>
                <div class="ph-meta">
                  <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.4 <span class="ph-reviews">(89)</span></div>
                  <span class="ph-tag"><i class="bi bi-truck"></i> 50 min</span>
                  <span class="ph-tag">Entrega 1 500 Kz</span>
                </div>
                <div class="ph-specs">
                  <span class="ph-spec">Geral</span><span class="ph-spec">Ortopedia</span>
                </div>
                <div class="ph-delivery"><i class="bi bi-clock"></i> Abre amanhã: <strong>08h00</strong></div>
                <div class="ph-actions">
                  <button class="ph-btn ph-view"><i class="bi bi-eye"></i> Ver</button>
                  {{-- <button class="ph-btn ph-order" style="opacity:.5;cursor:not-allowed;" disabled><i class="bi bi-bag-plus"></i> Fechada</button> --}}
                </div>
              </div>
            </div>
          </div>

        </div><!-- /gridContainer -->

        <!-- LIST VIEW items (mirrored) -->
        <div id="listContainer">
          <div class="ph-list-card" data-name="farmácia central" data-bairro="ingombotas" data-status="open">
            <div class="ph-list-img"><img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=320&auto=format&fit=crop" alt=""></div>
            <div class="ph-list-body">
              <div class="d-flex align-items-start gap-2 mb-1 flex-wrap">
                <span style="font-size:1rem;font-weight:800;color:var(--heading);">Farmácia Central</span>
                <span class="ph-badge ph-open" style="font-size:.68rem;padding:.18rem .6rem;border-radius:50px;background:#d4edda;color:#155724;border:none;"><i class="bi bi-circle-fill" style="font-size:.4rem;"></i> Aberta</span>
              </div>
              <div class="ph-loc mb-1"><i class="bi bi-geo-alt-fill"></i> Ingombotas, Rua Ho Chi Min · 1.2 km</div>
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.9 <span class="ph-reviews">(312)</span></div>
                <span class="ph-tag"><i class="bi bi-truck"></i> 25 min</span>
                <span class="ph-spec">Geral</span><span class="ph-spec">Derma</span>
              </div>
            </div>
            <div class="ph-list-actions">
              <button class="ph-btn ph-view" style="width:100%;" onclick="openModal('central')"><i class="bi bi-eye"></i> Ver</button>
              {{-- <button class="ph-btn ph-order" style="width:100%;"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
            </div>
          </div>

          <div class="ph-list-card" data-name="farmácia kilamba" data-bairro="kilamba" data-status="open">
            <div class="ph-list-img"><img src="https://images.unsplash.com/photo-1576671081837-49000212a370?w=320&auto=format&fit=crop" alt=""></div>
            <div class="ph-list-body">
              <div class="d-flex align-items-start gap-2 mb-1 flex-wrap">
                <span style="font-size:1rem;font-weight:800;color:var(--heading);">Farmácia Kilamba</span>
                <span class="ph-badge ph-open" style="font-size:.68rem;padding:.18rem .6rem;border-radius:50px;background:#d4edda;color:#155724;border:none;"><i class="bi bi-circle-fill" style="font-size:.4rem;"></i> Aberta 24h</span>
              </div>
              <div class="ph-loc mb-1"><i class="bi bi-geo-alt-fill"></i> Kilamba, Rua dos Combates · 3.8 km</div>
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.7 <span class="ph-reviews">(198)</span></div>
                <span class="ph-tag"><i class="bi bi-truck"></i> 30 min</span>
                <span class="ph-spec">Geral</span><span class="ph-spec">Cardiovascular</span>
              </div>
            </div>
            <div class="ph-list-actions">
              <button class="ph-btn ph-view" style="width:100%;" onclick="openModal('kilamba')"><i class="bi bi-eye"></i> Ver</button>
              {{-- <button class="ph-btn ph-order" style="width:100%;"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
            </div>
          </div>

          <div class="ph-list-card" data-name="farmácia talatona" data-bairro="talatona" data-status="open">
            <div class="ph-list-img"><img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=320&auto=format&fit=crop" alt=""></div>
            <div class="ph-list-body">
              <div class="d-flex align-items-start gap-2 mb-1 flex-wrap">
                <span style="font-size:1rem;font-weight:800;color:var(--heading);">Farmácia Talatona</span>
                <span class="ph-badge ph-open" style="font-size:.68rem;padding:.18rem .6rem;border-radius:50px;background:#d4edda;color:#155724;border:none;"><i class="bi bi-circle-fill" style="font-size:.4rem;"></i> Aberta</span>
              </div>
              <div class="ph-loc mb-1"><i class="bi bi-geo-alt-fill"></i> Talatona, Belas Shopping · 7.1 km</div>
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="ph-rating"><i class="bi bi-star-fill"></i> 4.9 <span class="ph-reviews">(421)</span></div>
                <span class="ph-tag"><i class="bi bi-truck"></i> 35 min</span>
                <span class="ph-spec">Geral</span><span class="ph-spec">Ortopedia</span>
              </div>
            </div>
            <div class="ph-list-actions">
              <button class="ph-btn ph-view" style="width:100%;" onclick="openModal('talatona')"><i class="bi bi-eye"></i> Ver</button>
              {{-- <button class="ph-btn ph-order" style="width:100%;"><i class="bi bi-bag-plus"></i> Pedir</button> --}}
            </div>
          </div>
        </div>

        <!-- Empty state -->
        <div class="empty-ph" id="emptyState">
          <i class="bi bi-hospital"></i>
          <h5>Nenhuma farmácia encontrada</h5>
          <p>Tente ajustar os filtros ou pesquisar por outro bairro.</p>
          <button class="ph-btn ph-order" style="display:inline-flex;max-width:180px;" onclick="resetAll()">Ver todas as farmácias</button>
        </div>

        <!-- Pagination -->
        <div class="pagination-fc" id="paginationBar">
          <button class="pg-btn" disabled><i class="bi bi-chevron-left"></i></button>
          <button class="pg-btn active">1</button>
          <button class="pg-btn">2</button>
          <button class="pg-btn">3</button>
          <button class="pg-btn">4</button>
          <button class="pg-btn">5</button>
          <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div><!-- /col-lg-9 -->
    </div>
  </div>
</div>

<!-- ===== MODAL FARMÁCIA DETAIL ===== -->
<div class="modal fade" id="pharmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-ph-banner">
        <img id="modalImg" src="" alt="">
      </div>
      <div class="modal-header">
        <div>
          <h5 class="modal-title" id="modalName" style="font-weight:800;color:var(--heading);margin:0;"></h5>
          <div id="modalLoc" style="font-size:.82rem;color:var(--muted);margin-top:.1rem;"></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-md-6">
            <h6 style="font-size:.8rem;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.8rem;">Informações</h6>
            <div class="info-row"><i class="bi bi-geo-alt-fill"></i> <span id="mAddr"></span></div>
            <div class="info-row"><i class="bi bi-telephone-fill"></i> <span id="mPhone"></span></div>
            <div class="info-row"><i class="bi bi-envelope-fill"></i> <span id="mEmail"></span></div>
            <div class="info-row"><i class="bi bi-star-fill" style="color:#f59e0b;"></i> <span id="mRating"></span></div>
            <div class="info-row"><i class="bi bi-truck"></i> <span id="mDelivery"></span></div>
            <div class="info-row"><i class="bi bi-credit-card"></i> <span>Multicaixa Express · Cartão · Numerário</span></div>
          </div>
          <div class="col-md-6">
            <h6 style="font-size:.8rem;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.8rem;">Horário de funcionamento</h6>
            <table class="hours-table" id="mHours"></table>
          </div>
        </div>
      </div>
      <div class="modal-footer gap-2">
        {{-- <button type="button" class="btn-close-fc" data-bs-dismiss="modal" style="background:var(--soft);color:var(--accent);border:none;border-radius:50px;padding:.5rem 1.2rem;font-size:.85rem;font-weight:700;cursor:pointer;">Fechar</button> --}}
        <button class="ph-btn ph-order" style="max-width:180px;display:inline-flex;" data-bs-dismiss="modal" onclick="showToast('Farmácia seleccionada!','Escolha os seus medicamentos.')"><i class="bi bi-bag-plus"></i> Fazer pedido</button>
      </div>
    </div>
  </div>
</div>

<!-- ===== FOOTER ===== -->
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

<!-- Toast -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle">Sucesso</strong><span id="toastMsg"></span></div>
</div>
<a href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

  /* ===== DATA ===== */
  const pharmData = {
    central: {
      name: 'Farmácia Central',
      loc: 'Ingombotas, Rua Ho Chi Min',
      img: 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=900&auto=format&fit=crop',
      addr: 'Rua Ho Chi Min, Nº 12, Ingombotas, Luanda',
      phone: '+244 222 345 678',
      email: 'central@farmaciasluanda.ao',
      rating: '4.9 ★ (312 avaliações)',
      delivery: 'Entrega em ~25 min · Taxa 800 Kz · Grátis acima 10 000 Kz',
      hours: [
        ['Segunda','08h00 — 22h00',false],['Terça','08h00 — 22h00',false],
        ['Quarta','08h00 — 22h00',false],['Quinta','08h00 — 22h00',false],
        ['Sexta','08h00 — 22h00',false],['Sábado','09h00 — 20h00',false],
        ['Domingo','10h00 — 18h00',true],
      ]
    },
    kilamba: {
      name: 'Farmácia Kilamba',
      loc: 'Kilamba, Rua dos Combates',
      img: 'https://images.unsplash.com/photo-1576671081837-49000212a370?w=900&auto=format&fit=crop',
      addr: 'Rua dos Combates, Bloco 14, Kilamba, Luanda',
      phone: '+244 222 456 789',
      email: 'kilamba@farmaciasluanda.ao',
      rating: '4.7 ★ (198 avaliações)',
      delivery: 'Entrega em ~30 min · Taxa 1 000 Kz · Aberta 24 horas',
      hours: [
        ['Segunda','24 horas',false],['Terça','24 horas',false],
        ['Quarta','24 horas',false],['Quinta','24 horas',false],
        ['Sexta','24 horas',false],['Sábado','24 horas',false],
        ['Domingo','24 horas',true],
      ]
    },
    talatona: {
      name: 'Farmácia Talatona',
      loc: 'Talatona, Belas Shopping',
      img: 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=900&auto=format&fit=crop',
      addr: 'Belas Shopping, Loja 34, Talatona, Luanda',
      phone: '+244 222 567 890',
      email: 'talatona@farmaciasluanda.ao',
      rating: '4.9 ★ (421 avaliações)',
      delivery: 'Entrega em ~35 min · Taxa 1 200 Kz · Grátis acima 15 000 Kz',
      hours: [
        ['Segunda','08h00 — 23h00',false],['Terça','08h00 — 23h00',false],
        ['Quarta','08h00 — 23h00',false],['Quinta','08h00 — 23h00',false],
        ['Sexta','08h00 — 23h00',false],['Sábado','09h00 — 23h00',false],
        ['Domingo','10h00 — 22h00',true],
      ]
    }
  };

  /* ===== MODAL ===== */
  function openModal(key) {
    const d = pharmData[key]; if (!d) return;
    document.getElementById('modalImg').src    = d.img;
    document.getElementById('modalName').textContent = d.name;
    document.getElementById('modalLoc').textContent  = d.loc;
    document.getElementById('mAddr').textContent     = d.addr;
    document.getElementById('mPhone').textContent    = d.phone;
    document.getElementById('mEmail').textContent    = d.email;
    document.getElementById('mRating').textContent   = d.rating;
    document.getElementById('mDelivery').textContent = d.delivery;
    const today = new Date().getDay(); // 0=Sun
    const dayMap = [6,0,1,2,3,4,5]; // Sun=6
    document.getElementById('mHours').innerHTML = d.hours.map((h, i) => `
      <tr class="${dayMap[today]===i?'today':''}">
        <td>${h[0]}</td><td>${h[1]}${dayMap[today]===i?' <strong style="color:var(--accent);">(hoje)</strong>':''}</td>
      </tr>`).join('');
    new bootstrap.Modal(document.getElementById('pharmModal')).show();
  }

  /* ===== VIEW TOGGLE ===== */
  function setView(mode) {
    document.body.className = mode + '-mode';
    document.getElementById('gridBtn').classList.toggle('active', mode === 'grid');
    document.getElementById('listBtn').classList.toggle('active', mode === 'list');
  }

  /* ===== FILTER ===== */
  function filterPharmacies() {
    const q      = document.getElementById('searchPharm').value.toLowerCase();
    const bairro = document.getElementById('filterBairro').value;
    const status = document.getElementById('filterStatus').value;
    let visible  = 0;

    // Grid
    document.querySelectorAll('.ph-grid-item').forEach(el => {
      const nm = el.dataset.name || '';
      const br = el.dataset.bairro || '';
      const st = el.dataset.status || '';
      const matchQ = !q || nm.includes(q);
      const matchB = !bairro || br === bairro;
      const matchS = !status || st === status || (status === 'open' && st !== 'closed') || (status === '24h' && st === '24h');
      el.style.display = (matchQ && matchB && matchS) ? 'block' : 'none';
      if (matchQ && matchB && matchS) visible++;
    });

    // List
    document.querySelectorAll('.ph-list-card').forEach(el => {
      const nm = el.dataset.name || '';
      const br = el.dataset.bairro || '';
      const st = el.dataset.status || '';
      const matchQ = !q || nm.includes(q);
      const matchB = !bairro || br === bairro;
      const matchS = !status || st === status || (status === 'open' && st !== 'closed');
      el.style.display = (matchQ && matchB && matchS) ? 'flex' : 'none';
    });

    document.getElementById('countVisible').textContent = visible;
    document.getElementById('emptyState').style.display  = visible === 0 ? 'block' : 'none';
    document.getElementById('paginationBar').style.display = visible === 0 ? 'none' : 'flex';
  }

  /* ===== QUICK FILTER ===== */
  function quickFilter(el, val) {
    document.querySelectorAll('.qf-tag').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('filterStatus').value = val;
    filterPharmacies();
  }

  /* ===== SORT ===== */
  function sortPharmacies(val) {
    showToast('Ordenação actualizada', 'Os resultados foram reorganizados.');
  }

  /* ===== FAVOURITE ===== */
  function toggleFav(btn) {
    const active = btn.classList.toggle('active');
    btn.innerHTML = active ? '<i class="bi bi-heart-fill"></i>' : '<i class="bi bi-heart"></i>';
    showToast(active ? '❤️ Adicionado aos favoritos' : 'Removido dos favoritos', '');
  }

  /* ===== CLEAR FILTER ===== */
  function clearFilter(type) {
    document.querySelectorAll(`#filter-sidebar input[type=checkbox]`).forEach(c => c.checked = false);
    filterPharmacies();
  }

  function resetAll() {
    document.getElementById('searchPharm').value = '';
    document.getElementById('filterBairro').value = '';
    document.getElementById('filterStatus').value = '';
    document.querySelectorAll('.qf-tag').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.qf-tag')[0]?.classList.add('active');
    filterPharmacies();
  }

  /* ===== HEADER SCROLL ===== */
  const hdr = document.getElementById('mainHeader');
  window.addEventListener('scroll', () => hdr.classList.toggle('scrolled', scrollY > 50));
  const st  = document.getElementById('scroll-top');
  window.addEventListener('scroll', () => st.style.display = scrollY > 320 ? 'flex' : 'none');

  /* ===== TOAST ===== */
  function showToast(title, msg) {
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMsg').textContent   = msg;
    const t = document.getElementById('toastFc');
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3200);
  }

  /* ===== PAGINATION ===== */
  document.querySelectorAll('.pg-btn').forEach(btn => {
    if (!btn.querySelector('i')) {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.pg-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        window.scrollTo({ top:0, behavior:'smooth' });
      });
    }
  });

  /* ===== ANIMATE ON SCROLL ===== */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.style.opacity='1'; e.target.style.transform='translateY(0)'; } });
  }, { threshold:.1 });
  document.querySelectorAll('.ph-card, .ph-list-card').forEach(el => {
    el.style.opacity = '0'; el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity .5s ease, transform .5s ease';
    io.observe(el);
  });

</script>
</body>
</html>