<!DOCTYPE html>
<html>
<head>
    <title>Cetak Rekap Transaksi</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #eee;
        }

        @media print {
            button {
                display: none;
            }
        }

    </style>
</head>

<body>

    <button onclick="window.print()">🖨️ Print</button>

    <h2>Rekap Transaksi Parkir</h2>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Plat</th>
                <th>Area</th>
                <th>Jenis</th>
                <th>Durasi</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $i => $t)
            <tr>
                <td>{{ $i + 1 }}</td>

                <td>
                    {{ data_get($t, 'masuk.kendaraan.no_plat', '-') }}
                </td>

                <td>
                    {{ data_get($t, 'masuk.areaParkir.nama_area', '-') }}
                </td>

                <td>
                    {{ data_get($t, 'masuk.kendaraan.jenis_kendaraan', '-') }}
                </td>

                <td>
                    {{ ceil(($t->durasi_menit ?? 0) / 60) }} Jam
                </td>

                <td>
                    Rp {{ number_format($t->biaya ?? 0, 0, ',', '.') }}
                </td>

                <td>
                    {{ $t->created_at?->format('d M Y H:i') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.onload = () => window.print();

    </script>

</body>
</html>

