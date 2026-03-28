<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>FarmaConnect - Medicamentos em Angola</title>
  <meta name="description" content="Encontre medicamentos nas farmácias de Luanda e receba em casa.">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com">
  <style>
    /* ===================== VARIÁVEIS ===================== */
    :root {
      --bg:           #ffffff;
      --text:         #363f40;
      --heading:      #1f2f31;
      --accent:       #099aa7;
      --accent-dark:  #067e8a;
      --soft:         #dff3f0;
      --mint:         #eaf6f5;
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow-x: hidden;
    }

    /* ===================== HEADER ===================== */
    .header {
      background: rgba(255,255,255,0.97);
      backdrop-filter: blur(16px);
      box-shadow: 0 1px 0 rgba(9,154,167,0.08), 0 4px 24px rgba(9,154,167,0.06);
      padding: 0.75rem 0;
      transition: box-shadow .3s;
      z-index: 1000;
    }
    .header.scrolled {
      box-shadow: 0 2px 28px rgba(9,154,167,0.14);
    }

    /* Logo */
    .sitename {
      font-size: 1.75rem;
      font-weight: 800;
      letter-spacing: -0.03em;
      line-height: 1;
      margin: 0;
      white-space: nowrap;
    }
    .sitename .s1 { color: var(--accent); }
    .sitename .s2 { color: var(--heading); }

    /* Barra de pesquisa central */
    .header-search {
      flex: 1;
      max-width: 560px;
    }
    .header-search .input-group {
      border: 1.5px solid #e4f2f2;
      border-radius: 50px;
      background: #f6fbfb;
      overflow: hidden;
      transition: border-color .2s, box-shadow .2s;
    }
    .header-search .input-group:focus-within {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(9,154,167,0.1);
    }
    .header-search .input-group-text {
      background: transparent;
      border: none;
      color: #a0b9bc;
      padding-left: 1.1rem;
      font-size: 1rem;
    }
    .header-search .form-control {
      background: transparent;
      border: none;
      font-size: 0.9rem;
      color: var(--heading);
      padding: 0.6rem 0.5rem;
    }
    .header-search .form-control::placeholder { color: #b0c4c6; }
    .header-search .form-control:focus { box-shadow: none; }
    .header-search .btn-search-go {
      background: transparent;
      border: none;
      color: var(--accent);
      padding-right: 1rem;
      font-size: 1.25rem;
      line-height: 1;
      transition: color .2s;
    }
    .header-search .btn-search-go:hover { color: var(--accent-dark); }

    /* Nav */
    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu li { margin: 0 .15rem; }
    .navmenu a {
      color: var(--heading); font-weight:600; font-size:.88rem;
      padding:.42rem .85rem; border-radius:50px;
      text-decoration:none; transition:.2s; white-space:nowrap;
    }
    .navmenu a:hover, .navmenu a.active {
      background: var(--soft); color: var(--accent);
    }

    /* Header actions */
    .header-cart {
      position: relative;
      color: var(--heading);
      font-size: 1.3rem;
      text-decoration: none;
      transition: color .2s;
    }
    .header-cart:hover { color: var(--accent); }
    .cart-badge {
      position: absolute;
      top: -6px; right: -8px;
      background: var(--accent); color: #fff;
      font-size: .6rem; font-weight:700;
      width:17px; height:17px;
      border-radius:50%;
      display: flex; align-items:center; justify-content:center;
      border: 2px solid #fff;
    }

    /* Profile dropdown */
    .profile-toggle {
      display:flex; align-items:center; gap:.5rem;
      text-decoration:none; color: var(--heading);
    }
    .profile-toggle img { border: 2px solid var(--soft); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .profile-toggle::after { font-size:.7rem; color:#a0b9bc; }

    .dropdown-menu {
      border: none;
      box-shadow: 0 12px 40px rgba(9,154,167,.12);
      border-radius: 18px;
      padding: .5rem;
      min-width: 180px;
    }
    .dropdown-item {
      border-radius: 10px;
      font-size: .9rem;
      font-weight:500;
      padding: .55rem .9rem;
      transition: background .15s;
    }
    .dropdown-item:hover { background: var(--soft); color: var(--accent); }
    .dropdown-item.text-danger:hover { background: #fdecea; color: #c0392b; }

    /* Btn principal */
    .btn-primary-fc {
      background: var(--accent); color:#fff;
      font-weight:700; font-size:.88rem;
      padding: .55rem 1.3rem; border-radius:50px;
      border: 2px solid var(--accent);
      text-decoration:none; transition: all .25s; white-space:nowrap;
    }
    .btn-primary-fc:hover { background: transparent; color: var(--accent); }

    .btn-outline-fc {
      background: transparent; color: var(--accent);
      font-weight:700; font-size:.95rem;
      padding:.65rem 1.5rem; border-radius:50px;
      border: 2px solid var(--accent);
      text-decoration:none; transition: all .25s;
      display:inline-flex; align-items:center; gap:.4rem;
    }
    .btn-outline-fc:hover { background: var(--accent); color:#fff; }

    /* ===================== HERO ===================== */
    .hero {
      background: linear-gradient(138deg, #046a76 0%, #099aa7 52%, #0ec4d4 100%);
      min-height: calc(100vh - 64px);
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
    }

    /* Blobs */
    .blob {
      position:absolute; border-radius:50%;
      filter:blur(90px); pointer-events:none;
    }
    .blob-1 { width:580px;height:580px; background:#fff;    opacity:.11; top:-200px; right:-80px; }
    .blob-2 { width:420px;height:420px; background:#b8f4f8; opacity:.12; bottom:-60px; left:-140px; }
    .blob-3 { width:200px;height:200px; background:#a8ffd4; opacity:.07; top:42%; left:38%; }

    /* Inner */
    .hero-inner {
      display:flex; align-items:center;
      width:100%; max-width:1340px;
      margin:0 auto; padding:4.5rem 5vw 3.5rem;
      gap:4rem; flex:1; position:relative; z-index:2;
    }

    /* Esquerda */
    .hero-left { flex:1; min-width:0; }

    .hero-eyebrow {
      display:inline-flex; align-items:center; gap:.5rem;
      background:rgba(255,255,255,.13);
      backdrop-filter:blur(8px);
      color:#fff; font-size:.83rem; font-weight:600;
      padding:.4rem 1rem; border-radius:50px;
      border:1px solid rgba(255,255,255,.24);
      margin-bottom:1.5rem;
    }
    .eyebrow-dot {
      width:7px; height:7px;
      background:#a8ffd4; border-radius:50%;
      box-shadow:0 0 0 3px rgba(168,255,212,.28);
      animation: pdot 2.2s infinite;
    }
    @keyframes pdot {
      0%,100%{ box-shadow:0 0 0 3px rgba(168,255,212,.28); }
      50%    { box-shadow:0 0 0 7px rgba(168,255,212,.06); }
    }

    .hero-title-new {
      font-size: clamp(2.2rem, 3.8vw, 3.5rem);
      font-weight: 800;
      color: #fff;
      line-height: 1.15;
      letter-spacing: -0.03em;
      margin-bottom: 1.2rem;
    }
    .hero-title-new .highlight {
      color: #a8ffd4;
      position: relative;
    }

    .hero-sub {
      font-size:1rem; color:rgba(255,255,255,.74);
      line-height:1.72; margin-bottom:2rem; max-width:490px;
    }

    /* Stats */
    .hero-stats {
      display:flex; gap:2.2rem; margin-bottom:2.2rem; flex-wrap:wrap;
    }
    .hstat .num {
      font-size:1.55rem; font-weight:800; color:#fff; line-height:1;
    }
    .hstat .lbl {
      font-size:.72rem; color:rgba(255,255,255,.6);
      text-transform:uppercase; letter-spacing:.055em; margin-top:.15rem;
    }

    /* CTAs */
    .hero-cta { display:flex; gap:.9rem; flex-wrap:wrap; }

    .btn-hero-white {
      background:#fff; color:var(--accent);
      font-weight:700; font-size:.92rem;
      padding:.82rem 1.7rem; border-radius:50px;
      text-decoration:none; transition:all .25s;
      display:inline-flex; align-items:center; gap:.45rem;
      box-shadow:0 10px 28px rgba(0,0,0,.14);
    }
    .btn-hero-white:hover { transform:translateY(-3px); box-shadow:0 16px 36px rgba(0,0,0,.2); color:var(--accent); }

    .btn-hero-ghost {
      background:rgba(255,255,255,.12); color:#fff;
      font-weight:600; font-size:.92rem;
      padding:.82rem 1.7rem; border-radius:50px;
      text-decoration:none; transition:all .25s;
      border:1.5px solid rgba(255,255,255,.3);
      display:inline-flex; align-items:center; gap:.45rem;
    }
    .btn-hero-ghost:hover { background:rgba(255,255,255,.22); color:#fff; }

    /* Direita — imagem editorial */
    .hero-right {
      flex-shrink:0;
      position:relative;
      width:440px;
    }

    .hero-img {
      width:100%; height:520px;
      object-fit:cover; object-position:center top;
      border-radius:48px 48px 110px 48px;
      display:block;
      box-shadow:0 50px 90px rgba(0,0,0,.26), 0 0 0 1px rgba(255,255,255,.08);
      animation:floatImg 5s ease-in-out infinite;
    }
    @keyframes floatImg {
      0%,100%{ transform:translateY(0); }
      50%    { transform:translateY(-14px); }
    }

    /* Cards flutuantes */
    .fcard {
      position:absolute;
      background:rgba(255,255,255,.93);
      backdrop-filter:blur(14px);
      border-radius:60px;
      padding:.62rem 1.1rem;
      display:flex; align-items:center; gap:.65rem;
      box-shadow:0 14px 38px rgba(0,0,0,.13);
      white-space:nowrap;
      border:1px solid rgba(255,255,255,.75);
    }
    .fcard-icon { font-size:1.3rem; color:var(--accent); }
    .fcard-val  { font-size:.86rem; font-weight:700; color:var(--heading); line-height:1.15; }
    .fcard-sub  { font-size:.68rem; color:#7a9699; }

    .fc-a { bottom:44px; left:-42px; animation:fca 3.8s ease-in-out infinite; }
    .fc-b { top:32px;   left:-50px; animation:fcb 4.5s ease-in-out infinite; }
    .fc-c { top:47%;    right:-32px; transform:translateY(-50%); animation:fca 5s ease-in-out infinite; }

    @keyframes fca { 0%,100%{transform:translateY(0)}   50%{transform:translateY(-9px)} }
    @keyframes fcb { 0%,100%{transform:translateY(0)}   50%{transform:translateY(9px)}  }
    .fc-c { animation-name:fcb; top:47%; transform:translateY(-50%); }

    /* Barra de stats */
    .hero-statsbar {
      background:rgba(0,0,0,.13);
      backdrop-filter:blur(14px);
      border-top:1px solid rgba(255,255,255,.1);
      display:flex; align-items:center; justify-content:center;
      padding:1.25rem 2rem; flex-wrap:wrap;
      position:relative; z-index:2;
    }
    .sbar-item {
      display:flex; flex-direction:column; align-items:center;
      padding:0 3rem;
    }
    .sbar-num { font-size:1.5rem; font-weight:800; color:#fff; line-height:1; }
    .sbar-lbl {
      font-size:.71rem; color:rgba(255,255,255,.6);
      text-transform:uppercase; letter-spacing:.06em; margin-top:.2rem;
    }
    .sbar-sep { width:1px; height:30px; background:rgba(255,255,255,.16); }

    /* ===================== SECTIONS ===================== */
    .section-title { text-align:center; margin-bottom:3rem; }
    .section-title h2 {
      font-size:2.1rem; font-weight:800;
      color:var(--heading); margin-bottom:.6rem;
    }
    .section-title p { color:#6c8285; font-size:.97rem; }

    /* Pharmacy cards */
    .pharmacy-card {
      background:#fff; border-radius:28px; padding:1.5rem;
      box-shadow:0 8px 28px rgba(9,154,167,.07);
      transition:all .3s; height:100%; border:2px solid transparent;
    }
    .pharmacy-card:hover {
      transform:translateY(-8px); border-color:var(--accent);
      box-shadow:0 20px 42px rgba(9,154,167,.14);
    }
    .pharmacy-img-wrap {
      width:100%; height:160px;
      border-radius:18px; overflow:hidden; margin-bottom:1rem;
    }
    .pharmacy-img-wrap img {
      width:100%; height:100%; object-fit:cover;
      transition:transform .4s;
    }
    .pharmacy-card:hover .pharmacy-img-wrap img { transform:scale(1.05); }
    .pharmacy-name { font-size:1.15rem; font-weight:700; color:var(--heading); margin-bottom:.35rem; }
    .pharmacy-location { color:#6c8285; font-size:.88rem; margin-bottom:.9rem; display:flex; align-items:center; gap:.4rem; }
    .pharmacy-status { display:inline-block; padding:.25rem .75rem; border-radius:50px; font-size:.8rem; font-weight:600; margin-bottom:.9rem; }
    .status-open   { background:#d4edda; color:#155724; }
    .status-closed { background:#f8d7da; color:#721c24; }
    .pharmacy-actions { display:flex; gap:.5rem; }
    .pharmacy-actions a {
      flex:1; padding:.5rem; text-align:center;
      border-radius:50px; text-decoration:none;
      font-weight:600; font-size:.85rem; transition:all .25s;
    }
    .btn-view  { background:var(--soft);   color:var(--accent); }
    .btn-order { background:var(--accent); color:#fff; }
    .btn-view:hover  { background:var(--accent); color:#fff; }
    .btn-order:hover { background:var(--accent-dark); }

    /* Service cards */
    .service-card {
      background:#fff; border-radius:28px; padding:2rem; text-align:center;
      box-shadow:0 8px 28px rgba(9,154,167,.07); transition:all .3s; height:100%;
      border:2px solid transparent;
    }
    .service-card:hover {
      transform:translateY(-8px); border-color:var(--soft);
      box-shadow:0 20px 42px rgba(9,154,167,.13);
    }
    .service-icon {
      width:72px; height:72px; background:var(--soft);
      border-radius:24px; display:flex; align-items:center;
      justify-content:center; margin:0 auto 1.3rem;
      transition:background .3s;
    }
    .service-card:hover .service-icon { background:var(--accent); }
    .service-icon i { font-size:2rem; color:var(--accent); transition:color .3s; }
    .service-card:hover .service-icon i { color:#fff; }
    .service-card h4 { font-size:1.1rem; font-weight:700; color:var(--heading); margin-bottom:.7rem; }
    .service-card p  { color:#6c8285; line-height:1.65; font-size:.92rem; }

    /* How it works */
    .how-section { padding:5rem 0; background:var(--mint); }
    .step-item { text-align:center; padding:1.5rem; }
    .step-num {
      width:56px; height:56px; background:var(--accent); color:#fff;
      border-radius:17px; display:flex; align-items:center; justify-content:center;
      font-size:1.6rem; font-weight:800; margin:0 auto 1.3rem;
      transform:rotate(8deg); transition:all .3s;
    }
    .step-item:hover .step-num { transform:rotate(0deg) scale(1.1); }
    .step-item h4 { font-size:1.1rem; font-weight:700; color:var(--heading); margin-bottom:.6rem; }
    .step-item p  { color:#6c8285; font-size:.92rem; }

    /* App section */
    .app-section { padding:5rem 0; }
    .app-card {
      background:linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
      border-radius:48px; padding:3.5rem;
      overflow:hidden; position:relative;
    }
    .app-card::before {
      content:'';
      position:absolute; top:-80px; right:-80px;
      width:300px; height:300px;
      background:rgba(255,255,255,.06);
      border-radius:50%;
    }
    .app-card::after {
      content:'';
      position:absolute; bottom:-100px; left:30%;
      width:250px; height:250px;
      background:rgba(255,255,255,.05);
      border-radius:50%;
    }
    .app-btn {
      background:#fff; color:var(--accent);
      font-weight:700; font-size:.9rem;
      padding:.78rem 1.5rem; border-radius:50px;
      text-decoration:none; display:inline-flex; align-items:center; gap:.5rem;
      transition:all .25s; position:relative; z-index:1;
    }
    .app-btn:hover { transform:translateY(-4px); box-shadow:0 12px 30px rgba(0,0,0,.18); color:var(--accent); }
    .app-img { max-width:100%; border-radius:32px; transform:translateY(-28px); position:relative; z-index:1; }

    /* Testimonials */
    .tcard {
      background:#fff; border-radius:24px; padding:1.8rem;
      box-shadow:0 8px 28px rgba(9,154,167,.07);
      transition:all .3s; height:100%; border:2px solid transparent;
    }
    .tcard:hover { border-color:var(--soft); box-shadow:0 18px 38px rgba(9,154,167,.12); }
    .tcard .stars i { color:#f59e0b; font-size:.9rem; }

    /* Footer */
    .footer { background:var(--heading); color:#fff; padding:4rem 0 2rem; }
    .footer h3 { font-size:1.75rem; font-weight:800; margin-bottom:1rem; }
    .footer h4 { font-weight:700; margin-bottom:1.3rem; color:#fff; }
    .footer a { color:#a0b9bc; text-decoration:none; transition:color .25s; }
    .footer a:hover { color:var(--accent); }
    .footer ul li { margin-bottom:.5rem; }
    .social-link {
      width:38px; height:38px;
      background:rgba(255,255,255,.08);
      display:inline-flex; align-items:center; justify-content:center;
      border-radius:50%; margin-right:.4rem; transition:all .25s;
      color:#a0b9bc; text-decoration:none; font-size:1rem;
    }
    .social-link:hover { background:var(--accent); color:#fff; }
    .contact-item { display:flex; align-items:flex-start; gap:.6rem; margin-bottom:.6rem; color:#a0b9bc; }
    .contact-item i { color:var(--accent); margin-top:.1rem; flex-shrink:0; }
    .footer-bottom {
      text-align:center; margin-top:3rem; padding-top:2rem;
      border-top:1px solid rgba(255,255,255,.07);
      color:#6a8a8d; font-size:.88rem;
    }

    

    /* Scroll top */
    #scroll-top {
      position:fixed; bottom:28px; right:28px;
      width:48px; height:48px; background:var(--accent); color:#fff;
      border-radius:50%; text-decoration:none; font-size:1.4rem;
      display:none; align-items:center; justify-content:center;
      z-index:999; transition:all .3s; box-shadow:0 6px 20px rgba(9,154,167,.35);
    }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    /* Misc */
    .bg-light { background-color:var(--mint) !important; }
    .animate-fade-up { animation:fadeUp .6s ease both; }
    @keyframes fadeUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width:1100px) {
      .hero-right { width:380px; }
      .hero-img   { height:460px; }
      .fc-b { left:-20px; }
      .fc-c { right:-10px; }
    }

    @media (max-width:992px) {
      .hero-inner {
        flex-direction:column; padding:3rem 5vw 2rem; text-align:center;
      }
      .hero-left { max-width:100%; }
      .hero-sub, .hero-cta { justify-content:center; }
      .hero-stats { justify-content:center; }
      .hero-right { width:100%; max-width:440px; }
      .hero-img { height:360px; border-radius:32px; }
      .fc-a, .fc-b, .fc-c { display:none; }
      .sbar-item { padding:.5rem 1.8rem; }
      .sbar-sep  { display:none; }
    }

    @media (max-width:768px) {
      .hero-title { font-size:1.9rem; }
      .app-card   { border-radius:30px; padding:2rem; }
      .app-img    { transform:translateY(0); margin-top:1.5rem; max-width:220px; }
      .header-search { display:none; }
    }

    @media (max-width:576px) {
      .sbar-item { padding:.5rem 1rem; }
      .btn-hero-ghost { display:none; }
    }
  </style>
</head>

<body>

  <!-- ===================== HEADER ===================== -->
@include('clientes.dashboard.header')


  <main >

    <!-- ===================== HERO ===================== -->
    <section id="hero" class="hero">
      <!-- Blobs -->
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div>

      <!-- Main content -->
      <div class="hero-inner">

        <!-- Esquerda -->
        <div class="hero-left">
          <div class="hero-eyebrow">
            <span class="eyebrow-dot"></span>
            Entrega segura em Luanda
          </div>

            <h1 class="hero-title-new">
              A saúde da sua família<br>
              em <span class="highlight">um só lugar</span>
            </h1>

          <p class="hero-sub">
            Encontre farmácias próximas, compare preços e receba
            seus medicamentos em casa. Rápido, seguro e confiável.
          </p>

          <div class="hero-stats">
            <div class="hstat">
              <span class="num">50+</span>
              <span class="lbl">Farmácias</span>
            </div>
            <div class="hstat">
              <span class="num">30min</span>
              <span class="lbl">Entrega média</span>
            </div>
            <div class="hstat">
              <span class="num">5 000+</span>
              <span class="lbl">Medicamentos</span>
            </div>
          </div>

          <div class="hero-cta">
            <a href="#pharmacies" class="btn-hero-white">
              <i class="bi bi-search"></i> Explorar farmácias
            </a>
            <a href="#how" class="btn-hero-ghost">
              <i class="bi bi-play-circle"></i> Como funciona
            </a>
          </div>
        </div>

        <!-- Direita: imagem editorial -->
        <div class="hero-right">
          <img
            src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=700&auto=format&fit=crop&q=80"
            class="hero-img"
            alt="Farmácia FarmaConnect"
          >

          <!-- Card A — pedido confirmado -->
          <div class="fcard fc-a">
            <div class="fcard-icon"><i class="bi bi-check-circle-fill" ></i></div>
            <div>
              <div class="fcard-val">Pedido confirmado</div>
              <div class="fcard-sub">Entrega em ~28 min</div>
            </div>
          </div>

          <!-- Card B — avaliação -->
          <div class="fcard fc-b">
            <div class="fcard-icon"><i class="bi bi-star-fill" style="color:#f59e0b;"></i></div>
            <div>
              <div class="fcard-val">4.9 ★ Avaliação</div>
              <div class="fcard-sub">+10 000 clientes</div>
            </div>
          </div>

          <!-- Card C — entrega -->
          <div class="fcard fc-c">
            <div class="fcard-icon"><i class="bi bi-truck"></i></div>
            <div>
              <div class="fcard-val">30 minutos</div>
              <div class="fcard-sub">Entrega média</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Barra de stats -->
      <div class="hero-statsbar">
        <div class="sbar-item">
          <span class="sbar-num">24h</span>
          <span class="sbar-lbl">Suporte Técnico</span>
        </div>
        <div class="sbar-sep"></div>
        <div class="sbar-item">
          <span class="sbar-num">100%</span>
          <span class="sbar-lbl">Entrega Rastreada</span>
        </div>
        <div class="sbar-sep"></div>
        <div class="sbar-item">
          <span class="sbar-num">+300%</span>
          <span class="sbar-lbl">Crescimento Anual</span>
        </div>
        <div class="sbar-sep"></div>
        <div class="sbar-item">
          <span class="sbar-num">100%</span>
          <span class="sbar-lbl">Transações Seguras ( Criptografia )</span>
        </div>
      </div>
    </section>

    <!-- ===================== PHARMACIES ===================== -->
    <section id="pharmacies" class="py-5">
      <div class="container">
        <div class="section-title">
          <h2>Farmácias Parceiras em Luanda</h2>
          <p>As melhores farmácias da cidade já estão na FarmaConnect</p>
        </div>
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="pharmacy-card">
              <div class="pharmacy-img-wrap">
                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600&auto=format&fit=crop" alt="Farmácia Central">
              </div>
              <h3 class="pharmacy-name">Farmácia Central</h3>
              <div class="pharmacy-location"><i class="bi bi-geo-alt-fill"></i> Ingombotas, Rua Ho Chi Min</div>
              <span class="pharmacy-status status-open"><i class="bi bi-circle-fill" style="font-size:.5rem;"></i> Aberta agora</span>
              <div class="pharmacy-actions">
                <a href="#" class="btn-view">Ver medicamentos</a>
                <a href="#" class="btn-order">Pedir entrega</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="pharmacy-card">
              <div class="pharmacy-img-wrap">
                <img src="https://images.unsplash.com/photo-1576671081837-49000212a370?w=600&auto=format&fit=crop" alt="Farmácia Kilamba">
              </div>
              <h3 class="pharmacy-name">Farmácia Kilamba</h3>
              <div class="pharmacy-location"><i class="bi bi-geo-alt-fill"></i> Kilamba, Rua dos Combates</div>
              <span class="pharmacy-status status-open"><i class="bi bi-circle-fill" style="font-size:.5rem;"></i> Aberta agora</span>
              <div class="pharmacy-actions">
                <a href="#" class="btn-view">Ver medicamentos</a>
                <a href="#" class="btn-order">Pedir entrega</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="pharmacy-card">
              <div class="pharmacy-img-wrap">
                <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=600&auto=format&fit=crop" alt="Farmácia Talatona">
              </div>
              <h3 class="pharmacy-name">Farmácia Talatona</h3>
              <div class="pharmacy-location"><i class="bi bi-geo-alt-fill"></i> Talatona, Belas Shopping</div>
              <span class="pharmacy-status status-open"><i class="bi bi-circle-fill" style="font-size:.5rem;"></i> Aberta agora</span>
              <div class="pharmacy-actions">
                <a href="#" class="btn-view">Ver medicamentos</a>
                <a href="#" class="btn-order">Pedir entrega</a>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center mt-5">
          <a href="{{ route('farmacias.list') }}" class="btn-outline-fc">Ver todas as farmácias <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </section>

    <!-- ===================== SERVICES ===================== -->
    <section class="py-5 bg-light">
      <div class="container">
        <div class="section-title">
          <h2>Nossos Serviços</h2>
          <p>Tudo o que precisa para cuidar da sua saúde</p>
        </div>
        <div class="row g-4">
          <div class="col-lg-3 col-md-6">
            <div class="service-card">
              <div class="service-icon"><i class="bi bi-search"></i></div>
              <h4>Busca Inteligente</h4>
              <p>Encontre medicamentos disponíveis nas farmácias mais próximas em tempo real.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="service-card">
              <div class="service-icon"><i class="bi bi-truck"></i></div>
              <h4>Entrega Rápida</h4>
              <p>Receba seus medicamentos em casa com entregadores treinados e seguros.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="service-card">
              <div class="service-icon"><i class="bi bi-credit-card"></i></div>
              <h4>Pagamento Digital</h4>
              <p>Pague com cartão, multicaixa ou dinheiro no ato da entrega.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="service-card">
              <div class="service-icon"><i class="bi bi-prescription2"></i></div>
              <h4>Receita Digital</h4>
              <p>Envie a receita do seu médico e nós preparamos com antecedência.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===================== HOW IT WORKS ===================== -->
    <section id="how" class="how-section">
      <div class="container">
        <div class="section-title">
          <h2>Como funciona?</h2>
          <p>4 passos simples para receber seus medicamentos em casa</p>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-num">1</div>
              <h4>Pesquise</h4>
              <p>Encontre o medicamento que precisa nas farmácias próximas</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-num">2</div>
              <h4>Compare</h4>
              <p>Veja os preços e escolha a melhor opção para o seu bolso</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-num">3</div>
              <h4>Peça</h4>
              <p>Faça o pedido e escolha a forma de pagamento preferida</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-num">4</div>
              <h4>Receba</h4>
              <p>Receba em casa ou retire na farmácia mais próxima</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===================== APP ===================== -->
    <section class="app-section">
      <div class="container">
        <div class="app-card">
          <div class="row align-items-center">
            <div class="col-lg-6" style="position:relative;z-index:1;">
              <h2 class="text-white mb-3" style="font-weight:800;font-size:2.1rem;">Baixe o nosso app</h2>
              <p style="color:rgba(255,255,255,.72);" class="mb-4">
                Tenha a FarmaConnect sempre à mão. Peça seus medicamentos de onde estiver, a qualquer hora.
              </p>
              <div class="d-flex gap-3 flex-wrap mb-4">
                <a href="#" class="app-btn"><i class="bi bi-google-play"></i> Google Play</a>
                <a href="#" class="app-btn"><i class="bi bi-apple"></i> App Store</a>
              </div>
              <div class="d-flex gap-4">
                <div>
                  <div style="font-size:1.5rem;font-weight:800;color:#fff;">5 000+</div>
                  <div style="font-size:.75rem;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.05em;">Downloads</div>
                </div>
                <div>
                  <div style="font-size:1.5rem;font-weight:800;color:#fff;">4.8 ★</div>
                  <div style="font-size:.75rem;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.05em;">Avaliação</div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
              <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&auto=format&fit=crop"
                   alt="App FarmaConnect" class="app-img img-fluid" style="max-width:280px;">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===================== TESTIMONIALS ===================== -->
    <section class="py-5">
      <div class="container">
        <div class="section-title">
          <h2>O que dizem os nossos clientes</h2>
          <p>Depoimentos de quem já usa a FarmaConnect</p>
        </div>
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="tcard">
              <div class="d-flex gap-3 mb-3 align-items-center">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle" width="46" height="46" alt="">
                <div>
                  <div style="font-weight:700;color:var(--heading);">Maria Santos</div>
                  <small class="text-muted">Ingombotas</small>
                </div>
              </div>
              <p class="mb-2" style="color:#4a5568;line-height:1.65;font-size:.93rem;">"Salvou minha mãe! Precisávamos de um medicamento urgente à noite e encontramos aberto."</p>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="tcard">
              <div class="d-flex gap-3 mb-3 align-items-center">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle" width="46" height="46" alt="">
                <div>
                  <div style="font-weight:700;color:var(--heading);">João Ferreira</div>
                  <small class="text-muted">Kilamba</small>
                </div>
              </div>
              <p class="mb-2" style="color:#4a5568;line-height:1.65;font-size:.93rem;">"Entrega super rápida! Pedi e em 25 minutos chegou. Muito confiável e fácil de usar."</p>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="tcard">
              <div class="d-flex gap-3 mb-3 align-items-center">
                <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle" width="46" height="46" alt="">
                <div>
                  <div style="font-weight:700;color:var(--heading);">Ana Costa</div>
                  <small class="text-muted">Talatona</small>
                </div>
              </div>
              <p class="mb-2" style="color:#4a5568;line-height:1.65;font-size:.93rem;">"Adoro poder comparar preços entre farmácias. Economizo sempre! Recomendo a toda gente."</p>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- ===================== FOOTER ===================== -->
  @include('clientes.dashboard.footer')
  
  <!-- Scroll top -->
  <a href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Scroll top
    const st = document.getElementById('scroll-top');
    window.addEventListener('scroll', () => {
      st.style.display = window.scrollY > 320 ? 'flex' : 'none';
    });

    // Header scroll
    const hdr = document.getElementById('mainHeader');
    window.addEventListener('scroll', () => {
      hdr.classList.toggle('scrolled', window.scrollY > 50);
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        const t = document.querySelector(a.getAttribute('href'));
        if (t) { e.preventDefault(); t.scrollIntoView({ behavior:'smooth', block:'start' }); }
      });
    });

    // Fade up on scroll
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('animate-fade-up'); });
    }, { threshold:.1 });
    document.querySelectorAll('.pharmacy-card,.service-card,.step-item,.tcard').forEach(el => io.observe(el));
  </script>

</body>
</html>