<?php

namespace App\Filament\Widgets;

use App\Models\Kendaraan;
use App\Models\PeminjamanKendaraan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PeminjamanKendaraanStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kendaraan', Kendaraan::count())
                ->description('Kendaraan tersedia')
                ->descriptionIcon('heroicon-o-truck')
                ->color('success'),

            Stat::make('Peminjaman Kendaraan', PeminjamanKendaraan::count())
                ->description('Total pengajuan')
                ->descriptionIcon('heroicon-o-key')
                ->color('primary'),

            Stat::make('Pending Kendaraan', PeminjamanKendaraan::where('status', 'pending')->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Disetujui Kendaraan', PeminjamanKendaraan::where('status', 'disetujui')->count())
                ->description('Aktif')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}