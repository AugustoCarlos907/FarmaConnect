<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Resultados — FarmaConnect</title>

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
      --shadow-md:   0 16px 48px rgba(9,154,167,.13);
    }
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'Inter',-apple-system,sans-serif; background:#f4f8f8; color:var(--text); overflow-x:hidden; }

    /* ===== HEADER ===== */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; position:sticky; top:0; z-index:1000; transition:box-shadow .3s; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }
    .hdr-search { flex:1; max-width:520px; }
    .hdr-search .ig { border:1.5px solid var(--border); border-radius:50px; background:#f6fbfb; overflow:hidden; display:flex; align-items:center; transition:border-color .2s,box-shadow .2s; }
    .hdr-search .ig:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .hdr-search .ig-icon { padding:.6rem 0 .6rem 1.1rem; color:#a0b9bc; }
    .hdr-search .ig input { flex:1; border:none; background:transparent; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; outline:none; font-family:inherit; }
    .hdr-search .ig input::placeholder { color:#b0c4c6; }
    .hdr-search .ig-btn { background:transparent; border:none; color:var(--accent); padding:.6rem 1rem; font-size:1.2rem; cursor:pointer; }
    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
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

    /* ===== TOPBAR ===== */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:2rem 0 4rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:300px;height:300px;background:#fff;opacity:.07;top:-100px;right:-50px; }
    .tb2 { width:200px;height:200px;background:#a8ffd4;opacity:.06;bottom:-60px;left:5%; }
    .topbar-inner { position:relative; z-index:2; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.75rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .result-meta { color:rgba(255,255,255,.7); font-size:.9rem; margin-top:.35rem; display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; }
    .result-meta strong { color:#fff; }
    .result-meta .dot { width:3px; height:3px; border-radius:50%; background:rgba(255,255,255,.4); }

     .topbar-search { margin-top:1.6rem; max-width:520px; }

    .hero-search-bar { margin-top:1.6rem; max-width:520px; }
    .hsb-inner { background:rgba(255,255,255,.15); backdrop-filter:blur(14px); border:1.5px solid rgba(255,255,255,.25); border-radius:50px; display:flex; align-items:center; padding:.4rem .4rem .4rem 1.2rem; gap:.5rem; transition:all .25s; }
    .hsb-inner:focus-within { background:rgba(255,255,255,.22); border-color:rgba(255,255,255,.5); }
    .hsb-inner input { flex:1; background:none; border:none; outline:none; color:#fff; font-size:.9rem; font-family:inherit; }
    .hsb-inner input::placeholder { color:rgba(255,255,255,.55); }
    .hsb-btn { background:#fff; color:var(--accent); border:none; border-radius:50px; padding:.55rem 1.3rem; font-size:.86rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.4rem; transition:all .22s; white-space:nowrap; }
    .hsb-btn:hover { background:var(--soft); }

    /* Search re-bar no topbar */
    .ts-box { background:#fff; border-radius:20px; box-shadow:0 20px 50px rgba(0,0,0,.18); padding:1rem 1.3rem; display:flex; align-items:center; gap:1rem; flex-wrap:wrap; margin-top:1.5rem; }
    .ts-field { flex:1; min-width:180px; position:relative; }
    .ts-field i { position:absolute; left:.95rem; top:50%; transform:translateY(-50%); color:var(--accent); font-size:.95rem; pointer-events:none; }
    .ts-field input,.ts-field select { width:100%; border:1.5px solid var(--border); border-radius:50px; padding:.65rem 1rem .65rem 2.6rem; font-size:.9rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; transition:border-color .2s; }
    .ts-field input:focus,.ts-field select:focus { border-color:var(--accent); }
    .ts-sep { width:1px; height:36px; background:var(--border); flex-shrink:0; }
    .ts-btn { background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.68rem 1.6rem; font-size:.9rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.45rem; transition:all .22s; white-space:nowrap; }
    .ts-btn:hover { background:var(--accent-dark); }

    /* ===== LAYOUT ===== */
    .results-wrap { margin-top:-2rem; padding-bottom:5rem; }

    /* ===== SIDEBAR ===== */
    .filter-card { background:#fff; border-radius:20px; box-shadow:var(--shadow); overflow:hidden; position:sticky; top:88px; }
    .fc-head { padding:1rem 1.2rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .fc-head h6 { font-size:.88rem; font-weight:800; color:var(--heading); margin:0; display:flex; align-items:center; gap:.5rem; }
    .fc-head h6 i { color:var(--accent); }
    .fc-reset { font-size:.75rem; font-weight:700; color:var(--accent); background:none; border:none; cursor:pointer; font-family:inherit; }
    .fc-reset:hover { text-decoration:underline; }
    .fc-body { padding:1rem 1.2rem; }
    .fc-section { margin-bottom:1.2rem; padding-bottom:1.2rem; border-bottom:1px solid var(--border); }
    .fc-section:last-child { margin-bottom:0; padding-bottom:0; border-bottom:none; }
    .fc-label { font-size:.75rem; font-weight:700; color:var(--heading); margin-bottom:.65rem; display:block; }
    .fcheck-item { display:flex; align-items:center; gap:.55rem; padding:.28rem 0; cursor:pointer; }
    .fcheck-item input[type=checkbox] { width:15px; height:15px; accent-color:var(--accent); cursor:pointer; flex-shrink:0; }
    .fcheck-item label { font-size:.84rem; color:var(--text); cursor:pointer; flex:1; }
    .fcheck-count { font-size:.7rem; background:var(--mint); color:var(--accent); padding:.08rem .45rem; border-radius:50px; font-weight:700; }
    .sort-option { display:flex; align-items:center; gap:.6rem; padding:.45rem .55rem; border-radius:10px; cursor:pointer; transition:background .15s; font-size:.83rem; color:var(--text); border:none; background:none; width:100%; text-align:left; font-family:inherit; }
    .sort-option:hover { background:var(--mint); color:var(--accent); }
    .sort-option.active { background:var(--soft); color:var(--accent); font-weight:700; }
    .sort-option i { font-size:.8rem; width:14px; }

    /* ===== TOOLBAR ===== */
    .results-toolbar { background:#fff; border-radius:16px; box-shadow:var(--shadow); padding:.85rem 1.3rem; margin-bottom:1.1rem; display:flex; align-items:center; gap:1rem; flex-wrap:wrap; }
    .rt-count { font-size:.85rem; color:var(--muted); }
    .rt-count strong { color:var(--heading); }
    .view-toggle { display:flex; gap:.3rem; }
    .vt-btn { width:32px; height:32px; border:1.5px solid var(--border); background:#fff; border-radius:9px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:var(--muted); transition:all .2s; font-size:.88rem; }
    .vt-btn.active,.vt-btn:hover { background:var(--accent); color:#fff; border-color:var(--accent); }

    /* ===== GRID CARD ===== */
    .ph-card { background:#fff; border-radius:22px; overflow:hidden; box-shadow:var(--shadow); transition:all .28s; height:100%; border:2px solid transparent; display:flex; flex-direction:column; }
    .ph-card:hover { transform:translateY(-5px); border-color:var(--accent); box-shadow:var(--shadow-md); }
    .ph-img-wrap { position:relative; height:165px; overflow:hidden; }
    .ph-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .ph-card:hover .ph-img-wrap img { transform:scale(1.06); }
    .ph-img-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,transparent 40%,rgba(0,0,0,.35)); }
    .ph-badge-top { position:absolute; top:10px; left:12px; display:flex; gap:.4rem; }
    .ph-badge { font-size:.7rem; font-weight:700; padding:.22rem .7rem; border-radius:50px; backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,.3); }
    .ph-open   { background:rgba(34,197,94,.85); color:#fff; }
    .ph-closed { background:rgba(231,76,60,.85);  color:#fff; }
    .ph-fav-btn { position:absolute; top:10px; right:12px; width:32px; height:32px; background:rgba(255,255,255,.88); border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:.95rem; color:#b0c4c6; transition:all .2s; backdrop-filter:blur(8px); border:none; }
    .ph-fav-btn:hover,.ph-fav-btn.active { color:#e74c3c; transform:scale(1.15); }
    .ph-body { padding:1.1rem; flex:1; display:flex; flex-direction:column; }
    .ph-name { font-size:.95rem; font-weight:800; color:var(--heading); margin-bottom:.2rem; }
    .ph-loc  { font-size:.76rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.6rem; }
    .ph-rating { display:flex; align-items:center; gap:.3rem; font-size:.78rem; font-weight:700; color:var(--heading); margin-bottom:.7rem; }
    .ph-rating i { color:#f59e0b; font-size:.82rem; }
    .ph-reviews { font-size:.7rem; color:var(--muted); }
    .ph-schedule { font-size:.76rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.9rem; }
    .ph-schedule strong { color:var(--heading); }
    .ph-actions { display:flex; gap:.5rem; margin-top:auto; }
    .ph-btn { flex:1; padding:.5rem; text-align:center; border-radius:50px; text-decoration:none; font-weight:700; font-size:.8rem; transition:all .22s; cursor:pointer; border:none; font-family:inherit; display:flex; align-items:center; justify-content:center; gap:.35rem; }
    .ph-view  { background:var(--soft); color:var(--accent); }
    .ph-order { background:var(--accent); color:#fff; }
    .ph-view:hover  { background:var(--accent); color:#fff; }
    .ph-order:hover { background:var(--accent-dark); }

    /* ===== LIST CARD ===== */
    .ph-list-card { background:#fff; border-radius:18px; box-shadow:var(--shadow); border:2px solid transparent; transition:all .28s; overflow:hidden; display:none; align-items:stretch; margin-bottom:.8rem; }
    .ph-list-card:hover { border-color:var(--accent); box-shadow:var(--shadow-md); transform:translateY(-2px); }
    .ph-list-img { width:150px; flex-shrink:0; overflow:hidden; }
    .ph-list-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .ph-list-card:hover .ph-list-img img { transform:scale(1.05); }
    .ph-list-body { flex:1; padding:1rem 1.2rem; display:flex; flex-direction:column; justify-content:center; }
    .ph-list-actions { display:flex; flex-direction:column; justify-content:center; gap:.5rem; padding:.9rem 1.1rem; border-left:1px solid var(--border); min-width:150px; }

    /* Modo de vista */
    body.list-mode .ph-grid-item { display:none !important; }
    body.list-mode .ph-list-card { display:flex !important; }
    body.grid-mode .ph-grid-item { display:block !important; }
    body.grid-mode .ph-list-card { display:none !important; }

    /* ===== EMPTY ===== */
    .empty-state { background:#fff; border-radius:22px; box-shadow:var(--shadow); padding:4rem 2rem; text-align:center; }
    .empty-state .es-icon { font-size:4rem; display:block; margin-bottom:1rem; }
    .empty-state h4 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.4rem; }
    .empty-state p { color:var(--muted); font-size:.88rem; max-width:300px; margin:0 auto 1.4rem; }
    .btn-back { display:inline-flex; align-items:center; gap:.5rem; background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.65rem 1.6rem; font-size:.88rem; font-weight:700; font-family:inherit; cursor:pointer; text-decoration:none; }
    .btn-back:hover { background:var(--accent-dark); color:#fff; }

    /* ===== PAGINAÇÃO ===== */
    .pagination-wrap { display:flex; align-items:center; justify-content:space-between; margin-top:1.5rem; flex-wrap:wrap; gap:.6rem; }
    .pagination-wrap .pag-info { font-size:.82rem; color:var(--muted); }
    .pagination { display:flex; gap:.3rem; margin:0; }
    .page-item .page-link { border:1.5px solid var(--border); border-radius:10px; color:var(--heading); font-size:.82rem; font-weight:600; padding:.38rem .7rem; transition:all .15s; }
    .page-item .page-link:hover { background:var(--soft); border-color:var(--accent); color:var(--accent); }
    .page-item.active .page-link { background:var(--accent); border-color:var(--accent); color:#fff; }
    .page-item.disabled .page-link { opacity:.4; cursor:default; }

    /* ===== TOAST ===== */
    .toast-fc { position:fixed; bottom:28px; right:28px; background:var(--heading); color:#fff; border-radius:16px; padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem; box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px; pointer-events:none; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span { font-size:.78rem; color:rgba(255,255,255,.65); }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;} }
    .ph-card,.ph-list-card { animation:fadeUp .35s ease forwards; }

    @media(max-width:991px) { .filter-card{position:static;margin-bottom:1rem;} }
    @media(max-width:768px) { .hdr-search{display:none;} .ph-list-img{width:100px;} .ph-list-actions{min-width:120px;} }
    @media(max-width:576px) { .ph-list-actions{display:none;} }
  </style>
</head>
<body class="grid-mode">

<!-- ===== HEADER ===== -->
@include('clientes.dashboard.header')

<!-- ===== TOPBAR ===== -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">

    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <a href="{{ route('farmacias.list') }}">Farmácias</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <span class="cur">Resultados</span>
    </div>

    <h2>
      @if(request('query'))
        Resultados para <em style="font-style:normal;color:#a8ffd4">"{{ request('query') }}"</em>
      @else
        Todas as farmácias
      @endif
    </h2>
    <div class="result-meta">
      <strong>{{ $farmacias->total() }}</strong>
      farmácia{{ $farmacias->total() !== 1 ? 's' : '' }}
      encontrada{{ $farmacias->total() !== 1 ? 's' : '' }}
      <span class="dot"></span>
      Luanda, Angola
    </div>

    {{-- Barra de pesquisa — preserva o query actual, permite nova pesquisa --}}
      <div class="topbar-search ">

        <div class="hero-search-bar">
          <form action="{{ route('farmacias.search') }}" method="get">

            <div class="hsb-inner">
              <i class="bi bi-hospital"></i>
              <input type="text" id="searchPharm" name="query" placeholder="Nome ou bairro da farmácia..." oninput="filterPharmacies()" value="{{ request('query') }}">
    
              <button type="submit" class="hsb-btn"><i class="bi bi-search"></i> Pesquisar</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<!-- ===== CONTEÚDO PRINCIPAL ===== -->
<div class="results-wrap">
  <div class="container-xl">
    <div class="row g-4 mt-0">

      <!-- ════ SIDEBAR ════ -->
      <div class="col-lg-3 mt-4">
        <div class="filter-card mt-4">
          <div class="fc-head mt-4">
            <h6><i class="bi bi-sliders"></i> Filtros</h6>
            <a href="{{ route('farmacias.search', ['query' => request('query')]) }}"
               class="fc-reset">Limpar</a>
          </div>
          <div class="fc-body">
            <form action="{{ route('farmacias.search') }}" method="GET" id="filterForm">
              <input type="hidden" name="query" value="{{ request('query') }}">


              {{-- Ordenação --}}
              <div class="fc-section">
                <span class="fc-label">Ordenar por</span>
                @foreach([
                  ['relevancia', 'bi-stars',           'Relevância'],
                  ['rating',     'bi-star-fill',       'Melhor avaliação'],
                  ['nome',       'bi-sort-alpha-down', 'Nome A→Z'],
                ] as [$val, $icon, $lbl])
                  <button type="submit" name="sort" value="{{ $val }}"
                          class="sort-option {{ request('sort', 'relevancia') === $val ? 'active' : '' }}">
                    <i class="bi {{ $icon }}"></i> {{ $lbl }}
                  </button>
                @endforeach
              </div>

              <button type="submit"
                      style="width:100%;background:var(--accent);color:#fff;border:none;border-radius:12px;padding:.58rem;font-size:.84rem;font-weight:700;font-family:inherit;cursor:pointer">
                <i class="bi bi-funnel me-1"></i> Aplicar filtros
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- ════ RESULTADOS ════ -->
      <div class="col-lg-9 mt-5">

        @if($farmacias->isEmpty())

          <div class="empty-state">
            <span class="es-icon">🏥</span>
            <h4>Nenhuma farmácia encontrada</h4>
            <p>
              Não encontrámos resultados para
              <strong>"{{ request('query') }}"</strong>.
              Tente um nome diferente ou veja todas as farmácias.
            </p>
            <a href="{{ route('farmacias.list') }}" class="btn-back">
              <i class="bi bi-arrow-left"></i> Ver todas as farmácias
            </a>
          </div>

        @else

          {{-- Toolbar --}}
          <div class="results-toolbar">
            <span class="rt-count">
              <strong>{{ $farmacias->firstItem() }}–{{ $farmacias->lastItem() }}</strong>
              de <strong>{{ $farmacias->total() }}</strong> farmácias
            </span>
            <div class="view-toggle ms-auto">
              <button class="vt-btn active" id="btnGrid" onclick="setView('grid')" title="Grelha">
                <i class="bi bi-grid-3x3-gap"></i>
              </button>
              <button class="vt-btn" id="btnList" onclick="setView('list')" title="Lista">
                <i class="bi bi-list-ul"></i>
              </button>
            </div>
          </div>

          {{-- ── VISTA GRELHA ── --}}
          <div class="row g-4" id="gridContainer">
            @foreach($farmacias as $i => $farmacia)
              @php
                $rating   = round($farmacia->avaliacoes->avg('classificacao') ?? 0, 1);
                $nReviews = $farmacia->avaliacoes->count();
                // $aberta   = ($farmacia->status ?? '') === 'Aberta';
              @endphp
              <div class="col-md-6 col-xl-4 ph-grid-item"
                   style="animation-delay:{{ $i * 0.05 }}s">
                <div class="ph-card">
                  <div class="ph-img-wrap">
                    @if($farmacia->foto ?? false)
                      <img src="{{ asset('storage/'.$farmacia->foto) }}" alt="{{ $farmacia->name }}">
                    @else
                      <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=500&auto=format&fit=crop"
                           alt="{{ $farmacia->name }}">
                    @endif
                    <div class="ph-img-overlay"></div>
                    {{-- <div class="ph-badge-top">
                      <span class="ph-badge {{ $aberta ? 'ph-open' : 'ph-closed' }}">
                        <i class="bi bi-circle-fill" style="font-size:.42rem"></i>
                        {{ $aberta ? 'Aberta' : 'Fechada' }}
                      </span> --}}
                    {{-- </div> --}}
                    <button class="ph-fav-btn" onclick="toggleFav(this)" title="Favorito">
                      <i class="bi bi-heart"></i>
                    </button>
                  </div>
                  <div class="ph-body">
                    <div class="ph-name">{{ $farmacia->name }}</div>
                    <div class="ph-loc">
                      <i class="bi bi-geo-alt-fill"></i>
                      {{ $farmacia->bairro ?? $farmacia->endereco ?? '—' }}
                    </div>
                    <div class="ph-rating">
                      <i class="bi bi-star-fill"></i>
                      {{ number_format($rating, 1) }}
                      <span class="ph-reviews">({{ $nReviews }})</span>
                    </div>
                    <div class="ph-schedule">
                      <i class="bi bi-clock"></i>
                      Seg–Dom:&nbsp;
                      <strong>
                        {{ $farmacia->horario_abertura  ?? '08:00' }} –
                        {{ $farmacia->horario_fechamento ?? '22:00' }}
                      </strong>
                    </div>
                    <div class="ph-actions">
                      {{-- <a href="{{ route('farmacias.detail', $farmacia->id) }}"
                         class="ph-btn ph-view">
                        <i class="bi bi-eye"></i> Ver
                      </a>
                      <a href="{{ route('produtos.clientes', ['farmacia_id' => $farmacia->id]) }}"
                         class="ph-btn ph-order">
                        <i class="bi bi-bag-plus"></i> Encomendar
                      </a> --}}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>{{-- /gridContainer --}}

          {{-- ── VISTA LISTA ── --}}
          <div id="listContainer">
            @foreach($farmacias as $i => $farmacia)
              @php
                $rating   = round($farmacia->avaliacoes->avg('classificacao') ?? 0, 1);
                $nReviews = $farmacia->avaliacoes->count();
                // $aberta   = ($farmacia->status ?? '') === 'Aberta';
              @endphp
              <div class="ph-list-card"
                   style="animation-delay:{{ $i * 0.04 }}s">
                <div class="ph-list-img">
                  @if($farmacia->foto ?? false)
                    <img src="{{ asset('storage/'.$farmacia->foto) }}" alt="{{ $farmacia->name }}">
                  @else
                    <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=320&auto=format&fit=crop"
                         alt="{{ $farmacia->name }}">
                  @endif
                </div>
                <div class="ph-list-body">
                  <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <span style="font-size:.95rem;font-weight:800;color:var(--heading)">{{ $farmacia->name }}</span>
                    {{-- <span class="ph-badge {{ $aberta ? 'ph-open' : 'ph-closed' }}"
                          style="font-size:.68rem;padding:.18rem .6rem;border-radius:50px;border:none">
                      <i class="bi bi-circle-fill" style="font-size:.4rem"></i>
                      {{ $aberta ? 'Aberta' : 'Fechada' }}
                    </span> --}}
                  </div>
                  <div class="ph-loc mb-1">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $farmacia->bairro ?? $farmacia->endereco ?? '—' }}
                  </div>
                  <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="ph-rating" style="margin:0">
                      <i class="bi bi-star-fill"></i>
                      {{ number_format($rating, 1) }}
                      <span class="ph-reviews">({{ $nReviews }})</span>
                    </div>
                    <span style="font-size:.76rem;color:var(--muted)">
                      <i class="bi bi-clock"></i>
                      {{ $farmacia->horario_abertura  ?? '08:00' }} –
                      {{ $farmacia->horario_fechamento ?? '22:00' }}
                    </span>
                  </div>
                  @if($farmacia->descricao ?? false)
                    <p style="font-size:.78rem;color:var(--muted);margin-top:.4rem;
                               display:-webkit-box;-webkit-line-clamp:2;
                               -webkit-box-orient:vertical;overflow:hidden">
                      {{ $farmacia->descricao }}
                    </p>
                  @endif
                </div>
                {{-- <div class="ph-list-actions">
                  <a href="{{ route('farmacias.detail', $farmacia->id) }}"
                     class="ph-btn ph-view" style="width:100%">
                    <i class="bi bi-eye"></i> Ver
                  </a>
                  <a href="{{ route('produtos.clientes', ['farmacia_id' => $farmacia->id]) }}"
                     class="ph-btn ph-order" style="width:100%">
                    <i class="bi bi-bag-plus"></i> Encomendar
                  </a>
                </div> --}}
              </div>
            @endforeach
          </div>{{-- /listContainer --}}

          {{-- Paginação --}}
          @if($farmacias->hasPages())
            <div class="pagination-wrap">
              <span class="pag-info">
                Página {{ $farmacias->currentPage() }} de {{ $farmacias->lastPage() }}
              </span>
              {{ $farmacias->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
          @endif

        @endif

      </div>{{-- /col-lg-9 --}}
    </div>{{-- /row --}}
  </div>
</div>

<!-- ===== FOOTER ===== -->
@include('clientes.dashboard.footer')

<!-- Toast -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle">Sucesso</strong><span id="toastMsg"></span></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

/* ── VISTA ────────────────────────────────── */
function setView(v) {
  document.body.className = v + '-mode';
  document.getElementById('btnGrid').classList.toggle('active', v === 'grid');
  document.getElementById('btnList').classList.toggle('active', v === 'list');
  localStorage.setItem('fc_farm_view', v);
}
const _sv = localStorage.getItem('fc_farm_view');
if (_sv === 'list') setView('list');

/* ── FAVORITO ─────────────────────────────── */
function toggleFav(btn) {
  const on = btn.classList.toggle('active');
  btn.innerHTML = on ? '<i class="bi bi-heart-fill"></i>' : '<i class="bi bi-heart"></i>';
  showToast(on ? 'Adicionado aos favoritos' : 'Removido dos favoritos', '');
}

/* ── HEADER SCROLL ────────────────────────── */
window.addEventListener('scroll', () => {
  document.getElementById('mainHeader')?.classList.toggle('scrolled', scrollY > 50);
});

/* ── TOAST ────────────────────────────────── */
@if(session('success'))
  showToast('{{ session("success") }}', '');
@endif

function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = msg ? ' ' + msg : '';
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3200);
}

</script>
</body>
</html>