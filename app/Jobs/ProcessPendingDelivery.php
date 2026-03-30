<?php

namespace App\Jobs;

use App\Models\Pedido;
use App\Services\EntregaService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPendingDelivery implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $tries = 5; // Número de tentativas
    public $backoff = 300; // 5 minutos entre tentativas

    public function __construct(
        public Pedido $pedido
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(EntregaService $entregaService): void
    {
        // Se o pedido já tiver entrega, não faz nada
        if ($this->pedido->entrega) {
            return;
        }

        try {
            $entrega = $entregaService->criarEntrega($this->pedido);

            // Se chegou aqui, a entrega foi criada com sucesso
            // Atualiza o status do pedido para 'Em Entrega'
            $this->pedido->update(['status' => 'Em Entrega']);

            $this->pedido->load(['user', 'items.stockItem.medicamento']);

            NotifyUserOrderCompletedJob::dispatch($this->pedido, $entrega);

        } catch (\Exception $e) {
                throw $e;
        }
    }
}
