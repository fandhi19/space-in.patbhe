<?php

namespace App\Filament\Resources\PeminjamanRuangans\Tables;

use App\Helpers\WhatsappHelper;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PeminjamanRuangansTable
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
                TextColumn::make('nip_nisn')
                    ->label('NIP / NISN')
                    ->searchable(),
                TextColumn::make('jabatan_kelas')
                    ->label('Jabatan / Kelas')
                    ->searchable(),
                TextColumn::make('unit_organisasi')
                    ->label('Unit / Organisasi')
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable(),
                TextColumn::make('kegiatan')
                    ->label('Nama Kegiatan')
                    ->searchable(),
                TextColumn::make('ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_peserta')
                    ->label('Jumlah Peserta')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
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
                    ->label('Status')
                    ->options([
                        'pending'   => 'Pending',
                        'disetujui' => 'Disetujui',
                        'ditolak'   => 'Ditolak',
                    ])
                    ->afterStateUpdated(function ($record, $state) {
                        $nama = $record->nama_peminjam;
                        $noHp = $record->no_hp;
                        $kode = $record->kode_peminjam;
                        $ruangan = $record->ruangan->nama_ruangan ?? '-';

                        // Format tanggal & jam dengan aman
                        $tanggalMulai = Carbon::parse($record->tanggal_mulai)->format('d/m/Y');
                        $tanggalSelesai = $record->tanggal_selesai
                            ? Carbon::parse($record->tanggal_selesai)->format('d/m/Y')
                            : $tanggalMulai;

                        $jamMulai = $record->jam_mulai instanceof Carbon
                            ? $record->jam_mulai->format('H:i')
                            : substr($record->jam_mulai, 0, 5);
                        $jamSelesai = $record->jam_selesai instanceof Carbon
                            ? $record->jam_selesai->format('H:i')
                            : substr($record->jam_selesai, 0, 5);

                        // ✅ Notifikasi disetujui
                        if ($state === 'disetujui') {
                            $pesan = "Halo *{$nama}*,\n\n"
                                . "Pengajuan peminjaman ruangan Anda dengan kode *{$kode}* telah *DISETUJUI*.\n\n"
                                . "📋 *Detail Peminjaman:*\n"
                                . "Ruangan   : {$ruangan}\n"
                                . "Tanggal   : {$tanggalMulai} s/d {$tanggalSelesai}\n"
                                . "Jam       : {$jamMulai} - {$jamSelesai}\n\n"
                                . "Silakan gunakan ruangan sesuai jadwal.\n\n"
                                . "Terima kasih.\n"
                                . "SPACE-IN PATBHE";

                            WhatsappHelper::send($noHp, $pesan);
                        }

                        // ❌ Notifikasi ditolak
                        if ($state === 'ditolak') {
                            $pesan = "Halo *{$nama}*,\n\n"
                                . "Mohon maaf, pengajuan peminjaman ruangan Anda dengan kode *{$kode}* *DITOLAK*.\n\n"
                                . "📋 *Detail Peminjaman:*\n"
                                . "Ruangan   : {$ruangan}\n"
                                . "Tanggal   : {$tanggalMulai} s/d {$tanggalSelesai}\n"
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
            ])
            ->filters([
                SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'pending'   => 'Pending',
                    'disetujui' => 'Disetujui',
                    'ditolak'   => 'Ditolak',
                ]),

                SelectFilter::make('ruangan_id')
                ->label('Ruangan')
                ->relationship('ruangan', 'nama_ruangan'),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(route('export.peminjaman-ruangan'))
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
                ->modalDescription('Apakah anda yakin untuk menghapus data peminjaman ruangan ?')
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
                    ->modalDescription('Apakah anda yakin untuk menghapus data peminjaman ruangan ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),
            ]);
    }
}
