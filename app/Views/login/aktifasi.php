<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Sweet Alerts -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Sweet Alerts -->
  <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <title>Aktifasi</title>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-header bg-info" style="font-weight: bold; color: red;">
            Catatan
          </div>
          <div>
            <ul>
              <li>Lihat pesan balasan di email anda yang berada di kotak spam</li>
              <li>klik laporkan bukan spam</li>
              <li>Terimakasih Sudah Aktifasi</li>
            </ul>
            <ul class="text-center mr-5">
              <h6>Sudah Aktifasi?</h6>
              <a class="text-danger text-center" href="<?= base_url('login/index'); ?>">Silahkan Login</a>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="card">
          <div class="card-header bg-info" style="font-weight: bold; text-align: center;">
            Hallo, sahabat Hidroponik Mundhut Sayur ingin aktifkan akun?
          </div>
          <div class="container" style="margin-top: 10px;">
            <?= session()->getFlashdata('error'); ?>
            <?= session()->getFlashdata('sukses'); ?>
            <form action="<?php echo base_url('login/simpan') ?>" method="POST">
              <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul">
              </div>
              <div class="form-group">
                <label for="nama">Nama/User ID</label>
                <input type="nama" name="nama" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="pesan">Pesan</label>
                <textarea class="form-control" name="pesan_konsul" id="pesan_konsul" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" type="submit">Kirim</button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>
</body>

</html>