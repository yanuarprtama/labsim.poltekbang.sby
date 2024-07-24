<?php

namespace App\Providers;

use App\Services\peminjaman\inventaris\inventarisService;
use App\Services\peminjaman\inventaris\inventarisServiceImplement;
use App\Services\peminjaman\laboratorium\laboratoriumService;
use App\Services\peminjaman\laboratorium\laboratoriumServiceImplement;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(inventarisService::class, inventarisServiceImplement::class);
        $this->app->bind(laboratoriumService::class, laboratoriumServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::useVite();
    }
}
