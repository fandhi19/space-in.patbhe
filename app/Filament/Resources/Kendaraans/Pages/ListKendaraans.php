<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKendaraans extends ListRecords
{
    protected static string $resource = KendaraanResource::class;

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
        return 'Data Kendaraan';
    }

    public function getTitle(): string
    {
        return 'Daftar Data Kendaraan';
    }
}
