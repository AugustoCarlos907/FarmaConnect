<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>FarmaConnect - Plataforma de Busca e Entrega de Medicamentos em Angola</title>
  <meta name="description" content="Encontre medicamentos nas farmácias de Luanda e receba em casa. Comparação de preços, entregas rápidas e farmácias parceiras.">
  <meta name="keywords" content="farmácia angola, medicamentos luanda, entrega de medicamentos, farmácia online angola">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
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
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      background-color: var(--background-color);
      color: var(--default-color);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow-x: hidden;
    }

    /* ===========================
       HEADER
    =========================== */
    .header {
      background: rgba(255,255,255,0.96);
      backdrop-filter: blur(12px);
      box-shadow: 0 2px 20px rgba(9,154,167,0.08);
      padding: 1rem 0;
      transition: all 0.3s ease;
      z-index: 1000;
    }
    .header .sitename {
      font-size: 1.9rem;
      font-weight: 800;
      letter-spacing: -0.03em;
      margin: 0;
      text-decoration: none;
      display: block;
    }
    .header .sitename span:first-child { color: var(--accent-color); }
    .header .sitename span:last-child  { color: var(--heading-color); }

    .navmenu ul {
      margin: 0; padding: 0;
      display: flex; list-style: none; align-items: center;
    }
    .navmenu li { position: relative; margin: 0 0.3rem; }
    .navmenu a {
      color: var(--heading-color);
      font-weight: 600; font-size: 0.95rem;
      padding: 0.5rem 0.9rem;
      text-decoration: none;
      display: flex; align-items: center;
      transition: 0.3s; border-radius: 50px;
    }
    .navmenu a:hover, .navmenu .active {
      background-color: var(--soft-green);
      color: var(--accent-color);
    }

    .btn-getstarted {
      background-color: var(--accent-color);
      color: white; font-weight: 700;
      padding: 0.65rem 1.5rem; border-radius: 50px;
      text-decoration: none; transition: all 0.3s;
      border: 2px solid var(--accent-color);
      font-size: 0.95rem;
    }
    .btn-getstarted:hover {
      background-color: transparent; color: var(--accent-color);
    }
    .btn-outline {
      background-color: transparent; color: var(--accent-color);
      font-weight: 700; padding: 0.65rem 1.5rem; border-radius: 50px;
      text-decoration: none; transition: all 0.3s;
      border: 2px solid var(--accent-color); font-size: 0.95rem;
      display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .btn-outline:hover { background-color: var(--accent-color); color: white; }

    /* ===========================
       HERO NEW — Appy Saúde Style
    =========================== */
    .hero-new {
      background: linear-gradient(135deg, #04717c 0%, #099aa7 50%, #0cbdcc 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      padding-top: 80px;
    }

    /* Decorative blobs */
    .hero-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.15;
      pointer-events: none;
    }
    .hero-blob-1 {
      width: 550px; height: 550px;
      background: #ffffff;
      top: -180px; right: -80px;
    }
    .hero-blob-2 {
      width: 380px; height: 380px;
      background: #c8f5f8;
      bottom: 60px; left: -120px;
    }
    .hero-blob-3 {
      width: 200px; height: 200px;
      background: #a8ffd4;
      top: 40%; left: 40%;
      opacity: 0.08;
    }

    /* Inner layout */
    .hero-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex: 1;
      padding: 4rem 7vw 3rem;
      gap: 3rem;
      max-width: 1400px;
      margin: 0 auto;
      width: 100%;
    }

    /* Left content */
    .hero-content { flex: 1; max-width: 580px; }

    .hero-badge-new {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(8px);
      color: #fff;
      font-size: 0.88rem; font-weight: 600;
      padding: 0.45rem 1.1rem;
      border-radius: 50px;
      border: 1px solid rgba(255,255,255,0.28);
      margin-bottom: 1.6rem;
      letter-spacing: 0.02em;
    }
    .badge-dot {
      width: 8px; height: 8px;
      background: #a8ffd4; border-radius: 50%;
      box-shadow: 0 0 0 3px rgba(168,255,212,0.3);
      display: inline-block;
      animation: pulse-dot 2s infinite;
    }
    @keyframes pulse-dot {
      0%, 100% { box-shadow: 0 0 0 3px rgba(168,255,212,0.3); }
      50%       { box-shadow: 0 0 0 7px rgba(168,255,212,0.08); }
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

    .hero-desc-new {
      font-size: 1.05rem;
      color: rgba(255,255,255,0.78);
      line-height: 1.7;
      margin-bottom: 2.2rem;
    }

    /* Search bar inside hero */
    .hero-search-bar {
      display: flex;
      align-items: center;
      background: #fff;
      border-radius: 70px;
      padding: 0.45rem 0.45rem 0.45rem 1.5rem;
      box-shadow: 0 20px 50px rgba(0,0,0,0.18);
      margin-bottom: 1.4rem;
    }
    .h-search-wrap {
      display: flex; align-items: center; gap: 0.6rem; flex: 1;
    }
    .h-search-wrap i { color: var(--accent-color); font-size: 1rem; flex-shrink: 0; }
    .h-search-wrap input,
    .h-search-wrap select {
      border: none; outline: none;
      font-size: 0.92rem; color: var(--heading-color);
      background: transparent; width: 100%; font-family: inherit;
    }
    .h-search-divider {
      width: 1px; height: 28px;
      background: #e5e5e5; margin: 0 0.8rem; flex-shrink: 0;
    }
    .hero-search-btn {
      background: var(--accent-color); color: white;
      border: none; padding: 0.8rem 1.7rem; border-radius: 50px;
      font-size: 0.92rem; font-weight: 700;
      cursor: pointer; display: flex; align-items: center; gap: 0.5rem;
      transition: background 0.2s, transform 0.2s; flex-shrink: 0;
      font-family: inherit;
    }
    .hero-search-btn:hover { background: #067e8a; transform: scale(1.03); }

    /* Popular pills */
    .hero-popular {
      display: flex; align-items: center; flex-wrap: wrap; gap: 0.5rem;
    }
    .popular-label {
      color: rgba(255,255,255,0.65); font-size: 0.83rem;
    }
    .pill-tag {
      background: rgba(255,255,255,0.15); color: #fff;
      border: 1px solid rgba(255,255,255,0.28);
      padding: 0.3rem 0.85rem; border-radius: 50px;
      font-size: 0.82rem; font-weight: 500;
      cursor: pointer; transition: background 0.2s;
    }
    .pill-tag:hover { background: rgba(255,255,255,0.28); }

    /* Right Visual */
/* Hero image — margem direita, sem frame de phone */
.hero-img-wrap {
  position: relative;
  width: 480px;
  flex-shrink: 0;
}

.hero-side-img {
  width: 100%;
  height: 520px;
  object-fit: cover;
  border-radius: 40px 40px 120px 40px; /* canto inferior direito arredondado assimétrico */
  display: block;
  box-shadow: 0 40px 80px rgba(0,0,0,0.22);
  animation: float-phone 4s ease-in-out infinite;
}

/* Cards flutuantes sobre a imagem */
.hero-img-card {
  position: absolute;
  background: rgba(255,255,255,0.92);
  backdrop-filter: blur(12px);
  border-radius: 60px;
  padding: 0.65rem 1.1rem;
  display: flex;
  align-items: center;
  gap: 0.7rem;
  box-shadow: 0 12px 32px rgba(0,0,0,0.12);
  white-space: nowrap;
}
.hic-icon { font-size: 1.4rem; color: var(--accent-color); }
.hic-label { font-size: 0.88rem; font-weight: 700; color: var(--heading-color); line-height: 1.1; }
.hic-sub   { font-size: 0.72rem; color: #6c8285; }

.card-a {
  bottom: 40px; left: -30px;
  animation: float-a 3.5s ease-in-out infinite;
}
.card-b {
  top: 30px; left: -40px;
  animation: float-b 4s ease-in-out infinite;
}
.card-c {
  top: 50%; right: -20px;
  transform: translateY(-50%);
  animation: float-a 4.5s ease-in-out infinite;
}

/* Responsive */
@media (max-width: 992px) {
  .hero-img-wrap { width: 100%; }
  .hero-side-img { height: 320px; border-radius: 28px; }
  .card-a, .card-b, .card-c { display: none; }
}

    /* Phone frame */
    .phone-frame {
      background: #fff; border-radius: 44px;
      padding: 12px;
      box-shadow: 0 50px 100px rgba(0,0,0,0.28), 0 0 0 1px rgba(255,255,255,0.12);
      position: relative; z-index: 2;
      animation: float-phone 4s ease-in-out infinite;
    }
    @keyframes float-phone {
      0%, 100% { transform: translateY(0); }
      50%       { transform: translateY(-16px); }
    }
    .phone-notch {
      width: 90px; height: 24px;
      background: #1c1c1e;
      border-radius: 0 0 20px 20px;
      margin: 0 auto 0;
      position: relative; z-index: 5;
    }
    .phone-screen {
      border-radius: 34px; overflow: hidden;
      position: relative; height: 430px;
    }
    .phone-img {
      width: 100%; height: 100%;
      object-fit: cover; display: block;
    }
    .phone-overlay-card {
      position: absolute; bottom: 16px; left: 16px; right: 16px;
      background: rgba(255,255,255,0.93);
      backdrop-filter: blur(10px); border-radius: 18px;
      padding: 0.75rem 1rem;
      display: flex; align-items: center; gap: 0.8rem;
    }
    .oc-icon { font-size: 1.5rem; color: #22c55e; }
    .oc-label { font-size: 0.88rem; font-weight: 700; color: var(--heading-color); }
    .oc-sub   { font-size: 0.76rem; color: #6c8285; }

    /* Floating pills */
    .float-pill {
      position: absolute;
      background: white; border-radius: 60px;
      padding: 0.65rem 1rem;
      display: flex; align-items: center; gap: 0.6rem;
      box-shadow: 0 12px 32px rgba(0,0,0,0.13); z-index: 3;
      white-space: nowrap;
    }
    .float-pill i { font-size: 1.3rem; color: var(--accent-color); }
    .fp-val { font-size: 0.9rem; font-weight: 700; color: var(--heading-color); line-height: 1.1; }
    .fp-lbl { font-size: 0.7rem; color: #6c8285; }
    .pill-a { bottom: 30px; left: -75px; animation: float-a 3.5s ease-in-out infinite; }
    .pill-b { top: 50px;   right: -70px; animation: float-b 4.2s ease-in-out infinite; }
    @keyframes float-a { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-9px)} }
    @keyframes float-b { 0%,100%{transform:translateY(0)} 50%{transform:translateY(9px)} }

    /* Stats bar */
    .stats-bar {
      background: rgba(0,0,0,0.12);
      backdrop-filter: blur(12px);
      border-top: 1px solid rgba(255,255,255,0.12);
      display: flex; align-items: center; justify-content: center;
      padding: 1.4rem 6vw; flex-wrap: wrap; gap: 0;
    }
    .stat-item {
      display: flex; flex-direction: column; align-items: center;
      padding: 0 3.5rem;
    }
    .stat-num {
      font-size: 1.7rem; font-weight: 800; color: #fff; line-height: 1;
    }
    .stat-lbl {
      font-size: 0.78rem; color: rgba(255,255,255,0.65);
      margin-top: 0.25rem; text-transform: uppercase; letter-spacing: 0.06em;
    }
    .stat-sep { width: 1px; height: 36px; background: rgba(255,255,255,0.18); }

    /* ===========================
       SECTION TITLES
    =========================== */
    .section-title { text-align: center; margin-bottom: 3rem; }
    .section-title h2 {
      font-size: 2.3rem; font-weight: 800;
      color: var(--heading-color); margin-bottom: 0.8rem;
    }
    .section-title p { color: #6c8285; font-size: 1rem; }

    /* ===========================
       PHARMACY CARDS
    =========================== */
    .pharmacy-card {
      background: white; border-radius: 28px;
      padding: 1.5rem;
      box-shadow: 0 8px 28px rgba(9,154,167,0.07);
      transition: all 0.3s; height: 100%;
      border: 2px solid transparent;
    }
    .pharmacy-card:hover {
      transform: translateY(-8px);
      border-color: var(--accent-color);
      box-shadow: 0 20px 40px rgba(9,154,167,0.14);
    }
    .pharmacy-image {
      width: 72px; height: 72px;
      border-radius: 18px; object-fit: cover; margin-bottom: 1rem;
    }
    .pharmacy-name {
      font-size: 1.2rem; font-weight: 700;
      color: var(--heading-color); margin-bottom: 0.4rem;
    }
    .pharmacy-location {
      color: #6c8285; font-size: 0.9rem; margin-bottom: 1rem;
      display: flex; align-items: center; gap: 0.4rem;
    }
    .pharmacy-status {
      display: inline-block; padding: 0.28rem 0.8rem;
      border-radius: 50px; font-size: 0.82rem; font-weight: 600; margin-bottom: 1rem;
    }
    .status-open  { background: #d4edda; color: #155724; }
    .status-closed{ background: #f8d7da; color: #721c24; }
    .pharmacy-actions { display: flex; gap: 0.5rem; }
    .pharmacy-actions a {
      flex: 1; padding: 0.5rem; text-align: center;
      border-radius: 50px; text-decoration: none;
      font-weight: 600; font-size: 0.87rem; transition: all 0.3s;
    }
    .btn-view  { background: var(--soft-green); color: var(--accent-color); }
    .btn-order { background: var(--accent-color); color: white; }

    /* ===========================
       SERVICE CARDS
    =========================== */
    .service-card {
      background: white; border-radius: 28px;
      padding: 2rem; text-align: center;
      box-shadow: 0 8px 28px rgba(9,154,167,0.07);
      transition: all 0.3s; height: 100%;
    }
    .service-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(9,154,167,0.14);
    }
    .service-icon {
      width: 76px; height: 76px;
      background: var(--soft-green); border-radius: 26px;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.4rem;
    }
    .service-icon i { font-size: 2.2rem; color: var(--accent-color); }
    .service-card h4 {
      font-size: 1.2rem; font-weight: 700;
      color: var(--heading-color); margin-bottom: 0.8rem;
    }
    .service-card p { color: #6c8285; line-height: 1.6; font-size: 0.95rem; }

    /* ===========================
       HOW IT WORKS
    =========================== */
    .how-it-works { padding: 5rem 0; background: var(--light-mint); }
    .step-item { text-align: center; padding: 1.5rem; }
    .step-number {
      width: 58px; height: 58px;
      background: var(--accent-color); color: white; border-radius: 18px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.7rem; font-weight: 800;
      margin: 0 auto 1.4rem;
      transform: rotate(8deg); transition: all 0.3s;
    }
    .step-item:hover .step-number { transform: rotate(0deg) scale(1.1); }
    .step-item h4 {
      font-size: 1.2rem; font-weight: 700;
      color: var(--heading-color); margin-bottom: 0.7rem;
    }
    .step-item p { color: #6c8285; font-size: 0.95rem; }

    /* ===========================
       APP SECTION
    =========================== */
    .app-section { padding: 5rem 0; }
    .app-content {
      background: linear-gradient(135deg, var(--accent-color) 0%, #067e8a 100%);
      border-radius: 50px; padding: 3.5rem; color: white;
    }
    .app-buttons { display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap; }
    .app-button {
      background: white; color: var(--accent-color);
      padding: 0.8rem 1.5rem; border-radius: 50px;
      text-decoration: none; font-weight: 700;
      display: flex; align-items: center; gap: 0.5rem;
      transition: all 0.3s; font-size: 0.95rem;
    }
    .app-button:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.2); color: var(--accent-color); }
    .app-image { max-width: 100%; border-radius: 32px; transform: translateY(-30px); }

    /* ===========================
       TESTIMONIALS
    =========================== */
    .testimonial-card {
      background: white; border-radius: 24px;
      padding: 1.8rem;
      box-shadow: 0 8px 28px rgba(9,154,167,0.07);
      transition: all 0.3s; height: 100%;
      border: 2px solid transparent;
    }
    .testimonial-card:hover {
      border-color: var(--soft-green);
      box-shadow: 0 16px 36px rgba(9,154,167,0.12);
    }

    /* ===========================
       FOOTER
    =========================== */
    .footer {
      background: var(--heading-color); color: white; padding: 4rem 0 2rem;
    }
    .footer h3 {
      font-size: 1.8rem; font-weight: 800;
      color: white; margin-bottom: 1rem;
    }
    .footer h4 { color: white; font-weight: 700; margin-bottom: 1.4rem; }
    .footer a { color: #a0b9bc; text-decoration: none; transition: all 0.3s; }
    .footer a:hover { color: var(--accent-color); }
    .footer ul li { margin-bottom: 0.5rem; }
    .footer .social-links a {
      width: 40px; height: 40px;
      background: rgba(255,255,255,0.08);
      display: inline-flex; align-items: center; justify-content: center;
      border-radius: 50%; margin-right: 0.5rem; transition: all 0.3s;
    }
    .footer .social-links a:hover { background: var(--accent-color); color: white; }
    .footer .contact-info li { display: flex; align-items: flex-start; gap: 0.6rem; margin-bottom: 0.6rem; }
    .footer .contact-info i { color: var(--accent-color); margin-top: 0.1rem; }
    .copyright {
      text-align: center; margin-top: 3rem; padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,0.08);
      color: #a0b9bc; font-size: 0.9rem;
    }

    /* Scroll to top */
    #scroll-top {
      position: fixed; bottom: 30px; right: 30px;
      width: 50px; height: 50px;
      background: var(--accent-color); color: white;
      border-radius: 50%; text-decoration: none;
      display: none; z-index: 999; transition: all 0.3s;
      align-items: center; justify-content: center;
      font-size: 1.4rem;
    }
    #scroll-top:hover { background: #067e8a; transform: translateY(-5px); }

    /* Bootstrap overrides */
    .bg-light { background-color: var(--light-mint) !important; }

        .hstat .num {
      font-size:1.55rem; font-weight:800; color:#fff; line-height:1;
    }
    .hstat .lbl {
      font-size:.72rem; color:rgba(255,255,255,.6);
      text-transform:uppercase; letter-spacing:.055em; margin-top:.15rem;
    }

    /* ===========================
       RESPONSIVE
    =========================== */
    @media (max-width: 992px) {
      .hero-inner {
        flex-direction: column; padding: 3rem 5vw 2rem; text-align: center;
      }
      .hero-content { max-width: 100%; }
      .hero-popular { justify-content: center; }
      .hero-phone-wrap { width: 260px; margin-top: 1rem; }
      .pill-a, .pill-b { display: none; }
      .stat-item { padding: 0.5rem 1.8rem; }
      .stat-sep { display: none; }
      .stats-bar { gap: 0.5rem; }
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
    @media (max-width: 768px) {
      .hero-title-new { font-size: 2rem; }
      .hero-search-bar {
        flex-direction: column; border-radius: 22px;
        padding: 1rem; gap: 0.6rem;
      }
      .h-search-divider { width: 100%; height: 1px; margin: 0; }
      .hero-search-btn { width: 100%; justify-content: center; }
      .app-content { border-radius: 30px; padding: 2rem; }
      .app-image { transform: translateY(0); margin-top: 1.5rem; max-width: 220px; }
      .navmenu { display: none; }
    }

    /* Fade-up animation */
    .animate-fade-up { animation: fadeUp 0.6s ease both; }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body>

  <!-- ===================== HEADER ===================== -->
  <header class="header fixed-top">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="text-decoration-none">
          <h1 class="sitename"><span>Farma</span><span>Connect</span></h1>
        </a>

        <nav class="navmenu">
          <ul>
            <li><a href="#hero" class="active "><i class="bi bi-house-door me-2"></i> Início</a></li>
            <li><a href="#pharmacies"><i class="bi bi-hospital me-2"></i> Farmácias</a></li>
            <li><a href="#how"><i class="bi bi-info-circle me-2"></i> Como funciona</a></li>
            <li><a href="#contact"><i class="bi bi-envelope me-2"></i> Contacto</a></li>
          </ul>
        </nav>

         <a class="btn-getstarted" href="{{ route('login') }}">Entrar</a>
      </div>
    </div>
  </header>

  <main>

    <!-- ===================== HERO NEW ===================== -->
    <section id="hero" class="hero-new">
      <!-- BG blobs -->
      <div class="hero-blob hero-blob-1"></div>
      <div class="hero-blob hero-blob-2"></div>
      <div class="hero-blob hero-blob-3"></div>

      <div class="container-fluid px-0 d-flex flex-column flex-grow-1">
        <div class="hero-inner">

          <!-- LEFT: Content -->
          <div class="hero-content">
            <div class="hero-badge-new">
              <span class="badge-dot"></span>
              Entrega segura em Luanda
            </div>

            <h1 class="hero-title-new">
              A saúde da sua família<br>
              em <span class="highlight">um só lugar</span>
            </h1>

            <p class="hero-desc-new">
              Encontre farmácias próximas, compare preços e receba<br class="d-none d-lg-block">
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

            <!-- Search bar -->
            {{-- <div class="hero-search-bar">
              <div class="h-search-wrap">
                <i class="bi bi-capsule-pill"></i>
                <input type="text" id="hero-med" placeholder="Pesquisar medicamento...">
              </div>
              <div class="h-search-divider"></div>
              <div class="h-search-wrap">
                <i class="bi bi-geo-alt-fill"></i>
                <select id="hero-bairro">
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
              <button class="hero-search-btn" id="hero-search-btn">
                <i class="bi bi-search"></i> Pesquisar
              </button>
            </div> --}}

            <!-- Popular tags -->
            {{-- <div class="hero-popular">
              <span class="popular-label">Populares:</span>
              <span class="pill-tag">Paracetamol</span>
              <span class="pill-tag">Ibuprofeno</span>
              <span class="pill-tag">Amoxicilina</span>
              <span class="pill-tag">Omeprazol</span>
            </div> --}}
          </div>

          <!-- RIGHT: Phone visual -->
<div class="hero-visual">
  <div class="hero-img-wrap">
    <img
      src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=700&auto=format&fit=crop&q=80"
      class="hero-side-img"
      alt="Medicamentos FarmaConnect"
    >
    <!-- Overlay card flutuante -->
    <div class="hero-img-card card-a">
      <div class="hic-icon"><i class="bi bi-check-circle-fill"></i></div>
      <div>
        <div class="hic-label">Pedido confirmado</div>
        <div class="hic-sub">Entrega em ~28 min</div>
      </div>
    </div>
    <div class="hero-img-card card-b">
      <div class="hic-icon" style="color:#f59e0b;"><i class="bi bi-star-fill"></i></div>
      <div>
        <div class="hic-label">4.9 ★ Avaliação</div>
        <div class="hic-sub">+10 000 clientes</div>
      </div>
    </div>
    <div class="hero-img-card card-c">
      <div class="hic-icon"><i class="bi bi-truck"></i></div>
      <div>
        <div class="hic-label">30 min</div>
        <div class="hic-sub">Entrega média</div>
      </div>
    </div>
  </div>
</div>
        </div>

        <!-- Stats bar -->
        <div class="stats-bar">
          <div class="stat-item">
            <span class="stat-num">50+</span>
            <span class="stat-lbl">Farmácias Parceiras</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat-item">
            <span class="stat-num">5 000+</span>
            <span class="stat-lbl">Medicamentos</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat-item">
            <span class="stat-num">30 min</span>
            <span class="stat-lbl">Entrega Média</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat-item">
            <span class="stat-num">10 000+</span>
            <span class="stat-lbl">Clientes Satisfeitos</span>
          </div>
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
                <a href="{{ route('farmacias.list') }}" class="btn-view"> 
                    <i class="bi bi-eye"></i> Ver Detalhes
                </a>
                {{-- <a href="#" class="btn-order">Pedir entrega</a> --}}
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="pharmacy-card">
              <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400&auto=format&fit=crop"
                   alt="Farmácia Kilamba" class="pharmacy-image">
              <h3 class="pharmacy-name">Farmácia Kilamba</h3>
              <div class="pharmacy-location">
                <i class="bi bi-geo-alt"></i> Kilamba, Rua dos Combates
              </div>
              <span class="pharmacy-status status-open">
                <i class="bi bi-clock"></i> Aberta agora
              </span>
              <div class="pharmacy-actions">
                
                <a href="{{ route('farmacias.list') }}" class="btn-view"> 
                    <i class="bi bi-eye"></i> Ver Detalhes
                </a>
                {{-- <a href="#" class="btn-order">Pedir entrega</a> --}}
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="pharmacy-card">
              <img src="https://images.unsplash.com/photo-1576671081837-49000212a370?w=400&auto=format&fit=crop"
                   alt="Farmácia Talatona" class="pharmacy-image">
              <h3 class="pharmacy-name">Farmácia Talatona</h3>
              <div class="pharmacy-location">
                <i class="bi bi-geo-alt"></i> Talatona, Belas Shopping
              </div>
              <span class="pharmacy-status status-open">
                <i class="bi bi-clock"></i> Aberta agora
              </span>
              <div class="pharmacy-actions">
                <a href="{{ route('farmacias.list') }}" class="btn-view"> 
                    <i class="bi bi-eye"></i> Ver Detalhes
                </a>
                {{-- <a href="#" class="btn-order">Pedir entrega</a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <a href="{{ route('farmacias.list')}}" class="btn-outline">Ver todas as farmácias <i class="bi bi-arrow-right"></i></a>
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
    <section id="how" class="how-it-works">
      <div class="container">
        <div class="section-title">
          <h2>Como funciona?</h2>
          <p>4 passos simples para receber seus medicamentos em casa</p>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-number">1</div>
              <h4>Pesquise</h4>
              <p>Encontre o medicamento que precisa nas farmácias próximas</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-number">2</div>
              <h4>Compare</h4>
              <p>Veja os preços e escolha a melhor opção para o seu bolso</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-number">3</div>
              <h4>Peça</h4>
              <p>Faça o pedido e escolha a forma de pagamento preferida</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="step-item">
              <div class="step-number">4</div>
              <h4>Receba</h4>
              <p>Receba em casa ou retire na farmácia mais próxima</p>
            </div>
          </div>
        </div>
      </div>
    </section>

      <!-- ===================== WHY US ===================== -->
  {{-- <section class="why-section">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=700&auto=format&fit=crop&q=80"
               class="why-img" alt="Por que FarmaConnect">
        </div>
        <div class="col-lg-6">
          <span class="stag" style="display:inline-block;background:var(--soft);color:var(--accent);font-size:.78rem;font-weight:700;padding:.28rem .9rem;border-radius:50px;margin-bottom:.8rem;">POR QUE NÓS</span>
          <h2 style="font-size:2.1rem;font-weight:800;color:var(--heading);margin-bottom:.8rem;">A plataforma de saúde mais confiável de Angola</h2>
          <p style="color:var(--muted);margin-bottom:1.5rem;line-height:1.72;">A FarmaConnect nasceu para resolver um problema real: a dificuldade de encontrar medicamentos rapidamente em Luanda. Hoje somos a principal plataforma de conexão entre farmácias e clientes.</p>
          <ul class="why-list">
            <li>
              <div class="why-icon"><i class="bi bi-shield-check"></i></div>
              <div class="why-text">
                <h6>Farmácias verificadas</h6>
                <p>Todos os nossos parceiros passam por um processo rigoroso de verificação e licenciamento junto do MINSA.</p>
              </div>
            </li>
            <li>
              <div class="why-icon"><i class="bi bi-clock-history"></i></div>
              <div class="why-text">
                <h6>Disponível 24 horas</h6>
                <p>Acesso a farmácias de urgência disponíveis 24h. Nunca mais fique sem os seus medicamentos essenciais.</p>
              </div>
            </li>
            <li>
              <div class="why-icon"><i class="bi bi-graph-down-arrow"></i></div>
              <div class="why-text">
                <h6>Melhor preço garantido</h6>
                <p>Compare preços entre todas as farmácias parceiras e escolha sempre a opção mais económica.</p>
              </div>
            </li>
            <li>
              <div class="why-icon"><i class="bi bi-headset"></i></div>
              <div class="why-text">
                <h6>Suporte dedicado</h6>
                <p>A nossa equipa de apoio ao cliente está disponível para ajudar sempre que precisar.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section> --}}
  
    <!-- ===================== APP SECTION ===================== -->
    <section class="app-section">
      <div class="container">
        <div class="app-content">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h2 class="text-white mb-3" style="font-weight:800;font-size:2.2rem;">Baixe o nosso app</h2>
              <p style="color:rgba(255,255,255,0.75);" class="mb-4">
                Tenha a FarmaConnect sempre à mão. Peça seus medicamentos de onde estiver, a qualquer hora.
              </p>
              <div class="app-buttons">
                <a href="#" class="app-button">
                  <i class="bi bi-google-play"></i> Google Play
                </a>
                <a href="#" class="app-button">
                  <i class="bi bi-apple"></i> App Store
                </a>
              </div>
              <div class="mt-4 d-flex gap-4">
                <div>
                  <h4 class="text-white mb-0" style="font-weight:800;">5 000+</h4>
                  <small style="color:rgba(255,255,255,0.6);">Downloads</small>
                </div>
                <div>
                  <h4 class="text-white mb-0" style="font-weight:800;">4.8 ★</h4>
                  <small style="color:rgba(255,255,255,0.6);">Avaliação</small>
                </div>
              </div>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
              <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&auto=format&fit=crop"
                   alt="App FarmaConnect" class="app-image img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===================== TESTIMONIALS ===================== -->
    <section class="py-5">
      <div class="container">
        <div class="section-title">
          <h2>O que dizem nossos clientes</h2>
          <p>Depoimentos de quem já usa a FarmaConnect</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-4">
            <div class="testimonial-card">
              <div class="d-flex gap-3 mb-3 align-items-center">
                <img src="https://randomuser.me/api/portraits/women/44.jpg"
                     alt="Maria Santos" class="rounded-circle" width="48" height="48">
                <div>
                  <h5 class="mb-0" style="font-weight:700;">Maria Santos</h5>
                  <small class="text-muted">Ingombotas</small>
                </div>
              </div>
              <p class="mb-2" style="color:#4a5568;line-height:1.6;">"Salvou minha mãe! Precisávamos de um medicamento urgente à noite e encontramos aberto."</p>
              <div class="text-warning fs-6">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-card">
              <div class="d-flex gap-3 mb-3 align-items-center">
                <img src="https://randomuser.me/api/portraits/men/32.jpg"
                     alt="João Ferreira" class="rounded-circle" width="48" height="48">
                <div>
                  <h5 class="mb-0" style="font-weight:700;">João Ferreira</h5>
                  <small class="text-muted">Kilamba</small>
                </div>
              </div>
              <p class="mb-2" style="color:#4a5568;line-height:1.6;">"Entrega super rápida! Pedi e em 25 minutos chegou. Muito confiável e fácil de usar."</p>
              <div class="text-warning fs-6">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-card">
              <div class="d-flex gap-3 mb-3 align-items-center">
                <img src="https://randomuser.me/api/portraits/women/68.jpg"
                     alt="Ana Costa" class="rounded-circle" width="48" height="48">
                <div>
                  <h5 class="mb-0" style="font-weight:700;">Ana Costa</h5>
                  <small class="text-muted">Talatona</small>
                </div>
              </div>
              <p class="mb-2" style="color:#4a5568;line-height:1.6;">"Adoro poder comparar preços entre farmácias. Economizo sempre! Recomendo a toda gente."</p>
              <div class="text-warning fs-6">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- ===================== FOOTER ===================== -->
  <footer id="contact" class="footer">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4">
          <h3>FarmaConnect</h3>
          <p style="color:#a0b9bc;line-height:1.7;">
            Plataforma angolana de busca e entrega de medicamentos. Conectamos farmácias e clientes em Luanda e futuramente em todo o país.
          </p>
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
            <li><a href="#">Farmácias</a></li>
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
            <li><i class="bi bi-clock"></i> Seg-Sex: 08h–20h | Sáb: 09h–18h</li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <p>&copy; 2026 FarmaConnect. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

    // Scroll top button
    const scrollTopBtn = document.getElementById('scroll-top');
    window.addEventListener('scroll', () => {
      scrollTopBtn.style.display = window.scrollY > 300 ? 'flex' : 'none';
    });

    // Header effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.style.boxShadow = '0 2px 24px rgba(9,154,167,0.15)';
      } else {
        header.style.boxShadow = '0 2px 20px rgba(9,154,167,0.08)';
      }
    });

    // Hero search
    document.getElementById('hero-search-btn').addEventListener('click', () => {
      const med    = document.getElementById('hero-med').value.trim();
      const bairro = document.getElementById('hero-bairro').value;
      if (med) {
        alert(`🔍 Buscando por "${med}" ${bairro ? 'em ' + bairro : 'em toda Luanda'}...\n(Funcionalidade em desenvolvimento)`);
      } else {
        alert('Por favor, digite o nome do medicamento.');
      }
    });

    // Popular pill tags → fill search input
    document.querySelectorAll('.pill-tag').forEach(tag => {
      tag.addEventListener('click', () => {
        document.getElementById('hero-med').value = tag.textContent.trim();
        document.getElementById('hero-med').focus();
      });
    });

    // Fade-up on scroll
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('animate-fade-up');
      });
    }, { threshold: 0.1 });
    document.querySelectorAll('.pharmacy-card, .service-card, .step-item, .testimonial-card').forEach(el => {
      observer.observe(el);
    });
  </script>

</body>
</html>