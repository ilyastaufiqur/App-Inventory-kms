<?= $this->extend('main/layout_user'); ?>


<?= $this->section('isi_user'); ?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Selamat Datang <span class="text-info"><?= session()->get('namauser'); ?></span></h1>
    <p class="lead">Selamat Bergabung </p>
  </div>
</div>
<?= $this->endSection('isi_user'); ?>