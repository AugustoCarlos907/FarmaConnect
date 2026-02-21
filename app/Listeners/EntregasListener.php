<?php

namespace App\Listeners;

use App\Events\EntregasEvent;
use App\Services\EntregaService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EntregasListener
{
    /**
     * Create the event listener.
     */
    public function __construct(public EntregaService $service)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EntregasEvent $event): void
    {
        $this->service->criarEntrega($event->pedido);
    }
}
