<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Form Permintaan Aktifasi
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('konsultasi/index_admin') ?>
<div class="input-group mb-3">
  <input type="text" class="form-control" name="cari" value="<?= $cari; ?>" placeholder="Cari User ID" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-info" type="submit" id="tombolcari" name="tombolcari">
      <i class="fa fa-search"></i>
    </button>
  </div>
</div>
<?= form_close() ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Judul Konsultasi</th>
      <th scope="col">ID User</th>
      <th scope="col">Email</th>
      <th scope="col">Waktu Konsul</th>
      <th>Pertanyaan</th>
      <th>aktif</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1 + (($nohalaman - 1) * 5);
    foreach ($tampil as $row) :
    ?>

      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $row->judul ?></td>
        <td><?= $row->nama; ?></td>
        <td><?= $row->email; ?></td>
        <td><?= $row->tanggal; ?></td>
        <td><?= $row->pesan_konsul; ?></td>
        <td>
          <?php if ($row->pesan_aktif == '1') : ?>
            <span class="badge badge-success">Direspon</span>
          <?php else : ?>
            <span class="badge badge-danger">Belum</span>
          <?php endif; ?>
        </td>
        <td style="text-align: center;">
          <a class="btn btn-warning btn-sm" onclick="edit(<?= $row->konsul_id  ?>)">
            <i class="fa fa-envelope"></i>
          </a>
          <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->konsul_id; ?>" data-nama="<?= $row->nama; ?>" data-pesan_aktif="<?= $row->pesan_aktif; ?>">
            <i class="fa fa-edit"></i>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="float-center">
  <?= $pager->links('konsultasi', 'paging'); ?>
</div>
<form action="/konsultasi/update" method="post">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Balas Chat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-6">
              <label>User id</label>
              <input type="hidden" name="konsul_id" id="konsul_id" class="konsul_id">
              <input type="text" name="nama" id="nama" class="form-control nama" readonly>
            </div>
            <div class="col-6">
              <label>Chat Aktif</label>
              <input type="number" name="pesan_aktif" id="pesan_aktif" class="form-control pesan_aktif">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="product_id" class="product_id">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  $(document).ready(function() {
    $('.btn-edit').on('click', function() {
      // get data from button edit
      const id = $(this).data('id');
      const pesan_aktif = $(this).data('pesan_aktif');
      const nama = $(this).data('nama');

      // Set data to Form Edit
      $('.konsul_id').val(id);
      $('.nama').val(nama);
      $('.pesan_aktif').val(pesan_aktif);
      // Call Modal Edit
      $('#editModal').modal('show');
    });
  });

  function edit(kode) {
    window.location.href = ('/konsultasi/balasKonsul/' + kode);
  }
</script>
<?= $this->endSection('isi'); ?>