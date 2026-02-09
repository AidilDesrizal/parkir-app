<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk Parkir</title>

    <!-- FONT MODERN -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 280px;
            margin: auto;
        }

        .center {
            text-align: center;
        }

        /* JUDUL BRAND */
        .brand {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 2px 0;
        }

        .subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: -3px;
        }

        img {
            display: block;
            margin: 0 auto 5px auto;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px 0;
        }

        td.right {
            text-align: right;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
        }

    </style>
</head>

<body onload="window.print()">

    <div class="center">
        <img src="{{ asset('images/logo.png') }}" width="90">

        <div class="brand">SimPark</div>
        <div class="subtitle">STRUK PARKIR</div>
    </div>

    <div class="line"></div>

  <table>
      <tr>
          <td>No Plat</td>
          <td class="right">
              {{ $transaksi->masuk?->kendaraan?->no_plat ?? '-' }}
          </td>
      </tr>

      <tr>
          <td>Jenis</td>
          <td class="right">
              {{ $transaksi->masuk?->kendaraan?->jenis_kendaraan ?? '-' }}
          </td>
      </tr>

      <tr>
          <td>Kode Tiket</td>
          <td class="right">
              {{ $transaksi->masuk?->kode_tiket ?? '-' }}
          </td>
      </tr>

      <tr>
          <td>Jam Masuk</td>
          <td class="right">
              {{ optional($transaksi->masuk?->waktu_masuk)->format('d/m/Y H:i') }}
          </td>
      </tr>

      <tr>
          <td>Jam Keluar</td>
          <td class="right">
              {{ optional($transaksi->waktu_keluar)->format('d/m/Y H:i') }}
          </td>
      </tr>

      <tr>
          <td>Durasi</td>
          <td class="right">
              {{ ceil(($transaksi->durasi_menit ?? 0)/60) }} Jam
          </td>
      </tr>

       <tr>
           <td>Petugas</td>
           <td class="right">
               {{ $transaksi->masuk?->user?->name ?? '-' }}
           </td>
       </tr>

  </table>


    <div class="line"></div>

    <div class="footer">
        Terima kasih sudah parkir<br>
    </div>

</body>
</html>

