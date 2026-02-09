<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiKeluarController;
use App\Models\TransaksiKeluar;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| CETAK STRUK PARKIR (PER TRANSAKSI KELUAR)
|--------------------------------------------------------------------------
| dipanggil dari tombol Filament:
| route('transaksi.cetak', $record->id)
*/

Route::get(
    '/transaksi-keluar/{id}/cetak',
    [TransaksiKeluarController::class, 'cetak']
)->name('transaksi.cetak');


/*
|--------------------------------------------------------------------------
| CETAK REKAP / LAPORAN TRANSAKSI PARKIR
|--------------------------------------------------------------------------
| sumber data = transaksi_keluars (SUDAH FINAL BAYAR)
*/

Route::get('/rekap-transaksi/print', function () {

    $query = TransaksiKeluar::with([
        'masuk.kendaraan',
        'masuk.areaParkir',
        'masuk.tarifParkir',
        'masuk.user',
    ]);

    // filter tanggal opsional
    if (request('dari')) {
        $query->whereDate('created_at', '>=', request('dari'));
    }

    if (request('sampai')) {
        $query->whereDate('created_at', '<=', request('sampai'));
    }

    $data = $query->get();

    return view('print.rekap-transaksi', compact('data'));

})->name('rekap.transaksi.print');
