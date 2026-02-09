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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    /* =========================
       🏷 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel = 'Kendaraan';
    protected static ?string $modelLabel = 'Kendaraan';
    protected static ?string $pluralModelLabel = 'Data Kendaraan';
    protected static ?string $recordTitleAttribute = 'no_plat';

    /* =========================
       🎨 SIDEBAR PREMIUM
    ========================== */

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedTruck;

    protected static string|\UnitEnum|null $navigationGroup =
        'Master Data';

    protected static ?int $navigationSort = 2;

    /* =========================
       🔢 BADGE JUMLAH DATA
    ========================== */

   
    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    /* =========================
       🔐 PERMISSION CLEAN
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
        return KendaraanForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return KendaraansTable::configure($table);
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
            'index' => ListKendaraans::route('/'),
            'create' => CreateKendaraan::route('/create'),
            'edit' => EditKendaraan::route('/{record}/edit'),
        ];
    }
}
