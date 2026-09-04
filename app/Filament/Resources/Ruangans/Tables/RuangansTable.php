<?php

namespace App\Filament\Resources\Ruangans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RuangansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_ruangan')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_ruangan')
                    ->label('Nama Ruangan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fasilitas')
                    ->label('Fasilitas')
                    ->searchable(),
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
                ->modalDescription('Apakah anda yakin untuk menghapus data ruangan ?')
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
                    ->modalDescription('Apakah anda yakin untuk menghapus data ruangan ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),
            ]);
    }
}
