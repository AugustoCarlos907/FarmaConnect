<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Dashboard Farmácia</title>
  <!-- Bootstrap 5 + ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Bibliotecas para PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
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
      background: #f4f7fc;
      color: #1f2f31;
      /* transform: scale(0.8); */
      /* max-width: 90%; */
      /* zoom: 90%;
      s */
      /* scale: 0.95;
      font */

    }

    :root {
      --accent: #099aa7;
      --accent-light: #e0f7f5;
      --accent-dark: #067e8a;
      --heading: #1f2f31;
      --text: #363f40;
      --text-light: #6c8285;
      --bg-light: #f8fbfb;
      --white: #ffffff;
      --soft-green: #dff3f0;
      --border: #eef2f6;
    }

    .dashboard {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 280px;
      background: white;
      border-right: 1px solid var(--border);
      padding: 2rem 1.5rem;
      position: fixed;
      height: 100vh;
      overflow-y: auto;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 2.5rem;
    }

    .logo .farma {
      color: var(--accent);
    }

    .logo .connect {
      color: var(--heading);
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 0.9rem 1.2rem;
      border-radius: 16px;
      color: var(--text);
      text-decoration: none;
      margin-bottom: 0.5rem;
      transition: all 0.3s;
      font-weight: 500;
    }

    .nav-item i {
      font-size: 1.3rem;
      color: var(--text-light);
    }

    .nav-item:hover {
      background: var(--accent-light);
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

    .nav-divider {
      height: 1px;
      background: var(--border);
      margin: 1.5rem 0;
    }

    .pharmacy-status {
      background: var(--accent-light);
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
      background: #d4edda;
      color: #155724;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      margin-left: 280px;
      padding: 2rem;
    }

    /* Top Bar */
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .page-title h1 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--heading);
      margin-bottom: 0.3rem;
    }

    .page-title p {
      color: var(--text-light);
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      padding: 0.5rem 1rem;
      background: white;
      border-radius: 50px;
      border: 1px solid var(--border);
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--accent-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: var(--accent);
    }

    /* Botão de relatório geral */
    .report-actions {
      margin-bottom: 2rem;
    }

    .btn-report-general {
      background: var(--accent);
      border: none;
      border-radius: 50px;
      padding: 1rem 2rem;
      font-weight: 600;
      color: white;
      display: inline-flex;
      align-items: center;
      gap: 0.8rem;
      transition: all 0.3s;
      font-size: 1.1rem;
    }

    .btn-report-general:hover {
      background: var(--accent-dark);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(9, 154, 167, 0.3);
    }

    .btn-report-general i {
      font-size: 1.3rem;
    }

    /* Cards de estatísticas */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: white;
      padding: 1.5rem;
      border-radius: 24px;
      border: 1px solid var(--border);
      transition: transform 0.3s;
    }

    .stat-card:hover {
      border-color: var(--accent);
    }

    .stat-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .stat-icon {
      width: 50px;
      height: 50px;
      background: var(--accent-light);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: var(--accent);
    }

    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      color: var(--heading);
      margin-bottom: 0.3rem;
      color: var(--text-light);
      opacity: 0.5;
    }

    .stat-label {
      color: var(--text-light);
      font-size: 0.9rem;
    }

    /* Grid de duas colunas */
    .dashboard-grid {
      display: grid;
      grid-template-columns: 1.5fr 1fr;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    /* Cards de conteúdo */
    .content-card {
      background: white;
      border-radius: 24px;
      padding: 1.5rem;
      border: 1px solid var(--border);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .card-header h3 {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--heading);
    }

    .card-header a {
      color: var(--accent);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 600;
    }

    /* Tabela de pedidos */
    .order-header {
      display: grid;
      grid-template-columns: 60px 120px 1fr 100px 80px 40px;
      align-items: center;
      padding: 0.8rem 0;
      border-bottom: 2px solid var(--border);
      font-weight: 600;
      color: var(--text-light);
      font-size: 0.85rem;
    }

    .empty-state {
      text-align: center;
      padding: 3rem;
      color: var(--text-light);
    }

    .empty-state i {
      font-size: 3rem;
      color: var(--border);
      margin-bottom: 1rem;
    }

    /* Stock items */
    .stock-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.8rem 0;
      border-bottom: 1px solid var(--border);
    }

    .stock-info h4 {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
      color: var(--text-light);
    }

    .stock-info p {
      font-size: 0.85rem;
      color: var(--text-light);
      opacity: 0.7;
    }

    .stock-quantity {
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--text-light);
      opacity: 0.5;
    }

    /* Entregadores */
    .delivery-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 0.8rem 0;
      border-bottom: 1px solid var(--border);
    }

    .delivery-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--accent-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: var(--accent);
      opacity: 0.7;
    }

    .delivery-info {
      flex: 1;
    }

    .delivery-info h4 {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
      color: var(--text-light);
    }

    .delivery-info p {
      font-size: 0.85rem;
      color: var(--text-light);
      opacity: 0.7;
    }

    .delivery-status {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--border);
    }

    /* Modal de relatório */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1000;
    }

    .modal-content {
      background: white;
      width: 500px;
      margin: 100px auto;
      padding: 2rem;
      border-radius: 32px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .modal-header h3 {
      font-size: 1.3rem;
      font-weight: 700;
    }

    .close-btn {
      background: transparent;
      border: none;
      font-size: 1.3rem;
      cursor: pointer;
      color: var(--text-light);
    }

    .modal-body {
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .form-control {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 2px solid var(--border);
      border-radius: 16px;
      font-family: 'Inter', sans-serif;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--accent);
    }

    .radio-group {
      display: flex;
      gap: 1rem;
      margin-top: 0.5rem;
      flex-wrap: wrap;
    }

    .radio-option {
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .modal-footer {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
    }

    .btn-primary {
      background: var(--accent);
      border: none;
      border-radius: 50px;
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      color: white;
    }

    .btn-primary:hover {
      background: var(--accent-dark);
    }

    .btn-secondary {
      background: transparent;
      border: 2px solid var(--border);
      border-radius: 50px;
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      color: var(--text);
    }

    .btn-secondary:hover {
      background: var(--border);
    }

    .btn-outline {
      background: transparent;
      border: 2px solid var(--accent);
      border-radius: 50px;
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      color: var(--accent);
    }

    .btn-outline:hover {
      background: var(--accent-light);
    }

    /* Nota informativa */
    .alert-info {
      background: var(--accent-light);
      border: none;
      border-radius: 16px;
      padding: 1rem;
      margin-top: 1.5rem;
    }

    /* Responsivo */
    @media (max-width: 1200px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .dashboard-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body >
  <div class="dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        <span class="farma">Farma</span><span class="connect">Connect</span>
      </div>

      <nav>
        <a href="#" class="nav-item active">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-box"></i>
          <span>Stock</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-truck"></i>
          <span>Pedidos</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-people"></i>
          <span>Entregadores</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-graph-up"></i>
          <span>Relatórios</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-star"></i>
          <span>Avaliações</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-files"></i>
          <span>Documentos</span>
        </a>
        
        <div class="nav-divider"></div>

        <a href="#" class="nav-item">
          <i class="bi bi-gear"></i>
          <span>Configurações</span>
        </a>
        <a href="#" class="nav-item">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sair</span>
        </a>
      </nav>

      <div class="pharmacy-status">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <span class="fw-semibold">Farmácia Central</span>
          <span class="status-badge">Aberta</span>
        </div>
        <p class="small mb-2"><i class="bi bi-geo-alt"></i> Ingombotas, Rua Ho Chi Min, 45</p>
        <p class="small mb-0"><i class="bi bi-clock"></i> 08:00 - 22:00</p>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Top Bar -->
      <div class="top-bar">
        <div class="page-title">
          <h1>Dashboard</h1>
          <p>Visão geral da sua farmácia</p>
        </div>
        <div class="user-profile">
          <div class="user-avatar">A</div>
          <div>
            <strong>Dr. António Silva</strong>
            <p class="small mb-0">Farmacêutico responsável</p>
          </div>
        </div>
      </div>

      <!-- Botão de Relatório Geral (ÚNICO BOTÃO) -->
      <div class="report-actions">
        <button class="btn-report-general" onclick="abrirModalRelatorio()">
          <i class="bi bi-file-earmark-pdf"></i>
          Gerar Relatório Geral da Farmácia
        </button>
      </div>

      <!-- Cards de estatísticas (SEM botões de relatório) -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon">
              <i class="bi bi-cart"></i>
            </div>
          </div>
          <div class="stat-value">—</div>
          <div class="stat-label">Pedidos hoje</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon">
              <i class="bi bi-cash-stack"></i>
            </div>
          </div>
          <div class="stat-value">— KZ</div>
          <div class="stat-label">Faturação hoje</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon">
              <i class="bi bi-box-seam"></i>
            </div>
          </div>
          <div class="stat-value">—</div>
          <div class="stat-label">Stock baixo</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon">
              <i class="bi bi-star"></i>
            </div>
          </div>
          <div class="stat-value">—</div>
          <div class="stat-label">Avaliações</div>
        </div>
      </div>

      <!-- Grid Principal -->
      <div class="dashboard-grid">
        <!-- Pedidos Recentes -->
        <div class="content-card">
          <div class="card-header">
            <h3><i class="bi bi-clock-history me-2"></i> Pedidos Recentes</h3>
            <a href="#">Ver todos</a>
          </div>

          <div class="order-header">
            <div>Pedido</div>
            <div>Cliente</div>
            <div>Itens</div>
            <div>Total</div>
            <div>Status</div>
            <div></div>
          </div>

          <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Nenhum pedido recebido hoje</p>
          </div>
        </div>

        <!-- Stock Baixo -->
        <div class="content-card">
          <div class="card-header">
            <h3><i class="bi bi-exclamation-triangle me-2"></i> Stock Baixo</h3>
            <a href="#">Gerir stock</a>
          </div>

          <div class="empty-state">
            <i class="bi bi-check-circle" style="color: var(--accent);"></i>
            <p>Stock normal</p>
          </div>

          <div class="mt-3">
            <button class="btn-outline w-100">Adicionar medicamento</button>
          </div>
        </div>
      </div>

      <!-- Segunda linha do grid -->
      <div class="dashboard-grid" style="margin-top: 1.5rem;">
        <!-- Entregadores -->
        <div class="content-card">
          <div class="card-header">
            <h3><i class="bi bi-bicycle me-2"></i> Entregadores</h3>
            <a href="#">Gerir</a>
          </div>

          <div class="empty-state">
            <i class="bi bi-person-plus"></i>
            <p>Nenhum entregador cadastrado</p>
          </div>

          <div class="mt-3">
            <button class="btn-outline w-100">Adicionar entregador</button>
          </div>
        </div>

        <!-- Vendas -->
        <div class="content-card">
          <div class="card-header">
            <h3><i class="bi bi-graph-up me-2"></i> Vendas (7 dias)</h3>
            <a href="#">Detalhes</a>
          </div>

          <div style="height: 200px; background: #f8fbfb; border-radius: 16px; display: flex; align-items: center; justify-content: center; border: 1px dashed var(--border);">
            <div class="text-center">
              <i class="bi bi-bar-chart-line" style="font-size: 2rem; color: var(--border);"></i>
              <p class="small text-muted mt-2">Gráfico de vendas</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Últimas avaliações -->
      <div class="content-card mt-4">
        <div class="card-header">
          <h3><i class="bi bi-star me-2"></i> Últimas avaliações</h3>
          <a href="#">Ver todas</a>
        </div>

        <div class="empty-state">
          <i class="bi bi-chat"></i>
          <p>Nenhuma avaliação ainda</p>
        </div>
      </div>

      <!-- Nota informativa -->
      <div class="alert-info">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Relatório Geral:</strong> Clique no botão acima para gerar um PDF completo com todas as informações da farmácia (pedidos, vendas, stock, entregadores e avaliações).
      </div>
    </main>
  </div>

  <!-- Modal de relatório (APENAS GERAL) -->
  <div id="modalRelatorio" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>📊 Relatório Geral da Farmácia</h3>
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
    // Abrir modal
    function abrirModalRelatorio() {
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
      mensagem += `📋 Relatório Geral da Farmácia\n`;
      mensagem += `📅 Período: ${periodo} ${periodo === 'personalizado' ? `(${dataInicio} a ${dataFim})` : ''}\n`;
      mensagem += `📄 Formato: ${formato.toUpperCase()}\n\n`;
      mensagem += `O relatório incluirá:\n`;
      mensagem += `• Pedidos do período\n`;
      mensagem += `• Vendas e faturação\n`;
      mensagem += `• Estado do stock\n`;
      mensagem += `• Desempenho dos entregadores\n`;
      mensagem += `• Avaliações dos clientes\n\n`;
      mensagem += `Quando houver dados, este relatório será gerado automaticamente.`;
      
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
  </script>
</body>
</html>