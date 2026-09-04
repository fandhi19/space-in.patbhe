<?php

namespace App\Filament\Resources\PeminjamanRuangans\Pages;

use App\Filament\Resources\PeminjamanRuangans\PeminjamanRuanganResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPeminjamanRuangan extends EditRecord
{
    protected static string $resource = PeminjamanRuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            ->label("Hapus"),
        ];
    }

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Update')
            ->body('Data Peminjaman Ruangan Berhasil Diperbaharui.');
    }
    public function getBreadcrumb(): string
    {
        return 'Edit Data';
    }

    public function getTitle(): string
    {
        return 'Edit Data Peminjaman Ruangan';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
            ->label('Simpan Data')
            ->icon('heroicon-s-bookmark')
            ->color('info'),
            $this->getCancelFormAction()
            ->label('Tidak')
            ->icon('heroicon-s-x-circle')
            ->color('danger'),
        ];
    }

}
