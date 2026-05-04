<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Admin · FarmaConnect</title>
  <!-- Google Fonts + Bootstrap Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: radial-gradient(circle at 10% 30%, #eef2f5, #e2e9ec);
      font-family: 'Inter', sans-serif;
      color: #0a2b2e;
    }

    /* variáveis globais */
    :root {
      --teal: #0899a6;
      --teal-dark: #066b75;
      --teal-glow: rgba(8,153,166,0.2);
      --navy: #0c2a33;
      --navy-light: #1e3a44;
      --surface: rgba(255,255,255,0.96);
      --glass-bg: rgba(255,255,255,0.6);
      --border-glass: 1px solid rgba(255,255,255,0.5);
      --shadow-sm: 0 8px 20px rgba(0,0,0,0.03), 0 2px 4px rgba(0,0,0,0.02);
      --shadow-lg: 0 25px 40px -12px rgba(0,0,0,0.12);
      --shadow-hover: 0 20px 30px -12px rgba(8,153,166,0.2);
      --radius-md: 18px;
      --radius-lg: 28px;
    }

    /* scroll elegante */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--teal); border-radius: 10px; }

    /* layout principal */
    .admin {
      display: flex;
      min-height: 100vh;
      backdrop-filter: blur(2px);
    }

    /* ---------- SIDEBAR PREMIUM ---------- */
    .sidebar {
      width: 280px;
      background: linear-gradient(145deg, #0c2a33 0%, #0e2129 100%);
      backdrop-filter: blur(4px);
      color: #d9f3f0;
      display: flex;
      flex-direction: column;
      position: sticky;
      top: 0;
      height: 100vh;
      border-right: 1px solid rgba(255,255,255,0.08);
      transition: all 0.2s;
      z-index: 20;
    }

    .logo-area {
      padding: 28px 24px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .logo {
      font-size: 1.7rem;
      font-weight: 800;
      letter-spacing: -0.02em;
    }
    .logo .farma { color: #22e0f0; text-shadow: 0 0 4px rgba(34,224,240,0.3); }
    .logo .connect { color: white; }
    .logo-small { font-size: 0.7rem; opacity: 0.5; margin-top: 6px; letter-spacing: 0.5px; }

    .profile-card {
      margin: 20px 16px;
      background: rgba(255,255,255,0.05);
      border-radius: 28px;
      padding: 16px;
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.08);
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .avatar {
      width: 46px;
      height: 46px;
      background: linear-gradient(135deg, #22e0f0, var(--teal));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1rem;
      color: #0c2a33;
    }
    .profile-info h4 { font-size: 0.9rem; font-weight: 600; margin-bottom: 2px; color: white; }
    .profile-info p { font-size: 0.7rem; opacity: 0.6; }

    .nav {
      flex: 1;
      padding: 16px 12px;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 18px;
      font-size: 0.85rem;
      font-weight: 500;
      color: #b3dfe6;
      transition: 0.2s;
      cursor: pointer;
    }
    .nav-item i { font-size: 1.2rem; width: 24px; }
    .nav-item.active {
      background: rgba(34,224,240,0.15);
      color: white;
      box-shadow: inset 0 0 0 1px rgba(34,224,240,0.2);
    }
    .nav-item:hover:not(.active) {
      background: rgba(255,255,255,0.03);
      color: white;
    }
    .badge {
      background: #f97316;
      color: #fff;
      font-size: 0.65rem;
      padding: 2px 8px;
      border-radius: 30px;
      margin-left: auto;
    }
    .badge-soft {
      background: rgba(255,255,255,0.12);
      padding: 2px 8px;
    }
    .sidebar-footer {
      padding: 20px 20px;
      border-top: 1px solid rgba(255,255,255,0.06);
      font-size: 0.7rem;
    }

    /* ---------- MAIN ---------- */
    .main {
      flex: 1;
      overflow-x: hidden;
    }
    .top-bar {
      background: rgba(255,255,255,0.7);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(0,0,0,0.03);
      padding: 12px 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    .page-title {
      font-weight: 600;
      font-size: 1.4rem;
      background: linear-gradient(135deg, #0a2e35, #0899a6);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
    }
    .header-actions {
      display: flex;
      gap: 12px;
      align-items: center;
    }
    .notif-icon {
      background: white;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: var(--shadow-sm);
      cursor: pointer;
      transition: 0.2s;
    }
    .notif-icon:hover { background: var(--teal); color: white; transform: scale(1.02);}
    .admin-pill {
      background: white;
      border-radius: 40px;
      padding: 5px 12px 5px 5px;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: var(--shadow-sm);
    }
    .admin-avatar-sm {
      width: 32px;
      height: 32px;
      background: var(--teal);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    /* conteudo */
    .content {
      padding: 28px 28px 40px;
    }

    /* grade de KPIs */
    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(4,1fr);
      gap: 22px;
      margin-bottom: 32px;
    }
    .kpi-card {
      background: var(--surface);
      backdrop-filter: blur(12px);
      border-radius: var(--radius-lg);
      padding: 20px;
      box-shadow: var(--shadow-sm);
      border: 1px solid rgba(255,255,255,0.7);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .kpi-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-hover);
    }
    .kpi-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
    }
    .kpi-icon {
      width: 48px;
      height: 48px;
      background: rgba(8,153,166,0.12);
      border-radius: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: var(--teal);
    }
    .trend {
      font-size: 0.7rem;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 50px;
      background: #ecfdf5;
      color: #059669;
    }
    .kpi-value {
      font-size: 2rem;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: #0a2e35;
      line-height: 1.2;
    }
    .kpi-label {
      font-size: 0.75rem;
      color: #5f7c82;
      font-weight: 500;
      margin-top: 6px;
    }

    /* tabelas modernas */
    .card-modern {
      background: white;
      border-radius: 32px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.02), 0 0 0 1px rgba(0,0,0,0.01);
      margin-bottom: 28px;
      transition: all 0.2s;
      overflow: hidden;
    }
    .card-header {
      padding: 16px 24px;
      border-bottom: 1px solid #edf2f4;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .card-header h2 {
      font-size: 1rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .link-mock {
      font-size: 0.75rem;
      color: var(--teal);
      cursor: pointer;
      font-weight: 500;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th {
      text-align: left;
      padding: 14px 16px;
      font-size: 0.7rem;
      font-weight: 600;
      color: #6b8b92;
      text-transform: uppercase;
      background: #fbfefd;
    }
    td {
      padding: 14px 16px;
      border-top: 1px solid #f0f4f5;
      font-size: 0.8rem;
    }
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 12px;
      border-radius: 50px;
      font-size: 0.7rem;
      font-weight: 600;
      width: fit-content;
    }
    .status-pendente { background: #fff3e0; color: #b45309; }
    .status-confirmado { background: #e0f2fe; color: #0369a1; }
    .status-pago { background: #dcfce7; color: #15803d; }
    .status-entrega { background: #f1f5f9; color: #334155; }

    .btn-sm {
      padding: 6px 12px;
      border-radius: 30px;
      font-size: 0.7rem;
      border: none;
      background: #f1f5f9;
      cursor: pointer;
      transition: 0.15s;
    }
    .btn-primary {
      background: var(--teal);
      color: white;
    }
    .btn-primary:hover { background: var(--teal-dark); transform: scale(0.98);}
    .btn-outline {
      border: 1px solid #cbd5e1;
      background: transparent;
    }

    /* grid dois colunas */
    .row-2col {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 24px;
      margin-bottom: 28px;
    }

    /* fundo centralizado (mini card) */
    .fund-card {
      background: linear-gradient(125deg, #0e2f38, #0a2128);
      border-radius: 32px;
      padding: 20px;
      color: white;
      margin-bottom: 20px;
    }
    .saldo {
      font-size: 2rem;
      font-weight: 800;
      margin: 12px 0;
    }
    .chip-val {
      background: rgba(255,255,255,0.15);
      padding: 2px 10px;
      border-radius: 50px;
      font-size: 0.7rem;
    }
    .row-fund {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .text-gold { color: #facc15; }
    .flex-between { display: flex; justify-content: space-between; align-items: center;}

    /* gráfico simples */
    .chart-bars {
      padding: 20px;
    }
    .bar-item {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 10px;
    }
    .bar-label {
      width: 32px;
      font-size: 0.7rem;
      font-weight: 500;
    }
    .bar-line {
      flex: 1;
      height: 8px;
      background: #e4eef0;
      border-radius: 10px;
      overflow: hidden;
    }
    .bar-fill {
      height: 100%;
      background: linear-gradient(90deg, #0899a6, #22e0f0);
      width: 0%;
      border-radius: 10px;
      transition: width 1s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    .value {
      width: 70px;
      text-align: right;
      font-size: 0.7rem;
      font-weight: 500;
    }

    /* atalhos */
    .shortcuts {
      display: grid;
      grid-template-columns: repeat(3,1fr);
      gap: 12px;
      padding: 8px 16px 20px;
    }
    .shortcut-item {
      background: #f8fafc;
      border-radius: 20px;
      padding: 12px 6px;
      text-align: center;
      cursor: pointer;
      transition: 0.2s;
    }
    .shortcut-item:hover { background: #e6f7f8; transform: translateY(-2px);}
    .shortcut-icon { font-size: 1.2rem; color: var(--teal); margin-bottom: 6px; }


.nav-label {
  font-size: .67rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--text-dim);
  padding: .8rem .8rem .3rem;
}

.nav-link {
  display: flex;
  align-items: center;
  gap: .85rem;
  padding: .72rem .9rem;
  border-radius: var(--r12);
  color: rgba(255,255,255,.5);
  text-decoration: none;
  font-size: .9rem;
  font-weight: 500;
  transition: all .2s;
  position: relative;
  cursor: pointer;
}
.nav-link i { font-size: 1.05rem; width: 20px; text-align: center; flex-shrink: 0; }

    /* responsivo */
    @media (max-width: 1000px) {
      .sidebar { width: 80px; overflow-x: hidden; }
      .logo-area .logo, .profile-card .profile-info, .nav-item span:not(.badge), .sidebar-footer { display: none; }
      .nav-item i { margin-right: 0; }
      .nav-item { justify-content: center; }
      .kpi-grid { grid-template-columns: repeat(2,1fr); }
      .row-2col { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
<div class="admin">

  <!-- SIDEBAR ULTRAMODERNA -->
  <aside class="sidebar">
    <div class="logo-area">
      <div class="logo"><span class="farma">Farma</span><span class="connect">Connect</span></div>
      <div class="logo-small">central de controlo</div>
    </div>
    <div class="profile-card">
      <div class="avatar">AO</div>
      <div class="profile-info">
        <h4>Admin Platform</h4>
        <p>supervisor</p>
      </div>
    </div>
    <div class="nav">
      <div class="nav-item active"><i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span></div>
      <div class="nav-item" onclick="alert('Painel de validação em breve')"><i class="bi bi-credit-card-2-front"></i><span>Validar pag.</span><span class="badge">7</span></div>
      <div class="nav-item" onclick="alert('Gestão de pedidos')"><i class="bi bi-bag-check"></i><span>Pedidos</span><span class="badge">23</span></div>
      <div class="nav-item"><i class="bi bi-hospital"></i><span>Farmácias</span></div>
      <div class="nav-item"><i class="bi bi-people"></i><span>Entregadores</span></div>
      <div class="nav-item"><i class="bi bi-cash-stack"></i><span>Fundo central</span></div>
      <div class="nav-item"><i class="bi bi-graph-up"></i><span>Relatórios</span></div>
    </div>
    <div class="sidebar-footer">
      <div><i class="bi bi-circle-fill" style="color:#22e0f0; font-size: 8px;"></i> sistema operacional</div>
          <a href="#" class="nav-link" style="color:rgba(240,78,96,.7)" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sair</span>
    </a>

    <form id="logout-form" action="{{ route('logout', ['id' => Auth::user()->id]) }}" method="POST" style="display: none;">
      @csrf
    </form>
    </div>
  </aside>

  <div class="main">
    <div class="top-bar">
      <div class="page-title">📊 Painel de controlo</div>
      <div class="header-actions">
        <div class="notif-icon" onclick="alert('Notificações do sistema')"><i class="bi bi-bell"></i></div>
        <div class="admin-pill">
          <div class="admin-avatar-sm">AO</div>
          <span style="font-size:0.8rem; font-weight: 500;">Admin</span>
          <i class="bi bi-chevron-down" style="font-size: 0.7rem;"></i>
        </div>
      </div>
    </div>

    <div class="content">

      <!-- KPI de impacto -->
      <div class="kpi-grid">
        <div class="kpi-card">
          <div class="kpi-header"><div class="kpi-icon"><i class="bi bi-bank2"></i></div><span class="trend">+18% vs anterior</span></div>
          <div class="kpi-value">4.286.500 <span style="font-size:0.9rem;">Kz</span></div>
          <div class="kpi-label">Vendas totais (maio/2026)</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-header"><div class="kpi-icon"><i class="bi bi-wallet2"></i></div><span class="trend">+5%</span></div>
          <div class="kpi-value">1.837.200 <span style="font-size:0.9rem;">Kz</span></div>
          <div class="kpi-label">Fundo central disponível</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-header"><div class="kpi-icon"><i class="bi bi-clock-history"></i></div><span class="trend" style="background:#ffedd5; color:#b45309;">pendente</span></div>
          <div class="kpi-value">7</div>
          <div class="kpi-label">Pagamentos por validar</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-header"><div class="kpi-icon"><i class="bi bi-truck"></i></div><span class="trend">+23 activos</span></div>
          <div class="kpi-value">148</div>
          <div class="kpi-label">Pedidos este mês</div>
        </div>
      </div>

      <!-- area principal: tabela de validação + resumo fundo -->
      <div class="row-2col">
        <div class="card-modern">
          <div class="card-header">
            <h2><i class="bi bi-file-check" style="color: #0899a6;"></i> Comprovativos por validar</h2>
            <div class="link-mock" onclick="alert('Lista completa')">Ver todos →</div>
          </div>
          <div style="overflow-x: auto;">
            <table>
              <thead><tr><th>Pedido</th><th>Cliente</th><th>Valor</th><th>Data</th><th>Comprovativo</th><th>Ações</th></tr></thead>
              <tbody>
                <tr><td style="font-weight:600;">#0041</td><td>João Mendes</td><td>2.400 Kz</td><td>04/05/26</td><td><span class="status-badge status-pendente" onclick="alert('ver comprovativo: imagem_0041.jpg')"><i class="bi bi-image"></i> visualizar</span></td><td><button class="btn-sm btn-primary" onclick="alert('Pagamento #0041 validado e fundo creditado')">Validar</button> <button class="btn-sm btn-outline" onclick="alert('Pagamento rejeitado')">Rejeitar</button></td></tr>
                <tr><td style="font-weight:600;">#0039</td><td>Ana Loureiro</td><td>5.800 Kz</td><td>04/05/26</td><td><span class="status-badge status-pendente"><i class="bi bi-file-pdf"></i> recibo_0039.pdf</span></td><td><button class="btn-sm btn-primary" onclick="alert('Validado')">Validar</button> <button class="btn-sm btn-outline">Rejeitar</button></td></tr>
                <tr><td style="font-weight:600;">#0037</td><td>Carlos Silva</td><td>1.200 Kz</td><td>03/05/26</td><td><span class="status-badge status-pendente"><i class="bi bi-earbuds"></i> transferência.png</span></td><td><button class="btn-sm btn-primary">Validar</button> <button class="btn-sm btn-outline">Rejeitar</button></td></tr>
                <tr><td style="font-weight:600;">#0035</td><td>Fernanda Neto</td><td>3.600 Kz</td><td>03/05/26</td><td><span class="status-badge status-pendente"><i class="bi bi-card-image"></i> comprovativo.jpg</span></td><td><button class="btn-sm btn-primary">Validar</button> <button class="btn-sm btn-outline">Rejeitar</button></td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- lado direito: fundo centralizado + indicadores -->
        <div>
          <div class="fund-card">
            <div style="opacity:0.7; display: flex; justify-content: space-between;"><span>💰 Fundo centralizado</span><span class="chip-val">saldo actual</span></div>
            <div class="saldo">1.837.200 Kz</div>
            <div class="flex-between"><span>Entradas (mai)</span><span><strong>+4.286.500 Kz</strong></span></div>
            <div class="flex-between"><span>Repasses farmácias</span><span style="color:#facc15;">-2.104.800 Kz</span></div>
            <div class="flex-between"><span>Comissões retidas (8%)</span><span>342.920 Kz</span></div>
            <div class="flex-between" style="margin-top: 12px;"><span>A pagar a farmácias</span><span class="text-gold">344.000 Kz</span></div>
            <button class="btn-sm btn-primary" style="background: #1e8b98; margin-top: 16px; width: 100%;" onclick="alert('Simular repasse às farmácias')">Gerar repasse financeiro →</button>
          </div>
          <div class="card-modern" style="padding: 16px;">
            <div style="font-weight: 600; margin-bottom: 12px;"><i class="bi bi-pie-chart"></i> Distribuição de pedidos</div>
            <div class="flex-between"><span><span class="status-badge status-confirmado">Pendente</span></span><span>12</span></div>
            <div class="flex-between"><span><span class="status-badge status-entrega">Em entrega</span></span><span>11</span></div>
            <div class="flex-between"><span><span class="status-badge status-pago">Concluído</span></span><span>98</span></div>
            <div class="flex-between"><span><span class="status-badge" style="background:#ffe4e6; color:#c2410c;">Cancelado</span></span><span>7</span></div>
          </div>
        </div>
      </div>

      <!-- Gráfico de barras e atalhos -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 28px;">
        <div class="card-modern">
          <div class="card-header"><h2><i class="bi bi-graph-up"></i> Movimento diário (Kz milhares)</h2></div>
          <div class="chart-bars" id="chartContainer"></div>
        </div>
        <div class="card-modern">
          <div class="card-header"><h2><i class="bi bi-lightning-charge"></i> Atalhos rápidos</h2></div>
          <div class="shortcuts">
            <div class="shortcut-item" onclick="alert('Validar pagamentos pendentes')"><div class="shortcut-icon"><i class="bi bi-check-circle"></i></div><div>Validar</div><div style="font-size:0.6rem;">7 pendentes</div></div>
            <div class="shortcut-item" onclick="alert('Gestão de farmácias')"><div class="shortcut-icon"><i class="bi bi-building"></i></div><div>Farmácias</div><div>3 activas</div></div>
            <div class="shortcut-item" onclick="alert('Relatórios financeiros')"><div class="shortcut-icon"><i class="bi bi-file-spreadsheet"></i></div><div>Relatórios</div><div>mai/2026</div></div>
            <div class="shortcut-item" onclick="alert('Fundo centralizado')"><div class="shortcut-icon"><i class="bi bi-cash"></i></div><div>Fundo</div><div>1,84M Kz</div></div>
            <div class="shortcut-item" onclick="alert('Entregadores online')"><div class="shortcut-icon"><i class="bi bi-truck"></i></div><div>Entregadores</div><div>2 online</div></div>
            <div class="shortcut-item" onclick="alert('Pedidos pendentes')"><div class="shortcut-icon"><i class="bi bi-bag"></i></div><div>Pedidos</div><div>12 pendentes</div></div>
          </div>
        </div>
      </div>

      <!-- Tabela de últimos pedidos -->
      <div class="card-modern">
        <div class="card-header"><h2><i class="bi bi-receipt"></i> Últimos pedidos na plataforma</h2><div class="link-mock" onclick="alert('todos os pedidos')">Histórico →</div></div>
        <div style="overflow-x: auto;">
          <table>
            <thead><tr><th>ID</th><th>Cliente</th><th>Farmácia(s)</th><th>Total</th><th>Método</th><th>Entrega</th><th>Status</th><th></th></tr></thead>
            <tbody>
              <tr><td class="fw">0042</td><td>Beatriz Ramos</td><td>Farmácia Saúde+</td><td>7.200 Kz</td><td>Express</td><td>Em entrega</td><td><span class="status-badge status-entrega">A caminho</span></td><td><button class="btn-sm" onclick="alert('detalhes')">Detalhes</button></td></tr>
              <tr><td>0041</td><td>João Mendes</td><td>Farmácia Central</td><td>2.400 Kz</td><td>Express</td><td>Retirada</td><td><span class="status-badge status-pendente">Pendente</span></td><td><button class="btn-sm">Detalhes</button></td></tr>
              <tr><td>0040</td><td>Mário Costa</td><td>Farmácia Saúde</td><td>4.800 Kz</td><td>Numerário</td><td>Express</td><td><span class="status-badge status-pago">Concluído</span></td><td><button class="btn-sm">Detalhes</button></td></tr>
              <tr><td>0038</td><td>Sónia Baptista</td><td>Múltiplas farmácias</td><td>12.600 Kz</td><td>Express</td><td>Express</td><td><span class="status-badge status-pago">Entregue</span></td><td><button class="btn-sm">Detalhes</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  // Gráfico de barras dinâmico (dados reais)
  const dailyData = [142,280,195,380,420,310,260,490,520,380,440,610,580,490,520,680,720,590,640,780,820,710,760,890,940,820,880,1020,980,860,920];
  const maxVal = Math.max(...dailyData);
  const container = document.getElementById('chartContainer');
  const days = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
  for (let i = 0; i < dailyData.length; i++) {
    const row = document.createElement('div');
    row.className = 'bar-item';
    const percent = (dailyData[i] / maxVal) * 100;
    row.innerHTML = `<div class="bar-label">${days[i]}</div>
                     <div class="bar-line"><div class="bar-fill" style="width: 0%;" data-width="${percent}"></div></div>
                     <div class="value">${(dailyData[i] * 1000).toLocaleString('pt-AO')} Kz</div>`;
    container.appendChild(row);
  }
  setTimeout(() => {
    document.querySelectorAll('.bar-fill').forEach(bar => {
      bar.style.width = bar.dataset.width + '%';
    });
  }, 100);
</script>
</body>
</html>