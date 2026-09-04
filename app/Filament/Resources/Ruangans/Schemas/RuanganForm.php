<?php

namespace App\Filament\Resources\Ruangans\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class RuanganForm
{
    public static function generateKodeRuangan(): string
    {
        $latestRuangan = \App\Models\Ruangan::latest('id')->first();
        $nextNumber = ($latestRuangan ? (int)substr($latestRuangan->kode_ruangan, -3) : 0) + 1;
        return 'R4B-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_ruangan')
                    ->label('Kode Ruangan')
                    ->disabled()                         // tidak bisa diedit user
                    ->dehydrated()                       // tetap kirim nilai saat submit
                    ->default(function ($livewire) {
                        // Hanya generate otomatis saat membuat record baru
                        if ($livewire instanceof CreateRecord) {
                            return self::generateKodeRuangan();
                        }
                        return null; // saat edit, akan mengambil dari database
                    })
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->helperText('Kode ruangan dibuat otomatis: R4B-001, R4B-002, dst.'),

                TextInput::make('nama_ruangan')
                    ->label('Nama Ruangan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kapasitas')
                    ->label('Kapasitas (orang)')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Textarea::make('fasilitas')
                    ->label('Fasilitas')
                    ->rows(3)
                    ->nullable()
                    ->helperText('Tulis fasilitas yang tersedia, pisahkan dengan koma. Contoh: Proyektor, AC, Papan Tulis'),
            ]);
    }
}
