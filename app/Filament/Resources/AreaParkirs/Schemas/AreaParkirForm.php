<?php

namespace App\Filament\Resources\AreaParkirs\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;

class AreaParkirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('📍 Data Area Parkir')
                    ->description('Konfigurasi area dan kapasitas parkir')
                    ->columns(2)
                    ->schema([

                        TextInput::make('nama_area')
                            ->label('Nama Area')
                            ->placeholder('Contoh: Basement A')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->helperText('Nama unik area parkir')
                            ->required()
                            ->maxLength(50),

                        TextInput::make('kapasitas')
                            ->label('Kapasitas Slot')
                            ->numeric()
                            ->placeholder('Contoh: 120')
                            ->prefixIcon('heroicon-o-hashtag')
                            ->helperText('Jumlah maksimal kendaraan')
                            ->minValue(1)
                            ->required(),

                    ]),
            ]);
    }
}
