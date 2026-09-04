<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\PeminjamanBarang;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PeminjamanBarangStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Barang', Barang::count())
                ->description('Jenis barang tersedia')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('success'),

            Stat::make('Peminjaman Barang', PeminjamanBarang::count())
                ->description('Total pengajuan')
                ->descriptionIcon('heroicon-o-clipboard-document-check')
                ->color('primary'),

            Stat::make('Pending Barang', PeminjamanBarang::where('status', 'pending')->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Disetujui Barang', PeminjamanBarang::where('status', 'disetujui')->count())
                ->description('Aktif')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}