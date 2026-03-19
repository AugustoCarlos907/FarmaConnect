<?php 

namespace App\Repositories\Interfaces;

interface FarmaInterface{
    
    public function getAllFarmacias($perPage);

    public function entregadoresByPharmacy($farmaciaId , $perPage);

    public function itemStockByPharmacy($farmaciaId);
}