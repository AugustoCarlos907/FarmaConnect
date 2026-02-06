<?php

namespace App\Jobs;

use App\Models\StockFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ParseStockCsvJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public StockFile $stockFile)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
    }
}
