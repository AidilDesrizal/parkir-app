<?php

namespace App\Filament\Resources\Kendaraans\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class KendaraanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('🚗 Data Kendaraan')
                    ->description('Input identitas kendaraan pengunjung')
                    ->columns(2)
                    ->schema([

                        TextInput::make('no_plat')
                            ->label('Nomor Plat')
                            ->placeholder('Contoh: B 1234 XYZ')
                            ->prefixIcon('heroicon-o-identification')
                            ->helperText('Masukkan nomor polisi kendaraan')
                            ->maxLength(15)
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) =>
                                $set('no_plat', strtoupper($state))
                            ),

                        Select::make('jenis_kendaraan')
                            ->label('Jenis Kendaraan')
                            ->options([
                                'Motor' => 'Motor',
                                'Mobil' => 'Mobil',
                            ])
                            ->prefixIcon('heroicon-o-truck')
                            ->helperText('Pilih kategori kendaraan')
                            ->native(false) // dropdown modern
                            ->required(),

                    ]),
            ]);
    }
}
