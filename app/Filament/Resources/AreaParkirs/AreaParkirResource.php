<?php

namespace App\Filament\Resources\AreaParkirs;

use App\Filament\Resources\AreaParkirs\Pages\CreateAreaParkir;
use App\Filament\Resources\AreaParkirs\Pages\EditAreaParkir;
use App\Filament\Resources\AreaParkirs\Pages\ListAreaParkirs;
use App\Filament\Resources\AreaParkirs\Schemas\AreaParkirForm;
use App\Filament\Resources\AreaParkirs\Tables\AreaParkirsTable;
use App\Models\AreaParkir;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AreaParkirResource extends Resource
{
    protected static ?string $model = AreaParkir::class;

    /* =========================
       🎯 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel   = 'Area Parkir';
    protected static ?string $modelLabel        = 'Area';
    protected static ?string $pluralModelLabel  = 'Data Area Parkir';
    protected static ?string $recordTitleAttribute = 'nama_area';

    /* =========================
       🎨 SIDEBAR PREMIUM
    ========================== */

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedMapPin;

    protected static string|\UnitEnum|null $navigationGroup =
        'Master Data';

    protected static ?int $navigationSort = 1;

    /* =========================
       🔐 PERMISSION CLEAN
    ========================== */

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    /* =========================
       🧾 FORM
    ========================== */

    public static function form(Schema $schema): Schema
    {
        return AreaParkirForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return AreaParkirsTable::configure($table);
    }

    /* =========================
       🔗 PAGES
    ========================== */

    public static function getPages(): array
    {
        return [
            'index'  => ListAreaParkirs::route('/'),
            'create' => CreateAreaParkir::route('/create'),
            'edit'   => EditAreaParkir::route('/{record}/edit'),
        ];
    }
}
