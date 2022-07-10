<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Cetak Laporan
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Silahkan Pilih Laporan yang ingin Dicetak
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="row">
  <div class="col-lg-4">
    <button type="button" class="btn btn-lg btn-block btn-success" onclick="window.location=('/laporan/cetak-barang-masuk')">
      <i class="fa fa-arrow-circle-up "></i>
      <span> Laporan Barang Masuk</span>
    </button>
  </div>
  <div class="col-lg-4">
    <button type="button" class="btn btn-lg btn-block btn-warning" onclick="window.location=('/laporan/cetak-barang-keluar')">
      <i class="fa fa-arrow-circle-down "></i>
      <span> Laporan Barang Keluar</span>
    </button>
  </div>
</div>

<?= $this->endSection('isi'); ?>