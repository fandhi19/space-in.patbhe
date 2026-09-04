<?php

namespace App\Filament\Resources\PengembalianBarangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengembalianBarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('peminjamanBarang.kode_peminjam')
                    ->label('Kode Peminjaman')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('peminjamanBarang.nama_peminjam')
                    ->label('Peminjam'),

                TextColumn::make('tanggal_pengembalian')
                    ->label('Tgl Kembali')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('jumlah_kembali')
                    ->label('Jumlah Kembali'),

                TextColumn::make('jumlah_hilang')
                    ->label('Hilang'),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(40)
                    ->wrap(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ->modalDescription('Apakah anda yakin untuk menghapus data pengembalian ruang ?')
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
                    ->modalDescription('Apakah anda yakin untuk menghapus data pengembalian barang ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),
            ]);
    }
}
