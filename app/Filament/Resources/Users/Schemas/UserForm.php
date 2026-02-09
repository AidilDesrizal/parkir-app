<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* =========================
                   👤 INFORMASI PENGGUNA
                ========================== */

                Section::make('Profil Pengguna')
                    ->description('Data utama akun pengguna sistem parkir')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([

                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->placeholder('Contoh: Aidil Ramadhan')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-identification')
                            ->helperText('Nama akan ditampilkan di sistem'),


                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->placeholder('user@email.com')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->prefixIcon('heroicon-o-envelope')
                            ->helperText('Gunakan email aktif'),
                    ]),


                /* =========================
                   🛡 ROLE
                ========================== */

                Section::make('Hak Akses')
                    ->icon('heroicon-o-shield-check')
                    ->schema([

                        Select::make('role')
                            ->label('Role Pengguna')
                            ->options([
                                'admin' => 'Admin',
                                'petugas' => 'Petugas',
                                'owner' => 'Owner',
                            ])
                            ->required()
                            ->native(false)
                            ->helperText('Menentukan hak akses menu'),
                    ]),


                /* =========================
                   🔐 KEAMANAN
                ========================== */

                Section::make('Keamanan')
                    ->description('Pengaturan password login')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable() // 👁 toggle show/hide
                            ->placeholder('Minimal 6 karakter')
                            ->required(fn ($context) => $context === 'create')
                            ->minLength(6)
                            ->prefixIcon('heroicon-o-key')

                            ->dehydrateStateUsing(
                                fn ($state) =>
                                    filled($state)
                                        ? Hash::make($state)
                                        : null
                            )
                            ->dehydrated(fn ($state) => filled($state))

                            ->helperText('Kosongkan jika tidak ingin mengubah'),
                    ]),
            ]);
    }
}
