<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\PeminjamanBarangStats;
use App\Filament\Widgets\PeminjamanBarChart;
use App\Filament\Widgets\PeminjamanKendaraanStats;
use App\Filament\Widgets\PeminjamanRuanganStats;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('SPACE-IN PATBHE')
            ->favicon(asset('images/logo-web.png'))
            ->colors([
                'primary'   => Color::Blue,          // Biru utama (600)
                'secondary' => Color::Green,         // Hijau muda (500)
                'success'   => Color::Emerald,       // Hijau terang untuk sukses
                'info'      => Color::Teal,          // Hijau kebiruan untuk info
                'warning'   => Color::Amber,         // Kuning cerah untuk peringatan
                'danger'    => Color::Rose,          // Merah muda terang untuk danger
                'gray'      => Color::Slate,      // Abu-abu netral
            ])
            ->darkMode(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                //FilamentInfoWidget::class,
                PeminjamanRuanganStats::class,
                PeminjamanBarangStats::class,
                PeminjamanKendaraanStats::class,
                PeminjamanBarChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
