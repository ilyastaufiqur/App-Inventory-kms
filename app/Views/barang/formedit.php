<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Form Edit Barang
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/barang/index')">
  <i class="fa fa-backward"> kembali</i>
</button>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= form_open_multipart('barang/updatedata'); ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Kode Barang</label>
  <div class="col-sm-8">
    <input type="hidden" name="idbarang">
    <input type="text" class="form-control" id="kodebarang" name="kodebarang" readonly value="<?= $kodebarang; ?>">
  </div>
</div>

<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Nama Barang</label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="namabarang" name="namabarang" value="<?= $namabarang; ?>">
  </div>
</div>

<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Pilih Kategori</label>
  <div class="col-sm-4">
    <select name="kategori" id="kategori" class="form-control">
      <?php foreach ($datakategori as $kat) : ?>
        <?php if ($kat['katid'] == $kategori) : ?>
          <option selected value="<?= $kat['katid']; ?>"><?= $kat['katnama']; ?></option>
        <?php else : ?>
          <option value="<?= $kat['katid']; ?>"><?= $kat['katnama']; ?></option>
        <?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Pilih Satuan</label>
  <div class="col-sm-4">
    <select name="satuan" id="satuan" class="form-control">
      <?php foreach ($datasatuan as $sat) : ?>
        <?php if ($kat['katid'] == $kategori) : ?>
          <option selected value="<?= $sat['satid']; ?>"><?= $sat['satnama']; ?></option>
        <?php else : ?>
          <option value="<?= $sat['satid']; ?>"><?= $sat['satnama']; ?></option>
        <?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Harga</label>
  <div class="col-sm-8">
    <input type="number" class="form-control" id="harga" name="harga" value="<?= $harga; ?>">
  </div>
</div>

<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Stok</label>
  <div class="col-sm-8">
    <input type="number" class="form-control" id="stok" name="stok" value="<?= $stok; ?>">
  </div>
</div>

<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label"> Gambar yang sudah di upload </label>
  <div class="col-sm-8">
    <img src="<?= base_url() . '/' . $gambar; ?>" class="img-thumbnail" style="width:50% ;" alt="Gambar Peralatan">
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Upload Gambar (<i style="color: red;">jika ingin diganti</i>)</label>
  <div class="col-sm-8">
    <input type="file" id="gambar" name="gambar">
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label"></label>
  <div class="col-sm-8">
    <input type="submit" value="simpan" class="btn btn-success">
  </div>
</div>

<?= form_close(); ?>


<?= $this->endSection('isi'); ?>