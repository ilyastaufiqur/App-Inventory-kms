<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Cetak Laporan Barang Masuk
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
  'class' => 'btn btn-warning btn-sm',
  'onclick' => "location.href=('" . site_url('laporan/index') . "')"
]) ?>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="row">
  <div class="col-lg-4">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">Pilih Priode</div>
      <div class="card-body bg-light">
        <div class="card-text">
          <?= form_open('laporan/cetak-barang-masuk-priode', ['target' => '_blank']) ?>
          <div class="form-group">
            <label for="">Tanggal Awal</label>
            <input type="date" name="tglawal" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Tanggal Akhir</label>
            <input type="date" name="tglakhir" class="form-control" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-success">
              <i class="fa fa-print"></i>
              Cetak Laporan
            </button>
          </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">Grafik Laporan</div>
      <div class="card-body bg-light">
        <div class="form-group">
          <label for="">Pilih Bulan</label>
          <input type="month" class="form-control" id="bulan" value="<?= date('Y-m') ?>">
          <button class="btn btn-sm btn-primary mt-2" type="button" id="tombolTampil"> Tampil</button>
        </div>
        <div class="viewTampilGrafik">

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function tampilGrafik() {
    $.ajax({
      type: "post",
      url: "/laporan/tampilGrafikBarangMasuk",
      data: {
        bulan: $('#bulan').val()
      },
      dataType: "json",
      beforeSend: function() {
        $('.viewTampilGrafik').html('<i class="fa fa-spin fa-spinner"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.viewTampilGrafik').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }
  $(document).ready(function() {
    tampilGrafik();
    $('#tombolTampil').click(function(e) {
      e.preventDefault();
      tampilGrafik();
    });
  });
</script>

<?= $this->endSection('isi'); ?>