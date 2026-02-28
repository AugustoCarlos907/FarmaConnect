<?php 

namespace App\Services;

use App\Models\StockItem;


class StockService { 
    public function __construct(
        public StockItem $stockItem
    ){}

    
}