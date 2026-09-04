<?php

namespace App\Filament\Resources\Ruangans\Pages;

use App\Filament\Resources\Ruangans\RuanganResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditRuangan extends EditRecord
{
    protected static string $resource = RuanganResource::class;

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
            ->body('Data Ruangan Berhasil Diperbaharui.');
    }

    public function getBreadcrumb(): string
    {
        return 'Edit Data';
    }

    public function getTitle(): string
    {
        return 'Edit Data Ruangan';
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
