<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Manajemen Data Barang
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/barang/tambah')">
  <i class="fa fa-plus-circle"></i> Tambah Barang
</button>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('barang/index') ?>
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
<table class="table table-striped table-bordered" style="width: 100%;">
  <thead>
    <tr>
      <th style="width: 5%;">No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Kategori</th>
      <th>Satuan</th>
      <th>Harga</th>
      <th>Stok</th>
      <th style="width: 15%; text-align:center ;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1 + (($nohalaman - 1) * 10);
    foreach ($tampildata as $row) :
    ?>
      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $row['brgkode']; ?></td>
        <td><?= $row['brgnama']; ?></td>
        <td><?= $row['katnama']; ?></td>
        <td><?= $row['satnama']; ?></td>
        <td><?= number_format($row['brgharga'], 0); ?></td>
        <td><?= number_format($row['brgstok'], 0); ?></td>
        <td style="text-align: center;">
          <button class="btn btn-warning btn-sm" onclick="edit('<?= $row['brgkode'];  ?>')">
            <i class="fa fa-edit"></i>
          </button>

          <!-- metode spofing untuk keamanan -->
          <form method="POST" action="/barang/hapus/<?= $row['brgkode']; ?>" style="display: inline;" onsubmit="return hapus()">
            <input type="hidden" value="DELETE" name="method">

            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data">
              <i class="fa fa-trash-alt"></i>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>

</table>

<div class="float-left mt-4">
  <?= $pager->links('barang', 'paging'); ?>
</div>

<script>
  function edit(kode) {
    window.location.href = ('/barang/edit/' + kode);
  }

  function hapus(kode) {
    pesan = confirm('Yakin ingin menghapus data ?');
    if (pesan) {
      return true;
    } else {
      return false;
    }
  }
</script>

<?= $this->endSection('isi'); ?>