<?php

namespace App\Filament\Resources\TarifParkirs;

use App\Filament\Resources\TarifParkirs\Pages\CreateTarifParkir;
use App\Filament\Resources\TarifParkirs\Pages\EditTarifParkir;
use App\Filament\Resources\TarifParkirs\Pages\ListTarifParkirs;
use App\Filament\Resources\TarifParkirs\Schemas\TarifParkirForm;
use App\Filament\Resources\TarifParkirs\Tables\TarifParkirsTable;
use App\Models\TarifParkir;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TarifParkirResource extends Resource
{
    protected static ?string $model = TarifParkir::class;

    /* =========================
       🏷 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel = 'Tarif Parkir';
    protected static ?string $modelLabel = 'Tarif';
    protected static ?string $pluralModelLabel = 'Data Tarif Parkir';
    protected static ?string $recordTitleAttribute = 'jenis_kendaraan';

    /* =========================
       🎨 SIDEBAR
    ========================== */

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCurrencyDollar;

    protected static string|\UnitEnum|null $navigationGroup =
        'Master Data';

    protected static ?int $navigationSort = 3;

    /* =========================
       🔐 ADMIN ONLY
    ========================== */

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()?->role === 'admin';
    }

    /* =========================
       🧾 FORM
    ========================== */

    public static function form(Schema $schema): Schema
    {
        return TarifParkirForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return TarifParkirsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    /* =========================
       🔗 PAGES
    ========================== */

    public static function getPages(): array
    {
        return [
            'index'  => ListTarifParkirs::route('/'),
            'create' => CreateTarifParkir::route('/create'),
            'edit'   => EditTarifParkir::route('/{record}/edit'),
        ];
    }
}
