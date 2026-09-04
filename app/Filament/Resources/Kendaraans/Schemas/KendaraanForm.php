<?php

namespace App\Filament\Resources\Kendaraans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KendaraanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_kendaraan')
                ->label('Kode Kendaraan')
                ->disabled()
                ->dehydrated()
                ->default(function ($livewire) {
                    if ($livewire instanceof \Filament\Resources\Pages\CreateRecord) {
                        return self::generateKodeKendaraan();
                    }
                    return null;
                })
                ->unique(ignoreRecord: true)
                ->required(),
            TextInput::make('nama_kendaraan')
                ->label('Nama Kendaraan')
                ->required(),
            TextInput::make('tipe_kendaraan')
                ->label('Tipe Kendaraan')
                ->required(),
            TextInput::make('kapasitas')
                ->label('Kapasitas')
                ->numeric()
                ->minValue(1)
                ->required(),
                        ]);
    }
    public static function generateKodeKendaraan(): string
    {
        $prefix = 'KND-';
        $last = \App\Models\Kendaraan::where('kode_kendaraan', 'like', $prefix . '%')
            ->orderBy('kode_kendaraan', 'desc')->first();
        $nextNumber = $last ? ((int) substr($last->kode_kendaraan, strlen($prefix))) + 1 : 1;
        return $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
