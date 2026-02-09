<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TarifParkir extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_kendaraan',
        'harga',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
