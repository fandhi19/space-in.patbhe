<?php

namespace App\Filament\Resources\PengembalianBarangs;

use App\Filament\Resources\PengembalianBarangs\Pages\CreatePengembalianBarang;
use App\Filament\Resources\PengembalianBarangs\Pages\EditPengembalianBarang;
use App\Filament\Resources\PengembalianBarangs\Pages\ListPengembalianBarangs;
use App\Filament\Resources\PengembalianBarangs\Schemas\PengembalianBarangForm;
use App\Filament\Resources\PengembalianBarangs\Tables\PengembalianBarangsTable;
use App\Models\PengembalianBarang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
// use Illuminate\Database\Eloquent\Builder;

class PengembalianBarangResource extends Resource
{
    protected static ?string $model = PengembalianBarang::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $recordTitleAttribute = 'PengembalianBarang';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Barang';

    protected static ?string $navigationLabel = 'Pengembalian Barang';

    protected static ?string $pluralModelLabel = 'Data Pengembalian Barang';

    protected static ?string $modelLabel = 'Pengembalian Barang';


    public static function form(Schema $schema): Schema
    {
        return PengembalianBarangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengembalianBarangsTable::configure($table);
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

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->with('details.barang');
    // }

    public static function getPages(): array
    {
        return [
            'index' => ListPengembalianBarangs::route('/'),
            'create' => CreatePengembalianBarang::route('/create'),
            'edit' => EditPengembalianBarang::route('/{record}/edit'),
        ];
    }
}
