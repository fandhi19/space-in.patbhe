<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateKendaraan extends CreateRecord
{
    protected static string $resource = KendaraanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data Kendaraan Berhasil Ditambahkan.');
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
