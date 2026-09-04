<?php

namespace App\Filament\Resources\PeminjamanBarangs\Pages;

use App\Filament\Resources\PeminjamanBarangs\PeminjamanBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamanBarangs extends ListRecords
{
    protected static string $resource = PeminjamanBarangResource::class;

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
        return 'Daftar Data Peminjam Barang';
    }
}
