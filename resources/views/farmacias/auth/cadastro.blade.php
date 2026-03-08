<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>FarmaConnect · Registo de Farmácia</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
body{
background: linear-gradient(145deg,#f8fbfb 0%,#ffffff 100%);
font-family: 'Inter', sans-serif;
padding:40px 0;
}
.card{
border-radius:30px;
box-shadow:0 20px 40px -12px rgba(9,154,167,0.1);
border:none;
}
#map{
height:320px;
border-radius:20px;
border:2px solid #dff3f0;
}
.section-title{
font-weight:700;
margin-top:40px;
margin-bottom:15px;
}
</style>
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-10">

<div class="card p-5">

<h3 class="text-center fw-bold mb-4">
Registo de Farmácia
</h3>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST"
action="{{ route('companhia.farmacia.register') }}"
enctype="multipart/form-data">
@csrf

<!-- ================= DADOS FARMÁCIA ================= -->
<div class="section-title">Dados da Farmácia</div>

<div class="row g-3">

<div class="col-md-6">
<label>Nome da Farmácia *</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6">
<label>NIF *</label>
<input type="text" name="nif" class="form-control" required>
</div>

<div class="col-md-6">
<label>Alvará</label>
<input type="text" name="alvara" class="form-control">
</div>

<div class="col-md-6">
<label>Upload do Alvará</label>
<input type="file" name="alvara_file" class="form-control">
</div>

</div>

<!-- ================= LOCALIZAÇÃO ================= -->
<div class="section-title">Localização da Farmácia</div>

<div class="row g-3">

<div class="col-md-4">
<label>Rua</label>
<input type="text" id="rua" name="rua" class="form-control">
</div>

<div class="col-md-4">
<label>Bairro</label>
<input type="text" id="bairro" name="bairro" class="form-control">
</div>

<div class="col-md-4">
<label>Município</label>
<input type="text" id="municipio" name="municipio" class="form-control">
</div>

</div>

<input type="hidden" name="endereco" id="endereco">
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">

<div id="map" class="mt-3"></div>

<!-- ================= GESTOR ================= -->
<div class="section-title">Gestor da Farmácia</div>

<div class="row g-3">

<div class="col-md-6">
<label>Nome *</label>
<input type="text" name="gestor_name" class="form-control" required>
</div>

<div class="col-md-6">
<label>Email *</label>
<input type="email" name="gestor_email" class="form-control" required>
</div>

<div class="col-md-6">
<label>Senha *</label>
<input type="password" name="gestor_password" class="form-control" required>
</div>

</div>

<div class="form-check mt-4">
<input type="checkbox" class="form-check-input" required>
<label class="form-check-label">
Aceito os termos
</label>
</div>

<button class="btn btn-primary w-100 mt-4">
Registar Farmácia
</button>

</form>
</div>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

let map = L.map('map').setView([-8.8383, 13.2344], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
maxZoom:19
}).addTo(map);

let marker = L.marker([-8.8383,13.2344],{draggable:true}).addTo(map);

updateCoordinates(-8.8383,13.2344);
reverseGeocode(-8.8383,13.2344);

/* Atualizar coordenadas */
function updateCoordinates(lat,lng){
document.getElementById('latitude').value=lat;
document.getElementById('longitude').value=lng;
}

/* Reverse Geocoding */
async function reverseGeocode(lat,lng){
try{
let response=await fetch(
`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`
);
let data=await response.json();

if(data.address){

let rua=data.address.road||data.address.residential||'';
let bairro=data.address.suburb||data.address.neighbourhood||'';
let municipio=data.address.city||data.address.town||'';

document.getElementById('rua').value=rua;
document.getElementById('bairro').value=bairro;
document.getElementById('municipio').value=municipio;

document.getElementById('endereco').value=
`${rua}, ${bairro}, ${municipio}, Luanda, Angola`;

}

}catch(e){
console.log("Erro geocoding:",e);
}
}

/* Arrastar marcador */
marker.on('dragend',function(e){
let pos=marker.getLatLng();
updateCoordinates(pos.lat,pos.lng);
reverseGeocode(pos.lat,pos.lng);
});

/* Clique no mapa */
map.on('click',function(e){
marker.setLatLng(e.latlng);
updateCoordinates(e.latlng.lat,e.latlng.lng);
reverseGeocode(e.latlng.lat,e.latlng.lng);
});

/* Garantir endereço antes de enviar */
document.querySelector('form').addEventListener('submit',function(){
let rua=document.getElementById('rua').value;
let bairro=document.getElementById('bairro').value;
let municipio=document.getElementById('municipio').value;

document.getElementById('endereco').value=
`${rua}, ${bairro}, ${municipio}, Luanda, Angola`;
});

});
</script>

</body>
</html>