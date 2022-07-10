<?= $this->extend('main/layout'); ?>
<?= $this->section('subjudul'); ?>
Dashboard
<?= $this->endSection('subjudul'); ?>
<?= $this->section('isi'); ?>

<div class="row">
  <div class="col-sm-3">
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?= total('barang'); ?></h3>
        <p>Barang</p>
      </div>
      <div class="icon">
        <i class="fa fa-box text-danger"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= total('barangmasuk'); ?></h3>
        <p><span>Barang Masuk</span> </p>
      </div>
      <div class="icon">
        <i class="fa fa-arrow-circle-up text-warning"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= total('barangkeluar'); ?></h3>
        <p><span>Barang Keluar</span> </p>
      </div>
      <div class="icon">
        <i class="fa fa-arrow-circle-down text-success"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="small-box bg-light">
      <div class="inner">
        <h3><?= total('users'); ?></h3>
        <p><span>User</span> </p>
      </div>
      <div class="icon">
        <i class="fa fa-users text-info"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<?= $this->endSection('isi'); ?>