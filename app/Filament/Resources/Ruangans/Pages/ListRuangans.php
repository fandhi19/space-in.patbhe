<?php

namespace App\Filament\Resources\Ruangans\Pages;

use App\Filament\Resources\Ruangans\RuanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuangans extends ListRecords
{
    protected static string $resource = RuanganResource::class;

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
        return 'Data Ruangan';
    }

    public function getTitle(): string
    {
        return 'Daftar Data Ruangan';
    }
}
