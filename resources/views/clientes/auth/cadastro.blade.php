<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Cadastro</title>
  <!-- Bootstrap 5 + ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Fonte Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <style>
    /* ----- PALETA OFICIAL –– VERDE FARMA + TONS NEUTROS ----- */
    :root {
      --background-color: #ffffff;
      --default-color: #363f40;
      --heading-color: #1f2f31;
      --accent-color: #099aa7;        /* verde‑azulado Farma */
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
      padding: 2rem 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      background: linear-gradient(145deg, #f8fbfb 0%, #ffffff 100%);
    }
     /* Botão voltar */
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
    .card {
      background-color: var(--surface-color);
      border: none;
      border-radius: 32px;
      box-shadow: 0 20px 40px -12px rgba(9, 154, 167, 0.08), 0 8px 24px -6px rgba(31, 47, 49, 0.05);
      transition: transform 0.25s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 30px 50px -18px rgba(9, 154, 167, 0.16);
      transform: translateY(-5px);
    }
    h1, h2, h3, .form-label, .heading-font {
      color: var(--heading-color);
      font-weight: 650;
      letter-spacing: -0.02em;
    }
    /* Botão accent (verde Farma) */
    .btn-accent {
      background-color: var(--accent-color);
      border-color: var(--accent-color);
      color: var(--contrast-color);
      font-weight: 600;
      padding: 0.65rem 1.5rem;
      border-radius: 50px;
      transition: all 0.2s ease;
    }
    .btn-accent:hover {
      background-color: #067e8a;
      border-color: #067e8a;
      color: white;
      transform: scale(1.02);
    }
    /* Botão cancelar (agora sozinho, mais abaixo) */
    .btn-cancel {
      background-color: transparent;
      color: #6c8285;
      border: 1.5px solid #d0dddf;
      border-radius: 50px;
      padding: 0.65rem 1.8rem;
      font-weight: 600;
      transition: all 0.2s;
    }
    .btn-cancel:hover {
      background-color: #f2f7f7;
      border-color: #a0b9bc;
      color: #1f2f31;
    }
    .btn-outline-accent {
      border: 2px solid var(--accent-color);
      color: var(--accent-color);
      background-color: transparent;
      border-radius: 50px;
      font-weight: 600;
      padding: 0.6rem 1.2rem;
    }
    .btn-outline-accent:hover {
      background-color: var(--accent-color);
      color: white;
    }
    /* Inputs com foco verde */
    .form-control, .form-select {
      border: 1.5px solid #e0e9ea;
      border-radius: 20px;
      padding: 0.7rem 1.2rem;
      background-color: #fcfefe;
      transition: border 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
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
    .form-check-input:checked {
      background-color: var(--accent-color);
      border-color: var(--accent-color);
    }
    /* Divisor com linha suave */
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

    /* Seção de verificação (verde suave) */
    .verification-section {
      background-color: var(--light-mint);
      border-radius: 24px;
      padding: 1.5rem 1.5rem;
      margin-top: 1.5rem;
      border: 1px solid #cde3e0;
      transition: all 0.3s ease;
    }
    .btn-soft-green {
      background-color: #c2e0db;
      color: #0a5c61;
      border-radius: 40px;
      font-weight: 600;
      border: none;
      padding: 0.6rem 1.2rem;
    }
    .btn-soft-green:hover {
      background-color: #aad4cf;
      color: #054e52;
    }
    /* Botões sociais */
    .btn-social {
      border-radius: 50px;
      padding: 0.65rem 1rem;
      font-weight: 600;
      border: 1.5px solid transparent;
      transition: background 0.2s, transform 0.1s;
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
    .btn-apple i, .btn-google i {
      font-size: 1.2rem;
      margin-right: 8px;
    }
    /* Marca FarmaConnect com cores personalizadas */
    .brand-farma {
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: -0.03em;
      line-height: 1.2;
    }
    .farma {
      color: var(--accent-color); /* #099aa7 */
    }
    .connect {
      color: var(--heading-color); /* #1f2f31 */
    }
    .brand-tagline {
      color: #6c8285;
      font-size: 0.95rem;
      font-weight: 400;
      margin-top: 0.2rem;
    }
    .termos-link {
      color: var(--accent-color);
      text-decoration: none;
      font-weight: 600;
      border-bottom: 1px dashed var(--accent-color);
    }
    .termos-link:hover {
      border-bottom: 1px solid var(--accent-color);
    }
    /* Animações */
    .animate-slide-up {
      animation: slideUpFade 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }
    @keyframes slideUpFade {
      0% { opacity: 0; transform: translateY(15px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    /* Linha fina entre secções */
    hr.separator {
      border: 0;
      border-top: 1.5px solid #ecf3f3;
      margin: 1.8rem 0 1.5rem 0;
      opacity: 0.8;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-9 col-xl-8">

        <!-- CARD PRINCIPAL -->
        <div class="card border-0 p-4 p-md-5 animate-slide-up">

            <!-- BOTÃO VOLTAR -->
          <div class="d-flex mb-0">
            <a class="btn-back text-decoration-none" href="{{ route('index') }}">
              <i class="bi bi-arrow-left"></i> Voltar
            </a>
          </div>
          
          <!-- CABEÇALHO: FarmaConnect com cores distintas -->
          <div class="mb-4">
            <div class="brand-farma">
              <span class="farma">Farma</span><span class="connect">Connect</span>
            </div>
            <div class="brand-tagline">
              Crie a sua conta
            </div>
          </div>
          

          <!-- FORMULÁRIO DE CADASTRO -->
          <form action="" method="POST">
            @csrf
              <div class="row g-4">

                <!-- Nome e Sobrenome -->
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Nome</label>
                  <input type="text" class="form-control" name="name" id="nome" placeholder="Nome">
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Sobrenome</label>
                  <input type="text" class="form-control" name="last_name" id="sobrenome" placeholder="Sobrenome">
                </div>
                
                <!-- E-mail e Telefone -->
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">E-mail</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Nº telefone</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-telephone"></i></span>
                    <input type="tel" class="form-control" name="phone" id="telefone" placeholder="Telefone">
                  </div>
                </div>
                
                <!-- Data nascimento + Gênero -->
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Data de nascimento</label>
                  <input type="date" class="form-control" name="data_nascimento" id="nascimento" value="2026-01-01">
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Gênero (opcional)</label>
                  <select class="form-select" name="genero" id="genero">
                    <option selected disabled>— selecione —</option>
                    <option value="F">Feminino</option>
                    <option value="M">Masculino</option>
                  </select>
                </div>

                <!-- Endereço -->
                <div class="col-12 mb-3">
                  <label class="form-label fw-semibold">Localização no mapa</label>
                  <div id="map" style="height: 300px; border-radius: 18px; border: 1.5px solid #e0e9ea;"></div>
                </div>
                <div class="col-12">
                  <label class="form-label fw-semibold">Endereço</label>
                  <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço completo" readonly>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Latitude</label>
                  <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" readonly>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Longitude</label>
                  <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" readonly>
                </div>
                
                <!-- Senha e Confirmar senha -->
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Senha</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" name="password" id="senha" placeholder="Senha">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold">Confirmar senha</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-check2-circle"></i></span>
                    <input type="password" class="form-control" name="password_confirmation" id="confirmSenha" placeholder="Confirmar senha">
                  </div>
                </div>
              </div> <!-- fim row -->

              <!-- SEÇÃO DE VERIFICAÇÃO (E-mail / SMS) -->
              <div class="verification-section mt-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                  <span class="fw-semibold mb-2 mb-sm-0" style="color: var(--heading-color);">
                    <i class="bi bi-shield-check me-1" style="color: var(--accent-color);"></i> 
                    Verificação de segurança
                  </span>
                  <div class="d-flex gap-2">
                    <button class="btn btn-soft-green btn-sm" id="enviarCodigoEmailBtn" type="button">
                      <i class="bi bi-envelope-check"></i> Enviar por e-mail
                    </button>
                    <button class="btn btn-soft-green btn-sm" id="enviarCodigoSmsBtn" type="button">
                      <i class="bi bi-chat-dots"></i> Enviar por SMS
                    </button>
                  </div>
                </div>
                <!-- Área do código de verificação -->
                <div id="codigoVerificacaoArea" style="display: none; margin-top: 1.2rem;" class="animate-slide-up">
                  <label class="form-label fw-semibold">Digite o código de 6 dígitos</label>
                  <div class="d-flex flex-wrap gap-2">
                    <input type="text" class="form-control" id="codigoDigitado" placeholder="000000" style="max-width: 180px; background: white;" maxlength="6">
                    <button class="btn btn-accent" id="confirmarCodigoBtn" type="button">Confirmar</button>
                    <span id="feedbackCodigo" class="align-self-center ms-2 small"></span>
                  </div>
                  <div id="codigoSimuladoHelper" class="mt-2 small text-secondary">
                    <i class="bi bi-info-circle"></i> Código simulado: <strong>123456</strong> (use para testar)
                  </div>
                </div>
              </div>

              <!-- CHECKBOX DOS TERMOS (agora sozinho, antes dos botões) -->
              <div class="form-check mt-4 mb-3">
                <input class="form-check-input" type="checkbox" id="termosCheck" style="cursor: pointer;">
                <label class="form-check-label fw-medium" for="termosCheck">
                  Aceito os <a href="#" class="termos-link">Termos e Condições</a> e a 
                  <a href="#" class="termos-link">Política de Privacidade</a>.
                </label>
              </div>

              <!-- BOTÕES CANCELAR E INSCREVER-SE – separados, mais abaixo, um ao lado do outro -->
              <div class="d-flex flex-column flex-sm-row gap-3 mt-2">
                <a class="btn btn-cancel flex-fill" href="{{ route('index') }}">
                  <i class="bi bi-x-lg me-1"></i> Cancelar
                </a>
                <button class="btn btn-accent flex-fill"  type="submit">
                  <i class="bi bi-check-lg me-1"></i> Inscrever-se
                </button>
              </div>
          </form>

          <!-- Divisor "ou registe-se com" -->
          <div class="divider mt-5">
            <span class="px-2 text-uppercase small fw-semibold" style="color: #66898b;">ou registe-se com</span>
          </div>

          <!-- Botões Apple e Google -->
          <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <button class="btn btn-social btn-google flex-fill" id="googleSignup">
              <i class="bi bi-google"></i> Cadastrar com Google
            </button>
            <button class="btn btn-social btn-apple flex-fill" id="appleSignup">
              <i class="bi bi-apple"></i> Cadastrar com Apple
            </button>
          </div>
          
          <!-- Link para login -->
          <p class="text-center text-muted small mt-4 mb-0">
            Já tem uma conta? <a href="login.html" style="color: var(--accent-color); font-weight: 600; text-decoration: none;">Entrar</a>
          </p>
        </div> <!-- fim card -->
        
        <!-- Feedback flutuante -->
        <div id="liveToastMsg" class="text-center mt-3 small fw-semibold" style="color: var(--accent-color); min-height: 28px;"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet.js para OpenStreetMap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />
  <script>
    (function() {
          // --- MAPA OPENSTREETMAP ---
          let map, marker;
          const enderecoInput = document.getElementById('endereco');
          const latitudeInput = document.getElementById('latitude');
          const longitudeInput = document.getElementById('longitude');
          // Coordenadas padrão (centro de Angola)
          const defaultLat = -11.2027;
          const defaultLng = 17.8739;
          map = L.map('map').setView([defaultLat, defaultLng], 6);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
          }).addTo(map);
          // Geocoder (busca endereço)
          const geocoder = L.esri.Geocoding.geosearch({
            providers: [L.esri.Geocoding.arcgisOnlineProvider()],
            placeholder: 'Pesquisar endereço...'
          }).addTo(map);
          geocoder.on('results', function(data) {
            if (data.results.length > 0) {
              const result = data.results[0];
              setMarker(result.latlng.lat, result.latlng.lng, result.text);
            }
          });
          // Clique no mapa
          map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            // Reverse geocode para endereço
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
              .then(res => res.json())
              .then(data => {
                setMarker(lat, lng, data.display_name || '');
              });
          });
          function setMarker(lat, lng, address) {
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);
            latitudeInput.value = lat;
            longitudeInput.value = lng;
            enderecoInput.value = address;
          }
      "use strict";

      // Elementos principais
      const emailInput = document.getElementById('email');
      const telefoneInput = document.getElementById('telefone');
      const btnEnviarEmail = document.getElementById('enviarCodigoEmailBtn');
      const btnEnviarSms = document.getElementById('enviarCodigoSmsBtn');
      const codigoArea = document.getElementById('codigoVerificacaoArea');
      const codigoDigitado = document.getElementById('codigoDigitado');
      const confirmarCodigoBtn = document.getElementById('confirmarCodigoBtn');
      const feedbackCodigo = document.getElementById('feedbackCodigo');
      const inscreverBtn = document.getElementById('inscreverBtn');
      const cancelarBtn = document.getElementById('cancelarBtn');
      const termosCheck = document.getElementById('termosCheck');
      const toastMsg = document.getElementById('liveToastMsg');

      const senha = document.getElementById('senha');
      const confirmSenha = document.getElementById('confirmSenha');
      const googleBtn = document.getElementById('googleSignup');
      const appleBtn = document.getElementById('appleSignup');

      // Feedback
      function mostrarFeedback(texto, isSucesso = true) {
        toastMsg.textContent = texto;
        toastMsg.style.color = isSucesso ? '#099aa7' : '#b34a4a';
        setTimeout(() => { toastMsg.textContent = ''; }, 4500);
      }

      function abrirAreaCodigo(metodo = 'email') {
        if (!codigoArea.style.display || codigoArea.style.display === 'none') {
          codigoArea.style.display = 'block';
        }
        mostrarFeedback(`📨 Código enviado por ${metodo === 'email' ? 'e-mail' : 'SMS'} (simulado: 123456)`, true);
        codigoDigitado.value = '';
        feedbackCodigo.innerHTML = '';
      }

      // Enviar código
      btnEnviarEmail.addEventListener('click', function(e) {
        e.preventDefault();
        if (!emailInput.value.trim()) {
          mostrarFeedback('⚠️ Por favor, insira um e-mail válido.', false);
          return;
        }
        abrirAreaCodigo('email');
      });

      btnEnviarSms.addEventListener('click', function(e) {
        e.preventDefault();
        if (!telefoneInput.value.trim()) {
          mostrarFeedback('⚠️ Insira um número de telefone para SMS.', false);
          return;
        }
        abrirAreaCodigo('sms');
      });

      // Confirmar código (123456)
      confirmarCodigoBtn.addEventListener('click', function() {
        const codigo = codigoDigitado.value.trim();
        if (codigo === '') {
          feedbackCodigo.innerHTML = '<span class="text-danger">🔴 Digite o código</span>';
          return;
        }
        if (codigo === '123456') {
          feedbackCodigo.innerHTML = '<span class="text-success fw-bold">✅ Código verificado!</span>';
        } else {
          feedbackCodigo.innerHTML = '<span class="text-danger">❌ Código incorreto. Tente 123456</span>';
        }
      });

      // Botão Inscrever-se
      inscreverBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const nome = document.getElementById('nome').value.trim();
        const sobrenome = document.getElementById('sobrenome').value.trim();
        const emailVal = emailInput.value.trim();
        const foneVal = telefoneInput.value.trim();
        const senhaVal = senha.value.trim();
        const confirmVal = confirmSenha.value.trim();

        if (!nome || !sobrenome) {
          mostrarFeedback('❌ Nome e sobrenome são obrigatórios.', false);
          return;
        }
        if (!emailVal || !emailVal.includes('@')) {
          mostrarFeedback('❌ E-mail válido é obrigatório.', false);
          return;
        }
        if (!foneVal) {
          mostrarFeedback('❌ Número de telefone necessário.', false);
          return;
        }
        if (senhaVal.length < 6) {
          mostrarFeedback('🔐 A senha deve ter pelo menos 6 caracteres.', false);
          return;
        }
        if (senhaVal !== confirmVal) {
          mostrarFeedback('❌ As senhas não coincidem.', false);
          return;
        }
        if (!termosCheck.checked) {
          mostrarFeedback('📄 Aceite os Termos e Condições.', false);
          return;
        }

        mostrarFeedback('🎉 Cadastro simulado com sucesso! (FarmaConnect)', true);
      });

      // Cancelar
      cancelarBtn.addEventListener('click', function() {
        if (confirm('Deseja cancelar o cadastro? Os dados serão perdidos.')) {
          document.getElementById('nome').value = '';
          document.getElementById('sobrenome').value = '';
          emailInput.value = '';
          telefoneInput.value = '';
          senha.value = '';
          confirmSenha.value = '';
          document.getElementById('nascimento').value = '1990-01-01';
          document.getElementById('genero').selectedIndex = 0;
          termosCheck.checked = false;
          codigoArea.style.display = 'none';
          feedbackCodigo.innerHTML = '';
          mostrarFeedback('✖️ Cadastro cancelado.', false);
        }
      });

      // Botões sociais
      googleBtn.addEventListener('click', function() {
        mostrarFeedback('🌐 Redirecionamento para Google (simulação)', true);
      });
      appleBtn.addEventListener('click', function() {
        mostrarFeedback('🍎 Autenticação Apple (simulação)', true);
      });

      // Links de termos
      const termosLinks = document.querySelectorAll('.termos-link');
      termosLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          mostrarFeedback('📋 Termos e Condições da FarmaConnect', true);
        });
      });

    })();
  </script>
</body>
</html>