<?php

namespace App\Providers;

use App\Models\PeminjamanBarang;
use App\Models\PeminjamanBarangDetail;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use App\Observers\PeminjamanBarangDetailObserver;
use App\Observers\PeminjamanBarangObserver;
use App\Observers\PeminjamanKendaraanObserver;
use App\Observers\PeminjamanRuanganObserver;
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
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        
        PeminjamanRuangan::observe(PeminjamanRuanganObserver::class);
        PeminjamanBarang::observe(PeminjamanBarangObserver::class);
        PeminjamanBarangDetail::observe(PeminjamanBarangDetailObserver::class);
        PeminjamanKendaraan::observe(PeminjamanKendaraanObserver::class);
    }
}
