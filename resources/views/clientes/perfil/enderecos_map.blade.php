<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ isset($endereco) ? 'Editar endereço' : 'Novo endereço' }} — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Leaflet — OpenStreetMap --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    :root {
      --accent:      #099aa7;
      --accent-dark: #067e8a;
      --heading:     #1f2f31;
      --text:        #363f40;
      --soft:        #dff3f0;
      --mint:        #eaf6f5;
      --muted:       #6c8285;
      --border:      #e4f0f0;
      --shadow:      0 8px 32px rgba(9,154,167,.08);
    }
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'Inter',-apple-system,sans-serif; background:#f4f8f8; color:var(--text); }

    /* ─── HEADER ─── */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; position:sticky; top:0; z-index:1000; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }

    /* ─── TOPBAR ─── */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:1.8rem 0 3.8rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:280px;height:280px;background:#fff;opacity:.07;top:-100px;right:-40px; }
    .tb2 { width:180px;height:180px;background:#a8ffd4;opacity:.06;bottom:-50px;left:5%; }
    .topbar-inner { position:relative; z-index:2; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.7rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .page-topbar p  { color:rgba(255,255,255,.68); font-size:.9rem; margin-top:.3rem; }

    /* ─── WRAP ─── */
    .map-page-wrap { margin-top:-2rem; padding-bottom:4rem; }

    /* ─── CARD ─── */
    .pcard { background:#fff; border-radius:24px; box-shadow:var(--shadow); margin-bottom:1.4rem; overflow:hidden; }
    .pcard-header { padding:1.3rem 1.8rem 1rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:.9rem; }
    .pcard-icon { width:42px; height:42px; background:var(--soft); border-radius:12px; display:flex; align-items:center; justify-content:center; color:var(--accent); font-size:1.1rem; flex-shrink:0; }
    .pcard-header h5 { font-size:1rem; font-weight:800; color:var(--heading); margin:0; }
    .pcard-header p  { font-size:.78rem; color:var(--muted); margin:0; }
    .pcard-body { padding:1.8rem; }

    /* ─── MAPA ─── */
    #map {
      width:100%;
      height:420px;
      border-radius:16px;
      border:1.5px solid var(--border);
      z-index:1;
      margin-bottom:1.2rem;
    }

    /* Barra de pesquisa sobre o mapa */
    .map-search-bar {
      position:relative;
      margin-bottom:1rem;
    }
    .map-search-bar i {
      position:absolute; left:1rem; top:50%;
      transform:translateY(-50%); color:var(--accent); font-size:.95rem; pointer-events:none;
    }
    .map-search-bar input {
      width:100%;
      border:1.5px solid var(--border); border-radius:50px;
      padding:.72rem 1rem .72rem 2.6rem;
      font-size:.9rem; font-family:inherit; color:var(--heading);
      background:#fafefe; outline:none; transition:border-color .2s;
    }
    .map-search-bar input:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .map-search-bar input::placeholder { color:#b0c4c6; }
    #searchResults {
      position:absolute; top:calc(100% + 6px); left:0; right:0;
      background:#fff; border:1.5px solid var(--border); border-radius:14px;
      box-shadow:0 12px 36px rgba(9,154,167,.12); z-index:1000;
      max-height:220px; overflow-y:auto; display:none;
    }
    .sr-item {
      padding:.72rem 1rem; cursor:pointer; font-size:.86rem;
      color:var(--heading); border-bottom:1px solid var(--border);
      display:flex; align-items:flex-start; gap:.6rem; transition:background .12s;
    }
    .sr-item:last-child { border-bottom:none; }
    .sr-item:hover { background:var(--mint); }
    .sr-item i { color:var(--accent); flex-shrink:0; margin-top:.1rem; }
    .sr-item span { font-size:.75rem; color:var(--muted); display:block; margin-top:.1rem; }

    /* Instrução do mapa */
    .map-tip { background:var(--mint); border-radius:12px; padding:.75rem 1rem; font-size:.82rem; color:var(--accent); display:flex; align-items:center; gap:.5rem; margin-bottom:1rem; }
    .map-tip i { flex-shrink:0; font-size:.9rem; }

    /* ─── FORM FIELDS ─── */
    .fc-label { font-size:.82rem; font-weight:700; color:var(--heading); margin-bottom:.42rem; display:flex; align-items:center; gap:.35rem; }
    .fc-label i { color:var(--accent); font-size:.85rem; }
    .fc-input { width:100%; border:1.5px solid var(--border); border-radius:14px; padding:.72rem 1rem; font-size:.9rem; font-family:inherit; color:var(--heading); background:#fafefe; transition:border-color .2s,box-shadow .2s; outline:none; }
    .fc-input:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); background:#fff; }
    .fc-input::placeholder { color:#b0c4c6; }
    .fc-input:read-only { background:#f0f8f8; color:var(--muted); cursor:default; }
    .fc-hint { font-size:.75rem; color:var(--muted); margin-top:.35rem; display:flex; align-items:center; gap:.3rem; }
    .fc-hint i { color:var(--accent); }
    .fc-divider { height:1px; background:var(--border); margin:1.5rem 0; }

    /* Coords display */
    .coords-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
    .coord-box { background:var(--mint); border:1.5px solid var(--border); border-radius:14px; padding:.8rem 1rem; display:flex; align-items:center; gap:.6rem; }
    .coord-box i { color:var(--accent); font-size:1rem; flex-shrink:0; }
    .coord-box .coord-label { font-size:.7rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.05em; }
    .coord-box .coord-val { font-size:.88rem; font-weight:700; color:var(--heading); }

    /* ─── BUTTONS ─── */
    .btn-loc { display:inline-flex; align-items:center; gap:.45rem; background:var(--soft); color:var(--accent); border:none; border-radius:50px; padding:.6rem 1.2rem; font-size:.85rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .22s; white-space:nowrap; }
    .btn-loc:hover { background:var(--accent); color:#fff; }
    .btn-save { background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.78rem 2rem; font-size:.92rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .25s; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-save:hover { background:var(--accent-dark); transform:translateY(-2px); box-shadow:0 8px 24px rgba(9,154,167,.25); }
    .btn-cancel { background:transparent; color:var(--muted); border:1.5px solid var(--border); border-radius:50px; padding:.78rem 1.5rem; font-size:.9rem; font-weight:600; font-family:inherit; cursor:pointer; transition:all .25s; text-decoration:none; display:inline-flex; align-items:center; }
    .btn-cancel:hover { border-color:var(--heading); color:var(--heading); }

    /* ─── TOAST ─── */
    .toast-fc { position:fixed; bottom:28px; right:28px; background:var(--heading); color:#fff; border-radius:16px; padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem; box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px; pointer-events:none; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span   { font-size:.78rem; color:rgba(255,255,255,.65); }

    /* Leaflet popup override */
    .leaflet-popup-content-wrapper { border-radius:14px; box-shadow:0 8px 28px rgba(9,154,167,.18); }
    .leaflet-popup-content { font-family:'Inter',sans-serif; font-size:.82rem; color:var(--heading); }

    @media(max-width:768px) {
      #map { height:320px; }
      .coords-row { grid-template-columns:1fr; }
    }
  </style>
</head>
<body>

@include('clientes.dashboard.header')

<!-- ─── TOPBAR ─── -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">
    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <a href="{{ route('perfil.clientes') }}">Meu Perfil</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <span class="cur">{{ isset($endereco) ? 'Editar endereço' : 'Novo endereço' }}</span>
    </div>
    <h2>{{ isset($endereco) ? 'Editar endereço' : 'Adicionar endereço' }}</h2>
    <p>Marque o ponto exacto no mapa ou pesquise pelo nome do local</p>
  </div>
</div>

<!-- ─── CONTEÚDO ─── -->
<div class="map-page-wrap">
  <div class="container-xl">
    <div class="row g-4 mt-0">

      {{-- Coluna mapa --}}
      <div class="col-lg-8">
        <div class="pcard">
          <div class="pcard-header">
            <div class="pcard-icon"><i class="bi bi-map"></i></div>
            <div>
              <h5>Marcar no mapa</h5>
              <p>Clique no mapa ou pesquise um local para definir o endereço</p>
            </div>
          </div>
          <div class="pcard-body">

            {{-- Barra de pesquisa Nominatim --}}
            <div class="map-search-bar" id="searchWrap">
              <i class="bi bi-search"></i>
              <input type="text" id="mapSearch" placeholder="Ex: Rua dos Coqueiros, Luanda…"
                     autocomplete="off" oninput="onSearchInput(this.value)">
              <div id="searchResults"></div>
            </div>

            {{-- Dica --}}
            <div class="map-tip">
              <i class="bi bi-info-circle-fill"></i>
              Clique num ponto do mapa para o marcar, ou pesquise um endereço acima.
              O marcador pode ser arrastado para ajustar a posição.
            </div>

            {{-- Botão GPS --}}
            <div class="mb-3">
              <button type="button" class="btn-loc" onclick="useGPS()">
                <i class="bi bi-crosshair2"></i> Usar a minha localização actual
              </button>
            </div>

            {{-- Mapa Leaflet --}}
            <div id="map"></div>

            {{-- Coordenadas detectadas --}}
            <div class="coords-row" id="coordsRow" style="{{ isset($endereco) && $endereco->latitude ? '' : 'display:none' }}">
              <div class="coord-box">
                <i class="bi bi-geo-alt-fill"></i>
                <div>
                  <div class="coord-label">Latitude</div>
                  <div class="coord-val" id="dispLat">{{ $endereco->latitude ?? '—' }}</div>
                </div>
              </div>
              <div class="coord-box">
                <i class="bi bi-compass-fill"></i>
                <div>
                  <div class="coord-label">Longitude</div>
                  <div class="coord-val" id="dispLng">{{ $endereco->longitude ?? '—' }}</div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      {{-- Coluna form --}}
      <div class="col-lg-4">
        <div class="pcard" style="position:sticky;top:88px">
          <div class="pcard-header">
            <div class="pcard-icon"><i class="bi bi-pencil-square"></i></div>
            <div>
              <h5>Detalhes do endereço</h5>
              <p>Confirme ou edite o nome do local</p>
            </div>
          </div>
          <div class="pcard-body">

            {{--
              ════════════════════════════════════
              FORM — action: enderecos.store (POST)
              Em modo edição, usa PUT via _method.
              ════════════════════════════════════
            --}}
            <form id="enderecoForm"
                  action="{{ route('enderecos.store') }}"
                  method="POST"
                  novalidate>
              @csrf

              {{-- Em edição, troca para PUT --}}
              @if(isset($endereco))
                @method('PUT')
              @endif

              {{-- Nome / descrição do endereço --}}
              <div class="mb-3">
                <label class="fc-label" for="fName">
                  <i class="bi bi-house"></i> Nome do endereço
                </label>
                <input type="text" class="fc-input" id="fName" name="name"
                       placeholder="Ex: Casa, Escritório, Farmácia…"
                       value="{{ $endereco->name ?? '' }}" required>
                <div class="fc-hint"><i class="bi bi-info-circle"></i> Este nome aparece na lista de endereços</div>
              </div>

              {{-- Endereço completo (preenchido pelo mapa) --}}
              <div class="mb-3">
                <label class="fc-label" for="fEndereco">
                  <i class="bi bi-geo-alt"></i> Endereço completo
                </label>
                <input type="text" class="fc-input" id="fEndereco" name="endereco"
                       placeholder="Preenchido automaticamente pelo mapa"
                       value="{{ $endereco->endereco ?? '' }}" readonly>
                <div class="fc-hint"><i class="bi bi-info-circle"></i> Clique no mapa para preencher</div>
              </div>

              {{-- Latitude (hidden + readonly para confirmação visual) --}}
              <input type="hidden" name="latitude"  id="hLat"  value="{{ $endereco->latitude  ?? '' }}">
              <input type="hidden" name="longitude" id="hLng"  value="{{ $endereco->longitude ?? '' }}">

              {{-- Indicador visual do status --}}
              <div id="statusBox" class="map-tip" style="{{ isset($endereco) && $endereco->latitude ? '' : 'display:none' }}">
                <i class="bi bi-check-circle-fill"></i>
                <span id="statusMsg">Localização marcada com sucesso.</span>
              </div>

              <div class="fc-divider"></div>

              <div class="d-flex flex-column gap-2">
                <button type="submit" class="btn-save" id="btnGuardar"
                        {{ (!isset($endereco) || !$endereco->latitude) ? 'disabled' : '' }}
                        style="{{ (!isset($endereco) || !$endereco->latitude) ? 'opacity:.5;cursor:not-allowed' : '' }}">
                  <i class="bi bi-check2-circle"></i>
                  {{ isset($endereco) ? 'Actualizar endereço' : 'Guardar endereço' }}
                </button>
                <a href="{{ route('perfil.clientes') }}" class="btn-cancel" style="justify-content:center">
                  <i class="bi bi-arrow-left me-1"></i> Cancelar
                </a>
              </div>

              @if($errors->any())
                <div style="background:#fdecea;border-radius:12px;padding:.8rem 1rem;margin-top:1rem;font-size:.82rem;color:#c0392b;">
                  <i class="bi bi-exclamation-triangle-fill me-1"></i>
                  {{ $errors->first() }}
                </div>
              @endif

            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@include('clientes.dashboard.footer')

<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle">Localização marcada!</strong><span id="toastMsg"></span></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ═══════════════════════════════════════════════════════════
   MAPA LEAFLET + OPENSTREETMAP / NOMINATIM
   ─────────────────────────────────────────────────────────
   Fluxo:
   1. Mapa centrado em Luanda (ou nas coordenadas do endereço
      se estiver em modo edição).
   2. Clique no mapa → move o marcador e faz reverse geocode
      via Nominatim para obter o nome do local.
   3. Pesquisa por texto → Nominatim forward geocode, lista
      resultados, clique seleciona e move marcador.
   4. GPS → navigator.geolocation, move marcador.
   5. Campos hidden latitude/longitude + input endereco são
      preenchidos automaticamente.
   6. Botão Guardar só fica activo depois de marcar.
═══════════════════════════════════════════════════════════ */

/* ── Valores iniciais (modo edição vs. novo) ── */
const INIT_LAT  = {{ isset($endereco) && $endereco->latitude  ? $endereco->latitude  : -8.8383  }};
const INIT_LNG  = {{ isset($endereco) && $endereco->longitude ? $endereco->longitude : 13.2344  }};
const IS_EDIT   = {{ isset($endereco) && $endereco->latitude ? 'true' : 'false' }};
const INIT_ZOOM = IS_EDIT ? 16 : 13;

/* ── Inicializar mapa ── */
const map = L.map('map').setView([INIT_LAT, INIT_LNG], INIT_ZOOM);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  maxZoom: 19,
}).addTo(map);

/* Ícone personalizado */
const pinIcon = L.divIcon({
  className: '',
  html: `<div style="
    width:36px;height:36px;
    background:var(--accent,#099aa7);
    border:3px solid #fff;
    border-radius:50% 50% 50% 0;
    transform:rotate(-45deg);
    box-shadow:0 4px 14px rgba(9,154,167,.4);
  "></div>`,
  iconSize:   [36, 36],
  iconAnchor: [18, 36],
  popupAnchor:[0, -38],
});

/* Marcador — começa no centro se for novo */
let marker = null;
if (IS_EDIT) {
  marker = L.marker([INIT_LAT, INIT_LNG], { draggable: true, icon: pinIcon }).addTo(map);
  marker.on('dragend', () => {
    const p = marker.getLatLng();
    updateCoords(p.lat, p.lng);
    reverseGeocode(p.lat, p.lng);
  });
}

/* ── Clique no mapa ── */
map.on('click', e => {
  const { lat, lng } = e.latlng;
  setMarker(lat, lng);
  reverseGeocode(lat, lng);
});

function setMarker(lat, lng) {
  if (marker) {
    marker.setLatLng([lat, lng]);
  } else {
    marker = L.marker([lat, lng], { draggable: true, icon: pinIcon }).addTo(map);
    marker.on('dragend', () => {
      const p = marker.getLatLng();
      updateCoords(p.lat, p.lng);
      reverseGeocode(p.lat, p.lng);
    });
  }
  updateCoords(lat, lng);
  map.panTo([lat, lng]);
}

function updateCoords(lat, lng) {
  const latR = parseFloat(lat).toFixed(6);
  const lngR = parseFloat(lng).toFixed(6);

  document.getElementById('hLat').value    = latR;
  document.getElementById('hLng').value    = lngR;
  document.getElementById('dispLat').textContent = latR;
  document.getElementById('dispLng').textContent = lngR;

  document.getElementById('coordsRow').style.display  = '';
  document.getElementById('statusBox').style.display  = '';
  document.getElementById('statusMsg').textContent = 'Localização marcada — confirme o nome e guarde.';

  /* Activa o botão Guardar */
  const btn = document.getElementById('btnGuardar');
  btn.disabled = false;
  btn.style.opacity = '1';
  btn.style.cursor  = 'pointer';
}

/* ── Reverse geocode (clique → nome do local) ── */
async function reverseGeocode(lat, lng) {
  try {
    const r = await fetch(
      `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=pt`,
      { headers: { 'Accept-Language': 'pt' } }
    );
    const d = await r.json();
    if (d && d.display_name) {
      document.getElementById('fEndereco').value = d.display_name;
      marker?.bindPopup(`<strong>📍 ${d.display_name}</strong>`).openPopup();
    }
  } catch (_) { /* silencioso */ }
}

/* ── Pesquisa forward (Nominatim) ── */
let searchTimer = null;

function onSearchInput(val) {
  clearTimeout(searchTimer);
  const res = document.getElementById('searchResults');
  if (val.trim().length < 3) { res.style.display = 'none'; return; }
  searchTimer = setTimeout(() => forwardGeocode(val), 500);
}

async function forwardGeocode(q) {
  const res = document.getElementById('searchResults');
  try {
    const r = await fetch(
      `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}&limit=5&accept-language=pt&countrycodes=ao`,
      { headers: { 'Accept-Language': 'pt' } }
    );
    const data = await r.json();
    if (!data.length) {
      res.innerHTML = `<div class="sr-item"><i class="bi bi-x-circle"></i>Nenhum resultado encontrado.</div>`;
      res.style.display = 'block';
      return;
    }
    res.innerHTML = data.map(item => `
      <div class="sr-item" onclick="selectResult(${item.lat},${item.lon},'${item.display_name.replace(/'/g,"\\'")}')">
        <i class="bi bi-geo-alt-fill"></i>
        <div>
          <div>${item.display_name.split(',').slice(0,2).join(', ')}</div>
          <span>${item.display_name}</span>
        </div>
      </div>`).join('');
    res.style.display = 'block';
  } catch (_) { res.style.display = 'none'; }
}

function selectResult(lat, lng, name) {
  setMarker(lat, lng);
  document.getElementById('fEndereco').value = name;
  document.getElementById('mapSearch').value = name.split(',').slice(0,2).join(', ');
  document.getElementById('searchResults').style.display = 'none';
  map.setView([lat, lng], 17);
  marker?.bindPopup(`<strong>📍 ${name}</strong>`).openPopup();
}

/* Fechar resultados ao clicar fora */
document.addEventListener('click', e => {
  if (!document.getElementById('searchWrap').contains(e.target)) {
    document.getElementById('searchResults').style.display = 'none';
  }
});

/* ── GPS ── */
function useGPS() {
  if (!navigator.geolocation) { showToast('Não suportado','O seu browser não suporta geolocalização.'); return; }
  navigator.geolocation.getCurrentPosition(pos => {
    const { latitude: lat, longitude: lng } = pos.coords;
    setMarker(lat, lng);
    reverseGeocode(lat, lng);
    map.setView([lat, lng], 17);
    showToast('Localização detectada!', 'Marcador posicionado na sua localização actual.');
  }, () => {
    showToast('Erro de GPS', 'Não foi possível obter a sua localização.');
  });
}

/* ── Toast ── */
function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = ' ' + msg;
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3500);
}

/* ── Header scroll ── */
window.addEventListener('scroll', () => {
  document.getElementById('mainHeader')?.classList.toggle('scrolled', scrollY > 50);
});

/* ── Flash de sessão ── */
@if(session('success'))
  showToast('Endereço guardado!', '{{ session("success") }}');
@endif
</script>
</body>
</html>