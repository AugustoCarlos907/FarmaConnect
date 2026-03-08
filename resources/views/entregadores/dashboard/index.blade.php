<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Dashboard Entregador</title>
  <!-- Bootstrap 5 + ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Leaflet (mapa) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <!-- Fonte Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f0f4f8;
      color: #1f2f31;
    }

    :root {
      --accent: #099aa7;
      --accent-light: #e0f7f5;
      --accent-dark: #067e8a;
      --heading: #1f2f31;
      --text: #363f40;
      --text-light: #6c8285;
      --white: #ffffff;
      --border: #eef2f6;
      --shadow: 0 10px 30px rgba(0,0,0,0.05);
      --shadow-hover: 0 15px 40px rgba(9, 154, 167, 0.1);
      --success: #28a745;
      --warning: #ffc107;
      --danger: #dc3545;
      --info: #17a2b8;
      --dark: #1e2a2c;
      --delivery-bg: #1a2c2f;
    }

    /* Animações */
    @keyframes slideIn {
      from { transform: translateX(-20px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .dashboard {
      display: flex;
      min-height: 100vh;
      background: #f0f4f8;
    }

    /* Sidebar DIFERENTE (entregador) */
    .sidebar {
      width: 280px;
      background: var(--dark);
      border-right: 1px solid #2a3f42;
      padding: 2rem 1.5rem;
      position: fixed;
      height: 100vh;
      overflow-y: auto;
      animation: slideIn 0.5s ease;
      box-shadow: var(--shadow);
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 2.5rem;
      text-decoration: none;
      display: block;
    }

    .logo .farma {
      color: var(--accent);
    }

    .logo .connect {
      color: #e0f7f5;
    }

    /* Menu items (estilo diferente) */
    .nav-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 0.9rem 1.2rem;
      border-radius: 16px;
      color: #b0d4d0;
      text-decoration: none;
      margin-bottom: 0.3rem;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .nav-item i {
      font-size: 1.3rem;
      color: #6c8f8b;
      transition: all 0.3s;
    }

    .nav-item:hover {
      background: #2a3f42;
      color: var(--accent);
    }

    .nav-item:hover i {
      color: var(--accent);
    }

    .nav-item.active {
      background: var(--accent);
      color: white;
    }

    .nav-item.active i {
      color: white;
    }

    /* Submenus */
    .has-submenu {
      position: relative;
    }

    .submenu {
      display: none;
      padding-left: 2.5rem;
      margin: 0.5rem 0;
    }

    .has-submenu.open .submenu {
      display: block;
    }

    .submenu-item {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      padding: 0.6rem 1rem;
      color: #b0d4d0;
      text-decoration: none;
      font-size: 0.9rem;
      border-radius: 12px;
      transition: all 0.3s;
    }

    .submenu-item:hover {
      background: #2a3f42;
      color: var(--accent);
    }

    .submenu-item i {
      font-size: 1rem;
      width: 20px;
      color: #6c8f8b;
    }

    .submenu-icon {
      margin-left: auto;
      transition: transform 0.3s;
    }

    .has-submenu.open .submenu-icon {
      transform: rotate(180deg);
    }

    /* Badges */
    .badge {
      padding: 0.2rem 0.6rem;
      border-radius: 50px;
      font-size: 0.7rem;
      font-weight: 600;
      margin-left: auto;
    }

    .badge.bg-warning {
      background: var(--warning);
      color: #000;
    }

    .badge.bg-danger {
      background: var(--danger);
      color: white;
    }

    .badge.bg-success {
      background: var(--success);
      color: white;
    }

    .badge.bg-info {
      background: var(--info);
      color: white;
    }

    .nav-divider {
      height: 1px;
      background: #2a3f42;
      margin: 1.5rem 0;
    }

    /* Status do entregador */
    .delivery-status-sidebar {
      background: #2a3f42;
      padding: 1rem;
      border-radius: 20px;
      margin-top: 2rem;
    }

    .status-badge {
      display: inline-block;
      padding: 0.4rem 1rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .status-online {
      background: var(--success);
      color: white;
    }

    .status-offline {
      background: var(--danger);
      color: white;
    }

    /* Main Content (mantém paleta original) */
    .main-content {
      flex: 1;
      margin-left: 280px;
      padding: 2rem;
      animation: fadeIn 0.6s ease;
    }

    /* Top Bar */
    .top-bar {
      background: white;
      padding: 1rem 2rem;
      border-radius: 60px;
      box-shadow: var(--shadow);
      margin-bottom: 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .page-title h1 {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--heading);
    }

    .user-actions {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .notifications {
      position: relative;
      cursor: pointer;
    }

    .notifications i {
      font-size: 1.5rem;
      color: var(--text-light);
    }

    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background: var(--accent);
      color: white;
      font-size: 0.7rem;
      padding: 0.2rem 0.5rem;
      border-radius: 50px;
      animation: pulse 2s infinite;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .user-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--accent-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: var(--accent);
      font-size: 1.2rem;
    }

    /* Botão de relatório verde */
    .btn-report {
      background: var(--accent);
      border: none;
      border-radius: 50px;
      padding: 0.8rem 1.5rem;
      font-weight: 600;
      color: white;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s;
      cursor: pointer;
      margin-bottom: 1.5rem;
    }

    .btn-report:hover {
      background: var(--accent-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }

    /* KPIs */
    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.2rem;
      margin-bottom: 1.5rem;
    }

    .kpi-card {
      background: white;
      padding: 1.2rem;
      border-radius: 24px;
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
      transition: all 0.3s;
    }

    .kpi-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-hover);
      border-color: var(--accent);
    }

    .kpi-icon {
      width: 45px;
      height: 45px;
      background: var(--accent-light);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent);
      margin-bottom: 0.8rem;
    }

    .kpi-value {
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--heading);
    }

    .kpi-label {
      color: var(--text-light);
      font-size: 0.85rem;
    }

    /* Grid Principal */
    .dashboard-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 1.2rem;
      margin-bottom: 1.2rem;
    }

    .dashboard-grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.2rem;
      margin-bottom: 1.2rem;
    }

    /* Cards */
    .card {
      background: white;
      border-radius: 24px;
      padding: 1.5rem;
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
      transition: all 0.3s;
    }

    .card:hover {
      box-shadow: var(--shadow-hover);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.2rem;
    }

    .card-header h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--heading);
    }

    .card-header a {
      color: var(--accent);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 600;
    }

    /* Lista de entregas */
    .delivery-list {
      max-height: 300px;
      overflow-y: auto;
    }

    .delivery-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem 0;
      border-bottom: 1px solid var(--border);
      transition: all 0.2s;
    }

    .delivery-item:hover {
      background: var(--accent-light);
      border-radius: 12px;
      padding-left: 0.5rem;
    }

    .delivery-icon {
      width: 40px;
      height: 40px;
      background: var(--accent-light);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent);
    }

    .delivery-info {
      flex: 1;
    }

    .delivery-info h4 {
      font-size: 0.95rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
    }

    .delivery-info p {
      font-size: 0.8rem;
      color: var(--text-light);
      margin: 0;
    }

    .delivery-status {
      padding: 0.3rem 0.8rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .status-ongoing {
      background: var(--success);
      color: white;
    }

    .status-cancelled {
      background: var(--danger);
      color: white;
    }

    /* Mapa */
    .map-container {
      height: 250px;
      border-radius: 16px;
      overflow: hidden;
      margin: 1rem 0;
      border: 1px solid var(--border);
    }

    #deliveryMap {
      height: 100%;
      width: 100%;
    }

    /* Ganhos */
    .earnings-summary {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1.5rem;
    }

    .earning-item {
      text-align: center;
    }

    .earning-label {
      font-size: 0.85rem;
      color: var(--text-light);
    }

    .earning-value {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--accent);
    }

    /* Histórico */
    .history-list {
      max-height: 200px;
      overflow-y: auto;
    }

    .history-item {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      padding: 0.8rem 0;
      border-bottom: 1px solid var(--border);
      transition: all 0.2s;
    }

    .history-item:hover {
      background: var(--accent-light);
      border-radius: 12px;
      padding-left: 0.5rem;
    }

    .history-icon {
      width: 35px;
      height: 35px;
      background: var(--accent-light);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent);
    }

    .history-info {
      flex: 1;
    }

    .history-info h4 {
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 0.1rem;
    }

    .history-info p {
      font-size: 0.75rem;
      color: var(--text-light);
      margin: 0;
    }

    .history-value {
      font-weight: 700;
      color: var(--accent);
    }

    /* Gráficos */
    .chart-container {
      height: 150px;
      margin-top: 1rem;
    }

    /* Responsivo */
    @media (max-width: 1200px) {
      .dashboard-grid, .dashboard-grid-2 {
        grid-template-columns: 1fr;
      }
      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Sidebar (diferente - entregador) -->
    <aside class="sidebar">
      <a href="#" class="logo">
        <span class="farma">Farma</span><span class="connect">Connect</span>
      </a>

      <nav>
        <a href="#" class="nav-item active">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>

        <!-- Entregas com submenu -->
        <div class="has-submenu">
          <div class="nav-item">
            <i class="bi bi-truck"></i>
            <span>Entregas</span>
            <span class="badge bg-danger">3</span>
            <i class="bi bi-chevron-down submenu-icon"></i>
          </div>
          <div class="submenu">
            <a href="#" class="submenu-item"><i class="bi bi-clock"></i> Em andamento <span class="badge bg-success ms-2">2</span></a>
            <a href="#" class="submenu-item"><i class="bi bi-x-circle"></i> Canceladas <span class="badge bg-danger ms-2">1</span></a>
            <a href="#" class="submenu-item"><i class="bi bi-check-circle"></i> Concluídas</a>
          </div>
        </div>

        <!-- Histórico com badge -->
        <a href="#" class="nav-item">
          <i class="bi bi-clock-history"></i>
          <span>Histórico</span>
          <span class="badge bg-info">127</span>
        </a>

        <!-- Ganhos com submenu -->
        <div class="has-submenu">
          <div class="nav-item">
            <i class="bi bi-cash-stack"></i>
            <span>Ganhos</span>
            <span class="badge bg-success">4.200 KZ</span>
            <i class="bi bi-chevron-down submenu-icon"></i>
          </div>
          <div class="submenu">
            <a href="#" class="submenu-item"><i class="bi bi-calendar-day"></i> Hoje</a>
            <a href="#" class="submenu-item"><i class="bi bi-calendar-week"></i> Esta semana</a>
            <a href="#" class="submenu-item"><i class="bi bi-calendar-month"></i> Este mês</a>
            <a href="#" class="submenu-item"><i class="bi bi-file-earmark"></i> Extrato</a>
          </div>
        </div>

        <!-- Relatórios com badge -->
        <a href="#" class="nav-item">
          <i class="bi bi-file-earmark-pdf"></i>
          <span>Relatórios</span>
          <span class="badge bg-warning">3</span>
        </a>

        <!-- Avaliações -->
        <a href="#" class="nav-item">
          <i class="bi bi-star"></i>
          <span>Avaliações</span>
          <span class="badge bg-warning">4.9</span>
        </a>

        <div class="nav-divider"></div>

        <!-- Perfil com submenu -->
        <div class="has-submenu">
          <div class="nav-item">
            <i class="bi bi-person"></i>
            <span>Perfil</span>
            <i class="bi bi-chevron-down submenu-icon"></i>
          </div>
          <div class="submenu">
            <a href="#" class="submenu-item"><i class="bi bi-info-circle"></i> Dados pessoais</a>
            <a href="#" class="submenu-item"><i class="bi bi-file-text"></i> Documentos</a>
            <a href="#" class="submenu-item"><i class="bi bi-gear"></i> Configurações</a>
          </div>
        </div>

                <form action="{{ route('logout', ['id' => auth()->user()->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item" style="background: none; border: none; width: 100%; text-align: left;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sair</span>
                    </button>
                </form>
      </nav>

      <!-- Status do entregador -->
      <div class="delivery-status-sidebar">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="fw-semibold text-white">Status</span>
          <span class="status-badge status-online">Online</span>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="statusSwitch" checked>
          <label class="form-check-label text-white-50" for="statusSwitch">Disponível para entregas</label>
        </div>
      </div>
    </aside>

    <!-- Main Content (mantém paleta original) -->
    <main class="main-content">
      <!-- Top Bar -->
      <div class="top-bar">
        <div class="page-title">
          <h1>Dashboard</h1>
          <p class="text-muted small">Bem-vindo, Entregador</p>
        </div>
        <div class="user-actions">
          <div class="notifications">
            <i class="bi bi-bell"></i>
            <span class="notification-badge">3</span>
          </div>
          <div class="user-profile">
            <div class="user-avatar">J</div>
            <div>
              <strong>João</strong>
              <p class="small text-muted mb-0">ID: ENT-001</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Botão de relatório verde -->
      <button class="btn-report" onclick="abrirModalRelatorio()">
        <i class="bi bi-file-earmark-pdf"></i>
        Relatório de Entregas
      </button>

      <!-- KPIs -->
      <div class="kpi-grid">
        <div class="kpi-card">
          <div class="kpi-icon"><i class="bi bi-truck"></i></div>
          <div class="kpi-value">{{ $data['entregas_hoje']->count() }}</div>
          <div class="kpi-label">Entregas hoje</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-icon"><i class="bi bi-cash-stack"></i></div>
          <div class="kpi-value">{{ $data['ganhos_hoje'] }}</div>
          <div class="kpi-label">Ganhos hoje</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-icon"><i class="bi bi-clock-history"></i></div>
          <div class="kpi-value">{{ $data['total_entregas'] }}</div>
          <div class="kpi-label">Total entregas</div>
        </div>
        {{-- <div class="kpi-card">
          <div class="kpi-icon"><i class="bi bi-star"></i></div>
          <div class="kpi-value">4.9</div>
          <div class="kpi-label">Avaliação</div>
        </div> --}}
      </div>

      <!-- Linha 1: Entregas + Mapa -->
      <div class="dashboard-grid">
        <!-- Entregas em andamento e canceladas -->
        <div class="card">
          <div class="card-header">
            <h3><i class="bi bi-clock-history me-2"></i> Entregas em Andamento</h3>
            <a href="#">Ver todas</a>
          </div>
          <div class="delivery-list">
            <div class="delivery-item">
              <div class="delivery-icon"><i class="bi bi-shop"></i></div>
              <div class="delivery-info">
                <h4>Farmácia Central → Ingombotas</h4>
                <p>Cliente: Maria S. · 2 itens</p>
              </div>
              <span class="delivery-status status-ongoing">Em andamento</span>
            </div>
            <div class="delivery-item">
              <div class="delivery-icon"><i class="bi bi-shop"></i></div>
              <div class="delivery-info">
                <h4>Farmácia Kilamba → Talatona</h4>
                <p>Cliente: João F. · 3 itens</p>
              </div>
              <span class="delivery-status status-cancelled">Cancelada</span>
            </div>
            <div class="delivery-item">
              <div class="delivery-icon"><i class="bi bi-shop"></i></div>
              <div class="delivery-info">
                <h4>Farmácia Talatona → Benfica</h4>
                <p>Cliente: Ana P. · 1 item</p>
              </div>
              <span class="delivery-status status-ongoing">Em andamento</span>
            </div>
          </div>
        </div>

        <!-- Mapa em tempo real -->
        <div class="card">
          <div class="card-header">
            <h3><i class="bi bi-geo-alt me-2"></i> Entrega Atual</h3>
            <a href="#">Detalhes</a>
          </div>
          <div class="map-container" id="mapContainer">
            <div id="deliveryMap"></div>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <small class="text-muted"><i class="bi bi-shop"></i> Farmácia Central</small>
            <small class="text-muted"><i class="bi bi-person"></i> Maria S.</small>
            <small class="text-muted"><i class="bi bi-clock"></i> 10 min</small>
          </div>
        </div>
      </div>

      <!-- Linha 2: Ganhos + Histórico -->
      <div class="dashboard-grid-2">
        <!-- Ganhos com gráfico -->
        <div class="card">
          <div class="card-header">
            <h3><i class="bi bi-cash-stack me-2"></i> Ganhos (7 dias)</h3>
            <a href="#">Ver todos</a>
          </div>
          <div class="earnings-summary">
            <div class="earning-item">
              <div class="earning-label">Hoje</div>
              <div class="earning-value">4.200 KZ</div>
            </div>
            <div class="earning-item">
              <div class="earning-label">Semana</div>
              <div class="earning-value">28.500 KZ</div>
            </div>
            <div class="earning-item">
              <div class="earning-label">Mês</div>
              <div class="earning-value">112.300 KZ</div>
            </div>
          </div>
          <div class="chart-container">
            <canvas id="earningsChart"></canvas>
          </div>
        </div>

        <!-- Histórico de entregas -->
        <div class="card">
          <div class="card-header">
            <h3><i class="bi bi-clock-history me-2"></i> Últimas Entregas</h3>
            <a href="#">Ver histórico</a>
          </div>
          
          <div class="history-list">
              @foreach ($data['ultimas_entregas'] as $entrega) 
            <div class="history-item">
              <div class="history-icon"><i class="bi bi-check-lg"></i></div>
              <div class="history-info">
                <h4>{{ $entrega->farmacia->nome }}</h4>
                <p>{{ $entrega->created_at->format('d/m/Y, H:i') }} · {{ $entrega->itens->count() }} itens</p>
              </div>
              <div class="history-value">{{ $entrega->valor_total }}</div>
            </div>
            <div class="history-item">
              <div class="history-icon"><i class="bi bi-check-lg"></i></div>
              <div class="history-info">
                <h4>{{ $entrega->farmacia->nome }}</h4>
                <p>{{ $entrega->created_at->format('d/m/Y, H:i') }} · {{ $entrega->itens->count() }} itens</p>
              </div>
              <div class="history-value">{{ $entrega->valor_total }}</div>
            </div>
            <div class="history-item">
              <div class="history-icon"><i class="bi bi-check-lg"></i></div>
              <div class="history-info">
                <h4>{{ $entrega->farmacia->nome }}</h4>
                <p>{{ $entrega->created_at->format('d/m/Y, H:i') }} · {{ $entrega->itens->count() }} itens</p>
              </div>
              <div class="history-value">{{ $entrega->valor_total }}</div>
            </div>
            @endforeach
          </div>

        </div>
      </div>
    </main>
  </div>

 <!-- Modal de relatório -->
  <div id="modalRelatorio" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitulo">Relatório</h3>
        <button class="close-btn" onclick="fecharModal()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formRelatorio">
          <div class="form-group">
            <label>Período do relatório:</label>
            <div class="radio-group">
              <div class="radio-option">
                <input type="radio" name="periodo" id="hoje" value="hoje" checked>
                <label for="hoje">Hoje</label>
              </div>
              <div class="radio-option">
                <input type="radio" name="periodo" id="semana" value="semana">
                <label for="semana">Últimos 7 dias</label>
              </div>
              <div class="radio-option">
                <input type="radio" name="periodo" id="mes" value="mes">
                <label for="mes">Últimos 30 dias</label>
              </div>
              <div class="radio-option">
                <input type="radio" name="periodo" id="personalizado" value="personalizado">
                <label for="personalizado">Personalizado</label>
              </div>
            </div>
          </div>

          <div id="campoDataPersonalizado" style="display: none;">
            <div class="form-group">
              <label>Data inicial:</label>
              <input type="date" class="form-control" id="dataInicio">
            </div>
            <div class="form-group">
              <label>Data final:</label>
              <input type="date" class="form-control" id="dataFim">
            </div>
          </div>

          <div class="form-group">
            <label>Formato:</label>
            <div class="radio-group">
              <div class="radio-option">
                <input type="radio" name="formato" id="pdf" value="pdf" checked>
                <label for="pdf">PDF</label>
              </div>
              <div class="radio-option">
                <input type="radio" name="formato" id="excel" value="excel">
                <label for="excel">Excel</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn-secondary" onclick="fecharModal()">Cancelar</button>
        <button class="btn-primary" onclick="gerarRelatorio()">Gerar Relatório</button>
      </div>
    </div>
  </div>

  <script>
    // Variável para guardar o tipo de relatório
    let tipoRelatorioAtual = '';

    // Abrir modal
    function abrirModalRelatorio(tipo) {
      tipoRelatorioAtual = tipo;
      const titulo = document.getElementById('modalTitulo');
      
      if (tipo === 'geral') {
        titulo.textContent = '📊 Relatório Geral da Plataforma';
      } else if (tipo === 'financeiro') {
        titulo.textContent = '💰 Relatório Financeiro';
      }
      
      document.getElementById('modalRelatorio').style.display = 'block';
    }

    // Fechar modal
    function fecharModal() {
      document.getElementById('modalRelatorio').style.display = 'none';
    }

    // Mostrar campos de data personalizada
    document.querySelectorAll('input[name="periodo"]').forEach(radio => {
      radio.addEventListener('change', function() {
        const campoData = document.getElementById('campoDataPersonalizado');
        campoData.style.display = this.value === 'personalizado' ? 'block' : 'none';
      });
    });

    // Função para gerar relatório
    function gerarRelatorio() {
      const periodo = document.querySelector('input[name="periodo"]:checked').value;
      const formato = document.querySelector('input[name="formato"]:checked').value;
      
      // Obter datas se for personalizado
      let dataInicio = '';
      let dataFim = '';
      if (periodo === 'personalizado') {
        dataInicio = document.getElementById('dataInicio').value;
        dataFim = document.getElementById('dataFim').value;
        
        if (!dataInicio || !dataFim) {
          alert('Por favor, selecione as datas de início e fim.');
          return;
        }
      }
      
      // Mensagem informativa
      let mensagem = `⚙️ Funcionalidade de relatório em desenvolvimento.\n\n`;
      
      if (tipoRelatorioAtual === 'geral') {
        mensagem += `📋 Relatório Geral da Plataforma\n`;
        mensagem += `📅 Período: ${periodo} ${periodo === 'personalizado' ? `(${dataInicio} a ${dataFim})` : ''}\n`;
        mensagem += `📄 Formato: ${formato.toUpperCase()}\n\n`;
        mensagem += `O relatório incluirá (quando houver dados):\n`;
        mensagem += `• Total de utilizadores registados\n`;
        mensagem += `• Total de farmácias\n`;
        mensagem += `• Total de entregadores\n`;
        mensagem += `• Número de pedidos realizados\n`;
        mensagem += `• Faturação total da plataforma\n`;
      } else if (tipoRelatorioAtual === 'financeiro') {
        mensagem += `📋 Relatório Financeiro\n`;
        mensagem += `📅 Período: ${periodo} ${periodo === 'personalizado' ? `(${dataInicio} a ${dataFim})` : ''}\n`;
        mensagem += `📄 Formato: ${formato.toUpperCase()}\n\n`;
        mensagem += `O relatório incluirá (quando houver dados):\n`;
        mensagem += `• Faturação total por período\n`;
        mensagem += `• Comissões retidas por pedido\n`;
        mensagem += `• Pagamentos a farmácias\n`;
        mensagem += `• Ganhos dos entregadores\n`;
      }
      
      mensagem += `\nQuando houver dados na plataforma, este relatório será gerado automaticamente.`;
      
      alert(mensagem);
      
      // Fechar modal
      fecharModal();
    }

    // Fechar modal clicando fora
    window.onclick = function(event) {
      const modal = document.getElementById('modalRelatorio');
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    }
     // Toggle status online/offline
    document.getElementById('statusSwitch').addEventListener('change', function(e) {
      const badge = document.querySelector('.status-badge');
      if (e.target.checked) {
        badge.textContent = 'Online';
        badge.className = 'status-badge status-online';
      } else {
        badge.textContent = 'Offline';
        badge.className = 'status-badge status-offline';
      }
    });

    // Toggle submenus
    document.querySelectorAll('.has-submenu > .nav-item').forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        const parent = item.closest('.has-submenu');
        parent.classList.toggle('open');
      });
    });


     // Notificações
    document.querySelector('.notifications').addEventListener('click', function() {
      alert('🔔 3 novas entregas disponíveis');
    });

    // Inicializar mapa
    const map = L.map('deliveryMap').setView([-8.8383, 13.2344], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap'
    }).addTo(map);

    // Marcador da entrega atual
    L.marker([-8.8183, 13.2320]).addTo(map)
      .bindPopup('Farmácia Central → Ingombotas')
      .openPopup();

    // Gráfico de ganhos
    new Chart(document.getElementById('earningsChart'), {
      type: 'line',
      data: {
        labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        datasets: [{
          data: [3200, 4100, 3800, 4500, 5200, 4800, 4200],
          borderColor: '#099aa7',
          backgroundColor: 'rgba(9, 154, 167, 0.1)',
          tension: 0.3,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } }
      }
    });
  </script>
</body>
</html>