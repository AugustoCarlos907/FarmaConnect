<?php 

namespace App\Repositories\Interfaces;

interface MedicamentoInterface
{
    public function SearchMedicamento($search , $perPage ,  $userLat, $userLng , $min_price = null);

    public function getMedicamentoByCategoria($perPage);

    public function getMedicamentosByFarmacia($farmaciaId);
}