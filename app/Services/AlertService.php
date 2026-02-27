<?php 

namespace App\Services;

use App\Jobs\SendStockAlertEmailJob;
use App\Models\AlertaStock;
use App\Models\StockItem;
use App\Repositories\Interfaces\AlertStockInterface;

class AlertService{
   public function __construct( public AlertStockInterface $repository){}


   public function getAlerts($paginate){
      $this->repository->getAlerts($paginate);
   }

    public function checkLowPriceItems(float $limit = 5): void
    {
       $items = StockItem::query()
            ->where('quantity', '<', $limit)
            ->where('active', '1')
            ->get()
            ->groupBy('farmacia_id');

            foreach ($items as $farmaciaItems) {

               $tipoAlerta = match (true) {
                  $farmaciaItems->count() <= 5 => 'Baixo_Stock',
                  $farmaciaItems->count() <=10  => 'validade_proxima' 
               };

               AlertaStock::create([
                  'stock_items_id' =>  $farmaciaItems->id,
                  'tipo' => $tipoAlerta,
                  'mensagem ' => "Existem " . $farmaciaItems->count() . " itens com stock baixo.",
               ]);

               SendStockAlertEmailJob::dispatch($farmaciaItems); 
            }
    }
    
}