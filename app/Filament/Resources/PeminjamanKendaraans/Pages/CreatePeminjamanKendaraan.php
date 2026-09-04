<?php

namespace App\Filament\Resources\PeminjamanKendaraans\Pages;

use App\Filament\Resources\PeminjamanKendaraans\PeminjamanKendaraanResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePeminjamanKendaraan extends CreateRecord
{
    protected static string $resource = PeminjamanKendaraanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data Peminjaman Kendaraan Berhasil Ditambahkan.');
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
