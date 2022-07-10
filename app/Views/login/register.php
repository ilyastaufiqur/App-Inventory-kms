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
  <title>Registrasi</title>
</head>

<body>
  <div class="form-bg ">
    <div class="container">
      <div class="row justify-content-center ">
        <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
          <div class="form-container">
            <div class="form-icon">
              <?php $errors = session()->getFlashdata('errors');
              if (!empty($errors)) : ?>
                <div class="alert alert-danger" role="alert">
                  <ul>
                    <?php foreach ($errors as $error) : ?>
                      <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif;  ?>
              <img src="<?= base_url('/dist/img/logo1.png') ?>" alt="">
              <h3 class="text-white mb-4">Komunitas Mundhut Sayur</h3>
              <h7 class="text-white mb-4 text-bold">sudah punya akun?</h7>
              <a style="color: red; " href="<?= base_url('login/index'); ?>">
                Klik Untuk Login
              </a>
            </div>
            <?= form_open('login/simpanRegister', ['class' => 'form form-horizontal']) ?>

            <div class="form-group">
              <span class="input-icon">
                <i class="fa fa-user"></i>
              </span>
              <input class="form-control" name="iduser" type="text" placeholder="User ID">
            </div>
            <div class="form-group">
              <span class="input-icon">
                <i class="fa fa-user"></i>
              </span>
              <input class="form-control" name="namauser" type="text" placeholder="Nama">
            </div>
            <div class="form-group">
              <span class="input-icon">
                <i class="fa fa-lock"></i>
              </span>
              <input class="form-control" name="password" type="password" placeholder="Password">
            </div>
            <div class="form-group">
              <span class="input-icon">
                <i class="fa fa-lock"></i>
              </span>
              <input class="form-control" name="repassword" type="password" placeholder="Retype Password">
            </div>
            <button type="submit" class="btn signin">Register</button>
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