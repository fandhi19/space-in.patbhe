<?php

namespace App\Filament\Resources\PeminjamanRuangans\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class PeminjamanRuanganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_peminjam')
                    ->label('Kode Peminjam')
                    ->disabled()
                    ->dehydrated()
                    ->maxLength(255)
                    ->helperText('Terisi otomatis: PR4B-tglmulai-koderuangan-urut'),

                TextInput::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nip_nisn')
                    ->label('NIP / NISN')
                    ->required()
                    ->maxLength(255),

                TextInput::make('jabatan_kelas')
                    ->label('Jabatan / Kelas')
                    ->required()
                    ->maxLength(255),

                TextInput::make('unit_organisasi')
                    ->label('Unit / Organisasi')
                    ->required()
                    ->maxLength(255),

                TextInput::make('no_hp')
                    ->label('No. HP')
                    ->tel()
                    ->required()
                    ->maxLength(15),

                TextInput::make('kegiatan')
                    ->label('Nama Kegiatan')
                    ->required()
                    ->maxLength(255),

                Textarea::make('tujuan')
                    ->label('Tujuan')
                    ->rows(3)
                    ->nullable(),

                Select::make('ruangan_id')
                    ->label('Ruangan')
                    ->relationship('ruangan', 'nama_ruangan') // relasi ke model Ruangan, tampilkan nama_ruangan
                    ->searchable()
                    ->preload()
                    ->required()
                    ->rules([
                        fn (callable $get) => function (string $_attribute, $value, \Closure $fail) use ($get) {
                            // Ambil nilai field lainnya
                            $tanggalMulai = $get('tanggal_mulai');
                            $tanggalSelesai = $get('tanggal_selesai');
                            $jamMulai = $get('jam_mulai');
                            $jamSelesai = $get('jam_selesai');

                            // Hanya lakukan validasi jika semua field sudah diisi
                            if ($tanggalMulai && $tanggalSelesai && $jamMulai && $jamSelesai) {
                                // Gabungkan tanggal dan jam menjadi DateTime penuh
                                $start = Carbon::parse("{$tanggalMulai} {$jamMulai}");
                                $end   = Carbon::parse("{$tanggalSelesai} {$jamSelesai}");

                                // Query peminjaman yang bentrok
                                $conflict = \App\Models\PeminjamanRuangan::where('ruangan_id', $value)
                                    ->where('status', '!=', 'ditolak') // Abaikan yang ditolak
                                    ->where(function ($query) use ($start, $end) {
                                        $query
                                            // Cek irisan tanggal
                                            ->whereDate('tanggal_mulai', '<=', $end->toDateString())
                                            ->whereDate('tanggal_selesai', '>=', $start->toDateString())
                                            // Cek irisan jam
                                            ->whereTime('jam_mulai', '<', $end->toTimeString())
                                            ->whereTime('jam_selesai', '>', $start->toTimeString());
                                    });

                                // Jika sedang edit, kecualikan record yang sedang diedit
                                $currentRecord = request()->route('record');
                                $currentRecordId = is_object($currentRecord)
                                    ? $currentRecord->getKey()
                                    : $currentRecord;

                                if ($currentRecordId) {
                                    $conflict->where('id', '!=', $currentRecordId);
                                }

                                // Jika ada peminjaman bentrok, tampilkan pesan error
                                if ($conflict->exists()) {
                                    $fail('❌ Ruangan sudah dipinjam pada rentang tanggal & jam tersebut. Silakan pilih waktu lain.');
                                }
                            }
                        },
                    ]),

                TextInput::make('jumlah_peserta')
                    ->label('Jumlah Peserta')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->displayFormat('d/m/Y')
                    ->required(),

                DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->afterOrEqual('tanggal_mulai'),

                TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->withoutSeconds()
                    ->required(),

                TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->withoutSeconds()
                    ->required()
                    ->after('jam_mulai'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending'   => 'Pending',
                        'disetujui' => 'Disetujui',
                        'ditolak'   => 'Ditolak',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    protected static function updateKodePeminjam(callable $get, callable $set): void
    {
        $tanggalMulai = $get('tanggal_mulai');
        $ruanganId = $get('ruangan_id');

        if (! $tanggalMulai || ! $ruanganId) {
            return;
        }

        $tanggal = is_string($tanggalMulai)
            ? date('dmy', strtotime($tanggalMulai))
            : $tanggalMulai->format('dmy');

        $kodeRuangan = sprintf('R%s', $ruanganId);
        $kode = sprintf('PR4B-%s-%s', $tanggal, $kodeRuangan);

        $set('kode_peminjam', $kode);
    }
}
