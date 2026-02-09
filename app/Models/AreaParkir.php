<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaksi;

class AreaParkir extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_area',
        'kapasitas',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
