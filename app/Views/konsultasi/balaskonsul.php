<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
email aktifasi
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/konsultasi/index_admin')">
  <i class="fa fa-backward"> kembali</i>
</button>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<div class="col-lg-8" style="margin: 0 auto;">
  <div class="card">
    <div class="card-header bg-success" style="font-weight: bold; text-align: center;">
      Konsultasi Sahabat Mundhut Sayur
    </div>
    <div class="container" style="margin-top: 20px;">
      <form action="<?= site_url('konsultasi/kirim') ?>" method="POST">
        <?= session()->getFlashdata('sukses'); ?>
        <div class="form-group row">
          <label for="" class="col-sm-4 col-form-label">Judul</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="judul" name="judul" value="<?= $judul; ?>" autofocus readonly>
          </div>
        </div>

        <div class="form-group row">
          <label for="" class="col-sm-4 col-form-label">Nama</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-4 col-form-label">email</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="email" name="email" value="<?= $email; ?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-4 col-form-label">pesan konsul</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="pesan_konsul" id="pesan_konsul" rows="3" readonly><?= $konsul_pesan; ?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label for="" class="col-sm-4 col-form-label">Balas Konsultasi</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="balas_konsul" id="balas_konsul" rows="5"></textarea>
          </div>
        </div>

        <div class="form-group text-right">
          <button class="btn btn-success" type="submit">Kirim</button>
        </div>
      </form>
    </div>

  </div>

</div>
<?= $this->endSection('isi'); ?>