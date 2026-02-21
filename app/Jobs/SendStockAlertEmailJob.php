<?php

namespace App\Jobs;

use App\Mail\LowStockItemsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendStockAlertEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Collection $items)
    {
        //
    }

    /**
     * Execute the job.
     */
   public function handle(): void
    {
        $firstItem = $this->items->first();

        if (!$firstItem) {
            logger()->warning('Coleção de stock vazia');
            return;
        }

        $pharmacy = $firstItem->farmacia;

        if (!$pharmacy || empty($pharmacy->email)) {
            logger()->warning('Farmácia sem email configurado', [
                'pharmacy_id' => $pharmacy?->id,
            ]);
            return;
        }

        Mail::to($pharmacy->email)
            ->send(new LowStockItemsMail($this->items));
   }

}
