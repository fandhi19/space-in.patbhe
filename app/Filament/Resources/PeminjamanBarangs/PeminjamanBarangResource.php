<?php

namespace App\Filament\Resources\PeminjamanBarangs;

use App\Filament\Resources\PeminjamanBarangs\Pages\CreatePeminjamanBarang;
use App\Filament\Resources\PeminjamanBarangs\Pages\EditPeminjamanBarang;
use App\Filament\Resources\PeminjamanBarangs\Pages\ListPeminjamanBarangs;
use App\Filament\Resources\PeminjamanBarangs\Schemas\PeminjamanBarangForm;
use App\Filament\Resources\PeminjamanBarangs\Tables\PeminjamanBarangsTable;
use App\Models\PeminjamanBarang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;


class PeminjamanBarangResource extends Resource
{
    protected static ?string $model = PeminjamanBarang::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    protected static ?string $recordTitleAttribute = 'PeminjamanBarang';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Barang';

    protected static ?string $navigationLabel = 'Peminjaman Barang';

    protected static ?string $pluralModelLabel = 'Data Peminjaman Barang';

    protected static ?string $modelLabel = 'Peminjaman Barang';

    public static function form(Schema $schema): Schema
    {
        return PeminjamanBarangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeminjamanBarangsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->latest();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPeminjamanBarangs::route('/'),
            'create' => CreatePeminjamanBarang::route('/create'),
            'edit' => EditPeminjamanBarang::route('/{record}/edit'),
        ];
    }
}
