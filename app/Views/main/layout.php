<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APP Inventory Mundhut Sayur</title>

  <!-- Google Font: Source Sans Pro -->
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
  <style>
    * {
      font-family: 'Open Sans', sans-serif;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('chat/index_admin'); ?>">
            <i class="nav-icon fa fa-inbox text-success">
              <small class="text-dark" style="font-weight: bold;"> Inbox Konsultasi</small>
            </i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('konsultasi/index_admin'); ?>">
            <i class="nav-icon fa fa-envelope text-danger">
              <small class="text-dark" style="font-weight: bold;">Konsultasi Aktifasi Akun</small>
            </i>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('login/keluar'); ?>" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt text-danger">
            </i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= site_url('main/index'); ?>" class="brand-link">
        <img src="<?= base_url() ?>/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">APP INVENTORY</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <span style="margin-top: 9px;" class="fa fa-user-circle text-white"></span>
          </div>
          <div class="info">
            <a href="" class="d-block">
              <?= session()->get('namauser'); ?>
            </a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php if (session()->idlevel == 1) : ?>
              <li class="nav-header">Master</li>
              <li class="nav-item">
                <a href="<?= site_url('kategori/index'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-tasks text-primary"></i>
                  <p class="text">Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('satuan/index'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-coins text-warning"></i>
                  <p class="text">Satuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('barang/index'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-box text-danger"></i>
                  <p class="text">Barang</p>
                </a>
              </li>
              <li class="nav-header">Transaksi</li>
              <li class="nav-item">
                <a href="<?= site_url('barangmasuk/data'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-arrow-circle-up text-success"></i>
                  <p class="text">Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('barangkeluar/data'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-arrow-circle-down text-warning"></i>
                  <p class="text">Barang Keluar</p>
                </a>
              </li>
              <li class="nav-header">Ultility</li>
              <li class="nav-item">
                <a href="<?= site_url('laporan/index'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-file text-success"></i>
                  <p class="text">Laporan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('backupdb/index'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-database text-warning"></i>
                  <p class="text">Backup Database</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('users/index'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-users text-info"></i>
                  <p class="text">Managemen User</p>
                </a>
              </li>
            <?php endif; ?>
            <!-- ====================================================================================================================== -->
            <!-- Hak Akses level 2 -->
            <?php if (session()->idlevel == 2) : ?>
              <li class="nav-header">Transaksi</li>
              <li class="nav-item">
                <a href="<?= site_url('barangmasuk/data'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-arrow-circle-up text-success"></i>
                  <p class="text">Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('barangkeluar/data'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-arrow-circle-down text-warning"></i>
                  <p class="text">Barang Keluar</p>
                </a>
              </li>
              <li class="nav-header">Konsultasi</li>
              <li class="nav-item">
                <a href="<?= site_url('chat/index_admin'); ?>" class="nav-link">
                  <i class="nav-icon fa fa-inbox text-success"></i>
                  <p class="text">Chat Konsul</p>
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="<?= site_url('backupdb/gantipassword'); ?>" class="nav-link">
                <i class="nav-icon fa fa-lock text-light"></i>
                <p class="text">Ganti Password</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>
                <?= $this->renderSection('judul'); ?>
              </h1>
            </div>
          </div>
        </div>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <?= $this->renderSection('subjudul'); ?>
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <?= $this->renderSection('isi'); ?>
          </div>
        </div>
      </section>
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">Komunitas Mundhut Sayur</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>

</html>