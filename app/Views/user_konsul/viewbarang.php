<?= $this->extend('main/layout_user'); ?>


<?= $this->section('isi_user'); ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('main/listdata') ?>
<div class="input-group mb-3">
  <input type="text" class="form-control" autofocus value="<?= $cari; ?>" name="cari" placeholder="Cari Data berdasarkan Kode, Nama Barang & Kategori">
  <div class="input-group-append">
    <button class="btn btn-outline-info" type="submit" name="tombolcari">
      <i class="fa fa-search"></i>
    </button>
  </div>
</div>
<?= form_close(); ?>
<span class="badge badge-success mb-3">
  <h6>
    <?= "total data : $totaldata"; ?>
  </h6>
</span>
<br>
<table class="table table-striped" style="width: 100%;">
  <thead>
    <tr>
      <th style="width: 5%;">No</th>
      <th>Nama Barang</th>
      <th>Kategori</th>
      <th>Satuan</th>
      <th>Harga</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1 + (($nohalaman - 1) * 5);
    foreach ($tampildata as $row) :
    ?>
      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $row['brgnama']; ?></td>
        <td><?= $row['katnama']; ?></td>
        <td><?= $row['satnama']; ?></td>
        <td><?= number_format($row['brgharga'], 0); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>

</table>

<div class="float-left mt-4">
  <?= $pager->links('barang', 'paging'); ?>
</div>
<?= $this->endSection('isi_user'); ?>