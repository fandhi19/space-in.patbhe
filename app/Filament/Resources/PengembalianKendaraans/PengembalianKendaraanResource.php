<?php

namespace App\Filament\Resources\PengembalianKendaraans;

use App\Filament\Resources\PengembalianKendaraans\Pages\CreatePengembalianKendaraan;
use App\Filament\Resources\PengembalianKendaraans\Pages\EditPengembalianKendaraan;
use App\Filament\Resources\PengembalianKendaraans\Pages\ListPengembalianKendaraans;
use App\Filament\Resources\PengembalianKendaraans\Schemas\PengembalianKendaraanForm;
use App\Filament\Resources\PengembalianKendaraans\Tables\PengembalianKendaraansTable;
use App\Models\PengembalianKendaraan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class PengembalianKendaraanResource extends Resource
{
    protected static ?string $model = PengembalianKendaraan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-left-end-on-rectangle';

    protected static ?string $recordTitleAttribute = 'PengembalianKendaraan';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Kendaraan';

    protected static ?string $navigationLabel = 'Pengembalian Kendaraan';

    protected static ?string $pluralModelLabel = 'Data Pengembalian Kendaraan';

    protected static ?string $modelLabel = 'Pengembalian Kendaraan';

    public static function form(Schema $schema): Schema
    {
        return PengembalianKendaraanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengembalianKendaraansTable::configure($table);
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
            'index' => ListPengembalianKendaraans::route('/'),
            'create' => CreatePengembalianKendaraan::route('/create'),
            'edit' => EditPengembalianKendaraan::route('/{record}/edit'),
        ];
    }
}
