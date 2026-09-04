<?php

namespace App\Filament\Resources\PeminjamanKendaraans\Schemas;

use App\Models\PeminjamanKendaraan;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class PeminjamanKendaraanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_peminjam')
                ->label('Kode Peminjaman')
                ->disabled()
                ->dehydrated(false)
                ->hidden(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
                TextInput::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->required(),
                Select::make('kendaraan_id')
                    ->label('Kendaraan')
                    ->relationship('kendaraan', 'nama_kendaraan')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->rules([
                        fn (callable $get) => fn (string $attribute, $value, \Closure $fail) => (
                            (function () use ($get, $value, $fail) {
                                $tanggal   = $get('tanggal_mulai');
                                $jamMulai  = $get('jam_mulai');
                                $jamSelesai= $get('jam_selesai');

                                if (!$tanggal || !$jamMulai || !$jamSelesai) return;

                                $start = Carbon::parse($tanggal . ' ' . $jamMulai);
                                $end   = Carbon::parse($tanggal . ' ' . $jamSelesai);

                                $conflict = PeminjamanKendaraan::where('kendaraan_id', $value)
                                    ->where('status', '!=', 'ditolak')
                                    ->whereDate('tanggal_mulai', $tanggal)
                                    ->where(function ($q) use ($start, $end) {
                                        $q->whereTime('jam_mulai', '<', $end->toTimeString())
                                        ->whereTime('jam_selesai', '>', $start->toTimeString());
                                    })
                                    ->exists();

                                if ($conflict) {
                                    $fail('Kendaraan sudah dipinjam pada tanggal dan jam tersebut.');
                                }
                            })()
                        ),
                    ]),
                TextInput::make('tujuan')
                    ->label('Tujuan')
                    ->required(),
                TextInput::make('nama_sopir')
                    ->label('Nama Sopir')
                    ->required(),
                TextInput::make('no_hp')
                    ->label('No. HP')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Peminjaman')
                    ->displayFormat('d/m/Y')
                    ->required(),
                TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->required(),
                TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'disetujui' => 'Disetujui',
                        'ditolak'   => 'Ditolak',
                        'dikembalikan' => 'Dikembalikan',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
