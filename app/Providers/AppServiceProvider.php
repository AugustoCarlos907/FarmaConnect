<?php

namespace App\Providers;

use App\Repositories\AlertStockRepository;
use App\Repositories\AvaliacaoRepository;
use App\Repositories\FarmaRepository;
use App\Repositories\FileRepository;
use App\Repositories\Interfaces\AlertStockInterface;
use App\Repositories\Interfaces\AvaliacaoInterface;
use App\Repositories\Interfaces\FarmaInterface;
use App\Repositories\Interfaces\FileInterface;
use App\Repositories\Interfaces\MedicamentoInterface;
use App\Repositories\Interfaces\PedidoInterface;
use App\Repositories\MedicamentoRepository;
use App\Repositories\PedidoRepository;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(AlertStockInterface::class , AlertStockRepository::class);
        $this->app->bind(AvaliacaoInterface::class , AvaliacaoRepository::class);
        $this->app->bind(FarmaInterface::class , FarmaRepository::class);
        Paginator::useBootstrapFive();
    }
}
