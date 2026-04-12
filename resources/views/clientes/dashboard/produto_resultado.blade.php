<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    body { font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; background:#f4f8f8; color:var(--text); overflow-x:hidden; }

    /* ===== HEADER ===== */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; position:sticky; top:0; z-index:1000; transition:box-shadow .3s; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }

    /* Search bar — igual ao header original */
    .header-search { flex:1; max-width:560px; }
    .ig { border:1.5px solid var(--border); border-radius:50px; background:#f6fbfb; overflow:hidden; display:flex; align-items:center; transition:border-color .2s,box-shadow .2s; }
    .ig:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .ig-icon { padding:.6rem 0 .6rem 1.1rem; color:#a0b9bc; }
    .search-form { flex:1; display:flex; align-items:center; }
    .search-input { flex:1; border:none; background:transparent; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; outline:none; font-family:inherit; min-width:0; }
    .search-input::placeholder { color:#b0c4c6; }
    .price-label { font-size:.75rem; color:var(--muted); white-space:nowrap; padding-left:.5rem; }
    .min-price-input { width:80px; border:none; background:transparent; padding:.5rem 0 .5rem .2rem; font-size:.85rem; color:var(--heading); outline:none; font-family:inherit; }
    .search-btn { background:transparent; border:none; color:var(--accent); padding:.6rem 1rem; font-size:1.2rem; cursor:pointer; flex-shrink:0; }

    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu a { color:var(--heading); font-weight:600; font-size:.88rem; padding:.42rem .85rem; border-radius:50px; text-decoration:none; transition:.2s; white-space:nowrap; }
    .navmenu a:hover { background:var(--soft); color:var(--accent); }
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

    /* ===== LAYOUT ===== */
    .results-wrap { margin-top:-2rem; padding-bottom:5rem; }

    /* ===== FILTROS SIDEBAR ===== */
    .filter-card { background:#fff; border-radius:20px; box-shadow:var(--shadow); overflow:hidden; position:sticky; top:88px; }
    .fc-head { padding:1rem 1.2rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .fc-head h6 { font-size:.88rem; font-weight:800; color:var(--heading); margin:0; display:flex; align-items:center; gap:.5rem; }
    .fc-head h6 i { color:var(--accent); }
    .fc-reset { font-size:.75rem; font-weight:700; color:var(--accent); background:none; border:none; cursor:pointer; font-family:inherit; }
    .fc-reset:hover { text-decoration:underline; }
    .fc-body { padding:1rem 1.2rem; }
    .fc-section { margin-bottom:1.2rem; padding-bottom:1.2rem; border-bottom:1px solid var(--border); }
    .fc-section:last-child { margin-bottom:0; padding-bottom:0; border-bottom:none; }
    .fc-label { font-size:.75rem; font-weight:700; color:var(--heading); margin-bottom:.7rem; display:block; }

    /* range de preço */
    .price-range { display:flex; gap:.5rem; align-items:center; }
    .price-input { flex:1; border:1.5px solid var(--border); border-radius:10px; padding:.45rem .7rem; font-size:.82rem; font-family:inherit; color:var(--heading); outline:none; transition:border-color .2s; }
    .price-input:focus { border-color:var(--accent); }
    .price-sep { color:var(--muted); font-size:.8rem; }

    /* ordenação */
    .sort-option { display:flex; align-items:center; gap:.6rem; padding:.5rem .6rem; border-radius:10px; cursor:pointer; transition:background .15s; font-size:.83rem; color:var(--text); }
    .sort-option:hover { background:var(--mint); color:var(--accent); }
    .sort-option.active { background:var(--soft); color:var(--accent); font-weight:700; }
    .sort-option i { font-size:.82rem; width:14px; text-align:center; }

    /* distância toggle */
    .dist-pills { display:flex; gap:.4rem; flex-wrap:wrap; }
    .dist-pill { padding:.3rem .75rem; border-radius:50px; border:1.5px solid var(--border); font-size:.75rem; font-weight:600; color:var(--muted); cursor:pointer; transition:all .18s; background:#fff; font-family:inherit; }
    .dist-pill:hover { border-color:var(--accent); color:var(--accent); }
    .dist-pill.active { background:var(--accent); border-color:var(--accent); color:#fff; }

    /* ===== TOOLBAR RESULTADOS ===== */
    .results-toolbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem; flex-wrap:wrap; gap:.6rem; }
    .rt-count { font-size:.84rem; color:var(--muted); }
    .rt-count strong { color:var(--heading); }
    .view-toggle { display:flex; border:1.5px solid var(--border); border-radius:10px; overflow:hidden; }
    .vt-btn { padding:.38rem .7rem; border:none; background:#fff; color:var(--muted); cursor:pointer; font-size:.9rem; transition:all .15s; }
    .vt-btn:hover { background:var(--mint); color:var(--accent); }
    .vt-btn.active { background:var(--accent); color:#fff; }

    /* ===== CARDS DE RESULTADO ===== */

    /* Vista grelha */
    .results-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(220px,1fr)); gap:1rem; }

    .med-card { background:#fff; border-radius:18px; box-shadow:var(--shadow); overflow:hidden; border:1.5px solid transparent; transition:all .25s; cursor:pointer; display:flex; flex-direction:column; }
    .med-card:hover { border-color:var(--accent); transform:translateY(-3px); box-shadow:var(--shadow-md); }

    .mc-img { height:140px; overflow:hidden; background:var(--mint); display:flex; align-items:center; justify-content:center; font-size:3.5rem; flex-shrink:0; position:relative; }
    .mc-img img { width:100%; height:100%; object-fit:cover; }
    .mc-dist-badge { position:absolute; bottom:8px; right:8px; background:rgba(255,255,255,.92); border-radius:50px; padding:.2rem .6rem; font-size:.65rem; font-weight:700; color:var(--heading); display:flex; align-items:center; gap:3px; }
    .mc-dist-badge i { color:var(--accent); font-size:.62rem; }

    .mc-body { padding:.9rem; flex:1; display:flex; flex-direction:column; }
    .mc-cat { font-size:.65rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.05em; margin-bottom:.2rem; }
    .mc-name { font-size:.9rem; font-weight:700; color:var(--heading); line-height:1.3; margin-bottom:.2rem; }
    .mc-form { font-size:.73rem; color:var(--muted); margin-bottom:.5rem; }
    .mc-pharm { font-size:.72rem; color:var(--muted); display:flex; align-items:center; gap:.3rem; margin-bottom:.65rem; }
    .mc-pharm i { color:var(--accent); font-size:.7rem; }
    .mc-footer { display:flex; align-items:center; justify-content:space-between; margin-top:auto; }
    .mc-price { font-size:1.05rem; font-weight:800; color:var(--heading); }
    .mc-price-unit { font-size:.65rem; color:var(--muted); font-weight:400; }
    .mc-add { width:32px; height:32px; border-radius:50%; background:var(--accent); color:#fff; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.9rem; transition:all .2s; flex-shrink:0; }
    .mc-add:hover { background:var(--accent-dark); transform:scale(1.1); }
    .mc-add.added { background:#22c55e; }

    /* Vista lista */
    .results-list { display:flex; flex-direction:column; gap:.75rem; }

    .med-row { background:#fff; border-radius:16px; box-shadow:var(--shadow); border:1.5px solid transparent; transition:all .22s; display:flex; align-items:center; gap:1rem; padding:.9rem 1.1rem; cursor:pointer; }
    .med-row:hover { border-color:var(--accent); box-shadow:var(--shadow-md); }
    .mr-img { width:64px; height:64px; border-radius:12px; background:var(--mint); display:flex; align-items:center; justify-content:center; font-size:2rem; flex-shrink:0; overflow:hidden; }
    .mr-img img { width:100%; height:100%; object-fit:cover; border-radius:12px; }
    .mr-info { flex:1; min-width:0; }
    .mr-name { font-size:.92rem; font-weight:700; color:var(--heading); margin-bottom:.15rem; }
    .mr-meta { font-size:.74rem; color:var(--muted); display:flex; align-items:center; gap:.6rem; flex-wrap:wrap; }
    .mr-meta i { font-size:.7rem; color:var(--accent); }
    .mr-right { display:flex; flex-direction:column; align-items:flex-end; gap:.5rem; flex-shrink:0; }
    .mr-price { font-size:1.05rem; font-weight:800; color:var(--heading); white-space:nowrap; }
    .mr-dist { font-size:.7rem; color:var(--muted); display:flex; align-items:center; gap:.25rem; }
    .mr-dist i { color:var(--accent); font-size:.68rem; }
    .mr-add { padding:.38rem .9rem; border-radius:50px; background:var(--accent); color:#fff; border:none; font-size:.78rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:.35rem; white-space:nowrap; }
    .mr-add:hover { background:var(--accent-dark); }
    .mr-add.added { background:#22c55e; }

    /* ===== EMPTY STATE ===== */
    .empty-state { background:#fff; border-radius:22px; box-shadow:var(--shadow); padding:4rem 2rem; text-align:center; }
    .empty-state .es-icon { font-size:4rem; display:block; margin-bottom:1rem; }
    .empty-state h4 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.4rem; }
    .empty-state p { color:var(--muted); font-size:.88rem; max-width:300px; margin:0 auto 1.4rem; }
    .btn-search-again { display:inline-flex; align-items:center; gap:.5rem; background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.68rem 1.6rem; font-size:.9rem; font-weight:700; font-family:inherit; cursor:pointer; text-decoration:none; }
    .btn-search-again:hover { background:var(--accent-dark); color:#fff; }

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

    /* ===== ANIMAÇÕES ===== */
    @keyframes fadeUp { from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:none;} }
    .med-card,.med-row { animation:fadeUp .35s ease forwards; }

    @media(max-width:991px) { .filter-card{position:static;margin-bottom:1rem;} }
    @media(max-width:768px) { .results-grid{grid-template-columns:repeat(2,1fr);} .header-search{display:none;} }
    @media(max-width:480px) { .results-grid{grid-template-columns:1fr;} }
  </style>
</head>
<body>

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
      <a href="{{ route('produtos.clientes') }}">Produtos</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <span class="cur">Resultados</span>
    </div>
    <h2>
      @if(request('search'))
        Resultados para <em style="font-style:normal;color:#a8ffd4">"{{ request('search') }}"</em>
      @else
        Todos os medicamentos
      @endif
    </h2>
    <div class="result-meta">
      <strong>{{ $medicamentos->total() }}</strong> resultado{{ $medicamentos->total() !== 1 ? 's' : '' }} encontrado{{ $medicamentos->total() !== 1 ? 's' : '' }}
      @if(request('min_price'))
        <span class="dot"></span>
        Preço mínimo: <strong>{{ number_format(request('min_price'), 0, ',', '.') }} Kz</strong>
      @endif
      <span class="dot"></span>
      Ordenado por proximidade
    </div>
  </div>
</div>

<!-- ===== MAIN ===== -->
<div class="results-wrap">
  <div class="container-xl">
    <div class="row g-4 mt-4">

      <!-- ════ SIDEBAR FILTROS ════ -->
      <div class="col-lg-3 mt-4">
        <div class="filter-card">
          <div class="fc-head">
            <h6><i class="bi bi-sliders"></i> Filtros</h6>
            <a href="{{ route('medicamentos.search', ['search' => request('search')]) }}" class="fc-reset">
              Limpar
            </a>
          </div>
          <div class="fc-body">

            {{-- Intervalo de preço --}}
            <form action="{{ route('medicamentos.search') }}" method="GET" id="filterForm">
              <input type="hidden" name="search" value="{{ request('search') }}">

              <div class="fc-section">
                <span class="fc-label">Intervalo de preço (Kz)</span>
                <div class="price-range">
                  <input type="number" name="min_price" class="price-input "
                         placeholder="Mín" step="100"
                         value="{{ request('min_price') }}">
                </div>
              </div>

              {{-- Distância --}}
              <div class="fc-section">
                <span class="fc-label">Distância máxima</span>
                <div class="dist-pills">
                  @foreach([1,3,5,10,20] as $km)
                    <button type="submit" name="max_dist" value="{{ $km }}"
                            class="dist-pill {{ request('max_dist') == $km ? 'active' : '' }}">
                      {{ $km }} km
                    </button>
                  @endforeach
                </div>
              </div>

              {{-- Ordenação --}}
              <div class="fc-section">
                <span class="fc-label">Ordenar por</span>
                @foreach([
                  ['distancia','bi-geo-alt','Mais próximo'],
                  ['preco_asc','bi-sort-numeric-down','Menor preço'],
                  ['preco_desc','bi-sort-numeric-up','Maior preço'],
                ] as [$val, $icon, $lbl])
                  <button type="submit" name="sort" value="{{ $val }}"
                          class="sort-option w-100 text-start {{ request('sort', 'distancia') === $val ? 'active' : '' }}">
                    <i class="bi {{ $icon }}"></i> {{ $lbl }}
                  </button>
                @endforeach
              </div>

              <button type="submit" class="btn w-100" style="background:var(--accent);color:#fff;border:none;border-radius:12px;padding:.6rem;font-size:.85rem;font-weight:700;font-family:inherit;cursor:pointer">
                <i class="bi bi-funnel me-1"></i> Aplicar filtros
              </button>
            </form>

          </div>
        </div>
      </div>

      <!-- ════ COLUNA DE RESULTADOS ════ -->
      <div class="col-lg-9 mt-2">

        @if($medicamentos->isEmpty())

          {{-- Estado vazio --}}
          <div class="empty-state">
            <span class="es-icon">🔍</span>
            <h4>Nenhum medicamento encontrado</h4>
            <p>
              Não encontrámos resultados para
              <strong>"{{ request('search') }}"</strong>
              @if(request('min_price'))
                com preço mínimo de {{ number_format(request('min_price'), 0, ',', '.') }} Kz
              @endif
              nas farmácias próximas de si.
            </p>
            <a href="{{ route('produtos.clientes') }}" class="btn-search-again">
              <i class="bi bi-arrow-left"></i> Ver todos os produtos
            </a>
          </div>

        @else

          {{-- Toolbar --}}
          <div class="results-toolbar mt-4">
            <span class="rt-count">
              <strong>{{ $medicamentos->firstItem() }}–{{ $medicamentos->lastItem() }}</strong>
              de <strong>{{ $medicamentos->total() }}</strong> resultados
            </span>
            <div class="view-toggle">
              <button class="vt-btn active" id="btnGrid" onclick="setView('grid')" title="Grelha">
                <i class="bi bi-grid-3x3-gap"></i>
              </button>
              <button class="vt-btn" id="btnList" onclick="setView('list')" title="Lista">
                <i class="bi bi-list-ul"></i>
              </button>
            </div>
          </div>

          {{-- Vista grelha (default) --}}
          <div class="results-grid" id="viewGrid">
            @foreach($medicamentos as $i => $stock)
              @php
                $med   = $stock->medicamento;
                $farm  = $stock->farmacia;
                $dist  = isset($stock->distancia) ? round($stock->distancia, 1) : null;
              @endphp

              <div class="med-card" style="animation-delay:{{ $i * 0.04 }}s">
                <div class="mc-img">
                  @if($med->img ?? false)
                    <img src="{{ asset('storage/img/'.$med->img) }}" alt="{{ $med->name }}">
                  @else
                    💊
                  @endif
                  @if($dist !== null)
                    <div class="mc-dist-badge">
                      <i class="bi bi-geo-alt-fill"></i> {{ $dist }} km
                    </div>
                  @endif
                </div>
                <div class="mc-body">
                  <div class="mc-cat">{{ $med->categoria->name ?? 'Medicamento' }}</div>
                  <div class="mc-name">{{ $med->name }}</div>
                  @if($med->forma_farmaceutica ?? false)
                    <div class="mc-form">{{ $med->forma_farmaceutica }}{{ $med->dosagem ? ' · '.$med->dosagem : '' }}</div>
                  @endif
                  <div class="mc-pharm">
                    <i class="bi bi-hospital"></i>
                    {{ $farm->name ?? '—' }}
                  </div>
                  <div class="mc-footer">
                    <div>
                      <div class="mc-price">{{ number_format($stock->preco, 0, ',', '.') }} Kz</div>
                      <div class="mc-price-unit">por unidade</div>
                    </div>
                    <form action="{{ route('carrinho.adicionar') }}" method="POST">
                      @csrf
                      <input type="hidden" name="stock_item_id" value="{{ $stock->id }}">
                      <input type="hidden" name="quantidade"    value="1">
                      <button type="submit" class="mc-add" title="Adicionar ao carrinho">
                        <i class="bi bi-bag-plus"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>

            @endforeach
          </div>

          {{-- Vista lista (oculta por defeito) --}}
          <div class="results-list d-none" id="viewList">
            @foreach($medicamentos as $i => $stock)
              @php
                $med  = $stock->medicamento;
                $farm = $stock->farmacia;
                $dist = isset($stock->distancia) ? round($stock->distancia, 1) : null;
              @endphp

              <div class="med-row" style="animation-delay:{{ $i * 0.03 }}s">
                <div class="mr-img">
                  @if($med->imagem ?? false)
                    <img src="{{ asset('storage/'.$med->imagem) }}" alt="{{ $med->name }}">
                  @else
                    💊
                  @endif
                </div>
                <div class="mr-info">
                  <div class="mr-name">{{ $med->name }}</div>
                  <div class="mr-meta">
                    <span><i class="bi bi-hospital"></i> {{ $farm->name ?? '—' }}</span>
                    @if($med->forma_farmaceutica ?? false)
                      <span><i class="bi bi-box"></i> {{ $med->forma_farmaceutica }}{{ $med->dosagem ? ' · '.$med->dosagem : '' }}</span>
                    @endif
                    @if($dist !== null)
                      <span><i class="bi bi-geo-alt-fill"></i> {{ $dist }} km</span>
                    @endif
                    <span>Stock: {{ $stock->quantidade }}</span>
                  </div>
                </div>
                <div class="mr-right">
                  <div class="mr-price">{{ number_format($stock->preco, 0, ',', '.') }} Kz</div>
                  <form action="{{ route('carrinho.adicionar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="stock_item_id" value="{{ $stock->id }}">
                    <input type="hidden" name="quantidade"    value="1">
                    <button type="submit" class="mr-add">
                      <i class="bi bi-bag-plus"></i> Adicionar
                    </button>
                  </form>
                </div>
              </div>

            @endforeach
          </div>

          {{-- Paginação --}}
          @if($medicamentos->hasPages())
            <div class="pagination-wrap">
              <span class="pag-info">
                Página {{ $medicamentos->currentPage() }} de {{ $medicamentos->lastPage() }}
              </span>
              {{ $medicamentos->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
          @endif

        @endif

      </div>

    </div>
  </div>
</div>

<!-- ===== FOOTER ===== -->
@include('clientes.dashboard.footer')

<!-- ===== TOAST ===== -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle">Adicionado!</strong><span id="toastMsg"></span></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

/* ── VISTA GRELHA / LISTA ───────────────────── */
function setView(v) {
  const grid = document.getElementById('viewGrid');
  const list = document.getElementById('viewList');
  document.getElementById('btnGrid').classList.toggle('active', v === 'grid');
  document.getElementById('btnList').classList.toggle('active', v === 'list');
  grid.classList.toggle('d-none', v !== 'grid');
  list.classList.toggle('d-none', v !== 'list');
  localStorage.setItem('fc_view', v);
}

/* Restaurar vista preferida */
const savedView = localStorage.getItem('fc_view');
if (savedView === 'list') setView('list');

/* ── SCROLL HEADER ──────────────────────────── */
window.addEventListener('scroll', () => {
  document.getElementById('mainHeader')?.classList.toggle('scrolled', scrollY > 50);
});

/* ── FLASH DE SESSÃO ────────────────────────── */
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