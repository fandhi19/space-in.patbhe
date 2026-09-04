<?php

namespace App\Filament\Resources\PeminjamanKendaraans\Tables;

use App\Helpers\WhatsappHelper;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class PeminjamanKendaraansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_peminjam')
                    ->label('Kode Peminjam')
                    ->searchable(),
                TextColumn::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->searchable(),
                TextColumn::make('kendaraan.nama_kendaraan')
                    ->label('Kendaraan')
                    ->sortable(),
                TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->searchable(),
                TextColumn::make('nama_sopir')
                    ->label('Nama Sopir')
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable(),
                TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Peminjaman')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->time()
                    ->sortable(),
                SelectColumn::make('status')
                    ->options([
                        'pending'      => 'Pending',
                        'disetujui'    => 'Disetujui',
                        'ditolak'      => 'Ditolak',
                        'dikembalikan' => 'Dikembalikan',
                    ])
                    ->disabled(fn ($record) => $record->status === 'dikembalikan')
                    ->afterStateUpdated(function ($record, $state) {
                        $nama = $record->nama_peminjam;
                        $noHp = $record->no_hp;
                        $kode = $record->kode_peminjam;
                        $kendaraan = $record->kendaraan->nama_kendaraan ?? '-';
                        $tipe = $record->kendaraan->tipe_kendaraan ?? '';
                        $tanggalMulai = Carbon::parse($record->tanggal_mulai)->format('d/m/Y');
                        $jamMulai = $record->jam_mulai instanceof Carbon
                            ? $record->jam_mulai->format('H:i')
                            : substr($record->jam_mulai, 0, 5);
                        $jamSelesai = $record->jam_selesai instanceof Carbon
                            ? $record->jam_selesai->format('H:i')
                            : substr($record->jam_selesai, 0, 5);

                        if ($state === 'disetujui') {
                            $pesan = "Halo *{$nama}*,\n\n"
                                . "Pengajuan peminjaman kendaraan Anda dengan kode *{$kode}* telah *DISETUJUI*.\n\n"
                                . "📋 *Detail Peminjaman:*\n"
                                . "Kendaraan : {$kendaraan} ({$tipe})\n"
                                . "Tanggal   : {$tanggalMulai}\n"
                                . "Jam       : {$jamMulai} - {$jamSelesai}\n\n"
                                . "Silakan gunakan kendaraan sesuai jadwal.\n\n"
                                . "Terima kasih.\n"
                                . "SPACE-IN PATBHE";

                            WhatsappHelper::send($noHp, $pesan);
                        } elseif ($state === 'ditolak') {
                            $pesan = "Halo *{$nama}*,\n\n"
                                . "Mohon maaf, pengajuan peminjaman kendaraan Anda dengan kode *{$kode}* *DITOLAK*.\n\n"
                                . "📋 *Detail Peminjaman:*\n"
                                . "Kendaraan : {$kendaraan} ({$tipe})\n"
                                . "Tanggal   : {$tanggalMulai}\n"
                                . "Jam       : {$jamMulai} - {$jamSelesai}\n\n"
                                . "Silakan hubungi admin untuk informasi lebih lanjut.\n\n"
                                . "Terima kasih.\n"
                                . "SPACE-IN PATBHE";

                            WhatsappHelper::send($noHp, $pesan);
                        }

                        Notification::make()
                            ->title('Status peminjaman berhasil diubah!')
                            ->success()
                            ->send();
                    })
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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'      => 'Pending',
                        'disetujui'    => 'Disetujui',
                        'ditolak'      => 'Ditolak',
                        'dikembalikan' => 'Dikembalikan',
                    ]),

                SelectFilter::make('kendaraan_id')
                    ->label('Kendaraan')
                    ->relationship('kendaraan', 'nama_kendaraan'),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(route('export.peminjaman-kendaraan'))
                    ->openUrlInNewTab(),
            ])
            ->recordActions([
                EditAction::make()
                ->button(),
                DeleteAction::make()
                ->button()
                ->label('Hapus')
                ->requiresConfirmation()
                ->modalHeading('Hapus Data')
                ->modalDescription('Apakah anda yakin untuk menghapus data peminjaman kendaraan ?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Tidak'),
                ViewAction::make()
                ->button()
                ->label("Lihat"),

                Action::make('kembalikan')
                ->label('Kembalikan')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('success')
                ->modalHeading('Form Pengembalian Kendaraan')
                ->modalButton('Simpan Pengembalian')
                ->visible(fn ($record) => $record->status === 'disetujui')
                ->form([
                    DatePicker::make('tanggal_pengembalian')
                        ->label('Tanggal Pengembalian')
                        ->default(now())
                        ->required(),
                    Select::make('kondisi')
                        ->label('Kondisi Kendaraan')
                        ->options([
                            'Baik' => 'Baik',
                            'Rusak' => 'Rusak',
                        ])
                        ->default('Baik')
                        ->required(),
                    Textarea::make('keterangan')
                        ->label('Keterangan')
                        ->rows(2)
                        ->nullable(),
                ])
                ->action(function ($record, array $data) {
                    DB::transaction(function () use ($record, $data) {
                        \App\Models\PengembalianKendaraan::create([
                            'peminjaman_kendaraan_id' => $record->id,
                            'tanggal_pengembalian' => $data['tanggal_pengembalian'],
                            'kondisi' => $data['kondisi'],
                            'keterangan' => $data['keterangan'] ?? null,
                        ]);

                        $record->update(['status' => 'dikembalikan']);
                    });

                    \Filament\Notifications\Notification::make()
                        ->title('Pengembalian kendaraan berhasil dicatat')
                        ->success()
                        ->send();
                })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                    ->label("Hapus")->requiresConfirmation()
                    ->modalHeading('Hapus Data')
                    ->modalDescription('Apakah anda yakin untuk menghapus data peminjaman kendaraan ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),
            ]);
    }
}
