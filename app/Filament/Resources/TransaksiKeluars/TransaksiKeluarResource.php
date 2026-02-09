<?php

namespace App\Filament\Resources\TransaksiKeluars;

use App\Filament\Resources\TransaksiKeluars\Pages\CreateTransaksiKeluar;
use App\Filament\Resources\TransaksiKeluars\Pages\EditTransaksiKeluar;
use App\Filament\Resources\TransaksiKeluars\Pages\ListTransaksiKeluars;
use App\Filament\Resources\TransaksiKeluars\Schemas\TransaksiKeluarForm;
use App\Filament\Resources\TransaksiKeluars\Tables\TransaksiKeluarsTable;
use App\Models\TransaksiKeluar;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransaksiKeluarResource extends Resource
{
    protected static ?string $model = TransaksiKeluar::class;

    /* =========================
       🏷 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel = 'Kendaraan Keluar';
    protected static ?string $modelLabel = 'Transaksi Keluar';
    protected static ?string $pluralModelLabel = 'Transaksi Keluar';
    protected static ?string $recordTitleAttribute = 'id';

    /* =========================
       🎨 SIDEBAR PREMIUM
    ========================== */

    protected static UnitEnum|string|null $navigationGroup = 'Operasional Parkir';

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedArrowRightCircle;

    protected static ?int $navigationSort = 3;

    /* =========================
       🔢 BADGE COUNTER
    ========================== */

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    /* =========================
       🔐 ROLE PETUGAS ONLY
    ========================== */

    protected static function isPetugas(): bool
    {
        return auth()->check() && auth()->user()->role === 'petugas';
    }

    public static function canViewAny(): bool
    {
        return self::isPetugas();
    }

    public static function canCreate(): bool
    {
        return self::isPetugas();
    }

    public static function canEdit($record): bool
    {
        return self::isPetugas();
    }

    public static function canDelete($record): bool
    {
        return self::isPetugas();
    }

    /* =========================
       🧾 FORM
    ========================== */

    public static function form(Schema $schema): Schema
    {
        return TransaksiKeluarForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return TransaksiKeluarsTable::configure($table);
    }

    /* =========================
       🔗 RELATION
    ========================== */

    public static function getRelations(): array
    {
        return [];
    }

    /* =========================
       📄 PAGES
    ========================== */

    public static function getPages(): array
    {
        return [
            'index'  => ListTransaksiKeluars::route('/'),
            'create' => CreateTransaksiKeluar::route('/create'),
            'edit'   => EditTransaksiKeluar::route('/{record}/edit'),
        ];
    }
}
