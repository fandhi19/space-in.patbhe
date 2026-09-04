<?php

namespace App\Filament\Resources\PeminjamanRuangans\Pages;

use App\Filament\Resources\PeminjamanRuangans\PeminjamanRuanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamanRuangans extends ListRecords
{
    protected static string $resource = PeminjamanRuanganResource::class;

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
        return 'Daftar Data Peminjam Ruangan';
    }
}
