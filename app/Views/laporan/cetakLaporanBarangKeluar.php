<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
  <title>Laporan Barang Keluar</title>

  <style>
    * {
      font-family: 'Open Sans', sans-serif;
    }

    h3,
    h5 {
      height: 3px;
    }
  </style>
</head>

<body onload="window.print();">
  <table style="width:100% ; border-collapse:collapse ; text-align: center;" border="1">
    <tr>
      <td>
        <table style="width: 100%; text-align: center;" border="0">
          <tr style="text-align: center;">
            <h3>Komunitas Mundhut Sayur</h3>
            <h5>
              <p>Jalan Wijaya Kusuma Gg. 5 No. 18, Kota Probolinggo 67219. Jawa Timur, Indonesia.</p>
            </h5>
            <h5>
              <p>Telp :+62 857 3303 8507 | Email : mundhutsayur@gmail.com</p>
            </h5>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; text-align: center;" border="0">
          <tr style="text-align: center;">
            <td>
              <h3> <u>Laporan Barang Masuk</u></h3><br>
              Periode : <?= $tglawal . " s/d " . $tglakhir ?>
            </td>
          </tr>
          <tr>
            <td>
              <br>
              <center>
                <table border="1" cellpadding="7" style="border-collapse:collapse ; border: 1px solid #000 ; text-align: center; width: 80%;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No.Faktur</th>
                      <th>Tanggal</th>
                      <th>Total Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $totalKeseluruhan = 0;
                    foreach ($datalaporan->getResultArray() as $row) :
                      $totalKeseluruhan += $row['totalharga'];
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['faktur']; ?></td>
                        <td><?= $row['tglfaktur']; ?></td>
                        <td style="text-align: right;"><?= "Rp." . number_format($row['totalharga'], 0, ",", ".") ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr style="font-weight: bold;">
                      <th colspan="3">Total Harga Keseluruhan</th>
                      <td style="text-align: right;"><?= "Rp." . number_format($totalKeseluruhan, 0, ",", ".") ?></td>
                    </tr>
                  </tfoot>
                </table>
              </center>
              <br>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>