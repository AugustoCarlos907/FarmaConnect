<?php 

namespace App\Repositories\Interfaces;

interface PedidoInterface{

    public function getPedidosDeHojeByPharmacy($perPage);
    public function getAllPedidosByPharmacy($perPage);
}