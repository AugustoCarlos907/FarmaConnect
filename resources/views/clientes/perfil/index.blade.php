<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Meu Perfil — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --bg:          #ffffff;
      --text:        #363f40;
      --heading:     #1f2f31;
      --accent:      #099aa7;
      --accent-dark: #067e8a;
      --soft:        #dff3f0;
      --mint:        #eaf6f5;
      --muted:       #6c8285;
      --border:      #e4f0f0;
      --card-shadow: 0 8px 32px rgba(9,154,167,.08);
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior: smooth; }

    body {
      background: #f4f8f8;
      color: var(--text);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow-x: hidden;
    }

    /* ===== HEADER ===== */
    .header {
      background: rgba(255,255,255,.97);
      backdrop-filter: blur(16px);
      box-shadow: 0 1px 0 rgba(9,154,167,.08), 0 4px 24px rgba(9,154,167,.06);
      padding: .75rem 0;
      transition: box-shadow .3s;
      z-index: 1000;
    }
    .header.scrolled { box-shadow: 0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; white-space:nowrap; }
    .sitename .s1 { color: var(--accent); }
    .sitename .s2 { color: var(--heading); }

    .header-search { flex:1; max-width:560px; }
    .header-search .input-group {
      border:1.5px solid var(--border); border-radius:50px;
      background:#f6fbfb; overflow:hidden; transition:border-color .2s, box-shadow .2s;
    }
    .header-search .input-group:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .header-search .input-group-text { background:transparent; border:none; color:#a0b9bc; padding-left:1.1rem; }
    .header-search .form-control { background:transparent; border:none; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; }
    .header-search .form-control::placeholder { color:#b0c4c6; }
    .header-search .form-control:focus { box-shadow:none; }
    .header-search .btn-search-go { background:transparent; border:none; color:var(--accent); padding-right:1rem; font-size:1.25rem; transition:color .2s; }
    .header-search .btn-search-go:hover { color:var(--accent-dark); }

    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu li { margin:0 .15rem; }
    .navmenu a { color:var(--heading); font-weight:600; font-size:.88rem; padding:.42rem .85rem; border-radius:50px; text-decoration:none; transition:.2s; white-space:nowrap; }
    .navmenu a:hover, .navmenu a.active { background:var(--soft); color:var(--accent); }

    .header-cart { position:relative; color:var(--heading); font-size:1.3rem; text-decoration:none; transition:color .2s; }
    .header-cart:hover { color:var(--accent); }
    .cart-badge { position:absolute; top:-6px; right:-8px; background:var(--accent); color:#fff; font-size:.6rem; font-weight:700; width:17px; height:17px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid #fff; }

    .profile-toggle { display:flex; align-items:center; gap:.5rem; text-decoration:none; color:var(--heading); }
    .profile-toggle img { border:2px solid var(--soft); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }

    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ===== PAGE BREADCRUMB ===== */
    .page-topbar {
      background: linear-gradient(138deg, #046a76 0%, #099aa7 52%, #0ec4d4 100%);
      padding: 2.5rem 0 4rem;
      position: relative;
      overflow: hidden;
    }
    .page-topbar::before {
      content: '';
      position: absolute; inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .topbar-blob {
      position: absolute; border-radius: 50%;
      filter: blur(60px); pointer-events: none;
    }
    .topbar-blob-1 { width:300px; height:300px; background:#fff; opacity:.08; top:-100px; right:-50px; }
    .topbar-blob-2 { width:200px; height:200px; background:#a8ffd4; opacity:.06; bottom:-60px; left:10%; }

    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; transition:color .2s; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc span { color:rgba(255,255,255,.4); font-size:.8rem; }
    .breadcrumb-fc .current { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.8rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .page-topbar p  { color:rgba(255,255,255,.68); font-size:.92rem; margin-top:.3rem; }

    /* ===== PROFILE LAYOUT ===== */
    .profile-wrap {
      margin-top: -2.5rem;
      padding-bottom: 4rem;
    }

    /* Sidebar */
    .profile-sidebar {
      background: #fff;
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      position: sticky;
      top: 84px;
    }

    .sidebar-cover {
      height: 90px;
      background: linear-gradient(135deg, #046a76, #0ec4d4);
      position: relative;
    }
    .sidebar-avatar-wrap {
      display: flex;
      justify-content: center;
      margin-top: -42px;
      position: relative;
      z-index: 1;
    }
    .sidebar-avatar {
      width: 84px; height: 84px;
      border-radius: 50%;
      border: 4px solid #fff;
      box-shadow: 0 8px 24px rgba(9,154,167,.2);
      object-fit: cover;
    }
    .avatar-edit-btn {
      position: absolute;
      bottom: 2px; right: calc(50% - 50px);
      width: 26px; height: 26px;
      background: var(--accent); color: #fff;
      border-radius: 50%; border: 2px solid #fff;
      display: flex; align-items: center; justify-content: center;
      font-size: .75rem; cursor: pointer;
      transition: background .2s;
    }
    .avatar-edit-btn:hover { background: var(--accent-dark); }

    .sidebar-info { text-align: center; padding: .8rem 1.5rem 1.5rem; }
    .sidebar-name { font-size: 1.1rem; font-weight: 800; color: var(--heading); margin-bottom: .15rem; }
    .sidebar-email { font-size: .82rem; color: var(--muted); margin-bottom: 1rem; }

    .sidebar-badge {
      display: inline-flex; align-items: center; gap: .35rem;
      background: var(--soft); color: var(--accent);
      font-size: .75rem; font-weight: 700;
      padding: .28rem .9rem; border-radius: 50px;
      margin-bottom: 1.2rem;
    }

    .sidebar-stats {
      display: flex; gap: 0;
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
      margin-bottom: 1.2rem;
    }
    .sstat {
      flex: 1; text-align: center; padding: .85rem .5rem;
    }
    .sstat + .sstat { border-left: 1px solid var(--border); }
    .sstat .val { font-size: 1.2rem; font-weight: 800; color: var(--heading); line-height: 1; }
    .sstat .key { font-size: .68rem; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; margin-top: .2rem; }

    /* Sidebar nav */
    .sidebar-nav { padding: 0 .8rem 1rem; }
    .snav-item {
      display: flex; align-items: center; gap: .75rem;
      padding: .72rem 1rem; border-radius: 12px;
      text-decoration: none; color: var(--text);
      font-weight: 600; font-size: .9rem;
      transition: all .2s; margin-bottom: .15rem;
      cursor: pointer;
    }
    .snav-item i { font-size: 1.05rem; color: var(--muted); width: 20px; flex-shrink: 0; transition: color .2s; }
    .snav-item:hover { background: var(--mint); color: var(--accent); }
    .snav-item:hover i { color: var(--accent); }
    .snav-item.active { background: var(--soft); color: var(--accent); }
    .snav-item.active i { color: var(--accent); }
    .snav-item .snav-badge { background: var(--accent); color: #fff; font-size: .65rem; font-weight: 700; padding: .15rem .45rem; border-radius: 50px; margin-left: auto; }
    .snav-divider { height: 1px; background: var(--border); margin: .6rem 1rem; }

    /* ===== MAIN CONTENT ===== */
    .profile-main {}

    /* Section card */
    .pcard {
      background: #fff;
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      margin-bottom: 1.5rem;
      overflow: hidden;
    }
    .pcard-header {
      padding: 1.4rem 1.8rem 1.1rem;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .pcard-title {
      display: flex; align-items: center; gap: .75rem;
    }
    .pcard-icon {
      width: 40px; height: 40px;
      background: var(--soft); border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      color: var(--accent); font-size: 1.1rem;
    }
    .pcard-title h5 { font-size: 1rem; font-weight: 800; color: var(--heading); margin: 0; }
    .pcard-title p  { font-size: .78rem; color: var(--muted); margin: 0; }
    .pcard-body { padding: 1.8rem; }

    /* Form fields */
    .fc-label {
      font-size: .82rem;
      font-weight: 700;
      color: var(--heading);
      margin-bottom: .45rem;
      display: flex; align-items: center; gap: .35rem;
    }
    .fc-label i { color: var(--accent); font-size: .85rem; }
    .fc-label .req { color: #e74c3c; font-size: .75rem; }

    .fc-input {
      width: 100%;
      border: 1.5px solid var(--border);
      border-radius: 14px;
      padding: .72rem 1rem;
      font-size: .9rem;
      font-family: inherit;
      color: var(--heading);
      background: #fafefe;
      transition: border-color .2s, box-shadow .2s, background .2s;
      outline: none;
    }
    .fc-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(9,154,167,.1);
      background: #fff;
    }
    .fc-input::placeholder { color: #b0c4c6; }
    .fc-input:disabled {
      background: #f4f8f8;
      color: #a0b9bc;
      cursor: not-allowed;
    }

    .fc-input-icon { position: relative; }
    .fc-input-icon i {
      position: absolute;
      left: 1rem; top: 50%;
      transform: translateY(-50%);
      color: #a0b9bc; font-size: .95rem;
      pointer-events: none;
    }
    .fc-input-icon .fc-input { padding-left: 2.6rem; }

    .fc-input-icon .eye-toggle {
      position: absolute;
      right: 1rem; top: 50%;
      transform: translateY(-50%);
      color: #a0b9bc; font-size: 1rem;
      cursor: pointer; border: none; background: transparent;
      transition: color .2s;
    }
    .fc-input-icon .eye-toggle:hover { color: var(--accent); }
    .fc-input-icon .fc-input.with-eye { padding-right: 2.8rem; }

    select.fc-input { cursor: pointer; }

    .fc-hint { font-size: .75rem; color: var(--muted); margin-top: .35rem; display: flex; align-items: center; gap: .3rem; }
    .fc-hint i { color: var(--accent); font-size: .75rem; }

    .fc-error { font-size: .75rem; color: #e74c3c; margin-top: .35rem; display: none; }
    .fc-input.is-error { border-color: #e74c3c; }
    .fc-input.is-ok    { border-color: #22c55e; }

    /* Password strength */
    .pw-strength { margin-top: .5rem; }
    .pw-bar { height: 4px; border-radius: 4px; background: #e8f0f0; overflow: hidden; }
    .pw-fill { height: 100%; width: 0; border-radius: 4px; transition: width .3s, background .3s; }
    .pw-text { font-size: .73rem; margin-top: .3rem; color: var(--muted); }

    /* Divider */
    .fc-divider {
      height: 1px; background: var(--border);
      margin: 1.5rem 0;
    }

    /* Toggle switch */
    .fc-switch { display: flex; align-items: center; gap: 1rem; padding: .8rem 0; }
    .fc-switch-label { flex: 1; }
    .fc-switch-label strong { font-size: .9rem; font-weight: 700; color: var(--heading); display: block; }
    .fc-switch-label span { font-size: .78rem; color: var(--muted); }
    .form-check-input:checked { background-color: var(--accent); border-color: var(--accent); }
    .form-check-input { width: 2.4em; height: 1.3em; cursor: pointer; }

    /* Location card */
    .map-preview {
      width: 100%; height: 180px;
      border-radius: 14px; overflow: hidden;
      background: linear-gradient(135deg, #eaf6f5, #dff3f0);
      display: flex; align-items: center; justify-content: center;
      border: 1.5px solid var(--border);
      margin-bottom: 1rem; position: relative;
    }
    .map-preview-placeholder {
      text-align: center; color: var(--muted);
    }
    .map-preview-placeholder i { font-size: 2.5rem; color: var(--accent); opacity: .4; display: block; margin-bottom: .5rem; }
    .map-preview-placeholder span { font-size: .82rem; }

    .loc-btn {
      display: inline-flex; align-items: center; gap: .5rem;
      background: var(--soft); color: var(--accent);
      border: none; border-radius: 50px; padding: .6rem 1.2rem;
      font-size: .85rem; font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .25s;
    }
    .loc-btn:hover { background: var(--accent); color: #fff; }

    /* Avatar upload */
    .avatar-upload-area {
      border: 2px dashed var(--border);
      border-radius: 16px;
      padding: 1.5rem;
      text-align: center;
      cursor: pointer;
      transition: border-color .2s, background .2s;
      background: #fafefe;
    }
    .avatar-upload-area:hover { border-color: var(--accent); background: var(--mint); }
    .avatar-upload-area i { font-size: 2rem; color: #b0c4c6; display: block; margin-bottom: .5rem; }
    .avatar-upload-area p { font-size: .82rem; color: var(--muted); margin: 0; }
    .avatar-upload-area span { font-size: .75rem; color: #b0c4c6; }

    /* Danger zone */
    .danger-card {
      background: #fff8f8;
      border: 1.5px solid #fde8e8;
      border-radius: 16px;
      padding: 1.2rem 1.5rem;
      display: flex; align-items: center; gap: 1rem;
    }
    .danger-icon { width: 44px; height: 44px; background: #fde8e8; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #e74c3c; font-size: 1.1rem; }
    .danger-text strong { font-size: .9rem; color: #c0392b; display: block; }
    .danger-text span   { font-size: .78rem; color: #e57575; }
    .btn-danger-fc {
      background: #fde8e8; color: #c0392b;
      border: none; border-radius: 50px;
      padding: .55rem 1.2rem; font-size: .83rem;
      font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .25s; white-space: nowrap;
    }
    .btn-danger-fc:hover { background: #e74c3c; color: #fff; }

    /* Submit buttons */
    .btn-save {
      background: var(--accent); color: #fff;
      border: none; border-radius: 50px;
      padding: .78rem 2rem; font-size: .92rem;
      font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .25s;
      display: inline-flex; align-items: center; gap: .5rem;
    }
    .btn-save:hover { background: var(--accent-dark); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(9,154,167,.25); }
    .btn-save:active { transform: translateY(0); }

    .btn-cancel {
      background: transparent; color: var(--muted);
      border: 1.5px solid var(--border); border-radius: 50px;
      padding: .78rem 1.5rem; font-size: .9rem;
      font-weight: 600; font-family: inherit;
      cursor: pointer; transition: all .25s;
    }
    .btn-cancel:hover { border-color: var(--heading); color: var(--heading); }

    /* Toast */
    .toast-fc {
      position: fixed; bottom: 28px; right: 28px;
      background: var(--heading); color: #fff;
      border-radius: 16px; padding: 1rem 1.4rem;
      display: flex; align-items: center; gap: .8rem;
      box-shadow: 0 16px 40px rgba(0,0,0,.18);
      z-index: 9999; transform: translateY(80px);
      opacity: 0; transition: all .35s cubic-bezier(.34,1.56,.64,1);
      max-width: 360px;
    }
    .toast-fc.show { transform: translateY(0); opacity: 1; }
    .toast-fc i { font-size: 1.3rem; color: #a8ffd4; flex-shrink: 0; }
    .toast-fc strong { font-size: .9rem; display: block; }
    .toast-fc span   { font-size: .78rem; color: rgba(255,255,255,.65); }

    /* Scroll top */
    #scroll-top {
      position:fixed; bottom:28px; right:28px;
      width:48px; height:48px; background:var(--accent); color:#fff;
      border-radius:50%; text-decoration:none; font-size:1.4rem;
      display:none; align-items:center; justify-content:center;
      z-index:999; transition:all .3s; box-shadow:0 6px 20px rgba(9,154,167,.35);
    }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    /* Responsive */
    @media (max-width:991px) {
      .profile-sidebar { position:static; margin-bottom:1.5rem; }
      .page-topbar { padding:2rem 0 3.5rem; }
    }
    @media (max-width:768px) {
      .header-search { display:none; }
      .pcard-body { padding:1.3rem; }
    }
  </style>
</head>
<body>

<!-- ===== HEADER ===== -->
<header class="header fixed-top" id="mainHeader">
  <div class="container-xl">
    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('index.clientes') }}" class="text-decoration-none me-2 flex-shrink-0">
        <h1 class="sitename"><span class="s1">Farma</span><span class="s2">Connect</span></h1>
      </a>
      <div class="header-search d-none d-md-block mx-auto">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input type="text" class="form-control" placeholder="Pesquise medicamentos, farmácias...">
          <button class="btn-search-go" type="button"><i class="bi bi-arrow-right-circle-fill"></i></button>
        </div>
      </div>
      <nav class="navmenu d-none d-lg-block flex-shrink-0">
        <ul>
          <li><a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a></li>
          <li><a href="{{route('farmacias.list')}}"><i class="bi bi-hospital"></i> Farmácias</a></li>
          <li><a href="{{ route('produtos.clientes') }}"><i class="bi bi-box-seam"></i> Produtos</a></li>
          <li><a href="{{ route('pedidos.clientes') }}"><i class="bi bi-clock-history"></i> Histórico</a></li>
        </ul>
      </nav>
      <div class="d-flex align-items-center gap-3 flex-shrink-0 ms-auto ms-lg-0">
        <a href="{{ route('carrinho.clientes') }}" class="header-cart d-none d-sm-inline-flex">
          <i class="bi bi-bag"></i>
          <span class="cart-badge">3</span>
        </a>
        <div class="dropdown">
          <a href="#" class="profile-toggle dropdown-toggle" id="pdrop" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&rounded=true&size=34"
                 width="34" height="34" class="rounded-circle" alt="Perfil">
            <span class="pname d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pdrop">
            <li><a class="dropdown-item active" href="{{ route('perfil.clientes') }}"><i class="bi bi-person me-2"></i>Minha Conta</a></li>
            <li><a class="dropdown-item" href="{{ route('pedidos.clientes') }}"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"></i>Favoritos</a></li>
            <li><hr class="dropdown-divider mx-2 my-1"></li>
            <li><a class="dropdown-item text-danger" href="{{ route('logout' , ['id'=>auth()->user()->id]) }}"><i class="bi bi-box-arrow-right me-2"></i>Terminar Sessão</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ===== PAGE TOPBAR ===== -->
<div class="page-topbar" style="padding-top:64px;">
  <div class="topbar-blob topbar-blob-1"></div>
  <div class="topbar-blob topbar-blob-2"></div>
  <div class="container-xl" style="position:relative;z-index:2;">
    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span><i class="bi bi-chevron-right" style="font-size:.7rem;"></i></span>
      <span class="current">Meu Perfil</span>
    </div>
    <h2>Meu Perfil</h2>
    <p>Gerencie as suas informações pessoais e preferências de conta</p>
  </div>
</div>

<!-- ===== PROFILE CONTENT ===== -->
<div class="profile-wrap">
  <div class="container-xl">
    <div class="row g-4">

      <!-- SIDEBAR -->
      <div class="col-lg-3">
        <div class="profile-sidebar">
          <div class="sidebar-cover"></div>
          <div class="sidebar-avatar-wrap">
            <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&size=84"
                 class="sidebar-avatar" alt="Ana Costa" id="sidebarAvatar">
            <span class="avatar-edit-btn" onclick="document.getElementById('avatarInput').click()">
              <i class="bi bi-camera-fill"></i>
            </span>
          </div>
          <div class="sidebar-info">
            <div class="sidebar-name" id="sidebarName">{{ Auth::user()->name }}</div>
            <div class="sidebar-email" id="sidebarEmail">{{ Auth::user()->email }}</div>
            <span class="sidebar-badge"><i class="bi bi-patch-check-fill"></i> Cliente verificado</span>
            <div class="sidebar-stats">
              <div class="sstat"><div class="val">{{ Auth::user()->pedidos()->count() }}</div><div class="key">Pedidos</div></div>
              {{-- <div class="sstat"><div class="val">4.9★</div><div class="key">Avaliação</div></div> --}}
              <div class="sstat"><div class="val">{{ Auth::user()->enderecos()->count() }}</div><div class="key">Endereços</div></div>
            </div>
          </div>
          <div class="sidebar-nav">
            <a class="snav-item active" onclick="showTab('info')">
              <i class="bi bi-person-fill"></i> Informações Pessoais
            </a>
            <a class="snav-item" onclick="showTab('security')">
              <i class="bi bi-shield-lock-fill"></i> Segurança
            </a>
            <a class="snav-item" onclick="showTab('location')">
              <i class="bi bi-geo-alt-fill"></i> Localização
            </a>
            <a class="snav-item" onclick="showTab('notif')">
              <i class="bi bi-bell-fill"></i> Notificações
              <span class="snav-badge">2</span>
            </a>
            <div class="snav-divider"></div>
            <a class="snav-item" href="{{ route('pedidos.clientes') }}">
              <i class="bi bi-bag-fill"></i> Meus Pedidos
            </a>
            <a class="snav-item" href="#">
              <i class="bi bi-heart-fill"></i> Favoritos
            </a>
            <div class="snav-divider"></div>
            <a class="snav-item" href="{{ route('logout' , ['id'=>auth()->user()->id]) }}" style="color:#e74c3c;">
              <i class="bi bi-box-arrow-right" style="color:#e74c3c;"></i> Terminar Sessão
            </a>
          </div>
        </div>
      </div>

      <!-- MAIN FORM -->
      <div class="col-lg-9">

        <!-- ===== TAB: INFORMAÇÕES PESSOAIS ===== -->
        <div id="tab-info">

          <!-- Avatar upload card -->
          <div class="pcard">
            <div class="pcard-header">
              <div class="pcard-title">
                <div class="pcard-icon"><i class="bi bi-camera"></i></div>
                <div>
                  <h5>Foto de Perfil</h5>
                  <p>JPG, PNG ou GIF · Máx. 2MB</p>
                </div>
              </div>
            </div>
            <div class="pcard-body">
              <div class="row align-items-center g-4">
                <div class="col-auto">
                  <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&size=80"
                       class="rounded-circle" width="80" height="80"
                       style="border:3px solid var(--soft);box-shadow:0 6px 20px rgba(9,154,167,.15);"
                       alt="Avatar" id="avatarPreview">
                </div>
                <div class="col">
                  <div class="avatar-upload-area" onclick="document.getElementById('avatarInput').click()">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <p>Arraste a foto aqui ou <strong style="color:var(--accent);">clique para selecionar</strong></p>
                    <span>Formatos suportados: JPG, PNG, GIF</span>
                  </div>
                  <input type="file" id="avatarInput" accept="image/*" class="d-none">
                </div>
              </div>
            </div>
          </div>

          <!-- Info pessoal form -->
          <div class="pcard">
            <div class="pcard-header">
              <div class="pcard-title">
                <div class="pcard-icon"><i class="bi bi-person"></i></div>
                <div>
                  <h5>Informações Pessoais</h5>
                  <p>Dados básicos da sua conta</p>
                </div>
              </div>
              <span style="font-size:.75rem;color:var(--muted);"><i class="bi bi-asterisk" style="color:#e74c3c;font-size:.6rem;"></i> campos obrigatórios</span>
            </div>
            <div class="pcard-body">
              <form id="formInfo" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">

                  <!-- Nome -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-person"></i> Primeiro Nome <span class="req">*</span></label>
                    <div class="fc-input-icon">
                      <i class="bi bi-person"></i>
                      <input type="text" class="fc-input" name="name" id="iName"
                             placeholder="Ex: Ana" value="{{ $user->name }}" required>
                    </div>
                    <div class="fc-error" id="err-name">Por favor, insira o primeiro nome.</div>
                  </div>

                  <!-- Apelido -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-person"></i> Apelido <span class="req">*</span></label>
                    <div class="fc-input-icon">
                      <i class="bi bi-person"></i>
                      <input type="text" class="fc-input" name="last_name" id="iLastName"
                             placeholder="Ex: Costa" value="{{ $user->last_name }}" required>
                    </div>
                    <div class="fc-error" id="err-last_name">Por favor, insira o apelido.</div>
                  </div>

                  <!-- Email -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-envelope"></i> Email <span class="req">*</span></label>
                    <div class="fc-input-icon">
                      <i class="bi bi-envelope"></i>
                      <input type="email" class="fc-input" name="email" id="iEmail"
                             placeholder="exemplo@email.com" value="{{ $user->email }}" required>
                    </div>
                    <div class="fc-hint"><i class="bi bi-info-circle"></i> Usado para login e notificações</div>
                    <div class="fc-error" id="err-email">Insira um email válido.</div>
                  </div>

                  <!-- Telefone -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-telephone"></i> Telefone</label>
                    <div class="fc-input-icon">
                      <i class="bi bi-telephone"></i>
                      <input type="tel" class="fc-input" name="phone" id="iPhone"
                             placeholder="+244 9XX XXX XXX" value="{{ $user->phone }}">
                    </div>
                    <div class="fc-hint"><i class="bi bi-info-circle"></i> Para confirmação de entrega</div>
                  </div>

                  <!-- Data de nascimento -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-calendar3"></i> Data de Nascimento</label>
                    <div class="fc-input-icon">
                      <i class="bi bi-calendar3"></i>
                      <input type="date" class="fc-input" name="data_nascimento" id="iDob"
                             value="{{ $user->data_nascimento }}" max="">
                    </div>
                    <div class="fc-hint"><i class="bi bi-info-circle"></i> Não pode ser uma data futura</div>
                  </div>

                  <!-- Género -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-gender-ambiguous"></i> Género</label>
                    <div class="fc-input-icon">
                      <i class="bi bi-gender-ambiguous"></i>
                      <select class="fc-input" name="genero" id="iGenero" >
                        <option value="masculino" {{ $user->genero === 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="feminino" {{ $user->genero === 'feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="outro" {{ $user->genero === 'outro' ? 'selected' : '' }}>Outro</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="fc-divider"></div>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                  <button type="submit" class="btn-save">
                    <i class="bi bi-check2-circle"></i> Guardar Alterações
                  </button>
                  <button type="reset" class="btn-cancel">Cancelar</button>
                  <span id="savingInfo" style="font-size:.83rem;color:var(--muted);display:none;">
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span> A guardar...
                  </span>
                </div>
              </form>
            </div>
          </div>

        </div><!-- /tab-info -->

        <!-- ===== TAB: SEGURANÇA ===== -->
        <div id="tab-security" style="display:none;">
          <div class="pcard">
            <div class="pcard-header">
              <div class="pcard-title">
                <div class="pcard-icon"><i class="bi bi-shield-lock"></i></div>
                <div>
                  <h5>Alterar Password</h5>
                  <p>Mantenha a sua conta protegida</p>
                </div>
              </div>
            </div>
            <div class="pcard-body">
              <form id="formSecurity" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">

                  <!-- Password actual (não é um campo de validation mas boa prática UX) -->
                  <div class="col-12">
                    <label class="fc-label"><i class="bi bi-lock"></i> Password Actual <span class="req">*</span></label>
                    <div class="fc-input-icon">
                      <i class="bi bi-lock"></i>
                      <input type="password" class="fc-input with-eye" name="current_password" id="iPwCurrent"
                             placeholder="A sua password actual">
                      <button type="button" class="eye-toggle" onclick="togglePw('iPwCurrent',this)">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                  </div>

                  <!-- Nova password -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-lock-fill"></i> Nova Password <span class="req">*</span></label>
                    <div class="fc-input-icon">
                      <i class="bi bi-lock-fill"></i>
                      <input type="password" class="fc-input with-eye" name="password" id="iPwNew"
                             placeholder="Mínimo 8 caracteres" oninput="checkStrength(this.value)">
                      <button type="button" class="eye-toggle" onclick="togglePw('iPwNew',this)">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <div class="pw-strength">
                      <div class="pw-bar"><div class="pw-fill" id="pwFill"></div></div>
                      <div class="pw-text" id="pwText">Insira uma password</div>
                    </div>
                    <div class="fc-error" id="err-password">Mínimo 8 caracteres.</div>
                  </div>

                  <!-- Confirmar password -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-lock-fill"></i> Confirmar Password <span class="req">*</span></label>
                    <div class="fc-input-icon">
                      <i class="bi bi-lock-fill"></i>
                      <input type="password" class="fc-input with-eye" name="password_confirmation" id="iPwConfirm"
                             placeholder="Repita a nova password">
                      <button type="button" class="eye-toggle" onclick="togglePw('iPwConfirm',this)">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <div class="fc-error" id="err-password_confirmation">As passwords não coincidem.</div>
                  </div>

                  <div class="col-12">
                    <div class="fc-hint"><i class="bi bi-info-circle"></i> Use letras maiúsculas, minúsculas, números e símbolos para uma password mais segura.</div>
                  </div>

                </div>

                <div class="fc-divider"></div>

                <!-- Sessões activas -->
                {{-- <div class="mb-3">
                  <h6 style="font-weight:700;color:var(--heading);margin-bottom:1rem;">Sessões Activas</h6>
                  <div style="display:flex;flex-direction:column;gap:.75rem;">
                    <div style="display:flex;align-items:center;gap:1rem;padding:.9rem 1.1rem;background:var(--mint);border-radius:14px;">
                      <div style="width:40px;height:40px;background:var(--soft);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:1.1rem;"><i class="bi bi-laptop"></i></div>
                      <div style="flex:1;"><strong style="font-size:.88rem;color:var(--heading);">Chrome · Windows</strong><div style="font-size:.75rem;color:var(--muted);">Luanda · Sessão actual</div></div>
                      <span style="background:var(--soft);color:var(--accent);font-size:.72rem;font-weight:700;padding:.2rem .65rem;border-radius:50px;">Actual</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:1rem;padding:.9rem 1.1rem;background:#fafefe;border:1.5px solid var(--border);border-radius:14px;">
                      <div style="width:40px;height:40px;background:#f0f0f0;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#a0b9bc;font-size:1.1rem;"><i class="bi bi-phone"></i></div>
                      <div style="flex:1;"><strong style="font-size:.88rem;color:var(--heading);">Safari · iPhone</strong><div style="font-size:.75rem;color:var(--muted);">Luanda · Há 2 dias</div></div>
                      <button type="button" style="background:#fde8e8;color:#c0392b;border:none;border-radius:50px;padding:.28rem .75rem;font-size:.75rem;font-weight:700;cursor:pointer;">Encerrar</button>
                    </div>
                  </div>
                </div> --}}

                <div class="fc-divider"></div>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                  <button type="submit" class="btn-save">
                    <i class="bi bi-shield-check"></i> Actualizar Password
                  </button>
                  <button type="reset" class="btn-cancel">Cancelar</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Danger zone -->
          <div class="pcard">
            <div class="pcard-header">
              <div class="pcard-title">
                <div class="pcard-icon" style="background:#fde8e8;color:#e74c3c;"><i class="bi bi-exclamation-triangle"></i></div>
                <div><h5 style="color:#c0392b;">Zona de Perigo</h5><p>Acções irreversíveis</p></div>
              </div>
            </div>
            <div class="pcard-body">
              <div class="danger-card">
                <div class="danger-icon"><i class="bi bi-trash3"></i></div>
                <div class="danger-text" style="flex:1;">
                  <strong>Eliminar conta</strong>
                  <span>Esta acção é permanente e não pode ser desfeita.</span>
                </div>
                <button class="btn-danger-fc">Eliminar conta</button>
              </div>
            </div>
          </div>
        </div><!-- /tab-security -->

        <!-- ===== TAB: LOCALIZAÇÃO ===== -->
        <div id="tab-location" style="display:none;">
          <div class="pcard">
            <div class="pcard-header">
              <div class="pcard-title">
                <div class="pcard-icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                  <h5>Endereço e Localização</h5>
                  <p>Para entregas mais rápidas e precisas</p>
                </div>
              </div>
            </div>
            <div class="pcard-body">
              <form id="formLocation" novalidate>
                @csrf
                @method('PUT')

                <!-- Mapa placeholder -->
                <div class="map-preview">
                  <div class="map-preview-placeholder">
                    <i class="bi bi-map"></i>
                    <span>Clique em "Usar localização actual" para preencher automaticamente</span>
                  </div>
                </div>

                <div class="d-flex gap-2 mb-4 flex-wrap">
                  <button type="button" class="loc-btn" onclick="getLocation()">
                    <i class="bi bi-crosshair2"></i> Usar localização actual
                  </button>
                  <button type="button" class="loc-btn" style="background:var(--mint);">
                    <i class="bi bi-plus-circle"></i> Adicionar endereço manualmente
                  </button>
                </div>

                <div class="row g-4">

                  <!-- Endereço -->
                  <div class="col-12">
                    <label class="fc-label"><i class="bi bi-house"></i> Endereço Completo</label>
                    <div class="fc-input-icon">
                      <i class="bi bi-house"></i>
                      <input type="text" class="fc-input" name="endereco" id="iEndereco"
                             placeholder="Rua, número, bairro, município..."
                             value="{{ $endereco->name }}">
                    </div>
                    <div class="fc-hint"><i class="bi bi-info-circle"></i> Máximo 500 caracteres</div>
                  </div>

                  <!-- Latitude -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-compass"></i> Latitude</label>
                    <div class="fc-input-icon">
                      <i class="bi bi-compass"></i>
                      <input type="text" class="fc-input" name="latitude" id="iLat"
                             placeholder="-8.8367" value="-{{$endereco->latitude}}"
                             pattern="^-?([0-9]{1,2})(\.[0-9]+)?$">
                    </div>
                  </div>

                  <!-- Longitude -->
                  <div class="col-md-6">
                    <label class="fc-label"><i class="bi bi-compass-fill"></i> Longitude</label>
                    <div class="fc-input-icon">
                      <i class="bi bi-compass-fill"></i>
                      <input type="text" class="fc-input" name="{{$endereco->longitude}}" id="iLng"
                             placeholder="13.2344" value="13.2344"
                             pattern="^-?([0-9]{1,3})(\.[0-9]+)?$">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="fc-hint"><i class="bi bi-shield-check"></i> As coordenadas são usadas apenas para calcular a rota de entrega e nunca são partilhadas.</div>
                  </div>

                </div>

                <div class="fc-divider"></div>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                  <button type="submit" class="btn-save">
                    <i class="bi bi-geo-alt-fill"></i> Guardar Localização
                  </button>
                  <button type="reset" class="btn-cancel">Cancelar</button>
                </div>
              </form>
            </div>
          </div>
        </div><!-- /tab-location -->

        <!-- ===== TAB: NOTIFICAÇÕES ===== -->
        <div id="tab-notif" style="display:none;">
          <div class="pcard">
            <div class="pcard-header">
              <div class="pcard-title">
                <div class="pcard-icon"><i class="bi bi-bell"></i></div>
                <div>
                  <h5>Preferências de Notificação</h5>
                  <p>Escolha como quer ser notificado</p>
                </div>
              </div>
            </div>
            <div class="pcard-body">
              <h6 style="font-size:.82rem;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:1rem;">Notificações por Email</h6>

              <div class="fc-switch">
                <div class="fc-switch-label">
                  <strong>Confirmação de pedidos</strong>
                  <span>Receba um email quando o seu pedido for confirmado</span>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>
              <div class="fc-divider" style="margin:.5rem 0;"></div>
              <div class="fc-switch">
                <div class="fc-switch-label">
                  <strong>Actualizações de entrega</strong>
                  <span>Saiba quando o seu entregador está a caminho</span>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>
              <div class="fc-divider" style="margin:.5rem 0;"></div>
              <div class="fc-switch">
                <div class="fc-switch-label">
                  <strong>Promoções e ofertas</strong>
                  <span>Fique a par das melhores ofertas das farmácias parceiras</span>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox">
                </div>
              </div>
              <div class="fc-divider" style="margin:.5rem 0;"></div>
              <div class="fc-switch">
                <div class="fc-switch-label">
                  <strong>Newsletter semanal</strong>
                  <span>Dicas de saúde e novidades da plataforma</span>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox">
                </div>
              </div>

              <h6 style="font-size:.82rem;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin:1.5rem 0 1rem;">Notificações Push</h6>

              <div class="fc-switch">
                <div class="fc-switch-label">
                  <strong>Alertas de stock</strong>
                  <span>Quando um medicamento favorito ficar disponível</span>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>
              <div class="fc-divider" style="margin:.5rem 0;"></div>
              <div class="fc-switch">
                <div class="fc-switch-label">
                  <strong>Avaliação pós-entrega</strong>
                  <span>Pedido para avaliar após receber o pedido</span>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="fc-divider"></div>
              <div class="d-flex align-items-center gap-3">
                <button class="btn-save" onclick="showToast('Preferências guardadas!','As suas notificações foram actualizadas.')">
                  <i class="bi bi-bell-fill"></i> Guardar Preferências
                </button>
              </div>
            </div>
          </div>
        </div><!-- /tab-notif -->

      </div><!-- /col-lg-9 -->
    </div><!-- /row -->
  </div><!-- /container -->
</div><!-- /profile-wrap -->

<!-- ===== FOOTER MINI ===== -->
<footer style="background:var(--heading);color:#fff;padding:2rem 0;margin-top:2rem;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
      <span style="font-size:1.3rem;font-weight:800;"><span style="color:var(--accent);">Farma</span>Connect</span>
      <span style="color:#6a8a8d;font-size:.85rem;">&copy; 2026 FarmaConnect · Todos os direitos reservados.</span>
      <div>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Privacidade</a>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Termos</a>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Suporte</a>
      </div>
    </div>
  </div>
</footer>

<!-- Toast notification -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div>
    <strong id="toastTitle">Perfil actualizado!</strong>
    <span id="toastMsg">As suas informações foram guardadas com sucesso.</span>
  </div>
</div>

<!-- Scroll top -->
<a href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

  // ===== TAB NAVIGATION =====
  function showTab(tab) {
    ['info','security','location','notif'].forEach(t => {
      document.getElementById('tab-' + t).style.display = t === tab ? 'block' : 'none';
    });
    document.querySelectorAll('.snav-item').forEach((el, i) => {
      el.classList.remove('active');
    });
    const map = {info:0, security:1, location:2, notif:3};
    document.querySelectorAll('.snav-item')[map[tab]]?.classList.add('active');
  }

  // ===== HEADER SCROLL =====
  const hdr = document.getElementById('mainHeader');
  window.addEventListener('scroll', () => hdr.classList.toggle('scrolled', scrollY > 50));

  // Scroll top
  const st = document.getElementById('scroll-top');
  window.addEventListener('scroll', () => st.style.display = scrollY > 320 ? 'flex' : 'none');

  // ===== AVATAR PREVIEW =====
  document.getElementById('avatarInput').addEventListener('change', function() {
    if (!this.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('avatarPreview').src = e.target.result;
      document.getElementById('sidebarAvatar').src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
  });

  // ===== PASSWORD TOGGLE =====
  function togglePw(id, btn) {
    const inp = document.getElementById(id);
    const isText = inp.type === 'text';
    inp.type = isText ? 'password' : 'text';
    btn.innerHTML = isText ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
  }

  // ===== PASSWORD STRENGTH =====
  function checkStrength(pw) {
    const fill = document.getElementById('pwFill');
    const text = document.getElementById('pwText');
    let score = 0;
    if (pw.length >= 8)  score++;
    if (/[A-Z]/.test(pw)) score++;
    if (/[0-9]/.test(pw)) score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;

    const levels = [
      {w:'0%',  c:'#e74c3c', t:'Muito fraca'},
      {w:'25%', c:'#e74c3c', t:'Fraca'},
      {w:'50%', c:'#f59e0b', t:'Razoável'},
      {w:'75%', c:'#3b82f6', t:'Boa'},
      {w:'100%',c:'#22c55e', t:'Excelente'},
    ];
    const lv = pw.length === 0 ? 0 : score;
    fill.style.width = levels[lv].w;
    fill.style.background = levels[lv].c;
    text.textContent = pw.length === 0 ? 'Insira uma password' : levels[lv].t;
    text.style.color = levels[lv].c;
  }

  // ===== GEOLOCATION =====
  function getLocation() {
    if (!navigator.geolocation) { alert('Geolocalização não suportada.'); return; }
    navigator.geolocation.getCurrentPosition(pos => {
      document.getElementById('iLat').value = pos.coords.latitude.toFixed(6);
      document.getElementById('iLng').value = pos.coords.longitude.toFixed(6);
      showToast('Localização detectada!','Coordenadas preenchidas automaticamente.');
    }, () => {
      showToast('Erro de localização','Não foi possível obter a sua localização.');
    });
  }

  // ===== DATE MAX (today) =====
  document.getElementById('iDob').max = new Date().toISOString().split('T')[0];

  // ===== TOAST =====
  function showToast(title, msg) {
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMsg').textContent = msg;
    const t = document.getElementById('toastFc');
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3500);
  }

  // ===== FORM VALIDATION — INFO =====
  document.getElementById('formInfo').addEventListener('submit', function(e) {
    e.preventDefault();
    let ok = true;
    const fields = [
      {id:'iName',     err:'err-name',      check: v => v.trim().length > 0},
      {id:'iLastName', err:'err-last_name',  check: v => v.trim().length > 0},
      {id:'iEmail',    err:'err-email',      check: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)},
    ];
    fields.forEach(f => {
      const inp = document.getElementById(f.id);
      const err = document.getElementById(f.err);
      if (!f.check(inp.value)) {
        inp.classList.add('is-error'); inp.classList.remove('is-ok');
        err.style.display = 'block'; ok = false;
      } else {
        inp.classList.remove('is-error'); inp.classList.add('is-ok');
        err.style.display = 'none';
      }
    });
    if (!ok) return;
    // Update sidebar live
    const name = document.getElementById('iName').value.trim();
    const last = document.getElementById('iLastName').value.trim();
    const email = document.getElementById('iEmail').value.trim();
    document.getElementById('sidebarName').textContent = name + ' ' + last;
    document.getElementById('sidebarEmail').textContent = email;
    document.getElementById('sidebarAvatar').src =
      `https://ui-avatars.com/api/?name=${encodeURIComponent(name+'+'+last)}&background=099aa7&color=fff&size=84`;

    const saving = document.getElementById('savingInfo');
    saving.style.display = 'inline-flex';
    setTimeout(() => {
      saving.style.display = 'none';
      showToast('Perfil actualizado!', 'As suas informações foram guardadas com sucesso.');
    }, 1200);
  });

  // ===== FORM VALIDATION — SECURITY =====
  document.getElementById('formSecurity').addEventListener('submit', function(e) {
    e.preventDefault();
    const pw    = document.getElementById('iPwNew').value;
    const conf  = document.getElementById('iPwConfirm').value;
    let ok = true;
    const errPw   = document.getElementById('err-password');
    const errConf = document.getElementById('err-password_confirmation');
    if (pw.length < 8) {
      document.getElementById('iPwNew').classList.add('is-error');
      errPw.style.display = 'block'; ok = false;
    } else {
      document.getElementById('iPwNew').classList.remove('is-error');
      document.getElementById('iPwNew').classList.add('is-ok');
      errPw.style.display = 'none';
    }
    if (pw !== conf || conf === '') {
      document.getElementById('iPwConfirm').classList.add('is-error');
      errConf.style.display = 'block'; ok = false;
    } else {
      document.getElementById('iPwConfirm').classList.remove('is-error');
      document.getElementById('iPwConfirm').classList.add('is-ok');
      errConf.style.display = 'none';
    }
    if (!ok) return;
    showToast('Password alterada!', 'A sua password foi actualizada com sucesso.');
    this.reset();
    checkStrength('');
  });

  // ===== FORM — LOCATION =====
  document.getElementById('formLocation').addEventListener('submit', function(e) {
    e.preventDefault();
    showToast('Localização guardada!', 'O seu endereço foi actualizado.');
  });

  // Clear error on input
  document.querySelectorAll('.fc-input').forEach(inp => {
    inp.addEventListener('input', () => {
      inp.classList.remove('is-error');
    });
  });

</script>
</body>
</html>