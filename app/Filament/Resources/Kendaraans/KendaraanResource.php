<?php

namespace App\Filament\Resources\Kendaraans;

use App\Filament\Resources\Kendaraans\Pages\CreateKendaraan;
use App\Filament\Resources\Kendaraans\Pages\EditKendaraan;
use App\Filament\Resources\Kendaraans\Pages\ListKendaraans;
use App\Filament\Resources\Kendaraans\Schemas\KendaraanForm;
use App\Filament\Resources\Kendaraans\Tables\KendaraansTable;
use App\Models\Kendaraan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-truck';

    protected static ?string $recordTitleAttribute = 'Kendaraan';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Kendaraan';

    protected static ?string $navigationLabel = 'Data Kendaraan';

    protected static ?string $pluralModelLabel = 'Data Kendaraan';

    protected static ?string $modelLabel = 'Data Kendaraan';

    public static function form(Schema $schema): Schema
    {
        return KendaraanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KendaraansTable::configure($table);
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
            'index' => ListKendaraans::route('/'),
            'create' => CreateKendaraan::route('/create'),
            'edit' => EditKendaraan::route('/{record}/edit'),
        ];
    }
}
