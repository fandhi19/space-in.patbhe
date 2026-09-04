<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

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
            ->body('Data admin Berhasil Diperbaharui.');
    }

    public function getBreadcrumb(): string
    {
        return 'Edit Data';
    }

    public function getTitle(): string
    {
        return 'Edit Data User SPACE-IN';
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
