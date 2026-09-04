<?php

namespace App\Filament\Resources\Kendaraans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KendaraansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_kendaraan')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_kendaraan')
                    ->label('Nama Kendaraan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipe_kendaraan')
                    ->label('Tipe')
                    ->searchable(),

                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                ->button(),
                DeleteAction::make()
                ->button()
                ->label('Hapus')
                ->requiresConfirmation()
                ->modalHeading('Hapus Data')
                ->modalDescription('Apakah anda yakin untuk menghapus data kendaraan ?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Tidak'),
                ViewAction::make()
                ->button()
                ->label("Lihat"),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                    ->label("Hapus")->requiresConfirmation()
                    ->modalHeading('Hapus Data')
                    ->modalDescription('Apakah anda yakin untuk menghapus data Kendaraan ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),
            ]);
    }
}
