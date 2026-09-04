<?php

namespace App\Filament\Resources\PengembalianKendaraans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengembalianKendaraanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('peminjaman_kendaraan_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_pengembalian')
                    ->required(),
                Select::make('kondisi')
                    ->options(['baik' => 'Baik', 'rusak' => 'Rusak'])
                    ->default('baik')
                    ->required(),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
