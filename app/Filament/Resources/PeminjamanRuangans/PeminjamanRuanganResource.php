<?php

namespace App\Filament\Resources\PeminjamanRuangans;

use App\Filament\Resources\PeminjamanRuangans\Pages\CreatePeminjamanRuangan;
use App\Filament\Resources\PeminjamanRuangans\Pages\EditPeminjamanRuangan;
use App\Filament\Resources\PeminjamanRuangans\Pages\ListPeminjamanRuangans;
use App\Filament\Resources\PeminjamanRuangans\Schemas\PeminjamanRuanganForm;
use App\Filament\Resources\PeminjamanRuangans\Tables\PeminjamanRuangansTable;
use App\Models\PeminjamanRuangan;
use BackedEnum;
use Carbon\Carbon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class PeminjamanRuanganResource extends Resource
{
    protected static ?string $model = PeminjamanRuangan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-up-on-square';

    protected static ?string $recordTitleAttribute = 'PeminjamanRuangan';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Ruangan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Peminjaman Ruangan';

    protected static ?string $pluralModelLabel = 'Data Peminjaman Ruangan';

    protected static ?string $modelLabel = 'Peminjaman Ruangan';

    public static function form(Schema $schema): Schema
    {
        return PeminjamanRuanganForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeminjamanRuangansTable::configure($table);
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
            'index' => ListPeminjamanRuangans::route('/'),
            'create' => CreatePeminjamanRuangan::route('/create'),
            'edit' => EditPeminjamanRuangan::route('/{record}/edit'),
        ];
    }
}
