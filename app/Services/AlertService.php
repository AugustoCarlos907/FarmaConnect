<?php 

namespace App\Services;

use App\Jobs\SendStockAlertEmailJob;
use App\Models\StockItem;

class AlertService{



    public function checkLowPriceItems(float $limit = 5): void
    {
       $items = StockItem::query()
            ->where('quantity', '<', $limit)
            ->where('active', '1')
            ->get()
            ->groupBy('farmacia_id');

            foreach ($items as $farmaciaItems) {
               SendStockAlertEmailJob::dispatch($farmaciaItems); 
            }
    }
    
}