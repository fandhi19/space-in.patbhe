<?php

namespace App\Filament\Resources\PeminjamanKendaraans\Pages;

use App\Filament\Resources\PeminjamanKendaraans\PeminjamanKendaraanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamanKendaraans extends ListRecords
{
    protected static string $resource = PeminjamanKendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->Label("Data Baru")
            ->icon('heroicon-s-squares-plus')
            ->color('info'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Data Peminjaman';
    }

    public function getTitle(): string
    {
        return 'Daftar Data Peminjam Kendaraan';
    }
}
