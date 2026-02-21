<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>FarmaConnect - Plataforma de Busca e Entrega de Medicamentos em Angola</title>
  <meta name="description" content="Encontre medicamentos nas farmácias de Luanda e receba em casa. Comparação de preços, entregas rápidas e farmácias parceiras.">
  <meta name="keywords" content="farmácia angola, medicamentos luanda, entrega de medicamentos, farmácia online angola">

  <!-- Favicons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    /* ----- PALETA FARMA CONNECT ----- */
    :root {
      --background-color: #ffffff;
      --default-color: #363f40;
      --heading-color: #1f2f31;
      --accent-color: #099aa7;
      --surface-color: #ffffff;
      --contrast-color: #ffffff;
      --soft-green: #dff3f0;
      --light-mint: #eaf6f5;
      --google-gray: #f1f3f4;
      --apple-dark: #1c1c1e;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: var(--background-color);
      color: var(--default-color);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow-x: hidden;
    }

    /* Header */
    .header {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(9, 154, 167, 0.08);
      padding: 1rem 0;
      transition: all 0.3s ease;
    }

    .header .logo {
      text-decoration: none;
    }

    .header .sitename {
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: -0.03em;
      margin: 0;
    }

    .header .sitename span:first-child {
      color: var(--accent-color);
    }

    .header .sitename span:last-child {
      color: var(--heading-color);
    }

    /* Navegação */
    .navmenu ul {
      margin: 0;
      padding: 0;
      display: flex;
      list-style: none;
      align-items: center;
    }

    .navmenu li {
      position: relative;
      margin: 0 0.5rem;
    }

    .navmenu a {
      color: var(--heading-color);
      font-weight: 600;
      font-size: 1rem;
      padding: 0.5rem 1rem;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: 0.3s;
      border-radius: 50px;
    }

    .navmenu a:hover,
    .navmenu .active {
      background-color: var(--soft-green);
      color: var(--accent-color);
    }

    .navmenu .dropdown ul {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      box-shadow: 0 10px 30px rgba(9, 154, 167, 0.1);
      border-radius: 20px;
      padding: 0.5rem;
      min-width: 200px;
      z-index: 99;
    }

    .navmenu .dropdown:hover ul {
      display: block;
    }

    .navmenu .dropdown ul li {
      margin: 0;
    }

    .navmenu .dropdown ul a {
      padding: 0.7rem 1rem;
      border-radius: 12px;
    }

    .btn-getstarted {
      background-color: var(--accent-color);
      color: white;
      font-weight: 600;
      padding: 0.7rem 1.5rem;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s;
      border: 2px solid var(--accent-color);
    }

    .btn-getstarted:hover {
      background-color: transparent;
      color: var(--accent-color);
    }

    .btn-outline {
      background-color: transparent;
      color: var(--accent-color);
      font-weight: 600;
      padding: 0.7rem 1.5rem;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s;
      border: 2px solid var(--accent-color);
    }

    .btn-outline:hover {
      background-color: var(--accent-color);
      color: white;
    }

    /* Hero Section */
    .hero {
      padding: 120px 0 60px;
      position: relative;
      overflow: hidden;
    }

    .hero-badge {
      background: var(--soft-green);
      color: var(--accent-color);
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.9rem;
      display: inline-block;
      margin-bottom: 1.5rem;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      color: var(--heading-color);
      line-height: 1.2;
      margin-bottom: 1.5rem;
    }

    .hero-title span {
      color: var(--accent-color);
    }

    .hero-description {
      font-size: 1.1rem;
      color: #6c8285;
      margin-bottom: 2rem;
      max-width: 90%;
    }

    .hero-stats {
      display: flex;
      gap: 2rem;
      margin: 2rem 0;
    }

    .hero-stats .stat {
      display: flex;
      flex-direction: column;
    }

    .hero-stats .stat .number {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--accent-color);
    }

    .hero-stats .stat .label {
      font-size: 0.9rem;
      color: #6c8285;
    }

    .hero-image {
      position: relative;
    }

    .hero-image .main-image {
      border-radius: 40px;
      box-shadow: 0 30px 60px rgba(9, 154, 167, 0.15);
    }

    .floating-card {
      position: absolute;
      background: white;
      padding: 1rem 1.5rem;
      border-radius: 60px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      gap: 1rem;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(9, 154, 167, 0.1);
    }

    .floating-card.delivery-card {
      bottom: 30px;
      left: 30px;
    }

    .floating-card.promo-card {
      top: 30px;
      right: 30px;
    }

    .floating-card i {
      font-size: 2rem;
      color: var(--accent-color);
    }

    .floating-card .text .label {
      font-size: 0.8rem;
      color: #6c8285;
    }

    .floating-card .text .value {
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--heading-color);
    }

    /* Search Section */
    .search-section {
      background: linear-gradient(145deg, var(--light-mint) 0%, #ffffff 100%);
      padding: 4rem 0;
      border-radius: 60px 60px 0 0;
    }

    .search-container {
      background: white;
      padding: 1rem;
      border-radius: 70px;
      box-shadow: 0 20px 40px rgba(9, 154, 167, 0.08);
      margin-top: -80px;
    }

    .search-row {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .search-field {
      flex: 1;
      position: relative;
    }

    .search-field i {
      position: absolute;
      left: 1.5rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--accent-color);
    }

    .search-field input,
    .search-field select {
      width: 100%;
      padding: 1rem 1rem 1rem 3rem;
      border: 2px solid var(--soft-green);
      border-radius: 60px;
      font-size: 1rem;
      transition: all 0.3s;
    }

    .search-field input:focus,
    .search-field select:focus {
      outline: none;
      border-color: var(--accent-color);
    }

    .search-submit {
      background: var(--accent-color);
      color: white;
      border: none;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      transition: all 0.3s;
    }

    .search-submit:hover {
      background: #067e8a;
      transform: scale(1.1);
    }

    /* Section Titles */
    .section-title {
      text-align: center;
      margin-bottom: 3rem;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--heading-color);
      margin-bottom: 1rem;
    }

    .section-title p {
      color: #6c8285;
      font-size: 1.1rem;
    }

    /* Pharmacy Cards */
    .pharmacy-card {
      background: white;
      border-radius: 32px;
      padding: 1.5rem;
      box-shadow: 0 10px 30px rgba(9, 154, 167, 0.08);
      transition: all 0.3s;
      height: 100%;
      border: 1px solid transparent;
    }

    .pharmacy-card:hover {
      transform: translateY(-10px);
      border-color: var(--accent-color);
      box-shadow: 0 20px 40px rgba(9, 154, 167, 0.15);
    }

    .pharmacy-image {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      object-fit: cover;
      margin-bottom: 1rem;
    }

    .pharmacy-name {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--heading-color);
      margin-bottom: 0.5rem;
    }

    .pharmacy-location {
      color: #6c8285;
      font-size: 0.95rem;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .pharmacy-status {
      display: inline-block;
      padding: 0.3rem 0.8rem;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .status-open {
      background: #d4edda;
      color: #155724;
    }

    .status-closed {
      background: #f8d7da;
      color: #721c24;
    }

    .pharmacy-actions {
      display: flex;
      gap: 0.5rem;
    }

    .pharmacy-actions a {
      flex: 1;
      padding: 0.5rem;
      text-align: center;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s;
    }

    .btn-view {
      background: var(--soft-green);
      color: var(--accent-color);
    }

    .btn-order {
      background: var(--accent-color);
      color: white;
    }

    /* Service Cards */
    .service-card {
      background: white;
      border-radius: 32px;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 10px 30px rgba(9, 154, 167, 0.08);
      transition: all 0.3s;
      height: 100%;
    }

    .service-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(9, 154, 167, 0.15);
    }

    .service-icon {
      width: 80px;
      height: 80px;
      background: var(--soft-green);
      border-radius: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
    }

    .service-icon i {
      font-size: 2.5rem;
      color: var(--accent-color);
    }

    .service-card h4 {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--heading-color);
      margin-bottom: 1rem;
    }

    .service-card p {
      color: #6c8285;
      line-height: 1.6;
    }

    /* How It Works */
    .how-it-works {
      padding: 4rem 0;
      background: var(--light-mint);
    }

    .step-item {
      text-align: center;
      padding: 2rem;
    }

    .step-number {
      width: 60px;
      height: 60px;
      background: var(--accent-color);
      color: white;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0 auto 1.5rem;
      transform: rotate(10deg);
      transition: all 0.3s;
    }

    .step-item:hover .step-number {
      transform: rotate(0deg) scale(1.1);
    }

    .step-item h4 {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--heading-color);
      margin-bottom: 1rem;
    }

    .step-item p {
      color: #6c8285;
    }

    /* App Section */
    .app-section {
      padding: 4rem 0;
    }

    .app-content {
      background: linear-gradient(135deg, var(--accent-color) 0%, #067e8a 100%);
      border-radius: 60px;
      padding: 3rem;
      color: white;
    }

    .app-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }

    .app-button {
      background: white;
      color: var(--accent-color);
      padding: 0.8rem 1.5rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s;
    }

    .app-button:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .app-image {
      max-width: 100%;
      border-radius: 40px;
      transform: translateY(-30px);
    }

    /* Footer */
    .footer {
      background: var(--heading-color);
      color: white;
      padding: 4rem 0 2rem;
    }

    .footer h4 {
      color: white;
      font-weight: 600;
      margin-bottom: 1.5rem;
    }

    .footer a {
      color: #a0b9bc;
      text-decoration: none;
      transition: all 0.3s;
    }

    .footer a:hover {
      color: var(--accent-color);
    }

    .footer .social-links a {
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin-right: 0.5rem;
    }

    .footer .social-links a:hover {
      background: var(--accent-color);
    }

    .footer .contact-info i {
      color: var(--accent-color);
      margin-right: 0.5rem;
    }

    .copyright {
      text-align: center;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Animações */
    .animate-fade-up {
      animation: fadeUp 0.6s ease;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 992px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .search-row {
        flex-direction: column;
      }
      
      .search-container {
        border-radius: 30px;
      }
      
      .search-submit {
        width: 100%;
        border-radius: 60px;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header fixed-top">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('index') }}" class="logo">
          <h1 class="sitename"><span>Farma</span><span>Connect</span></h1>
        </a>

        <nav class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Início</a></li>
            <li><a href="#search">Medicamentos</a></li>
            <li><a href="#pharmacies">Farmácias</a></li>
            <li class="dropdown">
              <a href="#">Cadastro <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="cadastro.html">Cliente</a></li>
                <li><a href="cadastrar_farmacia.html">Farmácia</a></li>
                <li><a href="cadastro-entregador.html">Entregador</a></li>
              </ul>
            </li>
            <li><a href="#contact">Contacto</a></li>
          </ul>
        </nav>

        <a class="btn-getstarted" href="{{route('login')}}">Entrar</a>
      </div>
    </div>
  </header>

  <main>
    <!-- Hero Section -->
    <section id="hero" class="hero">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right">
            <div class="hero-badge">
              <i class="bi bi-shield-check"></i> Entrega segura em Luanda
            </div>
            <h1 class="hero-title">
              Medicamentos na <span>palma da sua mão</span>
            </h1>
            <p class="hero-description">
              Encontre farmácias próximas, compare preços e receba seus medicamentos em casa. 
              Entrega rápida em todos os bairros de Luanda.
            </p>
            
            <div class="hero-stats">
              <div class="stat">
                <span class="number">50+</span>
                <span class="label">Farmácias Parceiras</span>
              </div>
              <div class="stat">
                <span class="number">30min</span>
                <span class="label">Entrega Média</span>
              </div>
              <div class="stat">
                <span class="number">5000+</span>
                <span class="label">Medicamentos</span>
              </div>
            </div>

            <div class="d-flex gap-3">
              <a href="#search" class="btn-getstarted">Pesquisar agora</a>
              <a href="#how" class="btn-outline">Como funciona</a>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left">
            <div class="hero-image">
              <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=800&auto=format&fit=crop" 
                   alt="Entrega de medicamentos" class="img-fluid main-image">
              
              <div class="floating-card delivery-card">
                <i class="bi bi-truck"></i>
                <div class="text">
                  <span class="label">Entrega em</span>
                  <span class="value">30 minutos</span>
                </div>
              </div>

              <div class="floating-card promo-card">
                <i class="bi bi-tag"></i>
                <div class="text">
                  <span class="label">Primeira compra</span>
                  <span class="value">10% desconto</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Search Section -->
    <section id="search" class="search-section">
      <div class="container">
        <div class="search-container" data-aos="fade-up">
          <form class="search-row">
            <div class="search-field">
              <i class="bi bi-capsule"></i>
              <input type="text" placeholder="Nome do medicamento..." id="medicamento">
            </div>
            <div class="search-field">
              <i class="bi bi-geo-alt"></i>
              <select id="bairro">
                <option value="">Todos os bairros</option>
                <option>Ingombotas</option>
                <option>Maianga</option>
                <option>Alvalade</option>
                <option>Kilamba</option>
                <option>Talatona</option>
                <option>Benfica</option>
                <option>Viana</option>
              </select>
            </div>
            <button type="submit" class="search-submit">
              <i class="bi bi-search"></i>
            </button>
          </form>
        </div>

        <div class="row mt-5">
          <div class="col-12">
            <div class="section-title">
              <h2>Medicamentos mais procurados</h2>
              <p>Os medicamentos mais pesquisados em Luanda esta semana</p>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-lg-2 col-md-4 col-6">
            <div class="badge bg-light text-dark p-3 w-100 text-center rounded-pill">
              Paracetamol 500mg
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-6">
            <div class="badge bg-light text-dark p-3 w-100 text-center rounded-pill">
              Amoxicilina
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-6">
            <div class="badge bg-light text-dark p-3 w-100 text-center rounded-pill">
              Ibuprofeno
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-6">
            <div class="badge bg-light text-dark p-3 w-100 text-center rounded-pill">
              Dipirona
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-6">
            <div class="badge bg-light text-dark p-3 w-100 text-center rounded-pill">
              Losartana
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-6">
            <div class="badge bg-light text-dark p-3 w-100 text-center rounded-pill">
              Omeprazol
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Pharmacies -->
    <section id="pharmacies" class="py-5">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Farmácias Parceiras em Luanda</h2>
          <p>As melhores farmácias da cidade já estão na FarmaConnect</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="pharmacy-card">
              <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&auto=format&fit=crop" 
                   alt="Farmácia Central" class="pharmacy-image">
              <h3 class="pharmacy-name">Farmácia Central</h3>
              <div class="pharmacy-location">
                <i class="bi bi-geo-alt"></i> Ingombotas, Rua Ho Chi Min
              </div>
              <span class="pharmacy-status status-open">
                <i class="bi bi-clock"></i> Aberta agora
              </span>
              <div class="pharmacy-actions">
                <a href="#" class="btn-view">Ver medicamentos</a>
                <a href="#" class="btn-order">Pedir entrega</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="pharmacy-card">
              <img src="https://images.unsplash.com/photo-1579684289531-9f9e6f7b0f5b?w=400&auto=format&fit=crop" 
                   alt="Farmácia Kilamba" class="pharmacy-image">
              <h3 class="pharmacy-name">Farmácia Kilamba</h3>
              <div class="pharmacy-location">
                <i class="bi bi-geo-alt"></i> Kilamba, Rua dos Combates
              </div>
              <span class="pharmacy-status status-open">
                <i class="bi bi-clock"></i> Aberta agora
              </span>
              <div class="pharmacy-actions">
                <a href="#" class="btn-view">Ver medicamentos</a>
                <a href="#" class="btn-order">Pedir entrega</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="pharmacy-card">
              <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400&auto=format&fit=crop" 
                   alt="Farmácia Talatona" class="pharmacy-image">
              <h3 class="pharmacy-name">Farmácia Talatona</h3>
              <div class="pharmacy-location">
                <i class="bi bi-geo-alt"></i> Talatona, Belas Shopping
              </div>
              <span class="pharmacy-status status-open">
                <i class="bi bi-clock"></i> Aberta agora
              </span>
              <div class="pharmacy-actions">
                <a href="#" class="btn-view">Ver medicamentos</a>
                <a href="#" class="btn-order">Pedir entrega</a>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <a href="#" class="btn-outline">Ver todas as farmácias <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Nossos Serviços</h2>
          <p>Tudo o que precisa para cuidar da sua saúde</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-search"></i>
              </div>
              <h4>Busca Inteligente</h4>
              <p>Encontre medicamentos disponíveis nas farmácias mais próximas em tempo real.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-truck"></i>
              </div>
              <h4>Entrega Rápida</h4>
              <p>Receba seus medicamentos em casa com entregadores treinados e seguros.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-credit-card"></i>
              </div>
              <h4>Pagamento Digital</h4>
              <p>Pague com cartão, multicaixa ou dinheiro no ato da entrega.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-prescription2"></i>
              </div>
              <h4>Receita Digital</h4>
              <p>Envie a receita do seu médico e nós preparamos com antecedência.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works -->
    <section id="how" class="how-it-works">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Como funciona?</h2>
          <p>4 passos simples para receber seus medicamentos em casa</p>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="step-item">
              <div class="step-number">1</div>
              <h4>Pesquise</h4>
              <p>Encontre o medicamento que precisa nas farmácias próximas</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="step-item">
              <div class="step-number">2</div>
              <h4>Compare</h4>
              <p>Veja os preços e escolha a melhor opção</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="step-item">
              <div class="step-number">3</div>
              <h4>Peça</h4>
              <p>Faça o pedido e escolha a forma de pagamento</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="step-item">
              <div class="step-number">4</div>
              <h4>Receba</h4>
              <p>Receba em casa ou retire na farmácia mais próxima</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- App Section -->
    <section class="app-section">
      <div class="container">
        <div class="app-content" data-aos="zoom-in">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h2 class="text-white mb-3">Baixe o nosso app</h2>
              <p class="text-white-50 mb-4">Tenha a FarmaConnect sempre à mão. Peça seus medicamentos de onde estiver.</p>
              
              <div class="app-buttons">
                <a href="#" class="app-button">
                  <i class="bi bi-google-play"></i> Google Play
                </a>
                <a href="#" class="app-button">
                  <i class="bi bi-apple"></i> App Store
                </a>
              </div>

              <div class="mt-4">
                <div class="d-flex gap-3">
                  <div>
                    <h4 class="text-white mb-0">5000+</h4>
                    <small class="text-white-50">Downloads</small>
                  </div>
                  <div>
                    <h4 class="text-white mb-0">4.8</h4>
                    <small class="text-white-50">Avaliação</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 text-center">
              <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&auto=format&fit=crop" 
                   alt="App FarmaConnect" class="app-image img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>O que dizem nossos clientes</h2>
          <p>Depoimentos de quem já usa a FarmaConnect</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 shadow-sm p-4 rounded-4">
              <div class="d-flex gap-3 mb-3">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                     alt="Cliente" class="rounded-circle" width="50">
                <div>
                  <h5 class="mb-0">Maria Santos</h5>
                  <small class="text-muted">Ingombotas</small>
                </div>
              </div>
              <p class="mb-0">"Salvou minha mãe! Precisávamos de um medicamento urgente à noite e encontramos aberto."</p>
              <div class="text-warning mt-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow-sm p-4 rounded-4">
              <div class="d-flex gap-3 mb-3">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                     alt="Cliente" class="rounded-circle" width="50">
                <div>
                  <h5 class="mb-0">João Ferreira</h5>
                  <small class="text-muted">Kilamba</small>
                </div>
              </div>
              <p class="mb-0">"Entrega super rápida! Pedi e em 25 minutos chegou. Muito confiável."</p>
              <div class="text-warning mt-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 shadow-sm p-4 rounded-4">
              <div class="d-flex gap-3 mb-3">
                <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                     alt="Cliente" class="rounded-circle" width="50">
                <div>
                  <h5 class="mb-0">Ana Costa</h5>
                  <small class="text-muted">Talatona</small>
                </div>
              </div>
              <p class="mb-0">"Adoro poder comparar preços entre farmácias. Economizo sempre!"</p>
              <div class="text-warning mt-2">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="contact" class="footer">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4">
          <h3>FarmaConnect</h3>
          <p class="text-white-50">Plataforma angolana de busca e entrega de medicamentos. Conectamos farmácias e clientes em Luanda e futuramente em todo o país.</p>
          <div class="social-links mt-3">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-whatsapp"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 offset-lg-1">
          <h4>Links</h4>
          <ul class="list-unstyled">
            <li><a href="#">Início</a></li>
            <li><a href="#">Sobre nós</a></li>
            <li><a href="">Farmácias</a></li>
            <li><a href="#">Medicamentos</a></li>
            <li><a href="#">Contacto</a></li>
          </ul>
        </div>

        <div class="col-lg-2">
          <h4>Para farmácias</h4>
          <ul class="list-unstyled">
            <li><a href="#">Cadastrar farmácia</a></li>
            <li><a href="#">Área do parceiro</a></li>
            <li><a href="#">Planos</a></li>
            <li><a href="#">Suporte</a></li>
          </ul>
        </div>

        <div class="col-lg-3">
          <h4>Contacto</h4>
          <ul class="list-unstyled contact-info">
            <li><i class="bi bi-telephone"></i> +244 923 456 789</li>
            <li><i class="bi bi-envelope"></i> geral@farmaconnect.ao</li>
            <li><i class="bi bi-geo-alt"></i> Luanda, Angola</li>
            <li><i class="bi bi-clock"></i> Seg-Sex: 08h-20h | Sáb: 09h-18h</li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <p>&copy; 2026 FarmaConnect. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Smooth scroll para links internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Scroll to top button
    const scrollTop = document.getElementById('scroll-top');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        scrollTop.style.display = 'flex';
      } else {
        scrollTop.style.display = 'none';
      }
    });

    scrollTop.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Header scroll effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 2px 20px rgba(9, 154, 167, 0.15)';
      } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = '0 2px 20px rgba(9, 154, 167, 0.08)';
      }
    });

    // Simulação de busca (apenas para demonstração)
    document.querySelector('.search-submit').addEventListener('click', (e) => {
      e.preventDefault();
      const medicamento = document.getElementById('medicamento').value;
      const bairro = document.getElementById('bairro').value;
      
      if (medicamento) {
        alert(`🔍 Buscando por "${medicamento}" ${bairro ? 'em ' + bairro : 'em toda Luanda'}...\n(Simulação - funcionalidade em desenvolvimento)`);
      } else {
        alert('Por favor, digite o nome do medicamento');
      }
    });

    // Animação simples ao scroll
    const animateElements = document.querySelectorAll('[data-aos]');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fade-up');
        }
      });
    });

    animateElements.forEach(el => observer.observe(el));
  </script>

  <style>
    /* Scroll to top button */
    #scroll-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: var(--accent-color);
      color: white;
      border-radius: 50%;
      text-decoration: none;
      display: none;
      z-index: 99;
      transition: all 0.3s;
    }

    #scroll-top:hover {
      background: #067e8a;
      transform: translateY(-5px);
    }

    /* Background elements */
    .bg-light {
      background-color: var(--light-mint) !important;
    }

    /* Images */
    .main-image {
      border-radius: 40px;
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .pharmacy-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
    }

    .app-image {
      max-width: 300px;
      border-radius: 40px;
    }

    /* Responsividade */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .hero-description {
        max-width: 100%;
      }
      
      .floating-card {
        display: none;
      }
      
      .app-image {
        margin-top: 2rem;
        max-width: 250px;
      }
    }
  </style>
</body>
</html>