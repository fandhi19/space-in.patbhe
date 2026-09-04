<?php

namespace App\Filament\Resources\PengembalianKendaraans\Pages;

use App\Filament\Resources\PengembalianKendaraans\PengembalianKendaraanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengembalianKendaraans extends ListRecords
{
    protected static string $resource = PengembalianKendaraanResource::class;

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
        return 'Data Pengembalian';
    }

    public function getTitle(): string
    {
        return 'Daftar Data Pengembalian Kendaraan';
    }
}
