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

    .pharmacy-card img {
    width: 100%;           /* Ocupa toda a largura do card */
    height: 200px;         /* Define uma altura fixa igual para todas */
    object-fit: cover;     /* Corta a imagem para preencher o espaço sem distorcer */
    display: block;        /* Remove espaços em branco por baixo da imagem */
    border-radius: 8px 8px 0 0; /* Arredonda apenas os cantos de cima (opcional) */
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
            <span class="stat-num">24h</span>
            <span class="stat-lbl">Suporte Técnico</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat-item">
            <span class="stat-num">100%</span>
            <span class="stat-lbl">Entrega Rastreada</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat-item">
            <span class="stat-num">+300%</span>
            <span class="stat-lbl">Crescimento <A></A>nual</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat-item">
            <span class="stat-num">100%</span>
            <span class="stat-lbl">Transações Seguras ( Criptografia )</span>

            {{-- <span class="stat-lbl">Clientes Satisfeitos</span> --}}
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
                <img src="{{ asset('storage/img/Mecofarma_Kinaxixi_1.png') }}" class="pharmacy-img" >

              <h3 class="pharmacy-name">Farmácia Mecofarma</h3>
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
                <img src="{{ asset('storage/img/palanca.jpeg') }}" class="pharmacy-img" >

              <h3 class="pharmacy-name">Farmácia Palanca</h3>
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
                <img src="{{ asset('storage/img/glover.jpeg') }}" class="pharmacy-img">

                           <h3 class="pharmacy-name">Glover Group Pharmacy</h3>
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
                <img src="data:image/jpeg;base64,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" class="rounded-circle" width="46" height="46" alt="">
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
                <img src="data:image/jpeg;base64,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" class="rounded-circle" width="46" height="46" alt="">
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