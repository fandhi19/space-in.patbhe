<?php

namespace App\Filament\Resources\PengembalianBarangs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengembalianBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('peminjaman_barang_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_pengembalian')
                    ->required(),
                TextInput::make('jumlah_kembali')
                    ->required()
                    ->numeric(),
                TextInput::make('jumlah_hilang')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}
