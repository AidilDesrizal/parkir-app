<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class TransaksiKeluar extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keluars';

    protected $fillable = [
        'transaksi_masuk_id',
        'waktu_keluar',
        'durasi_menit',
        'biaya',
    ];

    protected $casts = [
        'waktu_keluar' => 'datetime',
    ];

    public function masuk()
    {
        return $this->belongsTo(
            TransaksiMasuk::class,
            'transaksi_masuk_id'
        );
    }

    protected static function booted()
    {
        static::creating(fn ($data) => self::hitungBiaya($data));
        static::updating(fn ($data) => self::hitungBiaya($data));
    }

    protected static function hitungBiaya($data)
    {
        if (! $data->transaksi_masuk_id) return;

        $data->waktu_keluar ??= now();

        $masuk = TransaksiMasuk::with('tarifParkir')
            ->find($data->transaksi_masuk_id);

        if (! $masuk?->waktu_masuk) return;

        $masukTime  = Carbon::parse($masuk->waktu_masuk);
        $keluarTime = Carbon::parse($data->waktu_keluar);

        if ($keluarTime->lt($masukTime)) {
            $keluarTime->addDay();
        }

        $menit = $masukTime->diffInMinutes($keluarTime);
        $data->durasi_menit = $menit;

        $toleransi = 15;

        $jam = floor($menit / 60);
        $sisa = $menit % 60;

        if ($sisa > $toleransi) {
            $jam++;
        }

        $jam = max(1, $jam);

        $tarif = $masuk->tarifParkir->harga ?? 0;

        $data->biaya = $tarif * $jam;
    }
}
