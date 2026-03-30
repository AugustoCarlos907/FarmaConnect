<?php

namespace App\Jobs;

use App\Mail\NotifyUserOrderCompleted;
use App\Models\Entrega;
use App\Models\Pedido;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class NotifyUserOrderCompletedJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Pedido $pedido,
        public Entrega $entrega
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          try {
        $user = $this->pedido->user;
        Mail::to($user->email)->send(new NotifyUserOrderCompleted($this->pedido, $this->entrega));
    } catch (\Exception $e) {
        \Log::error('Falha ao enviar e‑mail de notificação', [
            'pedido_id' => $this->pedido->id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        throw $e; 
    }    }
}
