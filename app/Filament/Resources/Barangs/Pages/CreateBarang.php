<?php

namespace App\Filament\Resources\Barangs\Pages;

use App\Filament\Resources\Barangs\BarangResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data Barang Berhasil Ditambahkan.');
    }

    public function getBreadcrumb(): string
    {
        return 'Buat Data';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
            ->label('Buat Data')
            ->icon('heroicon-s-folder-plus')
            ->color('info'),
            $this->getCreateAnotherFormAction()
            ->label('Buat data & Buat lagi')
            ->color('secondary')
            ->icon('heroicon-s-squares-plus'),
            $this->getCancelFormAction()
            ->label('Tidak')
            ->icon('heroicon-s-x-circle')
            ->color('danger'),
        ];
    }
}
