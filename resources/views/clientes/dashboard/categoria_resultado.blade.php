<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultados de Categorias — FarmaConnect</title>

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

    /* ── HEADER ── */
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

    /* ── TOPBAR ── */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:2rem 0 4.5rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:320px;height:320px;background:#fff;opacity:.08;top:-120px;right:-60px; }
    .tb2 { width:220px;height:220px;background:#a8ffd4;opacity:.06;bottom:-80px;left:8%; }
    .topbar-inner { position:relative; z-index:2; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.85rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .result-meta { color:rgba(255,255,255,.7); font-size:.9rem; margin-top:.35rem; display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; }
    .result-meta strong { color:#fff; }
    .result-meta .dot { width:3px; height:3px; border-radius:50%; background:rgba(255,255,255,.4); }

    /* Search re-bar */
    .hero-search-bar { margin-top:1.5rem; max-width:520px; }
    .hsb-inner { background:rgba(255,255,255,.15); backdrop-filter:blur(14px); border:1.5px solid rgba(255,255,255,.25); border-radius:50px; display:flex; align-items:center; padding:.4rem .4rem .4rem 1.2rem; gap:.5rem; transition:all .25s; }
    .hsb-inner:focus-within { background:rgba(255,255,255,.22); border-color:rgba(255,255,255,.5); }
    .hsb-inner input { flex:1; background:none; border:none; outline:none; color:#fff; font-size:.9rem; font-family:inherit; min-width:0; }
    .hsb-inner input::placeholder { color:rgba(255,255,255,.55); }
    .hsb-btn { background:#fff; color:var(--accent); border:none; border-radius:50px; padding:.55rem 1.3rem; font-size:.86rem; font-weight:700; font-family:inherit; cursor:pointer; display:flex; align-items:center; gap:.4rem; transition:all .22s; white-space:nowrap; flex-shrink:0; }
    .hsb-btn:hover { background:var(--soft); }

    /* ── MAIN WRAP ── */
    .main-wrap { margin-top:-2.2rem; padding-bottom:5rem; }

    /* ── TOOLBAR ── */
    .toolbar-bar { background:#fff; border-radius:18px; box-shadow:var(--shadow); padding:.85rem 1.3rem; margin-bottom:1.3rem; display:flex; align-items:center; gap:.85rem; flex-wrap:wrap; }
    .result-count { font-size:.88rem; color:var(--muted); }
    .result-count strong { color:var(--heading); font-weight:700; }
    .sort-sel { border:1.5px solid var(--border); border-radius:50px; padding:.4rem 1rem; font-size:.84rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; cursor:pointer; }
    .view-btns { display:flex; gap:.3rem; }
    .vb { width:34px; height:34px; border-radius:10px; border:1.5px solid var(--border); background:#fff; color:var(--muted); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.9rem; transition:all .2s; }
    .vb.active, .vb:hover { background:var(--accent); color:#fff; border-color:var(--accent); }

    /* ── GRID ── */
    .cat-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.1rem; }
    .cat-grid.list-mode { grid-template-columns:1fr; }

    /* ── CATEGORY CARD ── */
    .cat-card { background:#fff; border-radius:20px; box-shadow:var(--shadow); border:1.5px solid transparent; overflow:hidden; text-decoration:none; color:inherit; display:flex; flex-direction:column; transition:all .28s cubic-bezier(.4,0,.2,1); cursor:pointer; }
    .cat-card:hover { border-color:var(--accent); box-shadow:var(--shadow-md); transform:translateY(-5px); color:inherit; text-decoration:none; }

    .cc-img { height:140px; position:relative; overflow:hidden; flex-shrink:0; background:var(--mint); }
    .cc-img img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; display:block; }
    .cat-card:hover .cc-img img { transform:scale(1.07); }
    .cc-img-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(14,31,34,.55) 0%, transparent 60%); }
    .cc-arrow { position:absolute; bottom:12px; right:12px; width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,.9); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:.85rem; opacity:0; transform:translateX(-6px); transition:all .25s; }
    .cat-card:hover .cc-arrow { opacity:1; transform:translateX(0); }

    .cc-body { padding:1rem 1.1rem; flex:1; display:flex; flex-direction:column; gap:.3rem; }
    .cc-name { font-size:.95rem; font-weight:800; color:var(--heading); line-height:1.3; letter-spacing:-.01em; }
    .cc-desc { font-size:.76rem; color:var(--muted); line-height:1.4; }
    .cc-footer { display:flex; align-items:center; justify-content:space-between; margin-top:auto; padding-top:.5rem; flex-wrap:wrap; gap:.3rem; }
    .cc-count { font-size:.74rem; font-weight:700; background:var(--soft); color:var(--accent); padding:.2rem .7rem; border-radius:50px; }

    /* LIST MODE */
    .cat-grid.list-mode .cat-card { flex-direction:row; border-radius:16px; }
    .cat-grid.list-mode .cc-img { width:110px; height:auto; min-height:95px; flex-shrink:0; }
    .cat-grid.list-mode .cc-img img { height:100%; min-height:95px; }
    .cat-grid.list-mode .cc-body { padding:.85rem 1rem; }
    .cat-grid.list-mode .cc-name { font-size:.9rem; }

    /* HIGHLIGHT do termo pesquisado */
    .hl { background:#fff3b0; border-radius:3px; padding:0 2px; font-weight:700; }

    /* Animações */
    @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:none; } }
    .cat-card { opacity:0; animation:fadeUp .4s ease forwards; }
    .cat-card:nth-child(1){animation-delay:.04s} .cat-card:nth-child(2){animation-delay:.08s}
    .cat-card:nth-child(3){animation-delay:.12s} .cat-card:nth-child(4){animation-delay:.16s}
    .cat-card:nth-child(5){animation-delay:.20s} .cat-card:nth-child(6){animation-delay:.24s}

    /* Empty */
    .empty-state { background:#fff; border-radius:20px; box-shadow:var(--shadow); padding:4rem 2rem; text-align:center; }
    .empty-state .ei { font-size:3.5rem; display:block; margin-bottom:1rem; }
    .empty-state h5 { font-size:1.1rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-state p  { color:var(--muted); font-size:.9rem; max-width:280px; margin:0 auto 1.2rem; }
    .btn-voltar { background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.58rem 1.5rem; font-size:.86rem; font-weight:700; cursor:pointer; font-family:inherit; text-decoration:none; display:inline-flex; align-items:center; gap:.4rem; }
    .btn-voltar:hover { background:var(--accent-dark); color:#fff; }

    /* Paginação */
    .pag-wrap { display:flex; justify-content:space-between; align-items:center; margin-top:2rem; flex-wrap:wrap; gap:.6rem; }
    .pag-info { font-size:.82rem; color:var(--muted); }
    .pag-wrap .page-item .page-link { width:40px; height:40px; border-radius:12px !important; border:1.5px solid var(--border) !important; background:#fff; color:var(--muted); font-size:.88rem; font-weight:600; display:flex; align-items:center; justify-content:center; padding:0; font-family:'Inter',sans-serif; transition:all .2s; }
    .pag-wrap .page-item.active .page-link { background:var(--accent) !important; color:#fff !important; border-color:var(--accent) !important; box-shadow:0 4px 14px rgba(9,154,167,.28); }
    .pag-wrap .page-item.disabled .page-link { opacity:.38; pointer-events:none; }
    .pag-wrap .page-item:not(.active):not(.disabled) .page-link:hover { border-color:var(--accent) !important; color:var(--accent); }

    /* Scroll top */
    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; box-shadow:0 6px 20px rgba(9,154,167,.35); transition:all .3s; border:none; cursor:pointer; }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    @media(max-width:991px) { .cat-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:768px)  { .header-search { display:none; } }
    @media(max-width:576px)  { .cat-grid { grid-template-columns:1fr 1fr; } .cc-img { height:110px; } }
  </style>
</head>
<body>

@include('clientes.dashboard.header')

<!-- ══ TOPBAR ══════════════════════════════════ -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">

    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <a href="{{ route('produtos.clientes') }}">Categorias</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <span class="cur">Resultados</span>
    </div>

    <h2>
      @if(request('query'))
        Resultados para <em style="font-style:normal;color:#a8ffd4">"{{ request('query') }}"</em>
      @else
        Todas as categorias
      @endif
    </h2>
    <div class="result-meta">
      <strong>{{ $categorias->total() }}</strong>
      categoria{{ $categorias->total() !== 1 ? 's' : '' }}
      encontrada{{ $categorias->total() !== 1 ? 's' : '' }}
      @if(request('query'))
        <span class="dot"></span>
        Pesquisa: <strong>"{{ request('query') }}"</strong>
      @endif
    </div>

    {{-- Barra de pesquisa — mantém o query, permite nova pesquisa --}}
    <div class="hero-search-bar">
      <form action="{{ route('categorias.search') }}" method="GET">
        @if(request('sort'))
          <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif
        <div class="hsb-inner">
          <i class="bi bi-search" style="color:rgba(255,255,255,.6);flex-shrink:0"></i>
          <input type="text" name="query"
                 value="{{ request('query') }}"
                 placeholder="Pesquisar categoria...">
          <button type="submit" class="hsb-btn">
            <i class="bi bi-search"></i> Pesquisar
          </button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- ══ CONTEÚDO ══════════════════════════════ -->
<div class="main-wrap">
  <div class="container-xl">

    @if($categorias->isEmpty())

      <div class="empty-state mt-5">
        <span class="ei">🔍</span>
        <h5>Nenhuma categoria encontrada</h5>
        <p>
          Não encontrámos resultados
          @if(request('query'))
            para <strong>"{{ request('query') }}"</strong>
          @endif.
          Tente um termo diferente ou veja todas as categorias.
        </p>
        <a href="{{ route('produtos.clientes') }}" class="btn-voltar">
          <i class="bi bi-arrow-left"></i> Ver todas as categorias
        </a>
      </div>

    @else

      <!-- Toolbar -->
      <div class="toolbar-bar mt-5">
        <span class="result-count">
          <strong>{{ $categorias->firstItem() }}–{{ $categorias->lastItem() }}</strong>
          de <strong>{{ $categorias->total() }}</strong> categorias
          @if(request('query'))
            para "<strong>{{ e(request('query')) }}</strong>"
          @endif
        </span>

        {{-- Ordenação — submete GET preservando o query --}}
        <form action="{{ route('categorias.search') }}" method="GET" style="margin-left:auto">
          @if(request('query'))
            <input type="hidden" name="query" value="{{ request('query') }}">
          @endif
          <select class="sort-sel" name="sort" onchange="this.form.submit()">
            <option value="default" {{ request('sort','default') === 'default' ? 'selected' : '' }}>Ordem padrão</option>
            <option value="az"      {{ request('sort') === 'az' ? 'selected' : '' }}>Nome A → Z</option>
            <option value="za"      {{ request('sort') === 'za' ? 'selected' : '' }}>Nome Z → A</option>
          </select>
        </form>

        <div class="view-btns">
          <button class="vb active" id="vGrid" onclick="setView('grid')" title="Grelha">
            <i class="bi bi-grid"></i>
          </button>
          <button class="vb" id="vList" onclick="setView('list')" title="Lista">
            <i class="bi bi-list-ul"></i>
          </button>
        </div>
      </div>

      <!-- Grid de categorias -->
      <div class="cat-grid" id="catGrid">
        @foreach($categorias as $i => $cat)
          <a class="cat-card"
             href="{{ route('produtos.categoria', ['id' => $cat->id]) }}"
             title="{{ $cat->name }}"
             style="animation-delay:{{ $i * 0.06 }}s">

            <div class="cc-img">
              {{-- @if($cat->imagem )
                <img src="{{ asset("$cat->imagem") }}" alt="{{ $cat->name }}" loading="lazy">
              @else --}}
                <img src="{{'https://conceito.de/wp-content/uploads/2023/03/pill-1884775_1280.jpg' }}"
                     alt="{{ $cat->name }}" loading="lazy">
              {{-- @endif --}}
              <div class="cc-img-overlay"></div>
              <div class="cc-arrow"><i class="bi bi-arrow-right"></i></div>
            </div>

            <div class="cc-body">
              <div class="cc-name">
                {{--
                  Highlight do termo pesquisado no nome da categoria.
                  Usa e() para escapar e depois realça o termo com <span class="hl">.
                --}}
                @if(request('query'))
                  {!! preg_replace(
                    '/('.preg_quote(e(request('query')), '/').')/iu',
                    '<span class="hl">$1</span>',
                    e($cat->name)
                  ) !!}
                @else
                  {{ $cat->name }}
                @endif
              </div>

              @if($cat->descricao)
                <div class="cc-desc">{{ Str::limit($cat->descricao, 65) }}</div>
              @endif

              <div class="cc-footer">
                <span class="cc-count">
                  <i class="bi bi-capsule-pill" style="font-size:.7rem"></i>
                  {{ $cat->medicamentos->count() }} medicamentos
                </span>
              </div>
            </div>

          </a>
        @endforeach
      </div>{{-- /cat-grid --}}

      <!-- Paginação -->
      @if($categorias->hasPages())
        <div class="pag-wrap">
          <span class="pag-info">
            Página {{ $categorias->currentPage() }} de {{ $categorias->lastPage() }}
          </span>
          <ul class="pagination mb-0">
            <li class="page-item {{ $categorias->onFirstPage() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $categorias->previousPageUrl() }}">
                <i class="bi bi-chevron-left"></i>
              </a>
            </li>
            @foreach($categorias->getUrlRange(1, $categorias->lastPage()) as $page => $url)
              <li class="page-item {{ $page == $categorias->currentPage() ? 'active' : '' }}">
                <a class="page-link"
                   href="{{ $categorias->appends(request()->query())->url($page) }}">
                  {{ $page }}
                </a>
              </li>
            @endforeach
            <li class="page-item {{ !$categorias->hasMorePages() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $categorias->nextPageUrl() }}">
                <i class="bi bi-chevron-right"></i>
              </a>
            </li>
          </ul>
        </div>
      @endif

    @endif

  </div>
</div>

@include('clientes.dashboard.footer')

<button id="scroll-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <i class="bi bi-arrow-up-short"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  /* ── Vista grelha / lista ─────────────────── */
  function setView(v) {
    document.getElementById('catGrid').classList.toggle('list-mode', v === 'list');
    document.getElementById('vGrid').classList.toggle('active', v === 'grid');
    document.getElementById('vList').classList.toggle('active', v === 'list');
    localStorage.setItem('catResultView', v);
  }
  const _sv = localStorage.getItem('catResultView');
  if (_sv === 'list') setView('list');

  /* ── Header scroll + scroll-top ──────────── */
  window.addEventListener('scroll', () => {
    document.getElementById('mainHeader')?.classList.toggle('scrolled', scrollY > 50);
    document.getElementById('scroll-top').style.display = scrollY > 320 ? 'flex' : 'none';
  });
</script>
</body>
</html>