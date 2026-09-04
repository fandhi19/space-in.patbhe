<?php

namespace App\Filament\Resources\PeminjamanBarangs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class PeminjamanBarangForm
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
                    ->helperText('Terisi otomatis: PB4B-tglmulai-kodebarang-urut'),
                TextInput::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->required(),
                TextInput::make('nip_nisn')
                    ->label('NIP/NISN')
                    ->required(),
                TextInput::make('jabatan_kelas')
                    ->label('Jabatan/Kelas')
                    ->required(),
                TextInput::make('unit_organisasi')
                    ->label('Unit Organisasi')
                    ->required(),
                
                 Repeater::make('details')
                    ->label('Daftar Barang')
                    ->relationship('details')
                    ->schema([
                        Select::make('barang_id')
                            ->label('Barang')
                            ->relationship('barang', 'nama_barang')
                            ->required()
                            ->reactive()
                            ->searchable()
                            ->preload(),
                        TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                    ])
                    ->columns(2)
                    ->required()
                    ->minItems(1),
                
                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->displayFormat('d/m/Y'),
                DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required()
                    ->displayFormat('d/m/Y')
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
                TextInput::make('kegiatan')
                    ->required()
                    ->label('Kegiatan'),
                Textarea::make('tujuan')
                    ->columnSpanFull()
                    ->label('Tujuan'),
                TextInput::make('no_hp')
                    ->required()
                    ->label('No. HP'),
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
}
