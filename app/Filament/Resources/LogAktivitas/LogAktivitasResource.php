<?php

namespace App\Filament\Resources\LogAktivitas;

use App\Filament\Resources\LogAktivitas\Pages\ListLogAktivitas;
use App\Filament\Resources\LogAktivitas\Schemas\LogAktivitasForm;
use App\Filament\Resources\LogAktivitas\Tables\LogAktivitasTable;
use App\Models\LogAktivitas;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogAktivitasResource extends Resource
{
    protected static ?string $model = LogAktivitas::class;

    /* =========================
       🏷 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel = 'Log Sistem';
    protected static ?string $modelLabel = 'Log';
    protected static ?string $pluralModelLabel = 'Log Aktivitas';
    protected static ?string $recordTitleAttribute = 'aksi';

    /* =========================
       🎨 SIDEBAR
    ========================== */

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedClipboardDocumentList;

    protected static string|\UnitEnum|null $navigationGroup =
        'System';

    protected static ?int $navigationSort = 99;

    /* =========================
       🔐 ADMIN ONLY
    ========================== */

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    /* =========================
       📋 FORM (READ ONLY — tetap ada untuk schema konsistensi)
    ========================== */

    public static function form(Schema $schema): Schema
    {
        return LogAktivitasForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return LogAktivitasTable::configure($table);
    }

    /* =========================
       🔗 PAGES
    ========================== */

    public static function getPages(): array
    {
        return [
            'index' => ListLogAktivitas::route('/'),
        ];
    }

    /* =========================
       🔒 READ ONLY ENFORCED
    ========================== */

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
