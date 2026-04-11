<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Documentos da Farmácia</title>

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

        /* Logout button */
    .logout-form {
        margin-top: 12px;
    }

    .logout-btn {
        color: var(--danger);
    }

    .logout-btn i {
        color: var(--danger);
    }

    .logout-btn:hover {
        background: var(--danger-light);
        color: var(--danger);
    }

    .logout-btn:hover i {
        color: var(--danger);
    }
    
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
    .content { 
      padding: 18px 22px; 
      flex: 1; 
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    /* ─── CARD ÚNICO ──────────────────────── */
    .document-card {
      max-width: 650px;
      width: 100%;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--r-xl);
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: transform 0.2s, box-shadow 0.2s;
      margin: 0 auto;
    }
    
    .document-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 30px rgba(8,153,166,0.15);
    }

    /* Cabeçalho do card com gradiente */
    .doc-header {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
      padding: 24px 24px 20px;
      color: white;
      position: relative;
      overflow: hidden;
    }
    
    .doc-header::before {
      content: '';
      position: absolute;
      top: -30px;
      right: -30px;
      width: 120px;
      height: 120px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
    }
    
    .doc-header::after {
      content: '';
      position: absolute;
      bottom: -30px;
      left: -30px;
      width: 150px;
      height: 150px;
      background: rgba(255,255,255,0.05);
      border-radius: 50%;
    }
    
    .doc-header-content {
      position: relative;
      z-index: 2;
    }
    
    .doc-header-icon {
      width: 60px;
      height: 60px;
      background: rgba(255,255,255,0.2);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      margin-bottom: 16px;
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255,255,255,0.3);
    }
    
    .doc-header-title {
      font-family: 'Sora', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 4px;
    }
    
    .doc-header-sub {
      font-size: 0.9rem;
      opacity: 0.9;
    }

    /* Corpo do card */
    .doc-body {
      padding: 24px;
    }

    /* Seções de documento */
    .doc-section {
      margin-bottom: 28px;
    }
    
    .doc-section:last-child {
      margin-bottom: 0;
    }
    
    .doc-section-title {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-2);
      margin-bottom: 16px;
      padding-bottom: 8px;
      border-bottom: 1px solid var(--border);
    }
    
    .doc-section-title i {
      font-size: 1rem;
      color: var(--accent);
    }

    /* Grid de informações */
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    
    .info-item {
      background: var(--surface-2);
      border-radius: var(--r-lg);
      padding: 14px;
      border: 1px solid var(--border);
      transition: border-color 0.2s;
    }
    
    .info-item:hover {
      border-color: var(--accent-mid);
    }
    
    .info-label {
      font-size: 0.7rem;
      color: var(--text-3);
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-bottom: 6px;
    }
    
    .info-value {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
      font-family: 'Sora', sans-serif;
    }
    
    .info-value.mono {
      font-family: 'DM Mono', 'Courier New', monospace;
      font-size: 1rem;
    }
    
    .info-value.small {
      font-size: 0.9rem;
    }

    /* Container de imagens */
    .images-container {
      display: flex;
      gap: 20px;
      margin-top: 16px;
    }
    
    .image-card {
      flex: 1;
      background: var(--surface-2);
      border-radius: var(--r-lg);
      border: 1px solid var(--border);
      overflow: hidden;
      transition: all 0.2s;
      cursor: pointer;
    }
    
    .image-card:hover {
      border-color: var(--accent);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(8,153,166,0.1);
    }
    
    .image-preview {
      height: 150px;
      background-size: cover;
      background-position: center;
      position: relative;
    }
    
    .image-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.2s;
    }
    
    .image-card:hover .image-overlay {
      opacity: 1;
    }
    
    .image-overlay i {
      color: white;
      font-size: 2rem;
      background: rgba(0,0,0,0.3);
      border-radius: 50%;
      padding: 10px;
    }
    
    .image-label {
      padding: 10px;
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--text-2);
      text-align: center;
      background: white;
      border-top: 1px solid var(--border);
    }

    /* Placeholder de imagem */
    .image-placeholder {
      height: 150px;
      background: var(--surface-2);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 8px;
      color: var(--text-4);
    }
    
    .image-placeholder i {
      font-size: 2.5rem;
    }
    
    .image-placeholder span {
      font-size: 0.75rem;
      text-align: center;
      padding: 0 10px;
    }

    /* Badge de status */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 4px 12px;
      border-radius: 30px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .status-valid {
      background: var(--success-light);
      color: #15803d;
    }
    
    .status-warning {
      background: var(--warning-light);
      color: #854f0b;
    }

    /* Rodapé do card */
    .doc-footer {
      padding: 20px 24px;
      border-top: 1px solid var(--border);
      background: var(--surface-2);
      display: flex;
      gap: 12px;
      justify-content: flex-end;
    }

    /* Botões */
    .btn { 
      display: inline-flex; 
      align-items: center; 
      gap: 6px; 
      padding: 8px 18px; 
      border-radius: var(--r-md); 
      font-size: 0.8rem; 
      font-weight: 600; 
      cursor: pointer; 
      transition: all 0.15s; 
      border: 1px solid; 
      font-family: 'DM Sans', sans-serif; 
      text-decoration: none;
    }
    .btn i { font-size: 0.9rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); border-color: var(--accent-2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(8,153,166,0.2); }
    .btn-outline { background: transparent; color: var(--accent); border-color: var(--accent); }
    .btn-outline:hover { background: var(--accent-light); transform: translateY(-2px); }

    /* ─── LIGHTBOX ────────────────────────── */
    .lightbox { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.95); z-index: 1000; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(8px); }
    .lightbox.open { display: flex; }
    .lightbox-inner { position: relative; max-width: 90vw; max-height: 90vh; }
    .lightbox-inner img { max-width: 100%; max-height: 85vh; border-radius: var(--r-lg); box-shadow: 0 24px 64px rgba(0,0,0,.5); display: block; border: 3px solid white; }
    .lightbox-close { position: absolute; top: -16px; right: -16px; width: 36px; height: 36px; border-radius: 50%; background: var(--surface); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1rem; color: var(--text-2); transition: all .1s; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
    .lightbox-close:hover { background: var(--danger-light); color: var(--danger); }
    .lightbox-label { text-align: center; color: rgba(255,255,255,.7); font-size: 0.85rem; margin-top: 16px; font-weight: 500; }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .info-grid { grid-template-columns: 1fr; }
      .images-container { flex-direction: column; }
      .doc-footer { flex-direction: column; }
      .doc-footer .btn { width: 100%; justify-content: center; }
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
            
            <!-- Dashboard -->
            <a href="{{ route('index.farmacias') }}" class="nav-item {{ request()->routeIs('index.farmacias') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <!-- Stock com submenu -->
            <div class="has-sub {{ request()->routeIs('medicamentos.farmacias') ? 'open' : '' }}" id="sub-stock">
                <div class="nav-item" onclick="toggleSub('sub-stock')">
                    <i class="bi bi-archive"></i>
                    <span>Stock</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <a href="{{ route('medicamentos.farmacias') }}" class="sub-item {{ request()->routeIs('medicamentos.farmacias') ? 'active-sub' : '' }}">
                        <i class="bi bi-list-ul"></i>
                        <span>Lista de produtos</span>
                    </a>
                    {{-- <div class="sub-item">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Stock baixo</span>
                    </div> --}}
                </div>
            </div>

            <!-- Pedidos -->
            <a href="{{ route('pedidos.farmacias') }}" class="nav-item {{ request()->routeIs('pedidos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Pedidos</span>

            </a>

            <!-- Entregadores -->
            {{-- <a href="{{ route('entregadores.farmacias') }}" class="nav-item {{ request()->routeIs('entregadores.farmacias') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Entregadores</span>

            </a> --}}

            <!-- Clientes -->
            <a href="{{ route('clientes.farmacias') }}" class="nav-item {{ request()->routeIs('clientes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>

            <!-- Avaliações -->
            <a href="{{ route('avaliacoes.farmacias') }}" class="nav-item {{ request()->routeIs('avaliacoes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-star"></i>
                <span>Avaliações</span>

            </a>

            <span class="nav-label">Gestão</span>

            <!-- Documentos -->
            <a href="{{ route('documentos.farmacias') }}" class="nav-item {{ request()->routeIs('documentos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Documentos</span>
            </a>

            <!-- Configurações com submenu -->
            <div class="has-sub" id="sub-cfg">
                <div class="nav-item" onclick="toggleSub('sub-cfg')">
                    <i class="bi bi-gear"></i>
                    <span>Configurações</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <div class="sub-item">
                        <i class="bi bi-person"></i>
                        <span>Perfil</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-shop"></i>
                        <span>Farmácia</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-clock"></i>
                        <span>Horário</span>
                    </div>
                </div>
            </div>

            <!-- Sair -->
            <form action="{{ route('logout', ['id'=>Auth::user()->id]) }}" method="post" class="logout-form">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sair</span>
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
                <span class="ph-name">{{ $farmacia->name ?? 'Farmácia' }}</span>
                <span class="ph-pill pill-open">{{ $farmacia->status ?? 'Aberta' }}</span>
            </div>
            <p class="ph-meta"><i class="bi bi-geo-alt"></i> {{ $farmacia->endereco ?? '—' }}</p>
            <p class="ph-meta"><i class="bi bi-clock"></i> {{ $farmacia->horario_abertura ?? '08:00' }} - {{ $farmacia->horario_fechamento ?? '22:00' }}</p>
            <p class="ph-meta" style="opacity:.55;font-size:.65rem;margin-top:2px"><i class="bi bi-building"></i> {{ $farmacia->company ?? 'FarmaConnect' }}</p>
        </div>
    </div>
</aside>

  <!-- ══ MAIN ══════════════════════════════════════ -->
  <div class="main">
    <header class="topbar">
      <div class="tb-left">
        <h1>Documentos</h1>
        <span class="tb-sep">/</span>
        <span class="tb-sub">{{ $farmacia->name ?? 'Farmácia' }}</span>
      </div>
      <div class="tb-right">
        <div class="ib"><i class="bi bi-search"></i></div>
        <div class="ib"><i class="bi bi-bell"></i><span class="ib-dot"></span></div>
        <div class="user-chip">
          <div class="u-av">FC</div>
          <div>
            <span class="u-name">{{ $farmacia->name ?? 'Farmácia' }}</span>
            <span class="u-role">{{ Auth::user()->name ?? 'Farmacêutico' }}</span>
          </div>
        </div>
      </div>
    </header>

    <div class="content">
      
      <!-- Card Único de Documentos -->
      <div class="document-card">
        
        <!-- Cabeçalho com gradiente -->
        <div class="doc-header">
          <div class="doc-header-content">
            <div class="doc-header-icon">
              <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="doc-header-title">{{ $farmacia->name ?? 'Farmácia Central' }}</div>
            <div class="doc-header-sub">Documentos de identificação e licenciamento</div>
          </div>
        </div>
        
        <!-- Corpo do card -->
        <div class="doc-body">
          
          <!-- Seção de Identificação Fiscal -->
          <div class="doc-section">
            <div class="doc-section-title">
              <i class="bi bi-card-text"></i>
              <span>Identificação Fiscal</span>
              <span class="status-badge status-valid" style="margin-left: auto;">
                <i class="bi bi-check-circle-fill"></i> Válido
              </span>
            </div>
            
            <div class="info-grid">
              <div class="info-item">
                <div class="info-label">NIF</div>
                <div class="info-value mono">{{ $documentos->nif ?? 'Não disponível' }}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Denominação Social</div>
                <div class="info-value small">{{ $farmacia->name ?? 'Farmácia Central, Lda.' }}</div>
              </div>
            </div>
          </div>
          
          <!-- Seção de Licenciamento -->
          <div class="doc-section">
            <div class="doc-section-title">
              <i class="bi bi-patch-check"></i>
              <span>Licenciamento</span>
              <span class="status-badge status-valid" style="margin-left: auto;">
                <i class="bi bi-check-circle-fill"></i> Válido
              </span>
            </div>
            
            <div class="info-grid">
              <div class="info-item">
                <div class="info-label">Tipo de Licença</div>
                <div class="info-value small">Alvará de Funcionamento</div>
              </div>
              {{-- <div class="info-item">
                <div class="info-label">Entidade Emissora</div>
                <div class="info-value small">MINSA — Angola</div>
              </div> --}}
              {{-- <div class="info-item">
                <div class="info-label">Data de Emissão</div>
                <div class="info-value small">12 de Janeiro de 2021</div>
              </div>
              <div class="info-item">
                <div class="info-label">Validade</div>
                <div class="info-value small" style="color: var(--success);">31 de Dezembro de 2025</div>
              </div>
            </div> --}}
          </div>
          
          <!-- Seção de Documentos Digitalizados -->
          <div class="doc-section ">
            <div class="doc-section-title ">
              <i class="bi bi-images"></i>
              <span>Documentos Digitalizados</span>
            </div>
            
            <div class="images-container">
              <!-- Alvará -->
              <div class="image-card" onclick="openLightbox('alvara')">
                @if($documentos->alvara)
                  <div class="image-preview" style="background-image: url('{{ asset('storage/' . $documentos->alvara) }}');">
                    <div class="image-overlay">
                      <i class="bi bi-zoom-in"></i>
                    </div>
                  </div>
                @else
                  <div class="image-placeholder">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span>Alvará não carregado</span>
                  </div>
                @endif
                <div class="image-label">
                  <i class="bi bi-patch-check" style="color: var(--success);"></i> Alvará de Funcionamento
                </div>
              </div>
              
              <!-- NIF (se houver imagem) -->
              @if($documentos->nif && file_exists(storage_path('app/public/' . $documentos->nif)))
              <div class="image-card" onclick="openLightbox('nif')">
                <div class="image-preview" style="background-image: url('{{ asset('storage/' . $documentos->nif) }}');">
                  <div class="image-overlay">
                    <i class="bi bi-zoom-in"></i>
                  </div>
                </div>
                <div class="image-label">
                  <i class="bi bi-check-circle" style="color: var(--success);"></i> Comprovativo NIF
                </div>
              </div>
              @endif
            </div>
          </div>
          
        </div>
        
        <!-- Rodapé com ações -->
        <div class="doc-footer">
          <a href="#" class="btn btn-outline" onclick="window.print(); return false;">
            <i class="bi bi-printer"></i> Imprimir
          </a>
          <a href="{{ $documentos->alvara ? asset('storage/' . $documentos->alvara) : '#' }}" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Descarregar Documentos
          </a>
        </div>
      </div>
      
    </div>
  </div>
</div>

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
  const img = document.getElementById('lightboxImg');
  const label = document.getElementById('lightboxLabel');
  
  @if($documentos->alvara)
  if (doc === 'alvara') {
    img.src = '{{ asset('storage/' . $documentos->alvara) }}';
    img.alt = 'Alvará de Funcionamento';
    label.textContent = 'Alvará de Funcionamento — {{ $farmacia->name ?? 'Farmácia' }}';
    document.getElementById('lightbox').classList.add('open');
  }
  @endif
  
  @if(isset($documentos->nif) && file_exists(storage_path('app/public/' . $documentos->nif)))
  if (doc === 'nif') {
    img.src = '{{ asset('storage/' . $documentos->nif) }}';
    img.alt = 'Comprovativo NIF';
    label.textContent = 'Comprovativo NIF — {{ $farmacia->name ?? 'Farmácia' }}';
    document.getElementById('lightbox').classList.add('open');
  }
  @endif
}

function closeLightbox() {
  document.getElementById('lightbox').classList.remove('open');
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeLightbox();
});

/* ══ SIDEBAR ═════════════════════════════════════ */
function setActive(el) {
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}

function toggleSub(id) { 
  document.getElementById(id).classList.toggle('open'); 
}
</script>
</body>
</html>