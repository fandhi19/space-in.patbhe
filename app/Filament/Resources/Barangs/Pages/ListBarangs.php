<?php

namespace App\Filament\Resources\Barangs\Pages;

use App\Filament\Resources\Barangs\BarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBarangs extends ListRecords
{
    protected static string $resource = BarangResource::class;

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
        return 'Data Barang';
    }

    public function getTitle(): string
    {
        return 'Daftar Data Barang';
    }
}
