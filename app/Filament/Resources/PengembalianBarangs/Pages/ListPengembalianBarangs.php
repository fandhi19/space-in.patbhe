<?php

namespace App\Filament\Resources\PengembalianBarangs\Pages;

use App\Filament\Resources\PengembalianBarangs\PengembalianBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengembalianBarangs extends ListRecords
{
    protected static string $resource = PengembalianBarangResource::class;

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
        return 'Daftar Data Pengembalian Barang';
    }
}
