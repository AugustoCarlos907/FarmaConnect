<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <style>
   
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
    body {
      background-color: var(--background-color);
      color: var(--default-color);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      padding: 1.5rem 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      background: linear-gradient(145deg, #f8fbfb 0%, #ffffff 100%);
    }
    .card {
      background-color: var(--surface-color);
      border: none;
      border-radius: 32px;
      box-shadow: 0 20px 40px -12px rgba(9, 154, 167, 0.08), 0 8px 24px -6px rgba(31, 47, 49, 0.05);
      transition: transform 0.25s ease, box-shadow 0.3s ease;
      padding-top: 1.75rem !important;
    }
    
    /* Botão voltar - mais acima */
    .btn-back {
      color: var(--heading-color);
      background-color: transparent;
      border: none;
      font-weight: 600;
      padding: 0.4rem 0.75rem;
      border-radius: 50px;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: -0.5rem;
      margin-bottom: 0.25rem;
    }
    .btn-back:hover {
      background-color: var(--soft-green);
      color: var(--accent-color);
    }
    
    /* Marca FarmaConnect */
    .brand-farma {
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: -0.03em;
      line-height: 1.1;
      margin-top: 0.25rem;
    }
    .farma {
      color: var(--accent-color);
    }
    .connect {
      color: var(--heading-color);
    }
    .brand-tagline {
      color: #6c8285;
      font-size: 0.95rem;
      font-weight: 400;
      margin-top: 0.2rem;
      margin-bottom: 1.25rem;
    }
    
    /* Botão accent */
    .btn-accent {
      background-color: var(--accent-color);
      border-color: var(--accent-color);
      color: var(--contrast-color);
      font-weight: 600;
      padding: 0.75rem 1.5rem;
      border-radius: 50px;
      transition: all 0.2s ease;
    }
    .btn-accent:hover {
      background-color: #067e8a;
      border-color: #067e8a;
      color: white;
      transform: scale(1.02);
    }
    
    /* Botão outline */
    .btn-outline-accent {
      border: 2px solid var(--accent-color);
      color: var(--accent-color);
      background-color: transparent;
      border-radius: 50px;
      font-weight: 600;
      padding: 0.75rem 1.5rem;
      transition: all 0.2s;
    }
    .btn-outline-accent:hover {
      background-color: var(--accent-color);
      color: white;
      border-color: var(--accent-color);
    }
    
    /* Inputs */
    .form-control {
      border: 1.5px solid #e0e9ea;
      border-radius: 20px;
      padding: 0.8rem 1.2rem;
      background-color: #fcfefe;
      transition: border 0.2s, box-shadow 0.2s;
    }
    .form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 0.2rem rgba(9, 154, 167, 0.15);
      background-color: white;
    }
    .input-group-text {
      background-color: var(--soft-green);
      border: 1.5px solid #e0e9ea;
      border-radius: 20px 0 0 20px;
      border-right: none;
      color: var(--heading-color);
    }
    
    /* Link Esqueceu a senha - abaixo do campo */
    .forgot-link {
      color: var(--accent-color);
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      border-bottom: 1px dashed var(--accent-color);
      display: inline-block;
      margin-top: 0.5rem;
      margin-bottom: 0.25rem;
    }
    .forgot-link:hover {
      border-bottom: 1px solid var(--accent-color);
    }
    
    /* Divisor */
    .divider {
      display: flex;
      align-items: center;
      color: #a0b3b5;
      font-size: 0.85rem;
      margin: 1.5rem 0;
    }
    .divider::before, .divider::after {
      content: "";
      flex: 1;
      height: 1px;
      background: linear-gradient(to right, transparent, #b6cbce, transparent);
    }
    .divider::before { margin-right: 1rem; }
    .divider::after { margin-left: 1rem; }
    
    /* Botões sociais */
    .btn-social {
      border-radius: 50px;
      padding: 0.75rem 1rem;
      font-weight: 600;
      border: 1.5px solid transparent;
      transition: all 0.2s;
    }
    .btn-google {
      background-color: var(--google-gray);
      color: #3c4043;
      border-color: #dadce0;
    }
    .btn-google:hover {
      background-color: #e8eaed;
      border-color: #bdc1c6;
      transform: translateY(-2px);
    }
    .btn-apple {
      background-color: var(--apple-dark);
      color: white;
      border-color: var(--apple-dark);
    }
    .btn-apple:hover {
      background-color: #2f2f31;
      transform: translateY(-2px);
    }
    .btn-social i {
      font-size: 1.2rem;
      margin-right: 8px;
    }
    
    /* Texto "Ainda não tem uma conta?" */
    .no-account-text {
      color: var(--default-color);
      font-size: 0.95rem;
      margin-bottom: 0.75rem;
    }
    
    /* Animações */
    .animate-slide-up {
      animation: slideUpFade 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }
    @keyframes slideUpFade {
      0% { opacity: 0; transform: translateY(15px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    
    /* Feedback */
    #liveToastMsg {
      min-height: 28px;
      transition: all 0.2s;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">

        <!-- CARD DE LOGIN -->
        <div class="card border-0 p-4 p-md-5 animate-slide-up" style="padding-top: 1.5rem !important;">
          
          @if($errors->any())
            <div class="text-danger">
              <p> {{ $errors }}</p>
            </div>
          @endif
          <!-- BOTÃO VOLTAR -->
          <div class="d-flex mb-0">
            <a class="btn-back text-decoration-none" href="{{ route('index') }}">
              <i class="bi bi-arrow-left"></i> Voltar
            </a>
          </div>

          <!-- LOGÓTIPO FARMA CONNECT -->
          <div class="mb-3 text-center text-md-start">
            <div class="brand-farma">
              <span class="farma">Farma</span><span class="connect">Connect</span>
            </div>
            <div class="brand-tagline">
              Aceda à sua conta
            </div>
          </div>

          <!-- FORMULÁRIO -->
          <div class="row g-4">
            <form action="{{ route('authenticate') }}" method="POST">
              @csrf

              <!-- E-mail -->
              <div class="col-12">
                <label class="form-label fw-semibold">E-mail</label>
                <div class="input-group">
                  <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                  <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                </div>
              </div>
              
              <!-- Senha -->
              <div class="col-12">
                <label class="form-label fw-semibold">Senha</label>
                <div class="input-group">
                  <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                  <input type="password" class="form-control" name="password" id="senha" placeholder="Senha">
                </div>
                <!-- Esqueceu a senha (abaixo) -->
                <div class="text-end">
                  <a href="recuperar_senha.html" class="forgot-link" id="esqueciSenha">Esqueceu a senha?</a>
                </div>
              </div>
            </div>

            <!-- BOTÃO ENTRAR -->
            <div class="d-grid mt-4">
              <button class="btn btn-accent"  type="submit">
                <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
              </button>
            </div>
          </form>

            <!-- SEÇÃO "Ainda não tem uma conta?" - RESTAURADA -->
          <div class="text-center mt-4">
           <div class="divider mt-4">
            <span class="px-2 text-uppercase small fw-semibold" style="color: #66898b;">Ainda não tem uma conta?</span>
          </div>
            <!-- BOTÃO CRIAR NOVA CONTA COM LINK PARA O CADASTRO -->
            <a href="{{ route('register') }}" id="criarContaLink" class="btn btn-outline-accent w-100">
              <i class="bi bi-person-plus me-2"></i> Criar nova conta
            </a>
          </div>

          <!-- Divisor "ou entre com" -->
          <div class="divider mt-4">
            <span class="px-2 text-uppercase small fw-semibold" style="color: #66898b;">ou entre com</span>
          </div>

          <!-- BOTÕES SOCIAIS: Google e Apple -->
          <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <button class="btn btn-social btn-google flex-fill" id="googleLogin">
              <i class="bi bi-google"></i> Google
            </button>
            <button class="btn btn-social btn-apple flex-fill" id="appleLogin">
              <i class="bi bi-apple"></i> Apple
            </button>
          </div>

          <!-- Termos -->
          <p class="text-center text-muted small mt-4 mb-0">
            Ao entrar, concorda com os <a href="#" class="termos-link" style="color: var(--accent-color); text-decoration: none; font-weight: 600;">Termos e Condições</a>.
          </p>
        </div> <!-- fim card -->
        
        <!-- Feedback -->
        <div id="liveToastMsg" class="text-center mt-3 small fw-semibold" style="color: var(--accent-color); min-height: 28px;"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (function() {
      "use strict";

      // Elementos
      const emailInput = document.getElementById('email');
      const senhaInput = document.getElementById('senha');
      const entrarBtn = document.getElementById('entrarBtn');
      const criarContaLink = document.getElementById('criarContaLink'); // Agora é um link <a>
      const esqueciSenha = document.getElementById('esqueciSenha');
      const btnVoltar = document.getElementById('btnVoltar');
      const googleBtn = document.getElementById('googleLogin');
      const appleBtn = document.getElementById('appleLogin');
      const toastMsg = document.getElementById('liveToastMsg');

      // Feedback
      function mostrarFeedback(texto, isSucesso = true) {
        toastMsg.textContent = texto;
        toastMsg.style.color = isSucesso ? '#099aa7' : '#b34a4a';
        setTimeout(() => { toastMsg.textContent = ''; }, 4500);
      }

      // BOTÃO ENTRAR
      entrarBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const email = emailInput.value.trim();
        const senha = senhaInput.value.trim();

        if (!email || !email.includes('@')) {
          mostrarFeedback('❌ Insira um e-mail válido.', false);
          return;
        }
        if (!senha) {
          mostrarFeedback('❌ Insira a sua senha.', false);
          return;
        }
        if (senha.length < 6) {
          mostrarFeedback('🔐 A senha deve ter pelo menos 6 caracteres.', false);
          return;
        }

        mostrarFeedback('✅ Login simulado com sucesso! (FarmaConnect)', true);
      });

      // BOTÃO VOLTAR (página inicial)
      btnVoltar.addEventListener('click', function(e) {
        e.preventDefault();
        mostrarFeedback('🏠 Voltar à página inicial (simulação)', true);
        // window.location.href = 'index.html'; // descomente para redirecionar
      });

      // LOGIN COM GOOGLE
      googleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        mostrarFeedback('🌐 Login com Google (simulação)', true);
      });

      // LOGIN COM APPLE
      appleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        mostrarFeedback('🍎 Login com Apple (simulação)', true);
      });

      // Links de termos
      const termosLink = document.querySelector('.termos-link');
      if (termosLink) {
        termosLink.addEventListener('click', function(e) {
          e.preventDefault();
          mostrarFeedback('📋 Termos e Condições da FarmaConnect', true);
        });
      }

      // Enter no campo de senha
      senhaInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          entrarBtn.click();
        }
      });

    })();
  </script>
</body>
</html>