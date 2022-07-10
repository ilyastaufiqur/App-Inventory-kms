<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/style.css">
  <title>Login</title>
</head>

<body>
  <div class="form-bg ">
    <div class="container">
      <div class="row justify-content-center ">
        <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
          <div class="form-container">
            <div class="form-icon">
              <?php if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success mb-4 " role="alert">';
                echo session()->getFlashdata('pesan');
                echo ' </div>';
              } ?>
              <img src="<?= base_url('/dist/img/logo1.png') ?>" alt="">
              <h3 class="text-white mb-4">Komunitas Mundhut Sayur</h3>
              <h7 class="text-white mb-4 text-bold">belum punya akun?</h7>
              <a style="color: red; " href="<?= base_url('login/register'); ?>">
                Klik Untuk Daftar
              </a>
              <br>
              <a class="text-warning mb-4 text-bold" href="<?= base_url('login/aktifasi'); ?>">
                aktifkan akun
              </a>
            </div>
            <?= form_open('login/cekUser', ['class' => 'form form-horizontal']) ?>
            <h3 class="title">Silahkan Login</h3>
            <div class="form-group">
              <?php
              $isInvalidUser = (session()->getFlashdata('errIduser')) ? 'is-invalid' : '';
              ?>
              <span class="input-icon">
                <i class="fa fa-user"></i>
              </span>
              <input class="form-control <?= $isInvalidUser; ?>" name="iduser" type="text" placeholder="User ID">
            </div>
            <?php
            if (session()->getFlashdata('errIduser')) {
              echo '<p id="validationServer03Feedback" class="form-control invalid-feedback text-danger">' . session()->getFlashdata('errIduser') . '</p>';
            }
            ?>

            <div class="form-group">
              <?php
              $isInvalidPassword = (session()->getFlashdata('errPassword')) ? 'is-invalid' : '';
              ?>
              <span class="input-icon">
                <i class="fa fa-lock"></i>
              </span>
              <input class="form-control <?= $isInvalidPassword; ?>" name="password" type="password" placeholder="Password">
            </div>
            <?php
            if (session()->getFlashdata('errPassword')) {
              echo '<p id="validationServer03Feedback" class="form-control invalid-feedback text-danger">' . session()->getFlashdata('errPassword') . '</p>';
            }
            ?>
            <button type="submit" class="btn signin">Login</button>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Sweet Alerts -->
  <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>