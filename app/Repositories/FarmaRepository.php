<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\FarmaInterface;

class FarmaRepository implements FarmaInterface{

    public function getAllFarmacias($perPage) {
        return \App\Models\Farmacia::with('companhia')
                                    ->paginate($perPage);
    }

}