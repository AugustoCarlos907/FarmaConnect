  
        <!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Meu Perfil (Entregador)</title>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    /* ========== ESTILOS GLOBAIS ========== */
    :root {
      --teal:       #0bbfcc;
      --teal-dim:   #08949f;
      --teal-ultra: rgba(11,191,204,.06);
      --surface:    #ffffff;
      --border-light:#e8eff2;
      --text-main:  #0e2228;
      --text-mid:   #4a6e78;
      --text-dim:   #8fadb5;
      --green:      #1ec97a;
      --amber:      #f5a623;
      --red:        #f04e60;
      --bg:         #f2f7f9;
      --r24: 24px; --r16: 16px; --r12: 12px;
      --shadow-sm:  0 2px 12px rgba(9,22,26,.06);
      --shadow-md:  0 8px 32px rgba(9,22,26,.10);
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    html { font-size: 13px; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text-main);
      min-height: 100vh;
    }

    .layout { display: flex; min-height: 100vh; }

    /* Sidebar (ajustado para o include) */
    .sidebar-placeholder {
      width: 260px;
      background: #09161a;
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      color: rgba(255,255,255,0.6);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-size: 0.9rem;
      z-index: 100;
    }
    .sidebar-placeholder p {
      text-align: center;
      background: rgba(255,255,255,0.1);
      padding: 1rem;
      border-radius: 12px;
      margin: 1rem;
    }
    .sidebar-placeholder i {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      display: block;
      color: #0bbfcc;
    }

    .main {
      flex: 1;
      margin-left: 260px;
      padding: 1.6rem 1.8rem;
      min-width: 0;
      animation: fadeUp .5s .1s cubic-bezier(.16,1,.3,1) both;
    }

    /* Topbar (reutilizado da dashboard de entregadores) */
    .topbar {
      display: flex; align-items: center; justify-content: space-between;
      background: var(--surface); border-radius: var(--r24);
      padding: .9rem 1.4rem; box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-light); margin-bottom: 1.5rem; gap: 1rem;
    }
    .topbar-greeting { font-family: 'Syne', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--text-main); line-height: 1.1; }
    .topbar-sub { font-size: .8rem; color: var(--text-mid); margin-top: .1rem; }

    /* Profile layout (similar ao exemplo do cliente) */
    .profile-wrap {
      margin-top: 0;
      padding-bottom: 2rem;
    }

    /* Sidebar do perfil */
    .profile-sidebar {
      background: var(--surface);
      border-radius: var(--r24);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
      position: sticky;
      top: 84px;
      border: 1px solid var(--border-light);
    }

    .sidebar-cover {
      height: 90px;
      background: linear-gradient(135deg, var(--teal), var(--teal-dim));
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
      border: 4px solid var(--surface);
      box-shadow: 0 8px 24px rgba(11,191,204,.2);
      object-fit: cover;
      background: #f0f0f0;
    }
    .avatar-edit-btn {
      position: absolute;
      bottom: 2px; right: calc(50% - 50px);
      width: 26px; height: 26px;
      background: var(--teal); color: #fff;
      border-radius: 50%; border: 2px solid #fff;
      display: flex; align-items: center; justify-content: center;
      font-size: .75rem; cursor: pointer;
      transition: background .2s;
    }
    .avatar-edit-btn:hover { background: var(--teal-dim); }

    .sidebar-info { text-align: center; padding: .8rem 1.5rem 1.5rem; }
    .sidebar-name { font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: .15rem; }
    .sidebar-email { font-size: .82rem; color: var(--text-mid); margin-bottom: 1rem; }

    .sidebar-badge {
      display: inline-flex; align-items: center; gap: .35rem;
      background: var(--teal-ultra); color: var(--teal);
      font-size: .75rem; font-weight: 700;
      padding: .28rem .9rem; border-radius: 50px;
      margin-bottom: 1.2rem;
    }

    .sidebar-stats {
      display: flex; gap: 0;
      border-top: 1px solid var(--border-light);
      border-bottom: 1px solid var(--border-light);
      margin-bottom: 1.2rem;
    }
    .sstat {
      flex: 1; text-align: center; padding: .85rem .5rem;
    }
    .sstat + .sstat { border-left: 1px solid var(--border-light); }
    .sstat .val { font-size: 1.2rem; font-weight: 800; color: var(--text-main); line-height: 1; }
    .sstat .key { font-size: .68rem; color: var(--text-mid); text-transform: uppercase; letter-spacing: .05em; margin-top: .2rem; }

    /* Sidebar nav */
    .sidebar-nav { padding: 0 .8rem 1rem; }
    .snav-item {
      display: flex; align-items: center; gap: .75rem;
      padding: .72rem 1rem; border-radius: 12px;
      text-decoration: none; color: var(--text-main);
      font-weight: 600; font-size: .9rem;
      transition: all .2s; margin-bottom: .15rem;
      cursor: pointer;
    }
    .snav-item i { font-size: 1.05rem; color: var(--text-mid); width: 20px; flex-shrink: 0; transition: color .2s; }
    .snav-item:hover { background: var(--teal-ultra); color: var(--teal); }
    .snav-item:hover i { color: var(--teal); }
    .snav-item.active { background: var(--teal-ultra); color: var(--teal); }
    .snav-item.active i { color: var(--teal); }
    .snav-divider { height: 1px; background: var(--border-light); margin: .6rem 1rem; }

    /* Cards de conteúdo */
    .pcard {
      background: var(--surface);
      border-radius: var(--r24);
      box-shadow: var(--shadow-sm);
      margin-bottom: 1.5rem;
      overflow: hidden;
      border: 1px solid var(--border-light);
    }
    .pcard-header {
      padding: 1.4rem 1.8rem 1.1rem;
      border-bottom: 1px solid var(--border-light);
      display: flex; align-items: center; justify-content: space-between;
    }
    .pcard-title {
      display: flex; align-items: center; gap: .75rem;
    }
    .pcard-icon {
      width: 40px; height: 40px;
      background: var(--teal-ultra); border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      color: var(--teal); font-size: 1.1rem;
    }
    .pcard-title h5 { font-size: 1rem; font-weight: 800; color: var(--text-main); margin: 0; }
    .pcard-title p  { font-size: .78rem; color: var(--text-mid); margin: 0; }
    .pcard-body { padding: 1.8rem; }

    /* Form fields */
    .fc-label {
      font-size: .82rem;
      font-weight: 700;
      color: var(--text-main);
      margin-bottom: .45rem;
      display: flex; align-items: center; gap: .35rem;
    }
    .fc-label i { color: var(--teal); font-size: .85rem; }
    .fc-label .req { color: var(--red); font-size: .75rem; }

    .fc-input {
      width: 100%;
      border: 1.5px solid var(--border-light);
      border-radius: 14px;
      padding: .72rem 1rem;
      font-size: .9rem;
      font-family: inherit;
      color: var(--text-main);
      background: #fafefe;
      transition: border-color .2s, box-shadow .2s, background .2s;
      outline: none;
    }
    .fc-input:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 3px rgba(11,191,204,.1);
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
    .fc-input-icon .eye-toggle:hover { color: var(--teal); }
    .fc-input-icon .fc-input.with-eye { padding-right: 2.8rem; }

    .fc-hint { font-size: .75rem; color: var(--text-mid); margin-top: .35rem; display: flex; align-items: center; gap: .3rem; }
    .fc-hint i { color: var(--teal); font-size: .75rem; }

    .fc-error { font-size: .75rem; color: var(--red); margin-top: .35rem; display: none; }
    .fc-input.is-error { border-color: var(--red); }
    .fc-input.is-ok    { border-color: var(--green); }

    /* Password strength */
    .pw-strength { margin-top: .5rem; }
    .pw-bar { height: 4px; border-radius: 4px; background: #e8f0f0; overflow: hidden; }
    .pw-fill { height: 100%; width: 0; border-radius: 4px; transition: width .3s, background .3s; }
    .pw-text { font-size: .73rem; margin-top: .3rem; color: var(--text-mid); }

    /* Divider */
    .fc-divider {
      height: 1px; background: var(--border-light);
      margin: 1.5rem 0;
    }

    /* Toggle switch */
    .fc-switch { display: flex; align-items: center; gap: 1rem; padding: .8rem 0; }
    .fc-switch-label { flex: 1; }
    .fc-switch-label strong { font-size: .9rem; font-weight: 700; color: var(--text-main); display: block; }
    .fc-switch-label span { font-size: .78rem; color: var(--text-mid); }
    .form-check-input:checked { background-color: var(--teal); border-color: var(--teal); }
    .form-check-input { width: 2.4em; height: 1.3em; cursor: pointer; }

    /* Location card */
    .map-preview {
      width: 100%; height: 180px;
      border-radius: 14px; overflow: hidden;
      background: linear-gradient(135deg, #eaf6f5, #dff3f0);
      display: flex; align-items: center; justify-content: center;
      border: 1.5px solid var(--border-light);
      margin-bottom: 1rem; position: relative;
    }
    .map-preview-placeholder {
      text-align: center; color: var(--text-mid);
    }
    .map-preview-placeholder i { font-size: 2.5rem; color: var(--teal); opacity: .4; display: block; margin-bottom: .5rem; }
    .map-preview-placeholder span { font-size: .82rem; }

    .loc-btn {
      display: inline-flex; align-items: center; gap: .5rem;
      background: var(--teal-ultra); color: var(--teal);
      border: none; border-radius: 50px; padding: .6rem 1.2rem;
      font-size: .85rem; font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .25s;
    }
    .loc-btn:hover { background: var(--teal); color: #fff; }

    /* Avatar upload */
    .avatar-upload-area {
      border: 2px dashed var(--border-light);
      border-radius: 16px;
      padding: 1.5rem;
      text-align: center;
      cursor: pointer;
      transition: border-color .2s, background .2s;
      background: #fafefe;
    }
    .avatar-upload-area:hover { border-color: var(--teal); background: var(--teal-ultra); }
    .avatar-upload-area i { font-size: 2rem; color: #b0c4c6; display: block; margin-bottom: .5rem; }
    .avatar-upload-area p { font-size: .82rem; color: var(--text-mid); margin: 0; }
    .avatar-upload-area span { font-size: .75rem; color: #b0c4c6; }

    /* Danger zone */
    .danger-card {
      background: #fff8f8;
      border: 1.5px solid #fde8e8;
      border-radius: 16px;
      padding: 1.2rem 1.5rem;
      display: flex; align-items: center; gap: 1rem;
    }
    .danger-icon { width: 44px; height: 44px; background: #fde8e8; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--red); font-size: 1.1rem; }
    .danger-text strong { font-size: .9rem; color: #c0392b; display: block; }
    .danger-text span   { font-size: .78rem; color: #e57575; }
    .btn-danger-fc {
      background: #fde8e8; color: #c0392b;
      border: none; border-radius: 50px;
      padding: .55rem 1.2rem; font-size: .83rem;
      font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .25s; white-space: nowrap;
    }
    .btn-danger-fc:hover { background: var(--red); color: #fff; }

    /* Buttons */
    .btn-save {
      background: var(--teal); color: #fff;
      border: none; border-radius: 50px;
      padding: .78rem 2rem; font-size: .92rem;
      font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .25s;
      display: inline-flex; align-items: center; gap: .5rem;
    }
    .btn-save:hover { background: var(--teal-dim); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(11,191,204,.25); }
    .btn-save:active { transform: translateY(0); }

    .btn-cancel {
      background: transparent; color: var(--text-mid);
      border: 1.5px solid var(--border-light); border-radius: 50px;
      padding: .78rem 1.5rem; font-size: .9rem;
      font-weight: 600; font-family: inherit;
      cursor: pointer; transition: all .25s;
    }
    .btn-cancel:hover { border-color: var(--text-main); color: var(--text-main); }

    /* Toast */
    .toast-fc {
      position: fixed; bottom: 28px; right: 28px;
      background: var(--text-main); color: #fff;
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
      width:48px; height:48px; background:var(--teal); color:#fff;
      border-radius:50%; text-decoration:none; font-size:1.4rem;
      display:none; align-items:center; justify-content:center;
      z-index:999; transition:all .3s; box-shadow:0 6px 20px rgba(11,191,204,.35);
    }
    #scroll-top:hover { background:var(--teal-dim); transform:translateY(-4px); }

    @keyframes fadeUp {
      from { transform: translateY(16px); opacity: 0; }
      to   { transform: translateY(0);    opacity: 1; }
    }

    @media (max-width:991px) {
      .profile-sidebar { position:static; margin-bottom:1.5rem; }
    }
    @media (max-width:768px) {
      .sidebar-placeholder { display: none; }
      .main { margin-left: 0; }
      .pcard-body { padding:1.3rem; }
    }
  </style>
</head>
<body>
<div class="layout">
  <!-- Sidebar existente da dashboard de entregadores -->
  <div class="sidebar-placeholder">
    @include('entregadores.dashboard.sidebar')
  </div>

  <main class="main">
    <!-- Topbar igual à da dashboard de entregadores (exemplo) -->
    <div class="topbar">
      <div class="topbar-left">
        <div>
          <div class="topbar-greeting">Meu Perfil</div>
          <div class="topbar-sub">Gerencie suas informações e preferências</div>
        </div>
      </div>
      <div class="topbar-right">
        <!-- opcional: botão de notificações, etc. -->
      </div>
    </div>

    <div class="profile-wrap">
      <div class="row g-4">
        <!-- Sidebar do perfil (navegação por tabs) -->
        <div class="col-lg-3">
          <div class="profile-sidebar">
            <div class="sidebar-cover"></div>
            <div class="sidebar-avatar-wrap">
              @if($entregador->foto_perfil)
                <img src="{{ asset('storage/' . $entregador->foto_perfil) }}" class="sidebar-avatar" id="sidebarAvatar" alt="Avatar">
              @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($entregador->name) }}&background=0bbfcc&color=fff&size=84" class="sidebar-avatar" id="sidebarAvatar" alt="Avatar">
              @endif
              <span class="avatar-edit-btn" onclick="document.getElementById('avatarInput').click()">
                <i class="bi bi-camera-fill"></i>
              </span>
            </div>
            <div class="sidebar-info">
              <div class="sidebar-name" id="sidebarName">{{ $entregador->name }}</div>
              <div class="sidebar-email" id="sidebarEmail">{{ $entregador->email }}</div>
              <span class="sidebar-badge"><i class="bi bi-patch-check-fill"></i> Entregador verificado</span>
              <div class="sidebar-stats">
                <div class="sstat"><div class="val">{{ $entregador->entregas()->count() }}</div><div class="key">Entregas</div></div>
                <div class="sstat"><div class="val">{{ $entregador->farmacia->name ?? '—' }}</div><div class="key">Farmácia</div></div>
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
              </a>
              <div class="snav-divider"></div>
              <a class="snav-item" href="{{ route('entregas.entregadores') }}">
                <i class="bi bi-truck"></i> Minhas Entregas
              </a>
              <div class="snav-divider"></div>
              <a class="snav-item" href="{{ route('logout'  , ['id'=>Auth::user()->id]) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: var(--red);">
                <i class="bi bi-box-arrow-right"></i> Terminar Sessão
              </a>
              <form id="logout-form" action="{{ route('logout'  , ['id'=>Auth::user()->id]) }}"
                 method="POST" style="display: none;">
                 @csrf
                
            </form>
            </div>
          </div>
        </div>

        <!-- Conteúdo principal (tabs) -->
        <div class="col-lg-9">
          <!-- Aba: Informações Pessoais -->
          <div id="tab-info">
            <!-- Card de foto de perfil -->
            <div class="pcard">
              <div class="pcard-header">
                <div class="pcard-title">
                  <div class="pcard-icon"><i class="bi bi-camera"></i></div>
                  <div>
                    <h5>Foto de Perfil</h5>
                    <p>JPG, PNG · Máx. 2MB</p>
                  </div>
                </div>
              </div>
              <div class="pcard-body">
                <div class="row align-items-center g-4">
                  <div class="col-auto">
                    @if($entregador->foto_perfil)
                      <img src="{{ asset('storage/' . $entregador->foto_perfil) }}" width="80" height="80" class="rounded-circle" style="border:3px solid var(--teal-ultra);box-shadow:0 6px 20px rgba(11,191,204,.15);" id="avatarPreview" alt="Avatar">
                    @else
                      <img src="https://ui-avatars.com/api/?name={{ urlencode($entregador->name) }}&background=0bbfcc&color=fff&size=80" width="80" height="80" class="rounded-circle" id="avatarPreview" alt="Avatar">
                    @endif
                  </div>
                  <div class="col">
                    <div class="avatar-upload-area" onclick="document.getElementById('avatarInput').click()">
                      <i class="bi bi-cloud-arrow-up"></i>
                      <p>Arraste a foto aqui ou <strong style="color:var(--teal);">clique para selecionar</strong></p>
                      <span>Formatos suportados: JPG, PNG</span>
                    </div>
                    <input type="file" id="avatarInput" accept="image/*" class="d-none">
                  </div>
                </div>
              </div>
            </div>

            <!-- Formulário de informações pessoais -->
            <div class="pcard">
              <div class="pcard-header">
                <div class="pcard-title">
                  <div class="pcard-icon"><i class="bi bi-person"></i></div>
                  <div>
                    <h5>Informações Pessoais</h5>
                    <p>Dados da sua conta e perfil de entregador</p>
                  </div>
                </div>
                <span style="font-size:.75rem;color:var(--text-mid);"><i class="bi bi-asterisk" style="color:var(--red);font-size:.6rem;"></i> campos obrigatórios</span>
              </div>
              <div class="pcard-body">
                <form id="formInfo" action="" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row g-4">
                    <!-- Nome completo -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-person"></i> Nome <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" class="fc-input" name="name" id="iName" value="{{ old('name', $entregador->name) }}" required>
                      </div>
                      <div class="fc-error" id="err-name">Por favor, insira o nome.</div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-envelope"></i> Email <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="fc-input" name="email" id="iEmail" value="{{ old('email', $entregador->email) }}" required>
                      </div>
                      <div class="fc-error" id="err-email">Insira um email válido.</div>
                    </div>

                    <!-- Telefone -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-telephone"></i> Telefone</label>
                      <div class="fc-input-icon">
                        <i class="bi bi-telephone"></i>
                        <input type="tel" class="fc-input" name="phone" id="iPhone" value="{{ old('phone', $entregador->telefone) }}">
                      </div>
                    </div>

                    <!-- Nº BI -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-file-person"></i> Nº de BI <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-file-person"></i>
                        <input type="text" class="fc-input" name="numero_bi" id="iBi" value="{{ old('numero_bi', $entregador->numero_bi) }}" required>
                      </div>
                      <div class="fc-error" id="err-bi">Campo obrigatório.</div>
                    </div>

                    <!-- Matrícula do veículo -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-truck"></i> Matrícula do Veículo <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-truck"></i>
                        <input type="text" class="fc-input" name="matricula_veiculo" id="iMatricula" value="{{ old('matricula_veiculo', $entregador->matricula_veiculo) }}" required>
                      </div>
                      <div class="fc-error" id="err-matricula">Campo obrigatório.</div>
                    </div>

                    <!-- Descrição -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-card-text"></i> Descrição (opcional)</label>
                      <textarea class="fc-input" name="descricao" rows="2">{{ old('descricao', $entregador->descricao) }}</textarea>
                    </div>

                    <!-- Disponível para entregas -->
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-hand-thumbs-up"></i> Disponível para entregas</label>
                      <div class="form-check form-switch" style="margin-top: 0.5rem;">
                        <input class="form-check-input" type="checkbox" name="disponivel" value="1" id="disponivel" {{ $entregador->disponivel ? 'checked' : '' }}>
                        <label class="form-check-label" for="disponivel">Sim, estou disponível</label>
                      </div>
                    </div>
                  </div>

                  <div class="fc-divider"></div>
                  <div class="d-flex align-items-center gap-3 flex-wrap">
                    <button type="submit" class="btn-save">
                      <i class="bi bi-check2-circle"></i> Guardar Alterações
                    </button>
                    <button type="reset" class="btn-cancel">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Aba: Segurança -->
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
                <form id="formSecurity" action="" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row g-4">
                    <div class="col-12">
                      <label class="fc-label"><i class="bi bi-lock"></i> Password Actual <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-lock"></i>
                        <input type="password" class="fc-input with-eye" name="current_password" id="iPwCurrent" placeholder="A sua password actual" required>
                        <button type="button" class="eye-toggle" onclick="togglePw('iPwCurrent',this)">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-lock-fill"></i> Nova Password <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" class="fc-input with-eye" name="password" id="iPwNew" placeholder="Mínimo 8 caracteres" oninput="checkStrength(this.value)" required>
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

                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-lock-fill"></i> Confirmar Password <span class="req">*</span></label>
                      <div class="fc-input-icon">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" class="fc-input with-eye" name="password_confirmation" id="iPwConfirm" placeholder="Repita a nova password" required>
                        <button type="button" class="eye-toggle" onclick="togglePw('iPwConfirm',this)">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      <div class="fc-error" id="err-password_confirmation">As passwords não coincidem.</div>
                    </div>
                  </div>

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

            <!-- Zona de perigo (opcional) -->
            <div class="pcard">
              <div class="pcard-header">
                <div class="pcard-title">
                  <div class="pcard-icon" style="background:#fde8e8;color:var(--red);"><i class="bi bi-exclamation-triangle"></i></div>
                  <div><h5 style="color:#c0392b;">Zona de Perigo</h5><p>Acções irreversíveis</p></div>
                </div>
              </div>
              <div class="pcard-body">
                <div class="danger-card">
                  <div class="danger-icon"><i class="bi bi-trash3"></i></div>
                  <div class="danger-text" style="flex:1;">
                    <strong>Desativar conta de entregador</strong>
                    <span>Esta acção impedirá que receba novas entregas.</span>
                  </div>
                  <button class="btn-danger-fc" onclick="alert('Funcionalidade em desenvolvimento.')">Desativar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Aba: Localização -->
          <div id="tab-location" style="display:none;">
            <div class="pcard">
              <div class="pcard-header">
                <div class="pcard-title">
                  <div class="pcard-icon"><i class="bi bi-geo-alt"></i></div>
                  <div>
                    <h5>Minha Localização Actual</h5>
                    <p>Coordenadas usadas para sugerir entregas próximas</p>
                  </div>
                </div>
              </div>
              <div class="pcard-body">
                <form id="formLocation" action="" method="POST">
                  @csrf
                  <div class="row g-4">
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-globe"></i> Latitude</label>
                      <div class="fc-input-icon">
                        <i class="bi bi-globe"></i>
                        <input type="text" class="fc-input" name="latitude" id="iLat" value="{{ old('latitude', $entregador->latitude) }}" placeholder="Ex: -8.838333">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="fc-label"><i class="bi bi-globe"></i> Longitude</label>
                      <div class="fc-input-icon">
                        <i class="bi bi-globe"></i>
                        <input type="text" class="fc-input" name="longitude" id="iLng" value="{{ old('longitude', $entregador->longitude) }}" placeholder="Ex: 13.234444">
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="button" class="loc-btn" onclick="getLocation()">
                        <i class="bi bi-crosshair"></i> Usar minha localização actual
                      </button>
                    </div>
                  </div>
                  <div class="fc-divider"></div>
                  <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn-save">
                      <i class="bi bi-geo-alt-fill"></i> Guardar Localização
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Aba: Notificações -->
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
                <h6 style="font-size:.82rem;text-transform:uppercase;letter-spacing:.07em;color:var(--text-mid);margin-bottom:1rem;">Notificações por Email</h6>

                <div class="fc-switch">
                  <div class="fc-switch-label">
                    <strong>Nova entrega disponível</strong>
                    <span>Receba um email quando houver uma nova entrega perto de si</span>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                  </div>
                </div>
                <div class="fc-divider" style="margin:.5rem 0;"></div>
                <div class="fc-switch">
                  <div class="fc-switch-label">
                    <strong>Actualizações de entrega</strong>
                    <span>Saiba quando o cliente confirma a recepção</span>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                  </div>
                </div>

                <h6 style="font-size:.82rem;text-transform:uppercase;letter-spacing:.07em;color:var(--text-mid);margin:1.5rem 0 1rem;">Notificações Push</h6>

                <div class="fc-switch">
                  <div class="fc-switch-label">
                    <strong>Alertas de nova entrega</strong>
                    <span>Notificação instantânea quando uma entrega estiver disponível</span>
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
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- Toast -->
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
    const activeIndex = map[tab];
    if (activeIndex !== undefined) {
      document.querySelectorAll('.snav-item')[activeIndex]?.classList.add('active');
    }
  }

  // ===== HEADER SCROLL (opcional, se tiver header fixo) =====
  // const hdr = document.getElementById('mainHeader');
  // window.addEventListener('scroll', () => hdr?.classList.toggle('scrolled', scrollY > 50));

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
      // Também podemos enviar o ficheiro automaticamente via AJAX, mas aqui apenas mostramos preview
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
    if (!navigator.geolocation) {
      showToast('Erro', 'Geolocalização não suportada pelo seu navegador.');
      return;
    }
    navigator.geolocation.getCurrentPosition(pos => {
      document.getElementById('iLat').value = pos.coords.latitude.toFixed(6);
      document.getElementById('iLng').value = pos.coords.longitude.toFixed(6);
      showToast('Localização detectada!', 'Coordenadas preenchidas automaticamente.');
    }, () => {
      showToast('Erro de localização', 'Não foi possível obter a sua localização. Verifique as permissões.');
    });
  }

  // ===== TOAST =====
  function showToast(title, msg) {
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMsg').textContent = msg;
    const t = document.getElementById('toastFc');
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3500);
  }

  // ===== FORM VALIDATION — INFO =====
  document.getElementById('formInfo')?.addEventListener('submit', function(e) {
    let ok = true;
    const fields = [
      {id:'iName', err:'err-name', check: v => v.trim().length > 0},
      {id:'iEmail', err:'err-email', check: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)},
      {id:'iBi', err:'err-bi', check: v => v.trim().length > 0},
      {id:'iMatricula', err:'err-matricula', check: v => v.trim().length > 0},
    ];
    fields.forEach(f => {
      const inp = document.getElementById(f.id);
      const err = document.getElementById(f.err);
      if (!f.check(inp.value)) {
        inp.classList.add('is-error'); inp.classList.remove('is-ok');
        if (err) err.style.display = 'block';
        ok = false;
      } else {
        inp.classList.remove('is-error'); inp.classList.add('is-ok');
        if (err) err.style.display = 'none';
      }
    });
    if (!ok) {
      e.preventDefault();
      showToast('Erro de validação', 'Por favor, preencha todos os campos obrigatórios correctamente.');
    } else {
      // Atualizar nome no sidebar (pode ser feito após submit, mas aqui apenas para UX)
      const name = document.getElementById('iName').value.trim();
      const email = document.getElementById('iEmail').value.trim();
      document.getElementById('sidebarName').textContent = name;
      document.getElementById('sidebarEmail').textContent = email;
      // A foto será actualizada após upload, mas não alteramos agora
    }
  });

  // ===== FORM VALIDATION — SECURITY =====
  document.getElementById('formSecurity')?.addEventListener('submit', function(e) {
    const pw = document.getElementById('iPwNew').value;
    const conf = document.getElementById('iPwConfirm').value;
    let ok = true;
    const errPw = document.getElementById('err-password');
    const errConf = document.getElementById('err-password_confirmation');
    if (pw.length < 8) {
      document.getElementById('iPwNew').classList.add('is-error');
      if (errPw) errPw.style.display = 'block';
      ok = false;
    } else {
      document.getElementById('iPwNew').classList.remove('is-error');
      document.getElementById('iPwNew').classList.add('is-ok');
      if (errPw) errPw.style.display = 'none';
    }
    if (pw !== conf || conf === '') {
      document.getElementById('iPwConfirm').classList.add('is-error');
      if (errConf) errConf.style.display = 'block';
      ok = false;
    } else {
      document.getElementById('iPwConfirm').classList.remove('is-error');
      document.getElementById('iPwConfirm').classList.add('is-ok');
      if (errConf) errConf.style.display = 'none';
    }
    if (!ok) {
      e.preventDefault();
      showToast('Erro de validação', 'Verifique a nova password (mínimo 8 caracteres e confirmação igual).');
    } else {
      // Sucesso será mostrado pelo redirect ou via toast após submit real
    }
  });

  // Clear error on input
  document.querySelectorAll('.fc-input').forEach(inp => {
    inp.addEventListener('input', () => {
      inp.classList.remove('is-error');
    });
  });
</script>

@if(session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      showToast('Sucesso!', '{{ session('success') }}');
    });
  </script>
@endif

@if($errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      showToast('Erro', 'Verifique os dados e tente novamente.');
    });
  </script>
@endif

</body>
</html>