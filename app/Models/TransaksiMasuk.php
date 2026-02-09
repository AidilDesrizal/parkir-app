<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransaksiMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tiket',
        'kendaraan_id',
        'tarif_parkir_id',
        'area_parkir_id',
        'user_id',
        'waktu_masuk',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
    ];

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tarifParkir(): BelongsTo
    {
        return $this->belongsTo(TarifParkir::class, 'tarif_parkir_id');
    }

    public function areaParkir(): BelongsTo
    {
        return $this->belongsTo(AreaParkir::class);
    }

    public function keluar(): HasOne
    {
        return $this->hasOne(
            TransaksiKeluar::class,
            'transaksi_masuk_id'
        );
    }
}
