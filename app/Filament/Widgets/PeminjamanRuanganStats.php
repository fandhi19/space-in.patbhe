<?php

namespace App\Filament\Widgets;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PeminjamanRuanganStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Ruangan', Ruangan::count())
                ->description('Ruangan tersedia')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('success'),

            Stat::make('Peminjaman Ruangan', PeminjamanRuangan::count())
                ->description('Total pengajuan')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('primary'),

            Stat::make('Pending Ruangan', PeminjamanRuangan::where('status', 'pending')->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Disetujui Ruangan', PeminjamanRuangan::where('status', 'disetujui')->count())
                ->description('Aktif')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}