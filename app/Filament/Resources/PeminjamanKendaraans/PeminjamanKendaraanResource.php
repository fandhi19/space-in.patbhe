<?php

namespace App\Filament\Resources\PeminjamanKendaraans;

use App\Filament\Resources\PeminjamanKendaraans\Pages\CreatePeminjamanKendaraan;
use App\Filament\Resources\PeminjamanKendaraans\Pages\EditPeminjamanKendaraan;
use App\Filament\Resources\PeminjamanKendaraans\Pages\ListPeminjamanKendaraans;
use App\Filament\Resources\PeminjamanKendaraans\Schemas\PeminjamanKendaraanForm;
use App\Filament\Resources\PeminjamanKendaraans\Tables\PeminjamanKendaraansTable;
use App\Models\PeminjamanKendaraan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class PeminjamanKendaraanResource extends Resource
{
    protected static ?string $model = PeminjamanKendaraan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-left-start-on-rectangle';

    protected static ?string $recordTitleAttribute = 'PeminjamanKendaraan';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Kendaraan';

    protected static ?string $navigationLabel = 'Peminjaman Kendaraan';

    protected static ?string $pluralModelLabel = 'Data Peminjaman Kendaraan';

    protected static ?string $modelLabel = 'Peminjaman Kendaraan';

    public static function form(Schema $schema): Schema
    {
        return PeminjamanKendaraanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeminjamanKendaraansTable::configure($table);
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
            'index' => ListPeminjamanKendaraans::route('/'),
            'create' => CreatePeminjamanKendaraan::route('/create'),
            'edit' => EditPeminjamanKendaraan::route('/{record}/edit'),
        ];
    }
}
