<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    /* =========================
       🏷 LABEL MODERN
    ========================== */

    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'Manajemen User';
    protected static ?string $recordTitleAttribute = 'name';

    /* =========================
       🎨 SIDEBAR
    ========================== */

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUsers;

    protected static string|\UnitEnum|null $navigationGroup =
        'System';

    protected static ?int $navigationSort = 1;

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
        return UserForm::configure($schema);
    }

    /* =========================
       📊 TABLE
    ========================== */

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    /* =========================
       🔗 PAGES
    ========================== */

    public static function getPages(): array
    {
        return [
            'index'  => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit'   => EditUser::route('/{record}/edit'),
        ];
    }
}
