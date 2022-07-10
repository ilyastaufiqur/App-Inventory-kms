<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Utility System
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Backup Database
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= session()->getFlashdata('pesan'); ?>
<div class="row">
  <div class="col-lg-6">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">Silahkan Backup Database</div>
      <div class="card-body bg-light">
        <button style="font-weight: bold;" class="btn btn-block btn-warning" onclick="location.href=('/backupdb/doBackup')">
          Klik untuk Backup Database
        </button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection('isi'); ?>