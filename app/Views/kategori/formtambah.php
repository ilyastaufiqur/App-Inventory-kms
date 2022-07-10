<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Form Tambah Kategori Peralatan
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
  'class' => 'btn btn-warning btn-sm',
  'onclick' => "location.href=('" . site_url('kategori/index') . "')"
]) ?>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= form_open('kategori/simpandata') ?>
<div class="form-group">
  <label for="namakategori">Nama Kategori</label>
  <?= form_input('namakategori', '', [
    'class' => 'form-control',
    'id' => 'namakategori',
    'autofocus' => 'true',
    'placeholder' => 'isi nama kategori'
  ]) ?>

  <?= session()->getFlashdata('errorNamaKategori'); ?>
</div>
<div class="form-group">
  <?= form_submit('', 'Simpan', [
    'class' => 'btn btn-success btn-sm'
  ]) ?>
</div>

<?= form_close(); ?>
<?= $this->endSection('isi'); ?>