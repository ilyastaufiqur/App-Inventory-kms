<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
  <title>Cetak Struk Barang Keluar</title>
  <style>
    p {
      white-space: nowrap;
    }

    * {
      font-family: 'Open Sans', sans-serif;
    }

    h3,
    h5 {
      height: 2px;
    }

    hr {
      border: none;
      border-top: 1.5px solid #000;
    }
  </style>
</head>

<body onload="window.print();">
  <table border="0" style="text-align: center; width: 100%;">
    <tr>
      <td colspan="2">
        <h3>Komunitas Mundhut Sayur</h3>
        <h5>
          <p>Jalan Wijaya Kusuma Gg. 5 No. 18, Kota Probolinggo 67219. Jawa Timur, Indonesia.</p>
        </h5>
        <h5>
          <p>Telp :+62 857 3303 8507 | Email : mundhutsayur@gmail.com</p>
        </h5>
        <hr>
      </td>
    </tr>
    <tr style="text-align: left;">
      <td>Faktur : </td>
      <td><?= $faktur; ?></td>
    </tr>
    <tr style="text-align: left;">
      <td>Tanggal : </td>
      <td><?= date('d M Y', strtotime($tanggal)) ?></td>
    </tr>
    <tr style="text-align: left;">
      <td>Pelanggan : </td>
      <td><?= $namapelanggan ?></td>
    </tr>
    <tr>
      <td colspan="2">
        <hr style="border-top:1px dashed #000;">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table style="width:100% ; text-align: left; font-weight: bold;">
          <?php
          $totalItem = 0;
          $jmlItem = 0;
          $totalHarga = 0;
          foreach ($detailbarang->getResultArray() as $row) :
            $totalItem += $row['detjml'];
            $jmlItem++;
            $totalHarga += $row['detsubtotal'];
          ?>
            <tr>
              <td colspan="12"><?= $row['brgnama']; ?></td>
            </tr>
            <tr>
              <td><?= number_format($row['detjml'], 0, ",", ".") . ' ' . $row['satnama'] ?></td>
              <td style="text-align: right ;"><?= number_format($row['dethargajual'], 0, ",", ".") ?></td>
              <td style="text-align: right ;"><?= number_format($row['detsubtotal'], 0, ",", ".") ?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="3">
              <hr style="border-top:1px dashed #000;">
            </td>
          </tr>
          <tr>
            <td colspan="3">
              Jumlah Item : <?= number_format($jmlItem, 0, ",", ".") . ' (' . number_format($totalItem, 0, ",", ".") . ')' ?>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <hr style="border-top:1px dashed #000;">
            </td>
          </tr>
          <tr style="text-align: right;">
            <td></td>
            <td>Total :</td>
            <td>
              <?= number_format($totalHarga, 0, ",", ".") ?>
            </td>
          </tr>
          <tr style="text-align: right;">
            <td></td>
            <td>Jumlah Pembayaran :</td>
            <td>
              <?= number_format($jumlahuang, 0, ",", ".") ?>
            </td>
          </tr>
          <tr style="text-align: right;">
            <td></td>
            <td>Sisa Uang :</td>
            <td>
              <?= number_format($sisauang, 0, ",", ".") ?>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <hr style="border-top:1px dashed #000;">
            </td>
          </tr>
          <tr style="text-align: center;">
            <td colspan="3">
              <h2>Terimakasih atas kunjungan Anda</h2>
              <h3>Komunitas Mundhut Sayur</h3>
              <h4>Perlengkapan Peralatan Hidroponik</h4>
              <h5>Selamat Bertani Hidroponik</h5>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>