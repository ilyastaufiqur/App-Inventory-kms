<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Manajemen Kategori Peralatan
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Data', [
  'class' => 'btn btn-primary btn-sm',
  'onclick' => "location.href=('" . site_url('kategori/formtambah') . "')"
]) ?>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= session()->getFlashdata('sukses'); ?>

<?= form_open('kategori/index') ?>
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Cari Data Kategori" value="<?= $cari; ?>" name="cari" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-info" type="submit" id="tombolcari" name="tombolcari">
      <i class="fa fa-search"></i>
    </button>
  </div>
</div>
<?= form_close() ?>

<table class="table table-striped table-bordered" style="width: 100%;">
  <thead>
    <tr>
      <th style="width: 5%;">No</th>
      <th>Nama Kategori</th>
      <th style="width: 15%; text-align:center ;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1 + (($nohalaman - 1) * 5);
    foreach ($tampildata as $row) :
    ?>
      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $row['katnama']; ?></td>
        <td style="text-align: center;">
          <button type="button" class="btn btn-warning btn-sm" title="Edit Data" onclick="edit('<?= $row['katid']; ?>')">
            <i class="fa fa-edit"></i>
          </button>

          <!-- metode spofing untuk keamanan -->
          <form method="POST" action="/kategori/hapus/<?= $row['katid']; ?>" style="display: inline;" onsubmit="hapus()">
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
<div class="float-center">
  <?= $pager->links('kategori', 'paging'); ?>
</div>

<script>
  function edit(id) {
    window.location = ('/kategori/formedit/' + id);
  }

  function hapus(id) {
    pesan = confirm('Apakah anda yakin ingin menghapus data ? ')

    if (pesan) {
      return true;
    } else {
      return false;
    }
  }
</script>

<?= $this->endSection('isi'); ?>