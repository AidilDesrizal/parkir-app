<?php

namespace App\Filament\Resources\TransaksiMasuks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Illuminate\Support\Str;

class TransaksiMasukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // =========================
                // SECTION TIKET
                // =========================
                Section::make('Informasi Tiket')
                    ->description('Data tiket dibuat otomatis oleh sistem')
                    ->columns(2)
                    ->schema([

                        TextInput::make('kode_tiket')
                            ->label('Kode Tiket')
                            ->default(fn () => 'TKT-' . strtoupper(Str::random(10)))
                            ->disabled()
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-qr-code')
                            ->helperText('Kode tiket auto generate')
                            ->required(),

                        DateTimePicker::make('waktu_masuk')
                            ->label('Waktu Masuk')
                            ->default(now())
                            ->seconds(false)
                            ->prefixIcon('heroicon-o-clock')
                            ->required(),

                    ]),

                // =========================
                // SECTION KENDARAAN
                // =========================
                Section::make('Kendaraan & Tarif')
                    ->columns(2)
                    ->schema([

                        Select::make('kendaraan_id')
                            ->label('Plat Nomor')
                            ->relationship('kendaraan', 'no_plat')
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih kendaraan')
                            ->prefixIcon('heroicon-o-truck')
                            ->required(),

                        Select::make('tarif_parkir_id')
                            ->label('Tarif Parkir')
                            ->relationship('tarifParkir', 'jenis_kendaraan')
                            ->getOptionLabelFromRecordUsing(
                                fn ($record) =>
                                    $record->jenis_kendaraan .
                                    ' • Rp ' . number_format($record->harga, 0, ',', '.')
                            )
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->helperText('Tarif sesuai jenis kendaraan')
                            ->required(),

                    ]),

                // =========================
                // SECTION AREA & USER
                // =========================
                Section::make('Area & Petugas')
                    ->columns(2)
                    ->schema([

                        Select::make('area_parkir_id')
                            ->label('Area Parkir')
                            ->relationship('areaParkir', 'nama_area')
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-map-pin')
                            ->required(),

                        Select::make('user_id')
                            ->label('Petugas')
                            ->relationship('user', 'name')
                            ->default(auth()->id())
                            ->disabled()
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-user')
                            ->helperText('Otomatis dari user login')
                            ->required(),

                    ]),
            ]);
    }
}
