<?php

namespace App\Filament\Resources\PeminjamanBarangs\Tables;

use App\Helpers\WhatsappHelper;
use App\Models\PengembalianBarang;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_peminjam')
                    ->searchable()
                    ->label('Kode Peminjam'),

                TextColumn::make('nama_peminjam')
                    ->searchable()
                    ->label('Nama Peminjam'),

                TextColumn::make('nip_nisn')
                    ->searchable()
                    ->label('NIP/NISN'),

                TextColumn::make('jabatan_kelas')
                    ->searchable()
                    ->label('Jabatan/Kelas'),

                TextColumn::make('unit_organisasi')
                    ->searchable()
                    ->label('Unit Organisasi'),

                TextColumn::make('barang_summary')
                    ->label('Barang & Jumlah')
                    ->getStateUsing(fn ($record) => DB::table('peminjaman_barang_details')
                        ->join('barangs', 'barangs.id', '=', 'peminjaman_barang_details.barang_id')
                        ->where('peminjaman_barang_details.peminjaman_barang_id', $record->id)
                        ->select('barangs.nama_barang', DB::raw('SUM(peminjaman_barang_details.jumlah) as total'))
                        ->groupBy('barangs.id', 'barangs.nama_barang')
                        ->get()
                        ->map(fn ($row) => $row->nama_barang . ' (' . $row->total . ')')
                        ->join(', '))
                    ->searchable(false),

                TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Mulai'),

                TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Selesai'),

                TextColumn::make('jam_mulai')
                    ->time()
                    ->sortable()
                    ->label('Jam Mulai'),

                TextColumn::make('jam_selesai')
                    ->time()
                    ->sortable()
                    ->label('Jam Selesai'),

                TextColumn::make('kegiatan')
                    ->searchable()
                    ->label('Kegiatan'),

                TextColumn::make('no_hp')
                    ->searchable()
                    ->label('No. HP'),

                SelectColumn::make('status')
                    ->label('Status')
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

                        // Ambil daftar barang + jumlah
                        $barangList = $record->details
                            ->map(fn($d) => $d->barang->nama_barang . ' (' . $d->jumlah . ' unit)')
                            ->join(', ');

                        // Format tanggal & jam dengan aman
                        $tanggalMulai = \Carbon\Carbon::parse($record->tanggal_mulai)->format('d/m/Y');
                        $tanggalSelesai = $record->tanggal_selesai
                            ? \Carbon\Carbon::parse($record->tanggal_selesai)->format('d/m/Y')
                            : $tanggalMulai;

                        $jamMulai = $record->jam_mulai instanceof \Carbon\Carbon
                            ? $record->jam_mulai->format('H:i')
                            : substr($record->jam_mulai, 0, 5);
                        $jamSelesai = $record->jam_selesai instanceof \Carbon\Carbon
                            ? $record->jam_selesai->format('H:i')
                            : substr($record->jam_selesai, 0, 5);

                        // ✅ Notifikasi disetujui
                        if ($state === 'disetujui') {
                            if ($noHp) {
                                $pesan = "Halo *{$nama}*,\n\n"
                                    . "Pengajuan peminjaman barang Anda dengan kode *{$kode}* telah *DISETUJUI*.\n\n"
                                    . "📋 *Detail Peminjaman:*\n"
                                    . "Barang   : {$barangList}\n"
                                    . "Tanggal  : {$tanggalMulai} s/d {$tanggalSelesai}\n"
                                    . "Jam      : {$jamMulai} - {$jamSelesai}\n\n"
                                    . "Silakan ambil barang sesuai jadwal.\n\n"
                                    . "Terima kasih.\n"
                                    . "SPACE-IN PATBHE";

                                WhatsappHelper::send($noHp, $pesan);
                            }
                        }

                        // ❌ Notifikasi ditolak
                        if ($state === 'ditolak') {
                            if ($noHp) {
                                $pesan = "Halo *{$nama}*,\n\n"
                                    . "Mohon maaf, pengajuan peminjaman barang Anda dengan kode *{$kode}* *DITOLAK*.\n\n"
                                    . "📋 *Detail Peminjaman:*\n"
                                    . "Barang   : {$barangList}\n"
                                    . "Tanggal  : {$tanggalMulai} s/d {$tanggalSelesai}\n"
                                    . "Jam      : {$jamMulai} - {$jamSelesai}\n\n"
                                    . "Silakan hubungi admin untuk informasi lebih lanjut.\n\n"
                                    . "Terima kasih.\n"
                                    . "SPACE-IN PATBHE";

                                WhatsappHelper::send($noHp, $pesan);
                            }
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
                ->options([
                    'pending'   => 'Pending',
                    'disetujui' => 'Disetujui',
                    'ditolak'   => 'Ditolak',
                    'dikembalikan' => 'Dikembalikan',
                ]),
                SelectFilter::make('barang_id')
                    ->label('Barang')
                    ->relationship('barang', 'nama_barang'),
                ])
            
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(route('export.peminjaman-barang'))
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
                ->modalDescription('Apakah anda yakin untuk menghapus data peminjaman barang ?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Tidak'),
                ViewAction::make()
                ->button()
                ->label("Lihat"),
                
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->modalHeading('Form Pengembalian Barang')
                    ->modalButton('Simpan Pengembalian')
                    ->visible(fn ($record) => $record->status === 'disetujui')
                    ->form(function ($record) {
                        $details = $record->details()->with('barang')->get();
                        $schema = [];

                        $schema[] = DatePicker::make('tanggal_pengembalian')
                            ->label('Tanggal Pengembalian')
                            ->default(now())
                            ->required();

                        foreach ($details as $detail) {
                            $barang = $detail->barang;
                            $jumlahPinjam = $detail->jumlah;

                            $schema[] = Section::make("{$barang->nama_barang} (Dipinjam: {$jumlahPinjam})")
                                ->schema([
                                    Radio::make("kelengkapan_{$detail->id}")
                                        ->label('Kelengkapan')
                                        ->options([
                                            'lengkap'        => 'Lengkap (semua kembali)',
                                            'tidak_lengkap'  => 'Tidak Lengkap',
                                        ])
                                        ->default('lengkap')
                                        ->reactive()
                                        ->required(),
                                    TextInput::make("jumlah_hilang_{$detail->id}")
                                        ->label('Jumlah Hilang')
                                        ->numeric()
                                        ->default(0)
                                        ->minValue(0)
                                        ->maxValue($jumlahPinjam)
                                        ->visible(fn (callable $get) => $get("kelengkapan_{$detail->id}") === 'tidak_lengkap')
                                        ->reactive(),
                                    Placeholder::make("jumlah_kembali_{$detail->id}")
                                        ->label('Jumlah Kembali')
                                        ->content(function (callable $get) use ($jumlahPinjam, $detail) {
                                            $hilang = (int) ($get("jumlah_hilang_{$detail->id}") ?? 0);
                                            return $jumlahPinjam - $hilang;
                                        }),
                                ]);
                        }

                        $schema[] = Textarea::make('catatan')
                            ->label('Catatan Umum')
                            ->rows(2)
                            ->nullable();

                        return $schema;
                    })
                    ->action(function ($record, array $data) {
                        $details = $record->details()->with('barang')->get();
                        $tanggalKembali = $data['tanggal_pengembalian'];

                        DB::transaction(function () use ($record, $data, $tanggalKembali, $details) {
                            foreach ($details as $detail) {
                                $barang = $detail->barang;
                                $jumlahPinjam = $detail->jumlah;
                                $hilang = 0;
                                $kelengkapan = $data["kelengkapan_{$detail->id}"] ?? 'lengkap';

                                if ($kelengkapan === 'tidak_lengkap') {
                                    $hilang = (int) $data["jumlah_hilang_{$detail->id}"];
                                }
                                $kembali = $jumlahPinjam - $hilang;

                                // Simpan pengembalian per barang
                                PengembalianBarang::create([
                                    'peminjaman_barang_id' => $record->id,
                                    'barang_detail_id'     => $detail->id,
                                    'tanggal_pengembalian' => $tanggalKembali,
                                    'jumlah_kembali'       => $kembali,
                                    'jumlah_hilang'        => $hilang,
                                    'keterangan'           => $data['catatan'] ?? null,
                                    'catatan'              => null,
                                ]);

                                // Tambah stok hanya untuk barang yang kembali
                                if ($kembali > 0) {
                                    $barang->increment('stok', $kembali);
                                }
                            }

                            // Update status peminjaman menjadi 'dikembalikan'
                            $record->update(['status' => 'dikembalikan']);
                        });

                        Notification::make()
                            ->title('Pengembalian berhasil dicatat')
                            ->success()
                            ->send();
                    })
                ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                    ->label("Hapus")->requiresConfirmation()
                    ->modalHeading('Hapus Data')
                    ->modalDescription('Apakah anda yakin untuk menghapus data peminjaman barang ?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Tidak'),
                ])
                ->label("Lainnya"),

            ]);
    }
}
