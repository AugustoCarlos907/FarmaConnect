<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'></text></svg>">
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
    body { font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; background:#f4f8f8; color:var(--text); overflow-x:hidden; }

    /* ===== HEADER ===== */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; position:sticky; top:0; z-index:1000; transition:box-shadow .3s; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }
    .header-search { flex:1; max-width:560px; }
    .header-search .ig { border:1.5px solid var(--border); border-radius:50px; background:#f6fbfb; overflow:hidden; display:flex; align-items:center; transition:border-color .2s,box-shadow .2s; }
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
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ===== PAGE TOPBAR ===== */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:2.5rem 0 5rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:320px;height:320px;background:#fff;opacity:.08;top:-120px;right:-60px; }
    .tb2 { width:220px;height:220px;background:#a8ffd4;opacity:.06;bottom:-80px;left:8%; }
    .topbar-inner { position:relative; z-index:2; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.9rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .page-topbar p  { color:rgba(255,255,255,.68); font-size:.92rem; margin-top:.3rem; }

    /* ===== SEARCH BAR IN HERO ===== */
    .hero-search { margin-top:1.8rem; }
    .hs-box { background:#fff; border-radius:20px; box-shadow:0 20px 50px rgba(0,0,0,.18); padding:1rem 1.2rem; display:flex; align-items:center; gap:.8rem; flex-wrap:wrap; max-width:760px; }
    .hs-field { flex:1; min-width:160px; position:relative; }
    .hs-field i { position:absolute; left:.95rem; top:50%; transform:translateY(-50%); color:var(--accent); font-size:.95rem; pointer-events:none; }
    .hs-field input, .hs-field select { width:100%; border:1.5px solid var(--border); border-radius:50px; padding:.65rem 1rem .65rem 2.55rem; font-size:.9rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; transition:border-color .2s; }
    .hs-field input:focus, .hs-field select:focus { border-color:var(--accent); }
    .hs-sep { width:1px; height:36px; background:var(--border); flex-shrink:0; }
    .hs-btn { background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.68rem 1.7rem; font-size:.92rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.45rem; transition:all .25s; white-space:nowrap; }
    .hs-btn:hover { background:var(--accent-dark); transform:scale(1.03); }

    /* Quick tags */
    .hero-tags { display:flex; gap:.45rem; flex-wrap:wrap; margin-top:.9rem; }
    .htag { background:rgba(255,255,255,.15); color:#fff; border:1px solid rgba(255,255,255,.28); padding:.25rem .8rem; border-radius:50px; font-size:.75rem; font-weight:600; cursor:pointer; transition:background .2s; backdrop-filter:blur(8px); }
    .htag:hover, .htag.active { background:#fff; color:var(--accent); }

    /* ===== MAIN WRAP ===== */
    .main-wrap { margin-top:-2.8rem; padding-bottom:5rem; }

    /* ===== SIDEBAR ===== */
    .sidebar { position:sticky; top:80px; }
    .sbox { background:#fff; border-radius:20px; box-shadow:var(--shadow); margin-bottom:1rem; overflow:hidden; }
    .sbox-head { padding:.9rem 1.2rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .sbox-head h6 { font-size:.8rem; font-weight:800; color:var(--heading); margin:0; text-transform:uppercase; letter-spacing:.06em; display:flex; align-items:center; gap:.45rem; }
    .sbox-head h6 i { color:var(--accent); }
    .sbox-clear { font-size:.74rem; color:var(--accent); cursor:pointer; font-weight:600; background:none; border:none; font-family:inherit; }
    .sbox-body { padding:1rem 1.2rem; }

    /* Category nav in sidebar */
    .cat-nav { display:flex; flex-direction:column; gap:.2rem; }
    .cat-nav-item { display:flex; align-items:center; gap:.7rem; padding:.55rem .7rem; border-radius:12px; cursor:pointer; transition:background .2s; text-decoration:none; color:var(--text); }
    .cat-nav-item:hover, .cat-nav-item.active { background:var(--soft); color:var(--accent); }
    .cat-nav-item .icon { width:32px; height:32px; border-radius:9px; background:var(--mint); display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; transition:background .2s; }
    .cat-nav-item:hover .icon, .cat-nav-item.active .icon { background:var(--accent); color:#fff; }
    .cat-nav-item .label { font-size:.85rem; font-weight:600; flex:1; }
    .cat-nav-item .cnt { font-size:.72rem; background:var(--mint); color:var(--accent); padding:.1rem .5rem; border-radius:50px; font-weight:700; }
    .cat-nav-item.active .cnt { background:rgba(9,154,167,.2); }

    /* Price filter */
    .price-range { display:flex; flex-direction:column; gap:.6rem; }
    .price-inputs { display:flex; gap:.5rem; align-items:center; }
    .price-input { flex:1; border:1.5px solid var(--border); border-radius:10px; padding:.45rem .7rem; font-size:.85rem; font-family:inherit; color:var(--heading); outline:none; transition:border-color .2s; }
    .price-input:focus { border-color:var(--accent); }
    .price-sep { color:var(--muted); font-size:.85rem; flex-shrink:0; }
    .price-slider { width:100%; accent-color:var(--accent); }

    /* Check list */
    .check-list { display:flex; flex-direction:column; gap:.35rem; }
    .check-item { display:flex; align-items:center; gap:.6rem; cursor:pointer; padding:.25rem 0; }
    .check-item input[type=checkbox] { width:15px; height:15px; accent-color:var(--accent); cursor:pointer; flex-shrink:0; }
    .check-item label { font-size:.86rem; color:var(--text); cursor:pointer; }

    /* Rating filter */
    .rating-list { display:flex; flex-direction:column; gap:.35rem; }
    .rating-item { display:flex; align-items:center; gap:.5rem; cursor:pointer; padding:.2rem 0; }
    .rating-item input { width:15px; height:15px; accent-color:var(--accent); }
    .ri-stars i { color:#f59e0b; font-size:.82rem; }
    .ri-stars span { font-size:.78rem; color:var(--muted); }

    /* ===== CONTENT AREA ===== */

    /* Toolbar */
    .toolbar { background:#fff; border-radius:18px; box-shadow:var(--shadow); padding:.85rem 1.3rem; margin-bottom:1.2rem; display:flex; align-items:center; gap:.85rem; flex-wrap:wrap; }
    .result-count { font-size:.88rem; color:var(--muted); }
    .result-count strong { color:var(--heading); font-weight:700; }
    .sort-select { border:1.5px solid var(--border); border-radius:50px; padding:.4rem 1rem; font-size:.84rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; cursor:pointer; }
    .view-toggle { display:flex; gap:.3rem; margin-left:auto; }
    .vt-btn { width:34px; height:34px; border-radius:10px; border:1.5px solid var(--border); background:#fff; color:var(--muted); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.9rem; transition:all .2s; }
    .vt-btn.active, .vt-btn:hover { background:var(--accent); color:#fff; border-color:var(--accent); }

    /* ===== CATEGORY SECTION ===== */
    .cat-section { margin-bottom:2.5rem; }
    .cat-section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.2rem; }
    .cat-label { display:flex; align-items:center; gap:.75rem; }
    .cat-icon-big { width:46px; height:46px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0; }
    .cat-title { font-size:1.15rem; font-weight:800; color:var(--heading); letter-spacing:-.01em; }
    .cat-sub   { font-size:.78rem; color:var(--muted); margin-top:.05rem; }
    .cat-see-all { font-size:.82rem; font-weight:700; color:var(--accent); text-decoration:none; display:flex; align-items:center; gap:.35rem; transition:gap .2s; }
    .cat-see-all:hover { gap:.6rem; color:var(--accent-dark); }
    .cat-divider { width:100%; height:2px; border-radius:99px; margin-bottom:1.2rem; }

    /* Products grid */
    .prod-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:1rem; }
    .prod-grid.list-mode { grid-template-columns:1fr; }

    /* ===== PRODUCT CARD ===== */
    .prod-card { background:#fff; border-radius:18px; box-shadow:var(--shadow); overflow:hidden; border:1.5px solid transparent; transition:all .28s; display:flex; flex-direction:column; position:relative; }
    .prod-card:hover { border-color:var(--accent); box-shadow:0 16px 44px rgba(9,154,167,.14); transform:translateY(-5px); }

    /* Badges */
    .prod-badges { position:absolute; top:10px; left:10px; display:flex; flex-direction:column; gap:.3rem; z-index:2; }
    .pbadge { font-size:.68rem; font-weight:700; padding:.22rem .65rem; border-radius:50px; }
    .pbadge-discount { background:#ef4444; color:#fff; }
    .pbadge-new      { background:#f59e0b; color:#fff; }
    .pbadge-low      { background:#f97316; color:#fff; }
    .pbadge-presc    { background:#7c3aed; color:#fff; }

    /* Fav button */
    .prod-fav { position:absolute; top:10px; right:10px; width:30px; height:30px; background:rgba(255,255,255,.88); backdrop-filter:blur(8px); border-radius:50%; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.88rem; color:#b0c4c6; transition:all .2s; z-index:2; }
    .prod-fav:hover, .prod-fav.active { color:#ef4444; transform:scale(1.15); }

    /* Image */
    .prod-img { height:150px; background:var(--mint); display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0; }
    .prod-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .prod-card:hover .prod-img img { transform:scale(1.06); }
    .prod-img-placeholder { font-size:3rem; opacity:.35; }

    /* Body */
    .prod-body { padding:1rem; flex:1; display:flex; flex-direction:column; gap:.4rem; }
    .prod-cat  { font-size:.68rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.05em; }
    .prod-name { font-size:.92rem; font-weight:700; color:var(--heading); line-height:1.3; }
    .prod-pharm { font-size:.75rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; }
    .prod-rating { display:flex; align-items:center; gap:.3rem; font-size:.75rem; }
    .prod-rating i { color:#f59e0b; font-size:.8rem; }
    .prod-rating .cnt { color:var(--muted); font-weight:400; }

    /* Price */
    .prod-price-row { display:flex; align-items:center; gap:.5rem; margin-top:auto; padding-top:.3rem; }
    .prod-price { font-size:1.05rem; font-weight:800; color:var(--heading); }
    .prod-price-old { font-size:.78rem; color:var(--muted); text-decoration:line-through; }
    .prod-unit { font-size:.72rem; color:var(--muted); }

    /* Stock indicator */
    .prod-stock { font-size:.72rem; display:flex; align-items:center; gap:.3rem; }
    .stock-dot { width:6px; height:6px; border-radius:50%; flex-shrink:0; }
    .stock-ok  { background:#22c55e; }
    .stock-low { background:#f97316; }
    .stock-out { background:#ef4444; }

    /* Add button */
    .prod-add-btn { width:100%; padding:.52rem; background:var(--accent); color:#fff; border:none; border-radius:12px; font-size:.84rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.4rem; transition:all .25s; margin-top:.5rem; }
    .prod-add-btn:hover { background:var(--accent-dark); }
    .prod-add-btn:disabled { background:#c8e6e8; cursor:not-allowed; }
    .prod-add-btn.added { background:#22c55e; }

    /* LIST MODE card */
    .prod-card.list-card { flex-direction:row; border-radius:16px; }
    .prod-card.list-card .prod-img { width:120px; height:auto; min-height:110px; flex-shrink:0; border-radius:0; }
    .prod-card.list-card .prod-body { padding:.9rem 1rem; }
    .prod-card.list-card .prod-add-btn { width:auto; padding:.44rem 1.1rem; margin-top:0; }
    .prod-card.list-card .prod-price-row { flex-wrap:wrap; }
    .prod-card.list-card .prod-actions-row { display:flex; align-items:center; gap:.6rem; margin-top:.4rem; flex-wrap:wrap; }

    /* ===== CATEGORY PILLS strip ===== */
    .cat-pills { display:flex; gap:.5rem; overflow-x:auto; padding-bottom:.5rem; scrollbar-width:none; margin-bottom:1.4rem; }
    .cat-pills::-webkit-scrollbar { display:none; }
    .cat-pill { flex-shrink:0; padding:.42rem 1.1rem; border-radius:50px; border:1.5px solid var(--border); background:#fff; color:var(--muted); font-size:.82rem; font-weight:700; cursor:pointer; transition:all .2s; white-space:nowrap; display:flex; align-items:center; gap:.4rem; font-family:inherit; }
    .cat-pill:hover, .cat-pill.active { background:var(--accent); color:#fff; border-color:var(--accent); }

    /* ===== PROMO BANNER ===== */
    .promo-banner { background:linear-gradient(135deg,#046a76,#099aa7); border-radius:20px; padding:1.4rem 1.8rem; display:flex; align-items:center; gap:1.5rem; margin-bottom:2rem; overflow:hidden; position:relative; }
    .promo-banner::after { content:''; position:absolute; right:-30px; top:-40px; width:160px; height:160px; background:rgba(255,255,255,.07); border-radius:50%; pointer-events:none; }
    .promo-banner::before { content:''; position:absolute; right:80px; bottom:-50px; width:120px; height:120px; background:rgba(255,255,255,.04); border-radius:50%; pointer-events:none; }
    .promo-emoji { font-size:2.8rem; flex-shrink:0; position:relative; z-index:1; }
    .promo-text { position:relative; z-index:1; }
    .promo-text strong { display:block; color:#fff; font-size:1rem; font-weight:800; }
    .promo-text span   { color:rgba(255,255,255,.7); font-size:.85rem; }
    .promo-btn { margin-left:auto; background:#fff; color:var(--accent); border:none; border-radius:50px; padding:.55rem 1.3rem; font-size:.84rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .25s; white-space:nowrap; position:relative; z-index:1; }
    .promo-btn:hover { background:var(--soft); }

    /* ===== EMPTY STATE ===== */
    .empty-state { background:#fff; border-radius:20px; box-shadow:var(--shadow); padding:3.5rem 2rem; text-align:center; display:none; }
    .empty-state .ei { font-size:3.5rem; color:var(--border); display:block; margin-bottom:1rem; }
    .empty-state h5 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-state p  { color:var(--muted); font-size:.9rem; max-width:280px; margin:0 auto 1.2rem; }

    /* ===== PAGINATION ===== */
    .pagination-fc { display:flex; align-items:center; justify-content:center; gap:.4rem; margin-top:1.5rem; }
    .pg-btn { width:38px; height:38px; border-radius:10px; border:1.5px solid var(--border); background:#fff; color:var(--muted); font-size:.85rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s; font-family:inherit; }
    .pg-btn:hover { border-color:var(--accent); color:var(--accent); }
    .pg-btn.active { background:var(--accent); color:#fff; border-color:var(--accent); }

    /* ===== CART DRAWER ===== */
    .cart-drawer { position:fixed; top:0; right:-400px; width:380px; height:100vh; background:#fff; box-shadow:-20px 0 60px rgba(0,0,0,.12); z-index:2000; display:flex; flex-direction:column; transition:right .35s cubic-bezier(.4,0,.2,1); }
    .cart-drawer.open { right:0; }
    .cart-drawer-overlay { position:fixed; inset:0; background:rgba(14,31,34,.3); backdrop-filter:blur(3px); z-index:1999; display:none; }
    .cart-drawer-overlay.open { display:block; }
    .cd-header { padding:1.2rem 1.4rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .cd-title { font-size:1.1rem; font-weight:800; color:var(--heading); display:flex; align-items:center; gap:.5rem; }
    .cd-close { background:var(--soft); border:none; color:var(--accent); width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:1rem; transition:all .2s; }
    .cd-close:hover { background:var(--accent); color:#fff; }
    .cd-body { flex:1; overflow-y:auto; padding:1rem 1.4rem; }
    .cd-footer { padding:1.2rem 1.4rem; border-top:1px solid var(--border); }
    .cd-item { display:flex; align-items:center; gap:.85rem; padding:.75rem 0; border-bottom:1px solid #f4f8f8; }
    .cd-item:last-child { border-bottom:none; }
    .cd-item-img { width:48px; height:48px; border-radius:10px; object-fit:cover; background:var(--mint); flex-shrink:0; }
    .cd-item-name { font-size:.86rem; font-weight:700; color:var(--heading); flex:1; min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .cd-item-price { font-size:.88rem; font-weight:800; color:var(--heading); flex-shrink:0; }
    .cd-qty { display:flex; align-items:center; gap:.4rem; }
    .cd-qty button { width:24px; height:24px; border-radius:50%; border:1.5px solid var(--border); background:#fff; color:var(--heading); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.85rem; font-weight:700; transition:all .2s; }
    .cd-qty button:hover { background:var(--accent); color:#fff; border-color:var(--accent); }
    .cd-qty span { font-size:.88rem; font-weight:700; min-width:18px; text-align:center; }
    .cd-remove { background:none; border:none; color:var(--muted); cursor:pointer; font-size:.9rem; padding:.2rem; transition:color .2s; }
    .cd-remove:hover { color:#ef4444; }
    .tot-row { display:flex; justify-content:space-between; font-size:.86rem; color:var(--muted); margin-bottom:.4rem; }
    .tot-row.bold { font-size:.98rem; font-weight:800; color:var(--heading); padding-top:.55rem; margin-top:.3rem; border-top:1px dashed var(--border); }
    .checkout-btn { width:100%; padding:.75rem; background:var(--accent); color:#fff; border:none; border-radius:14px; font-size:.95rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.5rem; transition:background .25s; margin-top:.9rem; }
    .checkout-btn:hover { background:var(--accent-dark); }
    .cart-empty { text-align:center; padding:2.5rem 1rem; }
    .cart-empty i { font-size:3rem; color:var(--border); display:block; margin-bottom:.8rem; }
    .cart-empty p { font-size:.9rem; color:var(--muted); }

    /* ===== TOAST ===== */
    .toast-fc { position:fixed; bottom:28px; right:28px; background:var(--heading); color:#fff; border-radius:16px; padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem; box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span   { font-size:.78rem; color:rgba(255,255,255,.65); }

    /* Scroll top */
    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; text-decoration:none; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; box-shadow:0 6px 20px rgba(9,154,167,.35); transition:all .3s; border:none; cursor:pointer; }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    /* Animations */
    @keyframes fadeSlide { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }
    .cat-section { opacity:0; animation:fadeSlide .5s ease forwards; }
    .cat-section:nth-child(1) { animation-delay:.05s; }
    .cat-section:nth-child(2) { animation-delay:.12s; }
    .cat-section:nth-child(3) { animation-delay:.19s; }
    .cat-section:nth-child(4) { animation-delay:.26s; }
    .cat-section:nth-child(5) { animation-delay:.33s; }
    .cat-section:nth-child(6) { animation-delay:.4s; }

    @media(max-width:991px) { .sidebar { display:none; } }
    @media(max-width:768px) { .header-search{display:none;} .prod-grid { grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); } }
    @media(max-width:576px) { .prod-grid { grid-template-columns:1fr 1fr; } .cart-drawer{width:100%;right:-100%;} }
  </style>
</head>
<body>

<!-- ===== CART OVERLAY ===== -->
<div class="cart-drawer-overlay" id="cartOverlay" onclick="closeCart()"></div>

<!-- ===== HEADER ===== -->
<header class="header" id="mainHeader">
  <div class="container-xl">
    <div class="d-flex align-items-center gap-3">
      <a href="#" class="text-decoration-none me-2 flex-shrink-0">
        <h1 class="sitename"><span class="s1">Farma</span><span class="s2">Connect</span></h1>
      </a>
      <div class="header-search d-none d-md-block mx-auto">
        <div class="ig">
          <span class="ig-icon"><i class="bi bi-search"></i></span>
          <input type="text" placeholder="Pesquise medicamentos, farmácias..." id="hdrSearchInput">
          <button class="ig-btn" onclick="document.getElementById('prodSearch').value=document.getElementById('hdrSearchInput').value;filterProducts()"><i class="bi bi-arrow-right-circle-fill"></i></button>
        </div>
      </div>
      <nav class="navmenu d-none d-lg-block flex-shrink-0">
        <ul>
          <li><a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a></li>
          <li><a href="#"><i class="bi bi-hospital"></i> Farmácias</a></li>
          <li><a href="#" class="active"><i class="bi bi-box-seam"></i> Produtos</a></li>
          <li><a href="#"><i class="bi bi-clock-history"></i> Histórico</a></li>
        </ul>
      </nav>
      <div class="d-flex align-items-center gap-3 flex-shrink-0 ms-auto ms-lg-0">
        <a href="#" class="hdr-icon d-none d-sm-inline-flex" onclick="openCart();return false;">
          <i class="bi bi-bag"></i>
          <span class="hdr-badge" id="cartBadge">0</span>
        </a>
        <div class="dropdown">
          <a href="#" class="profile-toggle dropdown-toggle" id="pdrop" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&rounded=true&size=34" width="34" height="34" class="rounded-circle" alt="Perfil">
            <span class="pname d-none d-md-inline">Ana Costa</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Minha Conta</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"></i>Favoritos</a></li>
            <li><hr class="dropdown-divider mx-2 my-1"></li>
            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Terminar Sessão</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ===== PAGE TOPBAR ===== -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">
    <div class="breadcrumb-fc">
      <a href="#"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem;"></i></span>
      <span class="cur">Produtos</span>
    </div>
    <h2>Medicamentos & Produtos</h2>
    <p>Encontre o que precisa, entregue na sua porta em minutos</p>

    <div class="hero-search">
      <div class="hs-box">
        <div class="hs-field" style="flex:2;">
          <i class="bi bi-search"></i>
          <input type="text" id="prodSearch" placeholder="Nome do medicamento, princípio activo..." oninput="filterProducts()">
        </div>
        <div class="hs-sep d-none d-sm-block"></div>
        <div class="hs-field">
          <i class="bi bi-hospital"></i>
          <select id="farmSel" onchange="filterProducts()">
            <option value="">Todas as farmácias</option>
            <option value="central">Farmácia Central</option>
            <option value="kilamba">Farmácia Kilamba</option>
            <option value="talatona">Farmácia Talatona</option>
            <option value="maianga">FarmaMaianga</option>
          </select>
        </div>
        <button class="hs-btn" onclick="filterProducts()"><i class="bi bi-search"></i> Pesquisar</button>
      </div>
      <div class="hero-tags">
        <span class="htag active" onclick="setHTag(this,'')">Todos</span>
        <span class="htag" onclick="setHTag(this,'analgesico')"> Analgésicos</span>
        <span class="htag" onclick="setHTag(this,'vitamina')"> Vitaminas</span>
        <span class="htag" onclick="setHTag(this,'antibiotico')"> Antibióticos</span>
        <span class="htag" onclick="setHTag(this,'cardiovascular')"> Cardiovascular</span>
        <span class="htag" onclick="setHTag(this,'dermatologia')"> Dermatologia</span>
        <span class="htag" onclick="setHTag(this,'pediatria')"> Pediatria</span>
      </div>
    </div>
  </div>
</div>

<!-- ===== MAIN ===== -->
<div class="main-wrap">
  <div class="container-xl">
    <div class="row g-4">

      <!-- SIDEBAR -->
      <div class="col-lg-3 d-none d-lg-block">
        <div class="sidebar">

          <!-- Categorias -->
          <div class="sbox">
            <div class="sbox-head"><h6><i class="bi bi-grid-3x3-gap"></i>Categorias</h6></div>
            <div class="sbox-body pt-2 pb-2">
              <div class="cat-nav" id="catNav">
                <a class="cat-nav-item active" href="#" onclick="filterByCat(event,'')">
                  {{-- <div class="icon" style="background:var(--soft);color:var(--accent);">🏠</div> --}}
                  <span class="label">Todos os produtos</span>
                  <span class="cnt">86</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'analgesico')">
                  <div class="icon"></div>
                  <span class="label">Analgésicos</span>
                  <span class="cnt">18</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'vitamina')">
                  <div class="icon"></div>
                  <span class="label">Vitaminas</span>
                  <span class="cnt">12</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'antibiotico')">
                  <div class="icon"></div>
                  <span class="label">Antibióticos</span>
                  <span class="cnt">9</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'cardiovascular')">
                  <div class="icon"></div>
                  <span class="label">Cardiovascular</span>
                  <span class="cnt">11</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'dermatologia')">
                  <div class="icon"></div>
                  <span class="label">Dermatologia</span>
                  <span class="cnt">8</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'pediatria')">
                  <div class="icon"></div>
                  <span class="label">Pediatria</span>
                  <span class="cnt">7</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'digestivo')">
                  <div class="icon"></div>
                  <span class="label">Digestivo</span>
                  <span class="cnt">10</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'ortopedia')">
                  {{-- <div class="icon">🦴</div> --}}
                  <span class="label">Ortopedia</span>
                  <span class="cnt">6</span>
                </a>
                <a class="cat-nav-item" href="#" onclick="filterByCat(event,'cuidado')">
                  {{-- <div class="icon">✨</div> --}}
                  <span class="label">Cuidado Pessoal</span>
                  <span class="cnt">5</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Preço -->
          <div class="sbox">
            <div class="sbox-head"><h6><i class="bi bi-tag"></i>Preço (Kz)</h6><button class="sbox-clear">Limpar</button></div>
            <div class="sbox-body">
              <div class="price-range">
                <div class="price-inputs">
                  <input type="number" class="price-input" placeholder="Mín." id="priceMin">
                  <span class="price-sep">—</span>
                  <input type="number" class="price-input" placeholder="Máx." id="priceMax">
                </div>
                <input type="range" class="price-slider" min="0" max="50000" value="50000" oninput="document.getElementById('priceMax').value=this.value">
              </div>
            </div>
          </div>

          <!-- Farmácia -->
          <div class="sbox">
            <div class="sbox-head"><h6><i class="bi bi-hospital"></i>Farmácia</h6><button class="sbox-clear">Limpar</button></div>
            <div class="sbox-body">
              <div class="check-list">
                <label class="check-item"><input type="checkbox" checked> <label>Farmácia Central</label></label>
                <label class="check-item"><input type="checkbox" checked> <label>Farmácia Kilamba</label></label>
                <label class="check-item"><input type="checkbox" checked> <label>Farmácia Talatona</label></label>
                <label class="check-item"><input type="checkbox" checked> <label>FarmaMaianga</label></label>
              </div>
            </div>
          </div>

          <!-- Disponibilidade -->
          <div class="sbox">
            <div class="sbox-head"><h6><i class="bi bi-check-circle"></i>Disponibilidade</h6></div>
            <div class="sbox-body">
              <div class="check-list">
                <label class="check-item"><input type="checkbox" checked> <label>Em stock</label></label>
                <label class="check-item"><input type="checkbox"> <label>Stock limitado</label></label>
                <label class="check-item"><input type="checkbox"> <label>Sem receita</label></label>
                <label class="check-item"><input type="checkbox"> <label>Com receita</label></label>
              </div>
            </div>
          </div>

          <!-- Avaliação -->
          <div class="sbox">
            <div class="sbox-head"><h6><i class="bi bi-star"></i>Avaliação</h6><button class="sbox-clear">Limpar</button></div>
            <div class="sbox-body">
              <div class="rating-list">
                <label class="rating-item"><input type="radio" name="rt"> <div class="ri-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i> <span>5 estrelas</span></div></label>
                <label class="rating-item"><input type="radio" name="rt"> <div class="ri-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i> <span>4+ estrelas</span></div></label>
                <label class="rating-item"><input type="radio" name="rt"> <div class="ri-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i> <span>3+ estrelas</span></div></label>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- CONTENT -->
      <div class="col-lg-9" id="contentArea">

        <!-- Promo banner -->
        <div class="promo-banner">
          <span class="promo-emoji">🏷️</span>
          <div class="promo-text">
            <strong>30% de desconto em Vitaminas e Suplementos</strong>
            <span>Promoção válida até 15 de Março · Apenas nas farmácias parceiras</span>
          </div>
          <button class="promo-btn" onclick="setHTag(document.querySelector('.htag:nth-child(3)'),'vitamina')">Ver promoção</button>
        </div>

        <!-- Category pills -->
        <div class="cat-pills" id="catPills">
          <button class="cat-pill active" onclick="filterByCatPill(this,'')"> Todos</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'analgesico')"> Analgésicos</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'vitamina')"> Vitaminas</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'antibiotico')"> Antibióticos</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'cardiovascular')"> Cardiovascular</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'dermatologia')"> Dermatologia</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'pediatria')"> Pediatria</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'digestivo')"> Digestivo</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'ortopedia')"> Ortopedia</button>
          <button class="cat-pill" onclick="filterByCatPill(this,'cuidado')">Cuidado Pessoal</button>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
          <span class="result-count">A mostrar <strong id="countShow">0</strong> produtos</span>
          <select class="sort-select" id="sortSel" onchange="renderAll()">
            <option value="relevance">Mais relevantes</option>
            <option value="price_asc">Preço: menor primeiro</option>
            <option value="price_desc">Preço: maior primeiro</option>
            <option value="rating">Melhor avaliação</option>
            <option value="new">Mais recentes</option>
          </select>
          <div class="view-toggle">
            <button class="vt-btn active" id="vGrid" onclick="setView('grid')" title="Grelha"><i class="bi bi-grid"></i></button>
            <button class="vt-btn" id="vList" onclick="setView('list')" title="Lista"><i class="bi bi-list-ul"></i></button>
          </div>
        </div>

        <!-- RENDERED CATEGORIES -->
        <div id="categorySections"></div>

        <!-- Empty -->
        <div class="empty-state" id="emptyState">
          <span class="ei"><i class="bi bi-capsule-pill"></i></span>
          <h5>Nenhum produto encontrado</h5>
          <p>Tente pesquisar com outros termos ou limpe os filtros activos.</p>
          <button onclick="resetAll()" style="background:var(--accent);color:#fff;border:none;border-radius:50px;padding:.55rem 1.4rem;font-size:.86rem;font-weight:700;cursor:pointer;font-family:inherit;">Limpar filtros</button>
        </div>

        <!-- Pagination -->
        <div class="pagination-fc" id="paginationBar">
          <button class="pg-btn" disabled><i class="bi bi-chevron-left"></i></button>
          <button class="pg-btn active">1</button>
          <button class="pg-btn">2</button>
          <button class="pg-btn">3</button>
          <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- ===== CART DRAWER ===== -->
<div class="cart-drawer" id="cartDrawer">
  <div class="cd-header">
    <div class="cd-title"><i class="bi bi-bag-heart-fill" style="color:var(--accent);"></i> Carrinho</div>
    <button class="cd-close" onclick="closeCart()"><i class="bi bi-x-lg"></i></button>
  </div>
  <div class="cd-body" id="cartBody">
    <div class="cart-empty"><i class="bi bi-bag-x"></i><p>O seu carrinho está vazio.</p></div>
  </div>
  <div class="cd-footer" id="cartFooter" style="display:none;">
    <div class="tot-row"><span>Subtotal</span><span id="cartSubtotal">0 Kz</span></div>
    <div class="tot-row"><span>Taxa de entrega</span><span>800 Kz</span></div>
    <div class="tot-row bold"><span>Total</span><span id="cartTotal">800 Kz</span></div>
    <button class="checkout-btn"><i class="bi bi-bag-check"></i> Finalizar pedido</button>
  </div>
</div>

<!-- ===== FOOTER ===== -->
<footer style="background:#1f2f31;color:#fff;padding:2rem 0;margin-top:1rem;">
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
  <div><strong id="toastTitle">Adicionado!</strong><span id="toastMsg"></span></div>
</div>

<button id="scroll-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="bi bi-arrow-up-short"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* =====================================================
   DATA
===================================================== */
const CATEGORIES = [
  {
    id:'analgesico', label:'Analgésicos & Anti-inflamatórios',
    emoji:'', color:'#e8f5e9', accent:'#22c55e',
    desc:'Alívio rápido da dor e inflamação',
    products:[
      { id:1, name:'Paracetamol 500mg', form:'Embalagem c/ 20 comp.', pharm:'Farmácia Central', pharmId:'central', price:850, oldPrice:null, rating:4.8, reviews:212, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:2, name:'Ibuprofeno 400mg', form:'Embalagem c/ 20 comp.', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:1200, oldPrice:1500, rating:4.7, reviews:98, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=300&auto=format&fit=crop', stock:'ok', badges:['discount'], presc:false },
      { id:3, name:'Dipirona 500mg', form:'Embalagem c/ 20 comp.', pharm:'Farmácia Talatona', pharmId:'talatona', price:700, oldPrice:null, rating:4.6, reviews:145, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:4, name:'Voltaren Gel 50g', form:'Tubo 50g', pharm:'FarmaMaianga', pharmId:'maianga', price:3200, oldPrice:3800, rating:4.9, reviews:67, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'low', badges:['discount','low'], presc:false },
    ]
  },
  {
    id:'vitamina', label:'Vitaminas & Suplementos',
    emoji:'', color:'#f0fdf4', accent:'#16a34a',
    desc:'Reforce a sua imunidade e bem-estar',
    products:[
      { id:10, name:'Vitamina C 1000mg', form:'Frasco c/ 30 comp. efervescentes', pharm:'Farmácia Central', pharmId:'central', price:3200, oldPrice:4500, rating:4.9, reviews:341, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'ok', badges:['discount','new'], presc:false },
      { id:11, name:'Vitamina D3 2000 UI', form:'Frasco c/ 60 caps.', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:4800, oldPrice:null, rating:4.8, reviews:89, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'ok', badges:['new'], presc:false },
      { id:12, name:'Complexo B', form:'Frasco c/ 30 comp.', pharm:'Farmácia Talatona', pharmId:'talatona', price:2100, oldPrice:null, rating:4.5, reviews:54, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:13, name:'Ômega 3 1000mg', form:'Frasco c/ 60 caps.', pharm:'FarmaMaianga', pharmId:'maianga', price:5600, oldPrice:6200, rating:4.7, reviews:123, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'ok', badges:['discount'], presc:false },
    ]
  },
  {
    id:'antibiotico', label:'Antibióticos',
    emoji:'', color:'#eff6ff', accent:'#3b82f6',
    desc:'Tratamento de infecções bacterianas',
    products:[
      { id:20, name:'Amoxicilina 500mg', form:'Caixa c/ 14 cáps.', pharm:'Farmácia Central', pharmId:'central', price:2400, oldPrice:null, rating:4.8, reviews:178, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'ok', badges:['presc'], presc:true },
      { id:21, name:'Azitromicina 500mg', form:'Caixa c/ 3 comp.', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:3100, oldPrice:null, rating:4.7, reviews:92, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=300&auto=format&fit=crop', stock:'ok', badges:['presc'], presc:true },
      { id:22, name:'Metronidazol 400mg', form:'Caixa c/ 14 comp.', pharm:'Farmácia Talatona', pharmId:'talatona', price:1800, oldPrice:null, rating:4.6, reviews:45, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'low', badges:['presc','low'], presc:true },
      { id:23, name:'Ciprofloxacino 500mg', form:'Caixa c/ 14 comp.', pharm:'FarmaMaianga', pharmId:'maianga', price:4200, oldPrice:null, rating:4.5, reviews:61, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'ok', badges:['presc'], presc:true },
    ]
  },
  {
    id:'cardiovascular', label:'Cardiovascular',
    emoji:'', color:'#fff1f2', accent:'#e11d48',
    desc:'Saúde do coração e sistema circulatório',
    products:[
      { id:30, name:'Losartana 50mg', form:'Caixa c/ 30 comp.', pharm:'Farmácia Central', pharmId:'central', price:2400, oldPrice:null, rating:4.9, reviews:203, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=300&auto=format&fit=crop', stock:'ok', badges:['presc'], presc:true },
      { id:31, name:'Atenolol 50mg', form:'Caixa c/ 30 comp.', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:1900, oldPrice:null, rating:4.7, reviews:87, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'ok', badges:['presc'], presc:true },
      { id:32, name:'Sinvastatina 20mg', form:'Caixa c/ 30 comp.', pharm:'Farmácia Talatona', pharmId:'talatona', price:3600, oldPrice:4000, rating:4.8, reviews:132, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'ok', badges:['discount','presc'], presc:true },
      { id:33, name:'Aspirina 100mg', form:'Caixa c/ 30 comp.', pharm:'FarmaMaianga', pharmId:'maianga', price:1200, oldPrice:null, rating:4.6, reviews:194, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
    ]
  },
  {
    id:'dermatologia', label:'Dermatologia',
    emoji:'', color:'#fdf4ff', accent:'#9333ea',
    desc:'Cuidados com a pele e tratamentos tópicos',
    products:[
      { id:40, name:'Hidrocortisona Creme 1%', form:'Tubo 30g', pharm:'Farmácia Central', pharmId:'central', price:1800, oldPrice:null, rating:4.7, reviews:76, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:41, name:'Clotrimazol Creme 1%', form:'Tubo 30g', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:1500, oldPrice:null, rating:4.6, reviews:54, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:42, name:'Protector Solar FPS 50+', form:'Frasco 200ml', pharm:'Farmácia Talatona', pharmId:'talatona', price:4500, oldPrice:5200, rating:4.9, reviews:210, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'ok', badges:['discount','new'], presc:false },
      { id:43, name:'Cetaphil Hidratante', form:'Frasco 250ml', pharm:'FarmaMaianga', pharmId:'maianga', price:6800, oldPrice:7500, rating:4.8, reviews:143, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=300&auto=format&fit=crop', stock:'low', badges:['discount'], presc:false },
    ]
  },
  {
    id:'pediatria', label:'Pediatria',
    emoji:'', color:'#fff7ed', accent:'#f97316',
    desc:'Medicamentos e cuidados para crianças',
    products:[
      { id:50, name:'Paracetamol Xarope 120mg/5ml', form:'Frasco 100ml', pharm:'Farmácia Central', pharmId:'central', price:1200, oldPrice:null, rating:4.9, reviews:328, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:51, name:'Ibuprofeno Suspensão 20mg/ml', form:'Frasco 100ml', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:1500, oldPrice:null, rating:4.8, reviews:187, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:52, name:'Vitamina D Gotas 400 UI', form:'Frasco 10ml', pharm:'Farmácia Talatona', pharmId:'talatona', price:2800, oldPrice:3200, rating:4.7, reviews:93, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'ok', badges:['discount'], presc:false },
      { id:53, name:'Soro Oral Sachê', form:'Caixa c/ 10 sachês', pharm:'FarmaMaianga', pharmId:'maianga', price:900, oldPrice:null, rating:4.8, reviews:276, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
    ]
  },
  {
    id:'digestivo', label:'Digestivo & Gastroenterologia',
    emoji:'', color:'#f0fdf4', accent:'#059669',
    desc:'Saúde gastrointestinal e bem-estar digestivo',
    products:[
      { id:60, name:'Omeprazol 20mg', form:'Caixa c/ 28 caps.', pharm:'Farmácia Central', pharmId:'central', price:2800, oldPrice:null, rating:4.8, reviews:241, img:'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
      { id:61, name:'Ranitidina 150mg', form:'Caixa c/ 20 comp.', pharm:'Farmácia Kilamba', pharmId:'kilamba', price:1600, oldPrice:null, rating:4.5, reviews:78, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&auto=format&fit=crop', stock:'low', badges:['low'], presc:false },
      { id:62, name:'Simeticona 40mg', form:'Frasco c/ 30 comp. mastigáveis', pharm:'FarmaMaianga', pharmId:'maianga', price:1100, oldPrice:null, rating:4.6, reviews:112, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300&auto=format&fit=crop', stock:'ok', badges:[], presc:false },
    ]
  },
];

/* =====================================================
   STATE
===================================================== */
let cart = [];
let currentCat = '';
let currentView = 'grid';

/* =====================================================
   RENDER
===================================================== */
function getStars(r) {
  const full = Math.floor(r), half = r % 1 >= .5 ? 1 : 0, empty = 5-full-half;
  return '<i class="bi bi-star-fill"></i>'.repeat(full) + (half?'<i class="bi bi-star-half"></i>':'') + '<i class="bi bi-star"></i>'.repeat(empty);
}

function getBadgesHtml(badges, presc) {
  let html = '';
  if (badges.includes('discount')) html += '<span class="pbadge pbadge-discount">DESCONTO</span>';
  if (badges.includes('new'))      html += '<span class="pbadge pbadge-new">NOVO</span>';
  if (badges.includes('low'))      html += '<span class="pbadge pbadge-low">Stock baixo</span>';
  if (presc)                        html += '<span class="pbadge pbadge-presc">Receita</span>';
  return html;
}

function getStockHtml(stock) {
  if (stock==='ok')  return '<div class="prod-stock"><span class="stock-dot stock-ok"></span>Em stock</div>';
  if (stock==='low') return '<div class="prod-stock"><span class="stock-dot stock-low"></span>Stock limitado</div>';
  return '<div class="prod-stock"><span class="stock-dot stock-out"></span>Esgotado</div>';
}

function renderCard(p, mode='grid') {
  const oldHtml = p.oldPrice ? `<span class="prod-price-old">${p.oldPrice.toLocaleString('pt-PT')} Kz</span>` : '';
  const discount = p.oldPrice ? `<span class="pbadge pbadge-discount" style="font-size:.65rem;padding:.15rem .5rem;">-${Math.round((1-p.price/p.oldPrice)*100)}%</span>` : '';

  if (mode === 'list') {
    return `
    <div class="prod-card list-card" data-cat="${p.catId}" data-pharm="${p.pharmId}" data-price="${p.price}" data-id="${p.id}">
      <div class="prod-img"><img src="${p.img}" alt="${p.name}" loading="lazy"></div>
      <div class="prod-body">
        <div class="prod-cat">${p.catLabel}</div>
        <div class="prod-name">${p.name}</div>
        <div class="prod-pharm"><i class="bi bi-hospital"></i> ${p.pharm} · ${p.form}</div>
        <div class="prod-rating" style="font-size:.78rem;">${getStars(p.rating)} <span style="font-weight:700;margin-left:.2rem;">${p.rating}</span> <span class="cnt">(${p.reviews})</span></div>
        <div class="prod-actions-row">
          <div class="prod-price-row">
            <span class="prod-price">${p.price.toLocaleString('pt-PT')} Kz</span>
            ${oldHtml} ${discount}
          </div>
          ${getStockHtml(p.stock)}
          <button class="prod-add-btn" style="flex:none;width:auto;padding:.44rem 1.2rem;" onclick="addToCart(${p.id})" ${p.stock==='out'?'disabled':''}>
            <i class="bi bi-bag-plus"></i> Adicionar
          </button>
          <button class="prod-fav" style="position:relative;top:auto;right:auto;" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
        </div>
      </div>
    </div>`;
  }

  return `
  <div class="prod-card" data-cat="${p.catId}" data-pharm="${p.pharmId}" data-price="${p.price}" data-id="${p.id}">
    <div class="prod-badges">${getBadgesHtml(p.badges, p.presc)}</div>
    <button class="prod-fav" onclick="toggleFav(this)"><i class="bi bi-heart"></i></button>
    <div class="prod-img"><img src="${p.img}" alt="${p.name}" loading="lazy"></div>
    <div class="prod-body">
      <div class="prod-cat">${p.catLabel}</div>
      <div class="prod-name">${p.name}</div>
      <div class="prod-pharm"><i class="bi bi-hospital"></i> ${p.pharm}</div>
      <div class="prod-rating">${getStars(p.rating)} <span style="font-weight:700;">${p.rating}</span> <span class="cnt">(${p.reviews})</span></div>
      ${getStockHtml(p.stock)}
      <div class="prod-price-row">
        <span class="prod-price">${p.price.toLocaleString('pt-PT')} Kz</span>
        ${oldHtml}
        <span class="prod-unit">${p.form.split(' ').slice(0,2).join(' ')}</span>
      </div>
      <button class="prod-add-btn" id="add-${p.id}" onclick="addToCart(${p.id})" ${p.stock==='out'?'disabled':''}>
        <i class="bi bi-bag-plus"></i> Adicionar ao carrinho
      </button>
    </div>
  </div>`;
}

function getFilteredProducts() {
  const q    = (document.getElementById('prodSearch')?.value||'').toLowerCase();
  const farm = document.getElementById('farmSel')?.value||'';
  const cat  = currentCat;

  return CATEGORIES.flatMap(c => {
    if (cat && c.id !== cat) return [];
    return c.products
      .filter(p => (!q || p.name.toLowerCase().includes(q) || p.form.toLowerCase().includes(q)))
      .filter(p => !farm || p.pharmId === farm)
      .map(p => ({...p, catId:c.id, catLabel:c.label}));
  });
}

function renderAll() {
  const sort = document.getElementById('sortSel')?.value||'relevance';
  const sections = document.getElementById('categorySections');
  const empty    = document.getElementById('emptyState');
  const pager    = document.getElementById('paginationBar');

  // Flatten filtered products
  let allProds = getFilteredProducts();

  // Sort
  if (sort==='price_asc')  allProds.sort((a,b)=>a.price-b.price);
  if (sort==='price_desc') allProds.sort((a,b)=>b.price-a.price);
  if (sort==='rating')     allProds.sort((a,b)=>b.rating-a.rating);
  if (sort==='new')        allProds.sort((a,b)=>b.id-a.id);

  document.getElementById('countShow').textContent = allProds.length;

  if (allProds.length === 0) {
    sections.innerHTML = '';
    empty.style.display = 'block';
    pager.style.display = 'none';
    return;
  }
  empty.style.display = 'none';
  pager.style.display = 'flex';

  // Group by category
  const grouped = {};
  allProds.forEach(p => {
    if (!grouped[p.catId]) grouped[p.catId] = [];
    grouped[p.catId].push(p);
  });

  sections.innerHTML = Object.entries(grouped).map(([catId, prods]) => {
    const cat = CATEGORIES.find(c=>c.id===catId);
    const cardsHtml = prods.map(p => renderCard(p, currentView)).join('');
    return `
    <div class="cat-section" id="section-${catId}">
      <div class="cat-section-header">
        <div class="cat-label">
          <div class="cat-icon-big" style="background:${cat.color};color:${cat.accent};">${cat.emoji}</div>
          <div>
            <div class="cat-title">${cat.label}</div>
            <div class="cat-sub">${cat.desc} · ${prods.length} produto${prods.length>1?'s':''}</div>
          </div>
        </div>
        <a href="#" class="cat-see-all" onclick="filterByCatPill(document.querySelector('.cat-pill:nth-child(${CATEGORIES.findIndex(c=>c.id===catId)+2})'), '${catId}');return false;">
          Ver todos <i class="bi bi-arrow-right"></i>
        </a>
      </div>
      <div class="cat-divider" style="background:linear-gradient(to right,${cat.accent}33,transparent);"></div>
      <div class="prod-grid${currentView==='list'?' list-mode':''}">${cardsHtml}</div>
    </div>`;
  }).join('');
}

/* =====================================================
   FILTER / SORT
===================================================== */
function filterProducts() { renderAll(); }

function filterByCat(e, cat) {
  e.preventDefault();
  currentCat = cat;
  // Update sidebar nav
  document.querySelectorAll('.cat-nav-item').forEach(el => el.classList.toggle('active', el.getAttribute('onclick').includes(`'${cat}'`)));
  // Update pills
  document.querySelectorAll('.cat-pill').forEach(el => el.classList.toggle('active', el.getAttribute('onclick').includes(`'${cat}'`)));
  renderAll();
}

function filterByCatPill(el, cat) {
  currentCat = cat;
  document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
  el.classList.add('active');
  document.querySelectorAll('.cat-nav-item').forEach(n => n.classList.toggle('active', n.getAttribute('onclick').includes(`'${cat}'`)));
  renderAll();
}

function setHTag(el, cat) {
  document.querySelectorAll('.htag').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  currentCat = cat;
  renderAll();
}

function resetAll() {
  currentCat = '';
  document.getElementById('prodSearch').value = '';
  document.getElementById('farmSel').value = '';
  document.querySelectorAll('.cat-pill').forEach((p,i)=>p.classList.toggle('active',i===0));
  document.querySelectorAll('.cat-nav-item').forEach((n,i)=>n.classList.toggle('active',i===0));
  document.querySelectorAll('.htag').forEach((t,i)=>t.classList.toggle('active',i===0));
  renderAll();
}

/* =====================================================
   VIEW
===================================================== */
function setView(v) {
  currentView = v;
  document.getElementById('vGrid').classList.toggle('active', v==='grid');
  document.getElementById('vList').classList.toggle('active', v==='list');
  renderAll();
}

/* =====================================================
   CART
===================================================== */
function getAllProducts() {
  return CATEGORIES.flatMap(c => c.products.map(p => ({...p, catId:c.id, catLabel:c.label})));
}

function addToCart(id) {
  const p = getAllProducts().find(x=>x.id===id);
  if (!p) return;
  const existing = cart.find(x=>x.id===id);
  if (existing) existing.qty++;
  else cart.push({...p, qty:1});
  updateCartBadge();
  renderCartDrawer();
  showToast(`🛒 ${p.name}`, 'adicionado ao carrinho!');
  // Button feedback
  const btn = document.getElementById('add-'+id);
  if (btn) {
    btn.classList.add('added');
    btn.innerHTML = '<i class="bi bi-check2"></i> Adicionado!';
    setTimeout(() => {
      btn.classList.remove('added');
      btn.innerHTML = '<i class="bi bi-bag-plus"></i> Adicionar ao carrinho';
    }, 1800);
  }
}

function removeFromCart(id) {
  cart = cart.filter(x=>x.id!==id);
  updateCartBadge();
  renderCartDrawer();
}

function changeQty(id, delta) {
  const item = cart.find(x=>x.id===id);
  if (!item) return;
  item.qty += delta;
  if (item.qty <= 0) removeFromCart(id);
  else { updateCartBadge(); renderCartDrawer(); }
}

function updateCartBadge() {
  const total = cart.reduce((s,x)=>s+x.qty,0);
  document.getElementById('cartBadge').textContent = total;
}

function renderCartDrawer() {
  const body   = document.getElementById('cartBody');
  const footer = document.getElementById('cartFooter');
  if (cart.length === 0) {
    body.innerHTML = '<div class="cart-empty"><i class="bi bi-bag-x"></i><p>O seu carrinho está vazio.</p></div>';
    footer.style.display = 'none';
    return;
  }
  footer.style.display = 'block';
  body.innerHTML = cart.map(item => `
    <div class="cd-item">
      <img class="cd-item-img" src="${item.img}" alt="${item.name}">
      <div style="flex:1;min-width:0;">
        <div class="cd-item-name">${item.name}</div>
        <div style="font-size:.72rem;color:var(--muted);">${item.pharm}</div>
        <div class="cd-qty" style="margin-top:.4rem;">
          <button onclick="changeQty(${item.id},-1)"><i class="bi bi-dash"></i></button>
          <span>${item.qty}</span>
          <button onclick="changeQty(${item.id},1)"><i class="bi bi-plus"></i></button>
        </div>
      </div>
      <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.3rem;">
        <div class="cd-item-price">${(item.price*item.qty).toLocaleString('pt-PT')} Kz</div>
        <button class="cd-remove" onclick="removeFromCart(${item.id})"><i class="bi bi-trash3"></i></button>
      </div>
    </div>`).join('');

  const subtotal = cart.reduce((s,x)=>s+x.price*x.qty,0);
  document.getElementById('cartSubtotal').textContent = subtotal.toLocaleString('pt-PT') + ' Kz';
  document.getElementById('cartTotal').textContent    = (subtotal+800).toLocaleString('pt-PT') + ' Kz';
}

function openCart()  { document.getElementById('cartDrawer').classList.add('open'); document.getElementById('cartOverlay').classList.add('open'); }
function closeCart() { document.getElementById('cartDrawer').classList.remove('open'); document.getElementById('cartOverlay').classList.remove('open'); }

/* =====================================================
   FAV / TOAST / MISC
===================================================== */
function toggleFav(btn) {
  const on = btn.classList.toggle('active');
  btn.innerHTML = on ? '<i class="bi bi-heart-fill"></i>' : '<i class="bi bi-heart"></i>';
  if (on) showToast(' Adicionado aos favoritos', '');
}

function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = msg;
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'), 3200);
}

const hdr = document.getElementById('mainHeader');
window.addEventListener('scroll', () => {
  hdr.classList.toggle('scrolled', scrollY > 50);
  document.getElementById('scroll-top').style.display = scrollY > 320 ? 'flex' : 'none';
});

document.querySelectorAll('.pg-btn').forEach(btn => {
  if (!btn.querySelector('i')) btn.addEventListener('click', () => {
    document.querySelectorAll('.pg-btn').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    window.scrollTo({top:0,behavior:'smooth'});
  });
});

// Initial render
renderAll();
</script>
</body>
</html>