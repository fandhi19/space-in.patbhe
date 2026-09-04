<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\CreateRecord;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_barang')
                    ->label('Kode Barang')
                    ->disabled()
                    ->dehydrated()
                    ->default(function ($livewire) {
                        if ($livewire instanceof CreateRecord) {
                            return self::generateKodeBarang();
                        }
                        return null;
                    })
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->helperText('Format: B4B-001, B4B-002, ...'),
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(255),
                TextInput::make('stok')
                    ->label('Stok')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
            ]);
    }

    // Method generate kode barang
    public static function generateKodeBarang(): string
    {
        $prefix = 'B4B-';
        $last = \App\Models\Barang::where('kode_barang', 'like', $prefix . '%')
            ->orderBy('kode_barang', 'desc')
            ->first();
        if ($last) {
            $number = (int) substr($last->kode_barang, strlen($prefix));
            $next = $number + 1;
        } else {
            $next = 1;
        }
        return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
