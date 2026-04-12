{{-- resources/views/clientes/dashboard/produtos_categoria.blade.php --}}
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $categoria->name }} — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* (todo o CSS permanece igual ao original – mantido por brevidade) */
    :root {
      --accent:      #099aa7;
      --accent-dark: #067e8a;
      --accent-xd:   #046a76;
      --heading:     #1f2f31;
      --text:        #363f40;
      --soft:        #dff3f0;
      --mint:        #eaf6f5;
      --muted:       #6c8285;
      --border:      #e4f0f0;
      --shadow:      0 8px 32px rgba(9,154,167,.08);
      --shadow-md:   0 16px 48px rgba(9,154,167,.13);
      --shadow-lg:   0 24px 64px rgba(9,154,167,.18);
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; background:#f4f8f8; color:var(--text); overflow-x:hidden; }

    /* ═══════════════════ HEADER ═══════════════════ */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; position:sticky; top:0; z-index:1000; transition:box-shadow .3s; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }
    .header-search { flex:1; max-width:520px; }
    .header-search .ig { border:1.5px solid var(--border); border-radius:50px; background:#f6fbfb; overflow:hidden; display:flex; align-items:center; transition:border-color .2s,box-shadow .2s; }
    .header-search .ig:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .header-search .ig-icon { padding:.6rem 0 .6rem 1.1rem; color:#a0b9bc; }
    .header-search .ig input { flex:1; border:none; background:transparent; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; outline:none; font-family:inherit; }
    .header-search .ig input::placeholder { color:#b0c4c6; }
    .header-search .ig-btn { background:transparent; border:none; color:var(--accent); padding:.6rem 1rem; font-size:1.2rem; cursor:pointer; }
    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu li { margin:0 .15rem; }
    .navmenu a { color:var(--heading); font-weight:600; font-size:.88rem; padding:.42rem .85rem; border-radius:50px; text-decoration:none; transition:.2s; white-space:nowrap; }
    .navmenu a:hover, .navmenu a.active { background:var(--soft); color:var(--accent); }
    .hdr-icon { position:relative; color:var(--heading); font-size:1.3rem; text-decoration:none; transition:color .2s; }
    .hdr-icon:hover { color:var(--accent); }
    .hdr-badge { position:absolute; top:-6px; right:-8px; background:var(--accent); color:#fff; font-size:.6rem; font-weight:700; width:17px; height:17px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid #fff; }
    .profile-toggle { display:flex; align-items:center; gap:.5rem; text-decoration:none; color:var(--heading); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ═══════════════════ TOPBAR / HERO ═══════════════════ */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:2.5rem 0 5.5rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:340px;height:340px;background:#fff;opacity:.07;top:-130px;right:-80px; }
    .tb2 { width:240px;height:240px;background:#a8ffd4;opacity:.06;bottom:-100px;left:5%; }
    .topbar-inner { position:relative; z-index:2; }

    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.9rem; flex-wrap:wrap; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; transition:color .2s; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }

    .hero-cat-badge { display:inline-flex; align-items:center; gap:.5rem; background:rgba(255,255,255,.15); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,.25); border-radius:50px; padding:.3rem .9rem; font-size:.78rem; font-weight:700; color:rgba(255,255,255,.9); margin-bottom:.75rem; letter-spacing:.03em; text-transform:uppercase; }
    .page-topbar h2 { color:#fff; font-size:2.1rem; font-weight:800; letter-spacing:-.025em; margin:0 0 .4rem; line-height:1.2; }
    .page-topbar .cat-desc { color:rgba(255,255,255,.7); font-size:.94rem; max-width:540px; }

    /* Stats strip */
    .stats-strip { display:flex; gap:2rem; margin-top:1.8rem; flex-wrap:wrap; }
    .stat-item strong { color:#fff; font-size:1.3rem; font-weight:800; display:block; line-height:1; }
    .stat-item span   { color:rgba(255,255,255,.6); font-size:.75rem; display:block; margin-top:.15rem; }
    .stat-sep { width:1px; height:38px; background:rgba(255,255,255,.2); flex-shrink:0; }

    /* ═══════════════════ MAIN WRAP ═══════════════════ */
    .main-wrap { margin-top:-2.5rem; padding-bottom:5rem; }

    /* ═══════════════════ LAYOUT: SIDEBAR + CONTENT ═══════════════════ */
    .page-layout { display:grid; grid-template-columns:260px 1fr; gap:1.4rem; align-items:start; }

    /* ── SIDEBAR ── */
    .sidebar { position:sticky; top:90px; }
    .sidebar-card { background:#fff; border-radius:18px; box-shadow:var(--shadow); overflow:hidden; }
    .sidebar-card + .sidebar-card { margin-top:1rem; }

    .sc-header { padding:1rem 1.1rem .75rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:.6rem; }
    .sc-header h6 { font-size:.82rem; font-weight:800; color:var(--heading); margin:0; text-transform:uppercase; letter-spacing:.04em; }
    .sc-header i  { color:var(--accent); font-size:.95rem; }

    /* Filtros */
    .filter-group { padding:.85rem 1.1rem; border-bottom:1px solid var(--border); }
    .filter-group:last-child { border-bottom:none; }
    .filter-label { font-size:.75rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.05em; margin-bottom:.65rem; display:block; }

    .price-row { display:flex; gap:.5rem; align-items:center; }
    .price-input { border:1.5px solid var(--border); border-radius:10px; padding:.4rem .7rem; font-size:.82rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; width:100%; transition:border-color .2s; }
    .price-input:focus { border-color:var(--accent); }
    .price-sep { color:var(--muted); font-size:.8rem; flex-shrink:0; }

    .check-list { display:flex; flex-direction:column; gap:.45rem; }
    .check-item { display:flex; align-items:center; gap:.55rem; cursor:pointer; }
    .check-item input[type=checkbox] { accent-color:var(--accent); width:15px; height:15px; border-radius:4px; flex-shrink:0; cursor:pointer; }
    .check-item label { font-size:.84rem; color:var(--text); cursor:pointer; line-height:1.3; }
    .check-count { margin-left:auto; font-size:.72rem; font-weight:700; color:var(--muted); background:#f4f8f8; padding:.1rem .5rem; border-radius:50px; }

    .btn-filter { width:100%; background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.6rem 1rem; font-size:.86rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .22s; margin-top:.1rem; }
    .btn-filter:hover { background:var(--accent-dark); }
    .btn-reset { width:100%; background:transparent; color:var(--muted); border:1.5px solid var(--border); border-radius:50px; padding:.5rem 1rem; font-size:.82rem; font-weight:600; font-family:inherit; cursor:pointer; transition:all .22s; margin-top:.5rem; }
    .btn-reset:hover { border-color:var(--accent); color:var(--accent); }

    /* ── CONTENT ── */
    .content-area {}

    /* Toolbar */
    .toolbar-bar { background:#fff; border-radius:18px; box-shadow:var(--shadow); padding:.85rem 1.2rem; margin-bottom:1.2rem; display:flex; align-items:center; gap:.85rem; flex-wrap:wrap; }
    .result-count { font-size:.88rem; color:var(--muted); }
    .result-count strong { color:var(--heading); font-weight:700; }
    .sort-sel { border:1.5px solid var(--border); border-radius:50px; padding:.4rem 1rem; font-size:.84rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; cursor:pointer; }
    .view-btns { display:flex; gap:.3rem; }
    .vb { width:34px; height:34px; border-radius:10px; border:1.5px solid var(--border); background:#fff; color:var(--muted); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.9rem; transition:all .2s; }
    .vb.active, .vb:hover { background:var(--accent); color:#fff; border-color:var(--accent); }

    /* ═══════════════════ PRODUCT GRID ═══════════════════ */
    .prod-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; }
    .prod-grid.list-mode { grid-template-columns:1fr; }

    /* ── PRODUCT CARD ── */
    .prod-card { background:#fff; border-radius:18px; box-shadow:var(--shadow); border:1.5px solid transparent; overflow:hidden; display:flex; flex-direction:column; transition:all .26s cubic-bezier(.4,0,.2,1); text-decoration:none; color:inherit; }
    .prod-card:hover { border-color:var(--accent); box-shadow:var(--shadow-md); transform:translateY(-4px); color:inherit; text-decoration:none; }

    /* Imagem */
    .pc-img { height:160px; background:var(--mint); position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .pc-img img { width:100%; height:100%; object-fit:cover; transition:transform .45s ease; }
    .prod-card:hover .pc-img img { transform:scale(1.06); }
    .pc-img-placeholder { font-size:3.5rem; opacity:.35; }

    /* Badges */
    .pc-badges { position:absolute; top:10px; left:10px; display:flex; flex-direction:column; gap:.3rem; }
    .badge-fc { font-size:.65rem; font-weight:800; padding:.2rem .55rem; border-radius:50px; letter-spacing:.02em; white-space:nowrap; }
    .badge-desc  { background:#fef2f2; color:#e53e3e; }
    .badge-novo  { background:#f0fdf4; color:#16a34a; }
    .badge-rec   { background:#f3e8ff; color:#7c3aed; }
    .badge-stock { background:#fff7ed; color:#c2410c; }

    /* Favorito */
    .pc-fav { position:absolute; top:10px; right:10px; width:32px; height:32px; border-radius:50%; background:rgba(255,255,255,.9); backdrop-filter:blur(8px); border:none; color:var(--muted); font-size:.95rem; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all .2s; }
    .pc-fav:hover, .pc-fav.active { background:#fff; color:#e53e3e; }

    /* Corpo */
    .pc-body { padding:.9rem 1rem; flex:1; display:flex; flex-direction:column; gap:.25rem; }
    .pc-cat  { font-size:.7rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.04em; }
    .pc-name { font-size:.9rem; font-weight:800; color:var(--heading); line-height:1.35; letter-spacing:-.01em; }
    .pc-sub  { font-size:.75rem; color:var(--muted); }
    .pc-farm { font-size:.73rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-top:.15rem; }

    /* Preço + botão */
    .pc-footer { padding:.75rem 1rem 1rem; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:.5rem; flex-wrap:wrap; }
    .pc-price-wrap {}
    .pc-price-old { font-size:.72rem; color:var(--muted); text-decoration:line-through; display:block; line-height:1; }
    .pc-price { font-size:1.05rem; font-weight:800; color:var(--heading); display:block; line-height:1.2; }
    .pc-price .cur { font-size:.7rem; font-weight:600; color:var(--muted); }
    .btn-cart { background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.45rem 1rem; font-size:.8rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.4rem; transition:all .22s; white-space:nowrap; flex-shrink:0; }
    .btn-cart:hover { background:var(--accent-dark); transform:scale(1.04); }
    .btn-cart.added { background:#16a34a; }

    /* pagination */
    .pagination-fc { display:flex; align-items:center; justify-content:center; gap:.4rem; margin-top:1.5rem; }
     */

    /* LIST MODE */
    .prod-grid.list-mode .prod-card { flex-direction:row; border-radius:16px; }
    .prod-grid.list-mode .pc-img { width:120px; height:auto; min-height:110px; flex-shrink:0; border-radius:0; }
    .prod-grid.list-mode .pc-img img { height:100%; min-height:110px; }
    .prod-grid.list-mode .pc-body { padding:.85rem 1rem .5rem; }
    .prod-grid.list-mode .pc-footer { border-top:none; padding:.5rem 1rem .85rem; }

    /* Animação */
    @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }
    .prod-card { opacity:0; animation:fadeUp .38s ease forwards; }
    .prod-card:nth-child(1){animation-delay:.04s} .prod-card:nth-child(2){animation-delay:.08s}
    .prod-card:nth-child(3){animation-delay:.12s} .prod-card:nth-child(4){animation-delay:.16s}
    .prod-card:nth-child(5){animation-delay:.20s} .prod-card:nth-child(6){animation-delay:.24s}
    .prod-card:nth-child(7){animation-delay:.28s} .prod-card:nth-child(8){animation-delay:.32s}
    .prod-card:nth-child(9){animation-delay:.36s}

    /* ─ EMPTY ─ */
    .empty-state { background:#fff; border-radius:20px; box-shadow:var(--shadow); padding:4rem 2rem; text-align:center; }
    .empty-state .ei { font-size:3.5rem; display:block; margin-bottom:1rem; }
    .empty-state h5 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-state p  { color:var(--muted); font-size:.9rem; max-width:280px; margin:0 auto; }

    /* ─ TOAST ─ */
    .toast-fc { position:fixed; bottom:28px; left:50%; transform:translateX(-50%) translateY(20px); background:var(--heading); color:#fff; border-radius:50px; padding:.6rem 1.4rem; font-size:.86rem; font-weight:600; z-index:9999; opacity:0; transition:all .3s; pointer-events:none; display:flex; align-items:center; gap:.5rem; white-space:nowrap; }
    .toast-fc.show { opacity:1; transform:translateX(-50%) translateY(0); }
    .toast-fc i { color:var(--accent); font-size:1rem; }

    /* ─ SCROLL TOP ─ */
    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; box-shadow:0 6px 20px rgba(9,154,167,.35); border:none; cursor:pointer; transition:all .3s; }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    @media(max-width:1100px) { .page-layout { grid-template-columns:220px 1fr; } .prod-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:900px)  { .page-layout { grid-template-columns:1fr; } .sidebar { position:static; } .sidebar-card { display:none; } .sidebar-card.always-show { display:block; } }
    @media(max-width:768px)  { .header-search { display:none; } .prod-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:480px)  { .prod-grid { grid-template-columns:1fr; } }
  </style>
</head>
<body>

<!-- ══════════════════════════════════════════════════════
     HEADER
══════════════════════════════════════════════════════ -->
@include('clientes.dashboard.header')

<!-- ══════════════════════════════════════════════════════
     TOPBAR / HERO da categoria
══════════════════════════════════════════════════════ -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">

    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right"></i></span>
      <a href="{{ route('produtos.clientes') }}">Categorias</a>
      <span class="sep"><i class="bi bi-chevron-right"></i></span>
      <span class="cur">{{ $categoria->name }}</span>
    </div>

    <div class="hero-cat-badge">
      <i class="bi bi-capsule-pill"></i>
      Categoria de medicamentos
    </div>

    <h2>{{ $categoria->name }}</h2>

    @if($categoria->descricao)
      <p class="cat-desc">{{ $categoria->descricao }}</p>
    @endif

    <div class="stats-strip">
      <div class="stat-item">
        <div>
          <strong>{{ $categoria->medicamentos()->count() }}</strong>
          <span>Medicamentos</span>
        </div>
      </div>
      <div class="stat-sep"></div>
      <div class="stat-item">
        <div>
          @php
            // Contagem de farmácias distintas que têm stock deste medicamento
            $farmaciasCount = \App\Models\StockItem::whereHas('medicamento', function($q) use ($categoria) {
                $q->where('categoria_id', $categoria->id);
            })->distinct('farmacia_id')->count('farmacia_id');
          @endphp
          <strong>{{ $farmaciasCount }}</strong>
          <span>Farmácias</span>
        </div>
      </div>
      <div class="stat-sep"></div>
      <div class="stat-item">
        <div>
          {{-- Como não há campo de desconto, exibimos quantidade de medicamentos com stock > 0 --}}
          @php
            $comStock = $categoria->medicamentos()->whereHas('stockItems', function($q) {
                $q->where('ativo', 1)->where('quantidade', '>', 0);
            })->count();
          @endphp
          <strong>{{ $comStock }}</strong>
          <span>Disponíveis</span>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     MAIN
══════════════════════════════════════════════════════ -->
<div class="main-wrap">
  <div class="container-xl">
    <div class="page-layout mt-4">

      <!-- ────────────── SIDEBAR ────────────── -->
      <aside class="sidebar">

        <!-- Filtros -->
        <form action="{{ route('produtos.categoria', $categoria->id) }}" method="GET">
          <div class="sidebar-card always-show">
            <div class="sc-header">
              <i class="bi bi-sliders"></i>
              <h6>Filtros</h6>
            </div>

            <!-- Preço -->
            <div class="filter-group">
              <span class="filter-label">Preço (Kz)</span>
              <div class="price-row">
                <input class="price-input" type="number" name="preco_min" value="{{ request('preco_min') }}" placeholder="Mín">
                <span class="price-sep">—</span>
                <input class="price-input" type="number" name="preco_max" value="{{ request('preco_max') }}" placeholder="Máx">
              </div>
            </div>

            <!-- Disponibilidade -->
            <div class="filter-group">
              <span class="filter-label">Disponibilidade</span>
              <div class="check-list">
                <label class="check-item">
                  <input type="checkbox" name="em_stock" value="1" {{ request('em_stock') ? 'checked' : '' }}>
                  <label>Em stock</label>
                </label>
                <label class="check-item">
                  <input type="checkbox" name="com_desconto" value="1" {{ request('com_desconto') ? 'checked' : '' }}>
                  <label>Com desconto</label>
                </label>
                <label class="check-item">
                  <input type="checkbox" name="sem_receita" value="1" {{ request('sem_receita') ? 'checked' : '' }}>
                  <label>Sem receita médica</label>
                </label>
              </div>
            </div>

            <!-- Farmácia -->
            @php
              // Obtém as farmácias que têm stock de medicamentos desta categoria
              $farmacias = \App\Models\Farmacia::whereHas('stockItems.medicamento', function($q) use ($categoria) {
                  $q->where('categoria_id', $categoria->id);
              })->get();
            @endphp
            @if($farmacias->count())
            <div class="filter-group">
              <span class="filter-label">Farmácia</span>
              <div class="check-list">
                @foreach($farmacias as $farm)
                <label class="check-item">
                  <input type="checkbox" name="farmacias[]" value="{{ $farm->id }}"
                    {{ in_array($farm->id, (array) request('farmacias', [])) ? 'checked' : '' }}>
                  <label>{{ $farm->name }}</label>
                </label>
                @endforeach
              </div>
            </div>
            @endif

            <div class="filter-group">
              <button type="submit" class="btn-filter">
                <i class="bi bi-funnel-fill me-1"></i> Aplicar filtros
              </button>
              <a href="{{ route('produtos.categoria', $categoria->id) }}" class="btn-reset d-block text-center text-decoration-none">
                Limpar filtros
              </a>
            </div>
          </div>
        </form>

      </aside>

      <!-- ────────────── CONTENT ────────────── -->
      <div class="content-area">

        <!-- Toolbar -->
        <div class="toolbar-bar mt-4">
          <span class="result-count">
            <strong>{{ $medicamentos->total() }}</strong> medicamento{{ $medicamentos->total() != 1 ? 's' : '' }}
            @if(request()->hasAny(['preco_min','preco_max','em_stock','com_desconto','sem_receita','farmacias']))
              <span style="color:var(--accent);"> · filtros activos</span>
            @endif
          </span>

          <form action="{{ route('produtos.categoria', $categoria->id) }}" method="GET" style="margin-left:auto;">
            @foreach(request()->except('sort') as $k => $v)
              @if(is_array($v))
                @foreach($v as $vi)
                  <input type="hidden" name="{{ $k }}[]" value="{{ $vi }}">
                @endforeach
              @else
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
              @endif
            @endforeach
            <select class="sort-sel" name="sort" onchange="this.form.submit()">
              <option value="default"  {{ request('sort','default')==='default'  ? 'selected':'' }}>Relevância</option>
              <option value="preco_az" {{ request('sort')==='preco_az' ? 'selected':'' }}>Preço: menor → maior</option>
              <option value="preco_za" {{ request('sort')==='preco_za' ? 'selected':'' }}>Preço: maior → menor</option>
              <option value="name_az"  {{ request('sort')==='name_az'  ? 'selected':'' }}>Nome A → Z</option>
              <option value="novo"     {{ request('sort')==='novo'     ? 'selected':'' }}>Mais recentes</option>
            </select>
          </form>

          <div class="view-btns">
            <button class="vb active" id="vGrid" onclick="setView('grid')" title="Grelha"><i class="bi bi-grid"></i></button>
            <button class="vb"        id="vList" onclick="setView('list')" title="Lista"><i class="bi bi-list-ul"></i></button>
          </div>
        </div>

        <!-- ══════════ GRID DE MEDICAMENTOS ══════════ -->
        @if($medicamentos->isEmpty())

          <div class="empty-state">
            <span class="ei">💊</span>
            <h5>Sem medicamentos nesta categoria</h5>
            <p>Ainda não existem medicamentos registados em <strong>{{ $categoria->name }}</strong>.</p>
          </div>

        @else

          <div class="prod-grid" id="prodGrid">

            @foreach($medicamentos as $med)
              @php
                  // Pega o primeiro StockItem activo com quantidade > 0
                  $stock = $med->stockItems
                               ->where('ativo', 1)
                               ->where('quantidade', '>', 0)
                               ->first();
              @endphp

              <div class="prod-card">

                {{-- IMAGEM --}}
                <div class="pc-img">
                  @if($med->img ?? false)
                    <img src="{{ asset('storage/img/'.$med->img) }}" alt="{{ $med->name }}" loading="lazy">
                  @else
                    <div class="pc-img-placeholder">💊</div>
                  @endif
                  <button class="pc-fav" title="Favoritos"><i class="bi bi-heart"></i></button>
                </div>

                {{-- CORPO --}}
                <div class="pc-body">
                  <div class="pc-cat">{{ $categoria->name }}</div>
                  <div class="pc-name">{{ $med->name }}</div>

                  @if($med->forma_farmaceutica)
                    <div class="pc-sub">{{ $med->forma_farmaceutica }} · {{ $med->dosagem }}</div>
                  @endif

                  {{-- Farmácia vem do StockItem --}}
                  @if($stock && $stock->farmacia)
                    <div class="pc-farm">
                      <i class="bi bi-hospital" style="font-size:.7rem;"></i>
                      {{ $stock->farmacia->name }}
                    </div>
                  @endif

                  @if ($med->requer_receita)
                    <div class="pc-sub"> 
                      <i class="bi bi-alert alert-danger" style="font-size:.7rem;"></i>
                       <h7 class="text-danger">  PRESCIÇÃO MÉDICA NECESSÁRIA</h7>
                       </div>

                  @endif
                </div>

                {{-- FOOTER COM PREÇO --}}
                <div class="pc-footer">
                  <div class="pc-price-wrap">
                    @if($stock)
                      <span class="pc-price">
                        {{ number_format($med->preco, 0, ',', ' ') }} <span class="cur">Kz</span>
                      </span>
                      <span style="font-size:.72rem; color:#22c55e; font-weight:600;">
                        {{ $stock->quantidade }} em stock
                      </span>
                    @else
                      <span style="font-size:.8rem; color:#ef4444; font-weight:700;">Sem stock</span>
                    @endif
                  </div>

                  {{-- Botão só activo se houver stock --}}
                  @if($stock)
                    <form action="{{ route('carrinho.adicionar') }}" method="POST">
                      @csrf
                      <input type="hidden" name="stock_item_id" value="{{ $stock->id }}">
                      <input type="hidden" name="quantidade"    value="1">
                      <button type="submit" class="btn-cart">
                        <i class="bi bi-bag-plus"></i> Adicionar
                      </button>
                    </form>
                  @else
                    <button class="btn-cart" disabled style="background:#e0e0e0;color:#aaa;cursor:not-allowed;">
                      Esgotado
                    </button>
                  @endif
                </div>

              </div>
            @endforeach

          </div>

          <!-- Paginação -->
          <div class="pagination-fc" id="pagination">
            {{ $medicamentos->links('vendor.pagination.fc-pagination') }}
          </div>

        @endif

      </div>
      {{-- /content-area --}}

    </div>
    {{-- /page-layout --}}
  </div>
</div>

<!-- FOOTER -->
@include('clientes.dashboard.footer')

<!-- Toast -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <span id="toastMsg">Adicionado ao carrinho!</span>
</div>

<button id="scroll-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <i class="bi bi-arrow-up-short"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  /* ── Vista grelha / lista ── */
  function setView(v) {
    document.getElementById('prodGrid')?.classList.toggle('list-mode', v === 'list');
    document.getElementById('vGrid').classList.toggle('active', v === 'grid');
    document.getElementById('vList').classList.toggle('active', v === 'list');
    localStorage.setItem('prodView', v);
  }
  const savedView = localStorage.getItem('prodView');
  if (savedView === 'list') setView('list');

  /* ── Favoritos (toggle visual) ── */
  document.querySelectorAll('.pc-fav').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      btn.classList.toggle('active');
      btn.querySelector('i').className = btn.classList.contains('active')
        ? 'bi bi-heart-fill' : 'bi bi-heart';
    });
  });

  /* ── Adicionar ao carrinho (feedback visual) ── */
  function addCart(btn) {
    btn.classList.add('added');
    btn.innerHTML = '<i class="bi bi-check-lg"></i> Adicionado';
    showToast('Produto adicionado ao carrinho!');
    setTimeout(() => {
      btn.classList.remove('added');
      btn.innerHTML = '<i class="bi bi-bag-plus"></i> Adicionar';
    }, 2500);
  }

  /* ── Toast ── */
  let toastTimer;
  function showToast(msg) {
    const t = document.getElementById('toastFc');
    document.getElementById('toastMsg').textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
  }

  /* ── Scroll ── */
  window.addEventListener('scroll', () => {
    document.getElementById('mainHeader').classList.toggle('scrolled', scrollY > 50);
    document.getElementById('scroll-top').style.display = scrollY > 320 ? 'flex' : 'none';
  });
</script>
</body>
</html>