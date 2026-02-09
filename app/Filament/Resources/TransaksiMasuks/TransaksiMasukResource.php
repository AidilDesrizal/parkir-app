<?php

namespace App\Filament\Resources\TransaksiMasuks;

use App\Filament\Resources\TransaksiMasuks\Pages\CreateTransaksiMasuk;
use App\Filament\Resources\TransaksiMasuks\Pages\EditTransaksiMasuk;
use App\Filament\Resources\TransaksiMasuks\Pages\ListTransaksiMasuks;
use App\Filament\Resources\TransaksiMasuks\Schemas\TransaksiMasukForm;
use App\Filament\Resources\TransaksiMasuks\Tables\TransaksiMasuksTable;
use App\Models\TransaksiMasuk;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransaksiMasukResource extends Resource
{
    protected static ?string $model = TransaksiMasuk::class;

    /* =========================
       🏷 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel = 'Kendaraan Masuk';
    protected static ?string $modelLabel = 'Transaksi Masuk';
    protected static ?string $pluralModelLabel = 'Transaksi Masuk';
    protected static ?string $recordTitleAttribute = 'kode_tiket';

    /* =========================
       🎨 SIDEBAR PREMIUM
    ========================== */

    protected static UnitEnum|string|null $navigationGroup = 'Operasional Parkir';

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedArrowDownCircle;

    protected static ?int $navigationSort = 2;

    /* =========================
       🔢 BADGE COUNTER
    ========================== */

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
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
        return TransaksiMasukForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return TransaksiMasuksTable::configure($table);
    }

    /* ========================= */

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
            'index'  => ListTransaksiMasuks::route('/'),
            'create' => CreateTransaksiMasuk::route('/create'),
            'edit'   => EditTransaksiMasuk::route('/{record}/edit'),
        ];
    }
}
