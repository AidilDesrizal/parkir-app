<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransaksiMasuk;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_plat',
        'jenis_kendaraan',
    ];

    public function transaksiMasuks()
    {
        return $this->hasMany(TransaksiMasuk::class);
    }
}
