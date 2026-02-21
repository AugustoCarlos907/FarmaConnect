<?php

namespace App\Providers;

use App\Repositories\FileRepository;
use App\Repositories\Interfaces\FileInterface;
use App\Repositories\Interfaces\MedicamentoInterface;
use App\Repositories\Interfaces\PedidoInterface;
use App\Repositories\MedicamentoRepository;
use App\Repositories\PedidoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(FileInterface::class , FileRepository::class);
        $this->app->bind(MedicamentoInterface::class , MedicamentoRepository::class);
        $this->app->bind(PedidoInterface::class , PedidoRepository::class);
    }
}
