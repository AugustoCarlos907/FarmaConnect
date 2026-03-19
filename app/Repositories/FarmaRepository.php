<?php 

namespace App\Repositories;

use App\Models\Entregador;
use App\Models\StockItem;
use App\Repositories\Interfaces\FarmaInterface;

class FarmaRepository implements FarmaInterface{

    public function getAllFarmacias($perPage) {
        return \App\Models\Farmacia::with('companhia')
                                    ->paginate($perPage);
    }


    public function entregadoresByPharmacy($farmaciaId, $perPage) {
        return Entregador::whereHas('farmacia', function($query) use ($farmaciaId) {
            $query->where('farmacia_id', $farmaciaId);
        })->paginate($perPage);
    }

    public function itemStockByPharmacy($farmaciaId){
        return StockItem::with('medicamento')
                        ->whereHas('farmacia', function($query) use ($farmaciaId) {
                            $query->where('farmacia_id', $farmaciaId);
                        })->get();
    }
}