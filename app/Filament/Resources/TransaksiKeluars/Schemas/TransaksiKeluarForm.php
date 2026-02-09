<?php

namespace App\Filament\Resources\TransaksiKeluars\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use App\Models\TransaksiMasuk;

class TransaksiKeluarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // =========================
                // PILIH TRANSAKSI MASUK
                // =========================
                Section::make('🚗 Pilih Kendaraan Keluar')
                    ->description('Tampilkan hanya kendaraan yang masih parkir')
                    ->columns(1)
                    ->schema([

                        Select::make('transaksi_masuk_id')
                            ->label('Tiket Parkir')
                            ->relationship(
                                name: 'masuk',
                                titleAttribute: 'kode_tiket',
                                modifyQueryUsing: fn ($query) =>
                                    $query
                                        ->doesntHave('keluar')
                                        ->with('kendaraan')
                            )

                            ->getOptionLabelFromRecordUsing(
                                fn ($record) =>
                                    "{$record->kode_tiket} — " .
                                    ($record->kendaraan->no_plat ?? '-') .
                                    " — {$record->waktu_masuk}"
                            )

                            ->getSearchResultsUsing(fn ($search) =>
                                TransaksiMasuk::with('kendaraan')
                                    ->where('kode_tiket', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->get()
                                    ->mapWithKeys(fn ($record) => [
                                        $record->id =>
                                            "{$record->kode_tiket} — {$record->kendaraan->no_plat} — {$record->waktu_masuk}"
                                    ])
                            )

                            ->getOptionLabelUsing(fn ($value) =>
                                optional(
                                    TransaksiMasuk::with('kendaraan')->find($value)
                                )?->kode_tiket
                                ? optional(
                                    TransaksiMasuk::with('kendaraan')->find($value)
                                )->kode_tiket . ' — ' .
                                optional(
                                    TransaksiMasuk::with('kendaraan')->find($value)
                                )->kendaraan->no_plat . ' — ' .
                                optional(
                                    TransaksiMasuk::with('kendaraan')->find($value)
                                )->waktu_masuk
                                : $value
                            )

                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-ticket')
                            ->helperText('Cari kode tiket / plat nomor')
                            ->required(),
                    ]),

                // =========================
                // HASIL PERHITUNGAN
                // =========================
                Section::make('💰 Ringkasan Biaya')
                    ->description('Dihitung otomatis saat tiket dipilih')
                    ->columns(2)
                    ->schema([

                        TextInput::make('durasi_menit')
                            ->label('Durasi Parkir')
                            ->suffix('menit')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-o-clock')
                            ->helperText('Otomatis dari waktu masuk'),

                        TextInput::make('biaya')
                            ->label('Total Biaya')
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-o-banknotes')
                            ->helperText('Dihitung dari tarif parkir'),
                    ]),
            ]);
    }
}
