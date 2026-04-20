<style>
.sidebar {
  width: 260px;
  background: var(--navy);
  position: fixed;
  top: 0; left: 0;
  height: 100vh;
  display: flex;
  flex-direction: column;
  padding: 0;
  overflow: hidden;
  z-index: 100;
  animation: slideInLeft .5s cubic-bezier(.16,1,.3,1) both;
}

/* subtle background texture */
.sidebar::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 160% 60% at 50% -10%, rgba(11,191,204,.12) 0%, transparent 60%),
    radial-gradient(ellipse 80% 80% at 110% 110%, rgba(11,191,204,.07) 0%, transparent 60%);
  pointer-events: none;
}

.sidebar-top {
  padding: 2rem 1.6rem 1.2rem;
  border-bottom: 1px solid var(--border);
}

.logo {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 2.5rem;
  text-decoration: none;
  display: block;
}
.logo .farma { color: var(--accent); }
.logo .connect { color: #e0f7f5; }

/* Deliverer profile strip */
.driver-strip {
  display: flex;
  align-items: center;
  gap: .9rem;
  padding: 1rem 1.6rem;
  border-bottom: 1px solid var(--border);
}
.driver-avatar {
  width: 40px; height: 40px;
  background: linear-gradient(135deg, var(--teal), var(--teal-dim));
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-family: 'Syne', sans-serif;
  font-weight: 700;
  color: #fff;
  font-size: 1.1rem;
  flex-shrink: 0;
  box-shadow: 0 4px 14px rgba(11,191,204,.35);
}
.driver-info { flex: 1; min-width: 0; }
.driver-name { font-weight: 600; color: #fff; font-size: .95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.driver-id { font-size: .75rem; color: var(--text-dim); }

/* Status pill */
.status-pill {
  display: flex;
  align-items: center;
  gap: .4rem;
  padding: .3rem .7rem;
  border-radius: 50px;
  font-size: .72rem;
  font-weight: 600;
  cursor: pointer;
  transition: all .2s;
  white-space: nowrap;
}
.status-pill.online  { background: rgba(30,201,122,.15); color: var(--green); border: 1px solid rgba(30,201,122,.25); }
.status-pill.offline { background: rgba(240,78,96,.12);  color: var(--red);   border: 1px solid rgba(240,78,96,.2); }
.status-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; animation: blink 2s infinite; }

/* Location button (novo) */
.location-btn {
  background: rgba(11,191,204,.15);
  border: 1px solid rgba(11,191,204,.3);
  border-radius: 40px;
  padding: .3rem .7rem;
  font-size: .75rem;
  font-weight: 600;
  color: #22c2d1;
  cursor: pointer;
  transition: all .2s;
  display: inline-flex;
  align-items: center;
  gap: .4rem;
  white-space: nowrap;
}
.location-btn:hover {
  background: rgba(11,191,204,.25);
  transform: translateY(-1px);
}

/* Nav */
.sidebar-nav {
  flex: 1;
  padding: 1rem 1rem;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: .15rem;
}
.sidebar-nav::-webkit-scrollbar { width: 4px; }
.sidebar-nav::-webkit-scrollbar-track { background: transparent; }
.sidebar-nav::-webkit-scrollbar-thumb { background: var(--navy-4); border-radius: 4px; }

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
.nav-link:hover { color: rgba(255,255,255,.85); background: rgba(255,255,255,.05); }
.nav-link.active {
  color: #fff;
  background: linear-gradient(135deg, rgba(11,191,204,.25), rgba(11,191,204,.1));
  border: 1px solid rgba(11,191,204,.2);
}
.nav-link.active i { color: var(--teal); }
.nav-link.active::before {
  content: '';
  position: absolute;
  left: 0; top: 20%; bottom: 20%;
  width: 3px;
  background: var(--teal);
  border-radius: 0 4px 4px 0;
}

.nav-badge {
  margin-left: auto;
  padding: .18rem .55rem;
  border-radius: 50px;
  font-size: .68rem;
  font-weight: 700;
}
.nb-teal   { background: rgba(11,191,204,.2);  color: var(--teal); }
.nb-green  { background: rgba(30,201,122,.15); color: var(--green); }
.nb-amber  { background: rgba(245,166,35,.15); color: var(--amber); }
.nb-red    { background: rgba(240,78,96,.15);  color: var(--red); }

.nav-divider { height: 1px; background: var(--border); margin: .6rem 0; }

/* Animations */
@keyframes slideInLeft {
  from { transform: translateX(-20px); opacity: 0; }
  to   { transform: translateX(0);     opacity: 1; }
}
@keyframes blink {
  0%,100% { opacity: 1; }
  50%      { opacity: .4; }
}
</style>

<aside class="sidebar">
  <div class="sidebar-top">
    <a href="#" class="logo">
      <span class="farma" style="color: #22c2d1">Farma</span><span class="connect">Connect</span>
    </a>

  </div>

  
  <div class="driver-strip">
    <div class="driver-avatar">
      {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
    <div class="driver-info">
      <div class="driver-name">{{ Auth::user()->name }}</div>
      <div class="driver-id">ID · ENT-{{ str_pad(Auth::user()->entregador->id, 3, '0', STR_PAD_LEFT) }}</div>
    </div>
    @php
      $entregador = Auth::user()->entregador;
      $isOnline = $entregador->status === 'Ativo';
    @endphp
    <div class="status-pill {{ $isOnline ? 'online' : 'offline' }}" id="statusPill" onclick="toggleStatus()">
      <span class="status-dot"></span>
      <span id="statusLabel">{{ $isOnline ? 'Online' : 'Offline' }}</span>
    </div>
         <!-- Botão de actualização de localização -->
    <button class="location-btn" id="btnAtualizarLocalizacao">
      <i class="bi bi-geo-alt-fill"></i> 
    </button>
    <span id="statusLocalizacao" class="ms-1" style="font-size: 0.7rem; color: #a0c4c8;"></span>

     </div>

  <nav class="sidebar-nav">
    <span class="nav-label">Principal</span>

    <a href="{{ route('index.entregadores') }}" 
       class="nav-link {{ request()->routeIs('index.entregadores') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i>
      <span>Paínel Administrativo</span>
    </a>

    <a href="{{ route('entregas.entregadores') }}" 
       class="nav-link {{ request()->routeIs('entregas.entregadores') ? 'active' : '' }}">
      <i class="bi bi-truck"></i>
      <span>Entregas</span>
    </a>

    <a href="{{ route('ganhos.entregadores') }}" 
       class="nav-link {{ request()->routeIs('ganhos.entregadores') ? 'active' : '' }}">
      <i class="bi bi-cash-stack"></i>
      <span>Ganhos</span>
    </a>    
    
    <a href="{{ route('avaliacao.entregadores') }}" 
       class="nav-link {{ request()->routeIs('avaliacao.entregadores') ? 'active' : '' }}">
      <i class="bi bi-star"></i>
      <span>Avaliações</span>
    </a>

    <span class="nav-label" style="margin-top:.4rem">Conta</span>

    <a href="{{ route('perfil.entregadores', ['id' => Auth::user()->id]) }}" 
       class="nav-link {{ request()->routeIs('perfil.entregadores') ? 'active' : '' }}">
      <i class="bi bi-person-circle"></i>
      <span>Perfil</span>
    </a>

    <div class="nav-divider"></div>

    <a href="#" class="nav-link" style="color:rgba(240,78,96,.7)" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sair</span>
    </a>

    <form id="logout-form" action="{{ route('logout', ['id' => Auth::user()->id]) }}" method="POST" style="display: none;">
      @csrf
    </form>
  </nav>
</aside>

<script>
  /* ── STATUS TOGGLE (persistente no backend) ── */
  function toggleStatus() {
    const pill = document.getElementById('statusPill');
    const label = document.getElementById('statusLabel');
    const isCurrentlyOnline = pill.classList.contains('online');
    const newStatus = !isCurrentlyOnline;

    // Optimistic UI update
    pill.classList.remove('online', 'offline');
    pill.classList.add(newStatus ? 'online' : 'offline');
    label.textContent = newStatus ? 'Online' : 'Offline';

    // Enviar para o backend
    fetch('{{ route("entregador.status.update") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        status: newStatus ? 'Ativo' : 'Inativo',
        disponivel: newStatus
      })
    }).catch(err => {
      // Reverter em caso de erro
      pill.classList.remove('online', 'offline');
      pill.classList.add(isCurrentlyOnline ? 'online' : 'offline');
      label.textContent = isCurrentlyOnline ? 'Online' : 'Offline';
      alert('Erro ao atualizar status. Tente novamente.');
    });
  }

  /* ── LOCALIZAÇÃO (manual + automática a cada 30 min) ── */
  function enviarLocalizacao() {
    const statusSpan = document.getElementById('statusLocalizacao');
    if (!statusSpan) return;
    statusSpan.innerHTML = '<i class="bi bi-hourglass-split"></i>';
    statusSpan.style.opacity = '1';

    if (!navigator.geolocation) {
      statusSpan.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Não suportado';
      setTimeout(() => statusSpan.innerHTML = '', 3000);
      return;
    }

    navigator.geolocation.getCurrentPosition(
      function(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        fetch('{{ route("entregador.localizacao") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ latitude: lat, longitude: lng })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            statusSpan.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
            setTimeout(() => statusSpan.innerHTML = '', 3000);
          } else {
            statusSpan.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
            setTimeout(() => statusSpan.innerHTML = '', 3000);
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          statusSpan.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
          setTimeout(() => statusSpan.innerHTML = '', 3000);
        });
      },
      function(error) {
        let msg = '';
        switch(error.code) {
          case error.PERMISSION_DENIED: msg = 'Permissão negada'; break;
          case error.POSITION_UNAVAILABLE: msg = 'Indisponível'; break;
          case error.TIMEOUT: msg = 'Tempo esgotado'; break;
          default: msg = 'Erro';
        }
        statusSpan.innerHTML = '<i class="bi bi-exclamation-triangle"></i> ' + msg;
        setTimeout(() => statusSpan.innerHTML = '', 4000);
      },
      { enableHighAccuracy: true, timeout: 10000 }
    );
  }

  // Botão manual
  const btnLoc = document.getElementById('btnAtualizarLocalizacao');
  if (btnLoc) {
    btnLoc.addEventListener('click', enviarLocalizacao);
  }

  // Envio automático a cada 30 minutos (1800000 ms)
  setInterval(enviarLocalizacao, 1800000);

  // Opcional: enviar ao carregar a página (após 2 segundos)
  window.addEventListener('load', function() {
    setTimeout(enviarLocalizacao, 2000);
  });
</script>