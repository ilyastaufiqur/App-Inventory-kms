<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Form Tambah Satuan
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
  'class' => 'btn btn-warning btn-sm',
  'onclick' => "location.href=('" . site_url('satuan/index') . "')"
]) ?>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= form_open('satuan/simpandata') ?>
<div class="form-group">
  <label for="namasatuan">Nama Satuan</label>
  <?= form_input('namasatuan', '', [
    'class' => 'form-control',
    'id' => 'namasatuan',
    'autofocus' => 'true',
    'placeholder' => 'isi nama satuan'
  ]) ?>

  <?= session()->getFlashdata('errorNamaSatuan'); ?>
</div>
<div class="form-group">
  <?= form_submit('', 'Simpan', [
    'class' => 'btn btn-success btn-sm'
  ]) ?>
</div>

<?= form_close(); ?>
<?= $this->endSection('isi'); ?>