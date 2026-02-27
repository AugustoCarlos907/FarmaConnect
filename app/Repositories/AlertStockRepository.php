<?php 

namespace App\Repositories;

use App\Models\AlertaStock;
use App\Repositories\Interfaces\AlertStockInterface;

class AlertStockRepository implements AlertStockInterface{

public function getAlerts ($paginate){
    return AlertaStock::with('stockItem')
                        ->orderByDesc( 'id')
                        ->paginate($paginate);
}

}