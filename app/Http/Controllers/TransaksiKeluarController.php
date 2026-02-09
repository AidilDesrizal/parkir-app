<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeluar;

class TransaksiKeluarController extends Controller
{
    public function cetak(int $id)
    {
        $transaksi = TransaksiKeluar::query()
            ->with([
                'masuk.kendaraan',
                'masuk.areaParkir',
                'masuk.tarifParkir',
                'masuk.user',
            ])
            ->findOrFail($id);

        return view('transaksi.cetak', [
            'transaksi' => $transaksi
        ]);
    }
}
