<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Documentos</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:        #0899a6;
      --accent-2:      #05707a;
      --accent-light:  #e6f7f8;
      --accent-mid:    #b2e8ec;
      --danger:        #d94040;
      --danger-light:  #fdecea;
      --warning:       #d97706;
      --warning-light: #fef3c7;
      --success:       #16a34a;
      --success-light: #dcfce7;
      --bg:            #f1f5f9;
      --surface:       #ffffff;
      --surface-2:     #f8fafc;
      --border:        #e2e8f0;
      --border-strong: #cbd5e1;
      --text:          #0f172a;
      --text-2:        #334155;
      --text-3:        #64748b;
      --text-4:        #94a3b8;
      --shadow-md:     0 4px 16px rgba(0,0,0,.08);
      --topbar-h:      52px;
      --r-sm: 6px; --r-md: 10px; --r-lg: 14px; --r-xl: 18px;
    }

    html { font-size: 13px; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; -webkit-font-smoothing: antialiased; }
    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ─────────────────────────── */
    .sidebar { width: 220px; flex-shrink: 0; background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; z-index: 200; }
    .sidebar-header { height: var(--topbar-h); min-height: var(--topbar-h); flex-shrink: 0; display: flex; align-items: center; padding: 0 16px; border-bottom: 1px solid var(--border); }
    .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; }
    .logo-mark { width: 28px; height: 28px; background: var(--accent); border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo-mark svg { width: 14px; height: 14px; fill: #fff; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); } .logo-text .c { color: var(--text); }
    .sidebar-body { flex: 1; overflow-y: auto; padding: 8px 0 12px; }
    .sidebar-body::-webkit-scrollbar { width: 0; }
    .nav-section { padding: 0 8px; }
    .nav-label { font-size: 0.67rem; font-weight: 600; color: var(--text-4); text-transform: uppercase; letter-spacing: .07em; padding: 10px 8px 4px; display: block; }
    .nav-item { display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: var(--r-md); font-size: 0.82rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: background .1s, color .1s; border: none; background: none; width: 100%; text-align: left; font-family: 'DM Sans', sans-serif; text-decoration: none; margin-bottom: 1px; }
    .nav-item i { font-size: 0.88rem; width: 15px; text-align: center; flex-shrink: 0; }
    .nav-item:hover { background: var(--surface-2); color: var(--text); }
    .nav-item.active { background: var(--accent-light); color: var(--accent); font-weight: 600; }
    .nav-item.active i { color: var(--accent); }
    .nav-badge { margin-left: auto; font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; line-height: 1.5; }
    .nb-red   { background: var(--danger-light); color: var(--danger); }
    .nb-amber { background: var(--warning-light); color: var(--warning); }
    .nb-teal  { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate { background: #f1f5f9; color: var(--text-3); }
    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .chevron { margin-left: auto; font-size: 0.68rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }
    .nav-divider { height: 1px; background: var(--border); margin: 6px 12px; }
    .sidebar-footer { flex-shrink: 0; padding: 8px; border-top: 1px solid var(--border); }
    .ph-card { padding: 10px 11px; background: var(--accent-light); border-radius: var(--r-lg); }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill { font-size: 0.62rem; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .pill-open { background: #dcfce7; color: #15803d; }
    .ph-meta { font-size: 0.7rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }

    /* ─── MAIN ────────────────────────────── */
    .main { flex: 1; margin-left: 220px; display: flex; flex-direction: column; min-height: 100vh; }
    .topbar { background: var(--surface); border-bottom: 1px solid var(--border); padding: 0 22px; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; flex-shrink: 0; }
    .tb-left { display: flex; align-items: center; gap: 8px; }
    .tb-left h1 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .tb-sep { color: var(--text-4); }
    .tb-sub { font-size: 0.78rem; color: var(--text-3); }
    .tb-right { display: flex; align-items: center; gap: 7px; }
    .ib { width: 30px; height: 30px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; color: var(--text-3); transition: all .1s; position: relative; }
    .ib:hover { background: var(--surface-2); color: var(--text); }
    .ib-dot { position: absolute; top: 5px; right: 5px; width: 5px; height: 5px; background: var(--danger); border-radius: 50%; border: 1.5px solid var(--surface); }
    .user-chip { display: flex; align-items: center; gap: 7px; padding: 3px 10px 3px 4px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); cursor: pointer; font-size: 0.77rem; }
    .u-av { width: 22px; height: 22px; border-radius: 5px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; display: block; }
    .u-role { font-size: 0.67rem; color: var(--text-3); display: block; }

    /* ─── CONTENT ─────────────────────────── */
    .content { padding: 18px 22px; flex: 1; }

    /* ─── GRID DE DOCUMENTOS ─────────────── */
    .docs-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 16px;
      max-width: 900px;
    }

    /* ─── CARD DOCUMENTO ──────────────────── */
    .doc-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--r-xl);
      overflow: hidden;
      transition: border-color .15s, box-shadow .15s;
    }
    .doc-card:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); }

    /* Cabeçalho do card */
    .doc-card-head {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .doc-icon {
      width: 34px; height: 34px;
      border-radius: var(--r-md);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.92rem;
      flex-shrink: 0;
    }
    .doc-icon.teal   { background: var(--accent-light); color: var(--accent); }
    .doc-icon.amber  { background: var(--warning-light); color: var(--warning); }
    .doc-title { font-family: 'Sora', sans-serif; font-size: 0.85rem; font-weight: 600; color: var(--text); }
    .doc-subtitle { font-size: 0.7rem; color: var(--text-4); margin-top: 1px; }

    /* Badge de validade */
    .doc-badge {
      margin-left: auto;
      font-size: 0.62rem;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 20px;
      flex-shrink: 0;
    }
    .badge-valid   { background: var(--success-light); color: #15803d; }
    .badge-warning { background: var(--warning-light); color: #854f0b; }
    .badge-expired { background: var(--danger-light); color: var(--danger); }

    /* Área da imagem */
    .doc-img-wrap {
      position: relative;
      background: var(--surface-2);
      border-bottom: 1px solid var(--border);
      min-height: 200px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      cursor: pointer;
    }
    .doc-img-wrap img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      display: block;
      transition: transform .2s;
    }
    .doc-img-wrap:hover img { transform: scale(1.02); }

    /* Placeholder quando sem imagem */
    .doc-placeholder {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 32px;
      color: var(--text-4);
      height: 200px;
    }
    .doc-placeholder i { font-size: 2rem; }
    .doc-placeholder span { font-size: 0.77rem; text-align: center; }

    /* Overlay de zoom */
    .doc-zoom-btn {
      position: absolute;
      bottom: 10px;
      right: 10px;
      width: 30px;
      height: 30px;
      border-radius: var(--r-sm);
      background: rgba(255,255,255,.9);
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.82rem;
      color: var(--text-3);
      cursor: pointer;
      transition: all .1s;
      opacity: 0;
      transition: opacity .15s;
    }
    .doc-img-wrap:hover .doc-zoom-btn { opacity: 1; }
    .doc-zoom-btn:hover { background: var(--surface); color: var(--accent); }

    /* Rodapé do card */
    .doc-card-body { padding: 14px 16px; }

    .doc-field { display: flex; align-items: center; gap: 8px; padding: 8px 0; border-bottom: 1px solid var(--border); font-size: 0.8rem; }
    .doc-field:last-child { border-bottom: none; padding-bottom: 0; }
    .doc-field-lbl { font-size: 0.72rem; color: var(--text-3); width: 110px; flex-shrink: 0; }
    .doc-field-val { flex: 1; font-weight: 600; color: var(--text-2); }
    .doc-field-val.mono { font-family: 'DM Mono', 'Courier New', monospace; font-size: 0.88rem; letter-spacing: .04em; color: var(--text); }

    /* Acções */
    .doc-card-footer { padding: 12px 16px; border-top: 1px solid var(--border); display: flex; gap: 7px; }
    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-icon { padding: 5px 8px; }

    /* ─── LIGHTBOX ────────────────────────── */
    .lightbox { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.88); z-index: 1000; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(4px); }
    .lightbox.open { display: flex; }
    .lightbox-inner { position: relative; max-width: 90vw; max-height: 90vh; }
    .lightbox-inner img { max-width: 100%; max-height: 85vh; border-radius: var(--r-lg); box-shadow: 0 24px 64px rgba(0,0,0,.5); display: block; }
    .lightbox-close { position: absolute; top: -14px; right: -14px; width: 32px; height: 32px; border-radius: 50%; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.88rem; color: var(--text-2); transition: all .1s; }
    .lightbox-close:hover { background: var(--danger-light); color: var(--danger); }
    .lightbox-label { text-align: center; color: rgba(255,255,255,.6); font-size: 0.77rem; margin-top: 10px; }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .docs-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
<div class="layout">

  <!-- ══ SIDEBAR ══════════════════════════════════ -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="logo">
        <div class="logo-mark">
          <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 13v-2H9v-2h2V9h2v2h2v2h-2v2h-2z"/></svg>
        </div>
        <span class="logo-text"><span class="f">Farma</span><span class="c">Connect</span></span>
      </a>
    </div>

    <div class="sidebar-body">
      <div class="nav-section">
        <span class="nav-label">Principal</span>
        <button class="nav-item " onclick="setActive(this)">
          <i class="bi bi-grid-1x2"></i> <a href="{{route('index.farmacias')}}">Dashboard</a> 
        </button>
        <div class="has-sub" id="sub-stock">
          <button class="nav-item" onclick="toggleSub('sub-stock')">
            <i class="bi bi-archive"></i> Stock
            {{-- <span class="nav-badge nb-amber">3</span> --}}
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-list-ul"></i><a class="text-decoration-none" href="{{ route('medicamentos.farmacias') }}"> Lista de produtos</a></div>
            <div class="sub-item"><i class="bi bi-exclamation-triangle"></i> Stock baixo <span class="nav-badge nb-red" style="margin-left:4px"></span></div>
          </div>
        </div>
        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-truck"></i><a href="{{route('pedidos.farmacias')}}"> Pedidos</a>
          {{-- <span class="nav-badge nb-red">{{ $data['pedidos_hoje']->count() }}</span> --}}
        </button>
        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-person-badge"></i> <a href="{{route('entregadores.farmacias')}}"> Entregadores </a>
          {{-- <span class="nav-badge nb-teal">4</span> --}}
        </button>
        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-people"></i> <a href="{{route('clientes.farmacias')}}">Clientes</a> 
        </button>

        {{-- <span class="nav-label">Análise</span>
        <div class="has-sub" id="sub-rel">
          <button class="nav-item" onclick="toggleSub('sub-rel')">
            <i class="bi bi-bar-chart-line"></i> Relatórios
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-cash-stack"></i> Vendas</div>
            <div class="sub-item"><i class="bi bi-archive"></i> Stock</div>
            <div class="sub-item"><i class="bi bi-truck"></i> Entregas</div>
            <div class="sub-item"><i class="bi bi-star"></i> Avaliações</div>
          </div>
        </div> --}}
        
        <button class="nav-item" onclick="setActive(this)">
          <i class="bi bi-star"></i> <a href="{{route('avaliacoes.farmacias')}}"> Avaliações</a>
          {{-- <span class="nav-badge nb-amber">{{ $data['todas_avaliacoes']->count() }}</span> --}}
        </button>

        <span class="nav-label">Gestão</span>
        <button class="nav-item active" onclick="setActive(this)">
          <i class="bi bi-file-earmark-text"></i> <a href="{{route('documentos.farmacias') }}">Documentos</a> 
          {{-- <span class="nav-badge nb-slate">2</span> --}}
        </button>
        <div class="has-sub" id="sub-cfg">
          <button class="nav-item" onclick="toggleSub('sub-cfg')">
            <i class="bi bi-gear"></i> Configurações
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-person"></i> Perfil</div>
            <div class="sub-item"><i class="bi bi-shop"></i> Farmácia</div>
            <div class="sub-item"><i class="bi bi-clock"></i> Horário</div>
            {{-- <div class="sub-item"><i class="bi bi-bell"></i> Notificações</div> --}}
          </div>
        </div>
        <div class="nav-divider"></div>
        <form action="{{ route('logout', ['id'=>Auth::user()->id]) }}" method="post">
          @csrf
          <button type="submit" class="nav-item" style="color:var(--danger)">
            <i class="bi bi-box-arrow-right" style="color:var(--danger)"></i> Sair
          </button>
        </form>
      </div>
    </div>

   <div class="sidebar-footer">
      @php
        $farmacia = Auth::user()->farmacia;
      @endphp
      <div class="ph-card">
        <div class="ph-row">
          <span class="ph-name">{{ $farmacia->name ?? 'FC' }}</span>
          <span class="ph-pill pill-open">{{ $farmacia->status  }}</span>
        </div>
        <p class="ph-meta"><i class="bi bi-geo-alt"></i> {{ $farmacia->endereco  }}</p>
        <p class="ph-meta"><i class="bi bi-clock"></i> {{ $farmacia->horario_abertura ?? '08:00 ' }} - {{ $farmacia->horario_fechamento ?? '22:00' }}</p>
        <p class="ph-meta" style="opacity:.55;font-size:.65rem;margin-top:2px"><i class="bi bi-building"></i> {{ $farmacia->company ?? 'UNKNOWN' }}</p>
      </div>
    </div>
  </aside>

  <!-- ══ MAIN ══════════════════════════════════════ -->
  <div class="main">
    <header class="topbar">
      <div class="tb-left">
        <h1>Documentos</h1>
        <span class="tb-sep">/</span>
        <span class="tb-sub">Farmácia Central</span>
      </div>
      <div class="tb-right">
        <div class="ib"><i class="bi bi-search"></i></div>
        <div class="ib"><i class="bi bi-bell"></i><span class="ib-dot"></span></div>
        <div class="user-chip">
          <div class="u-av">FC</div>
            <div><span class="u-name">{{ Auth::user()->farmacia->name ?? 'UNKNOWN'  }}</span><span class="u-role">{{ Auth::user()->name ?? 'Dr. António Silva' }}</span></div>
        </div>
      </div>
    </header>

    <div class="content">

      <div class="docs-grid">

        <!-- ── CARD ALVARÁ ──────────────────── -->
        <div class="doc-card">
          <div class="doc-card-head">
            <div class="doc-icon teal"><i class="bi bi-patch-check"></i></div>
            <div>
              <div class="doc-title">Alvará de Funcionamento</div>
              <div class="doc-subtitle">Licença de operação farmacêutica</div>
            </div>
            <span class="doc-badge badge-valid">Válido</span>
          </div>

          <!-- Imagem do alvará -->
          <div class="doc-img-wrap" onclick="openLightbox('alv')">
            {{-- Substituir src por {{ asset('storage/' . $farmacia->alvara_path) }} --}}
            <img id="alvaraImg"
                 src="https://placehold.co/600x400/e6f7f8/0899a6?text=Alvará+de+Funcionamento"
                 alt="Alvará de Funcionamento — Farmácia Central"
                 onerror="this.parentElement.innerHTML=noImgHtml('Alvará não carregado')">
            <button class="doc-zoom-btn" title="Ampliar">
              <i class="bi bi-zoom-in"></i>
            </button>
          </div>

          <!-- Campos -->
          <div class="doc-card-body">
            <div class="doc-field">
              <span class="doc-field-lbl">Número</span>
              {{-- <span class="doc-field-val mono">{{ $farmacia->alvara_numero ?? '—' }}</span> --}}
              <span class="doc-field-val mono">ALV-2021-004872</span>
            </div>
            <div class="doc-field">
              <span class="doc-field-lbl">Emitido por</span>
              <span class="doc-field-val">MINSA — Angola</span>
            </div>
            <div class="doc-field">
              <span class="doc-field-lbl">Data de emissão</span>
              <span class="doc-field-val">12 de Janeiro de 2021</span>
            </div>
            <div class="doc-field">
              <span class="doc-field-lbl">Validade</span>
              <span class="doc-field-val" style="color:var(--success);font-weight:700">31 de Dezembro de 2025</span>
            </div>
          </div>

          <div class="doc-card-footer">
            <a href="#" class="btn btn-primary" onclick="openLightbox('alv');return false">
              <i class="bi bi-eye"></i> Ver documento
            </a>
            <a href="#" class="btn btn-outline" download>
              <i class="bi bi-download"></i> Descarregar
            </a>
          </div>
        </div>

        <!-- ── CARD NIF ─────────────────────── -->
        <div class="doc-card">
          <div class="doc-card-head">
            <div class="doc-icon amber"><i class="bi bi-card-text"></i></div>
            <div>
              <div class="doc-title">Número de Identificação Fiscal</div>
              <div class="doc-subtitle">Comprovativo NIF da farmácia</div>
            </div>
            <span class="doc-badge badge-valid">Válido</span>
          </div>

          <!-- Imagem do NIF -->
          <div class="doc-img-wrap" onclick="openLightbox('nif')">
            {{-- Substituir src por {{ asset('storage/' . $farmacia->nif_path) }} --}}
            <img id="nifImg"
                 src="https://placehold.co/600x400/fef3c7/d97706?text=Comprovativo+NIF"
                 alt="Comprovativo NIF — Farmácia Central"
                 onerror="this.parentElement.innerHTML=noImgHtml('NIF não carregado')">
            <button class="doc-zoom-btn" title="Ampliar">
              <i class="bi bi-zoom-in"></i>
            </button>
          </div>

          <!-- Campos -->
          <div class="doc-card-body">
            <div class="doc-field">
              <span class="doc-field-lbl">NIF</span>
              {{-- <span class="doc-field-val mono">{{ $farmacia->nif ?? '—' }}</span> --}}
              <span class="doc-field-val mono">5 000 412 731</span>
            </div>
            <div class="doc-field">
              <span class="doc-field-lbl">Denominação</span>
              <span class="doc-field-val">Farmácia Central, Lda.</span>
            </div>
            <div class="doc-field">
              <span class="doc-field-lbl">Data de registo</span>
              <span class="doc-field-val">03 de Março de 2019</span>
            </div>
            <div class="doc-field">
              <span class="doc-field-lbl">Estado</span>
              <span class="doc-field-val" style="color:var(--success);font-weight:700">Activo</span>
            </div>
          </div>

          <div class="doc-card-footer">
            <a href="#" class="btn btn-primary" onclick="openLightbox('nif');return false">
              <i class="bi bi-eye"></i> Ver documento
            </a>
            <a href="#" class="btn btn-outline" download>
              <i class="bi bi-download"></i> Descarregar
            </a>
          </div>
        </div>

      </div>{{-- /docs-grid --}}

    </div>{{-- /content --}}
  </div>{{-- /main --}}
</div>{{-- /layout --}}


<!-- ══ LIGHTBOX ══════════════════════════════════ -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
  <div class="lightbox-inner" onclick="event.stopPropagation()">
    <div class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></div>
    <img id="lightboxImg" src="" alt="">
    <div class="lightbox-label" id="lightboxLabel"></div>
  </div>
</div>

<script>
/* ══ LIGHTBOX ════════════════════════════════════ */
function openLightbox(doc) {
  const img   = document.getElementById('lightboxImg');
  const label = document.getElementById('lightboxLabel');
  if (doc === 'alv') {
    img.src   = document.getElementById('alvaraImg')?.src || '';
    img.alt   = 'Alvará de Funcionamento';
    label.textContent = 'Alvará de Funcionamento — Farmácia Central';
  } else {
    img.src   = document.getElementById('nifImg')?.src || '';
    img.alt   = 'Comprovativo NIF';
    label.textContent = 'Comprovativo NIF — Farmácia Central';
  }
  document.getElementById('lightbox').classList.add('open');
}

function closeLightbox() {
  document.getElementById('lightbox').classList.remove('open');
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeLightbox();
});

/* Placeholder HTML quando a imagem falha */
function noImgHtml(msg) {
  return `<div class="doc-placeholder">
    <i class="bi bi-image-alt"></i>
    <span>${msg}<br>Carregue o ficheiro nas configurações</span>
  </div>`;
}

/* ══ SIDEBAR ═════════════════════════════════════ */
function setActive(el) {
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}
function toggleSub(id) { document.getElementById(id).classList.toggle('open'); }
</script>
</body>
</html>