<?php

namespace App\Filament\Resources\TarifParkirs\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;

class TarifParkirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('💰 Konfigurasi Tarif Parkir')
                    ->description('Atur tarif berdasarkan jenis kendaraan')
                    ->columns(2)
                    ->schema([

                        TextInput::make('jenis_kendaraan')
                            ->label('Jenis Kendaraan')
                            ->placeholder('Contoh: Motor / Mobil')
                            ->prefixIcon('heroicon-o-truck')
                            ->helperText('Kategori kendaraan')
                            ->required()
                            ->maxLength(50),

                        TextInput::make('harga')
                            ->label('Tarif')
                            ->numeric()
                            ->prefix('Rp')
                            ->prefixIcon('heroicon-o-banknotes')
                            ->helperText('Biaya parkir per periode')
                            ->minValue(0)
                            ->required(),
                    ]),
            ]);
    }
}
