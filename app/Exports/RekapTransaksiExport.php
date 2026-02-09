<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapTransaksiExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

   public function collection()
{
    return $this->data->values()->map(function ($t, $i) {
        return [

            'Kode' => $i + 1,   // ← nomor urut

            'Plat Nomor' =>
                data_get($t, 'masuk.kendaraan.no_plat', '-'),

            'Area Parkir' =>
                data_get($t, 'masuk.areaParkir.nama_area', '-'),

            'Jenis Kendaraan' =>
                data_get($t, 'masuk.kendaraan.jenis_kendaraan', '-'),

            'Durasi (Jam)' =>
                ceil(($t->durasi_menit ?? 0) / 60),

            'Total Bayar' =>
                $t->biaya ?? 0,

            'Tanggal' =>
                optional($t->created_at)->format('d-m-Y H:i'),
        ];
    });
}

    public function headings(): array
    {
        return [
            'Kode',
            'Plat Nomor',
            'Area Parkir',
            'Jenis Kendaraan',
            'Durasi (Jam)',
            'Total Bayar',
            'Tanggal',
        ];
    }
}
