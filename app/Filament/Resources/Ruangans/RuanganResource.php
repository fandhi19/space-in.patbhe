<?php

namespace App\Filament\Resources\Ruangans;

use App\Filament\Resources\Ruangans\Pages\CreateRuangan;
use App\Filament\Resources\Ruangans\Pages\EditRuangan;
use App\Filament\Resources\Ruangans\Pages\ListRuangans;
use App\Filament\Resources\Ruangans\Schemas\RuanganForm;
use App\Filament\Resources\Ruangans\Tables\RuangansTable;
use App\Models\Ruangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
//use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class RuanganResource extends Resource
{
    protected static ?string $model = Ruangan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $recordTitleAttribute = 'Ruangan';

    protected static string|UnitEnum|null $navigationGroup = 'Data Peminjaman Ruangan';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Data Ruangan';

    protected static ?string $pluralModelLabel = 'Data Ruangan';

    protected static ?string $modelLabel = 'Ruangan';

    public static function form(Schema $schema): Schema
    {
        return RuanganForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RuangansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRuangans::route('/'),
            'create' => CreateRuangan::route('/create'),
            'edit' => EditRuangan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->latest();
    }

    public static function generateKodeRuangan(): string
    {
        $prefix = 'R4B-';
        // Ambil kode terakhir dengan prefix tersebut, urut menurun
        $last = \App\Models\Ruangan::where('kode_ruangan', 'like', $prefix . '%')
            ->orderBy('kode_ruangan', 'desc')
            ->first();

        if ($last) {
            // Ambil angka di belakang, misal dari "R4B-005" ambil 5
            $number = (int) substr($last->kode_ruangan, strlen($prefix));
            $next = $number + 1;
        } else {
            $next = 1;
        }

        // Format jadi 3 digit: 001, 002, ...
        return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
