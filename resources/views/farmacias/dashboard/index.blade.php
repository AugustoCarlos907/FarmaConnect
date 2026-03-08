<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmaConnect · Dashboard Farmácia</title>
    <!-- Bootstrap 5 + ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        }

        .dashboard {
            display: flex;
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
            text-decoration: none;
            display: block;
            margin-bottom: 2rem;
        }

        .logo .farma { color: var(--accent); }
        .logo .connect { color: var(--heading); }

        /* Menu items */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 1rem;
            border-radius: 16px;
            color: var(--text);
            text-decoration: none;
            margin-bottom: 0.3rem;
            transition: all 0.3s;
            cursor: pointer;
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

        .nav-item i {
            font-size: 1.2rem;
            color: var(--text-light);
            transition: all 0.3s;
        }

        /* Submenus */
        .has-submenu {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 1rem;
            color: var(--text);
            text-decoration: none;
            width: 100%;
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
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.9rem;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .submenu-item:hover {
            background: var(--accent-light);
            color: var(--accent);
        }

        .submenu-item i {
            font-size: 1rem;
            width: 20px;
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
            background: #ffc107;
            color: #000;
        }

        .badge.bg-danger {
            background: #dc3545;
            color: white;
        }

        .badge.bg-success {
            background: #28a745;
            color: white;
        }

        .badge.bg-info {
            background: #17a2b8;
            color: white;
        }

        .nav-divider {
            height: 1px;
            background: var(--border);
            margin: 1.5rem 0;
        }

        /* Status da farmácia */
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
            background: #d4edda;
            color: #155724;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
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

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--accent-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-weight: 700;
        }

        /* Botão de relatório */
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

        .btn-report i {
            font-size: 1.1rem;
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
            color: var(--text-light);
            opacity: 0.7;
        }

        .kpi-label {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Grid Principal - 2 COLUNAS */
        .dashboard-grid {
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

        /* Gráficos */
        .chart-container {
            height: 200px;
            margin: 1rem 0;
            position: relative;
        }

        /* Branch info */
        .branch-info {
            background: var(--accent-light);
            padding: 1rem;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .branch-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
        }

        /* Estado vazio */
        .empty-state {
            text-align: center;
            padding: 1.5rem;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 2.5rem;
            color: var(--border);
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

        /* Responsivo */
        @media (max-width: 1200px) {
            .dashboard-grid {
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
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="#" class="logo">
                <span class="farma">Farma</span><span class="connect">Connect</span>
            </a>
            
            <!-- Menu principal -->
            <nav>
                <a href="#" class="nav-item active">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Stock com submenu -->
                <div class="has-submenu">
                    <div class="nav-item">
                        <i class="bi bi-box"></i>
                        <span>Stock</span>
                        <span class="badge bg-warning">3</span>
                        <i class="bi bi-chevron-down submenu-icon"></i>
                    </div>
                    <div class="submenu">
                        <a href="#" class="submenu-item"><i class="bi bi-list-ul"></i> Lista de produtos</a>
                        <a href="#" class="submenu-item"><i class="bi bi-plus-circle"></i> Adicionar produto</a>
                        <a href="#" class="submenu-item"><i class="bi bi-cloud-upload"></i> Upload CSV</a>
                        <a href="#" class="submenu-item"><i class="bi bi-exclamation-triangle"></i> Stock baixo <span class="badge bg-danger">3</span></a>
                    </div>
                </div>

                <!-- Pedidos com badge -->
                <a href="#" class="nav-item">
                    <i class="bi bi-truck"></i>
                    <span>Pedidos</span>
                    <span class="badge bg-danger">12</span>
                </a>

                <!-- Entregadores com badge -->
                <a href="#" class="nav-item">
                    <i class="bi bi-people"></i>
                    <span>Entregadores</span>
                    <span class="badge bg-success">4</span>
                </a>

                <!-- Relatórios com submenu -->
                <div class="has-submenu">
                    <div class="nav-item">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <span>Relatórios</span>
                        <i class="bi bi-chevron-down submenu-icon"></i>
                    </div>
                    <div class="submenu">
                        <a href="#" class="submenu-item"><i class="bi bi-cash-stack"></i> Vendas</a>
                        <a href="#" class="submenu-item"><i class="bi bi-box"></i> Stock</a>
                        <a href="#" class="submenu-item"><i class="bi bi-truck"></i> Entregas</a>
                        <a href="#" class="submenu-item"><i class="bi bi-star"></i> Avaliações</a>
                    </div>
                </div>

                <!-- Avaliações com badge -->
                <a href="#" class="nav-item">
                    <i class="bi bi-star"></i>
                    <span>Avaliações</span>
                    <span class="badge bg-warning">8</span>
                </a>

                <!-- Documentos com badge -->
                <a href="#" class="nav-item">
                    <i class="bi bi-files"></i>
                    <span>Documentos</span>
                    <span class="badge bg-info">2</span>
                </a>

                <div class="nav-divider"></div>

                <!-- Configurações com submenu -->
                <div class="has-submenu">
                    <div class="nav-item">
                        <i class="bi bi-gear"></i>
                        <span>Configurações</span>
                        <i class="bi bi-chevron-down submenu-icon"></i>
                    </div>
                    <div class="submenu">
                        <a href="#" class="submenu-item"><i class="bi bi-person"></i> Perfil</a>
                        <a href="#" class="submenu-item"><i class="bi bi-shop"></i> Farmácia</a>
                        <a href="#" class="submenu-item"><i class="bi bi-clock"></i> Horário</a>
                        <a href="#" class="submenu-item"><i class="bi bi-bell"></i> Notificações</a>
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

            <!-- Status da farmácia -->
            <div class="pharmacy-status">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-semibold">Farmácia Central</span>
                    <span class="status-badge">Aberta</span>
                </div>
                <p class="small mb-1"><i class="bi bi-geo-alt"></i> Ingombotas, Luanda</p>
                <p class="small mb-0"><i class="bi bi-clock"></i> 08:00 - 22:00</p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="page-title">
                    <h1>Dashboard</h1>
                    <p class="text-muted small">Visão geral da farmácia</p>
                </div>
                <div class="user-profile d-flex align-items-center gap-2">
                    <div class="user-avatar">FC</div>
                    <div><strong>Farmácia Central</strong><br><small class="text-muted">Dr. António Silva</small></div>
                </div>
            </div>

            <!-- Botão de relatório -->
            <button class="btn-report" onclick="abrirModalRelatorio()">
                <i class="bi bi-file-earmark-pdf"></i>
                Relatório Geral
            </button>

            <!-- KPIs -->
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-icon"><i class="bi bi-cart"></i></div>
                    <div class="kpi-value">{{ $data['pedidos_hoje']->count() }}</div>
                    <div class="kpi-label">Pedidos hoje</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-icon"><i class="bi bi-cash-stack"></i></div>
                    <div class="kpi-value">_____</div>
                    <div class="kpi-label">Faturação hoje</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-icon"><i class="bi bi-box-seam"></i></div>
                    <div class="kpi-value">____</div>
                    <div class="kpi-label">Stock baixo</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-icon"><i class="bi bi-star"></i></div>
                    <div class="kpi-value">{{$data['media_avaliacoes'] }}</div>
                    <div class="kpi-label">Avaliações</div>
                </div>
            </div>

            <!-- Linha 1: Pedidos + Stock -->
            <div class="dashboard-grid">
                <!-- Pedidos com gráfico -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="bi bi-clock-history me-2"></i> Pedidos (7 dias)</h3>
                        <a href="#">Ver todos</a>
                    </div>
                    <div class="chart-container">
                        <canvas id="pedidosChart"></canvas>
                    </div>
                </div>

                <!-- Stock com gráfico -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="bi bi-box me-2"></i> Stock</h3>
                        <a href="#">Gerir</a>
                    </div>
                    <div class="chart-container">
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Linha 2: Entregadores + Documentos -->
            <div class="dashboard-grid">
                <!-- Entregadores com gráfico -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="bi bi-bicycle me-2"></i> Entregadores</h3>
                        <a href="#">Gerir</a>
                    </div>
                    <div class="chart-container">
                        <canvas id="entregadoresChart"></canvas>
                    </div>
                </div>

                <!-- Documentos + Filial -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="bi bi-files me-2"></i> Documentos</h3>
                        <a href="#">Ver todos</a>
                    </div>
                    <div class="branch-info mb-3">
                        <div class="branch-icon"><i class="bi bi-building"></i></div>
                        <div>
                            <h4 class="mb-0">Filial de</h4>
                            <p class="mb-0 small text-muted">Farmácias Unidas de Angola</p>
                        </div>
                    </div>
                    <div class="empty-state">
                        <i class="bi bi-file-earmark"></i>
                        <p>Nenhum documento</p>
                    </div>
                </div>
            </div>

            <!-- Linha 3: Avaliações + Origem dos Pedidos -->
            <div class="dashboard-grid">
                <!-- Avaliações com gráfico -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="bi bi-star me-2"></i> Avaliações</h3>
                        <a href="#">Ver todas</a>
                    </div>
                    <div class="chart-container">
                        <canvas id="avaliacoesChart"></canvas>
                    </div>
                </div>

                <!-- Origem dos Pedidos com gráfico -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="bi bi-geo-alt me-2"></i> Origem dos Pedidos</h3>
                        <a href="#">Detalhes</a>
                    </div>
                    <div class="chart-container">
                        <canvas id="origemChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal de relatório -->
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

        // Toggle submenus
        document.querySelectorAll('.has-submenu > .nav-item').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const parent = item.closest('.has-submenu');
                parent.classList.toggle('open');
            });
        });

        // Gráficos
        new Chart(document.getElementById('pedidosChart'), {
            type: 'line',
            data: {
                labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                datasets: [{
                    data: [12, 19, 15, 17, 24, 23, 10],
                    borderColor: '#099aa7',
                    backgroundColor: 'rgba(9, 154, 167, 0.1)',
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        new Chart(document.getElementById('stockChart'), {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Baixo', 'Crítico'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        new Chart(document.getElementById('entregadoresChart'), {
            type: 'bar',
            data: {
                labels: ['João', 'Maria', 'Pedro', 'Ana'],
                datasets: [{
                    data: [28, 34, 19, 42],
                    backgroundColor: '#099aa7'
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        new Chart(document.getElementById('avaliacoesChart'), {
            type: 'polarArea',
            data: {
                labels: ['5 ⭐', '4 ⭐', '3 ⭐', '2 ⭐', '1 ⭐'],
                datasets: [{
                    data: [58, 24, 10, 5, 3],
                    backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#fd7e14', '#dc3545']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        new Chart(document.getElementById('origemChart'), {
            type: 'pie',
            data: {
                labels: ['Ingombotas', 'Maianga', 'Alvalade', 'Kilamba', 'Talatona'],
                datasets: [{
                    data: [42, 38, 51, 27, 33],
                    backgroundColor: ['#099aa7', '#4ec3b0', '#2c7a78', '#0f4e5a', '#6c8285']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
</body>
</html>