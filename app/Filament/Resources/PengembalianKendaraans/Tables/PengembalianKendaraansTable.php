<?php

namespace App\Filament\Resources\PengembalianKendaraans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengembalianKendaraansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('peminjamanKendaraan.kode_peminjam')
                    ->label('Kode Peminjaman')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('peminjamanKendaraan.kendaraan.nama_kendaraan')
                ->label('Kendaraan')
                ->searchable(),
                TextColumn::make('peminjamanKendaraan.nama_peminjam')
                    ->label('Peminjam')
                    ->searchable(),

                TextColumn::make('tanggal_pengembalian')
                    ->label('Tgl Kembali')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baik' => 'success',
                        'rusak' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => $state === 'baik' ? 'Baik' : 'Rusak'),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Dicatat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
                ->modalDescription('Apakah anda yakin untuk menghapus data pengembalian kendaraan ?')
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
                    ->modalDescription('Apakah anda yakin untuk menghapus data pengembalian kendaraan ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),
            ]);
    }
}
