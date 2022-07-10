<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Data Chat Konsultasi
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/dist/css/bootstrap4-toggle.min.css">
<script src="<?= base_url() ?>/dist/js/bootstrap4-toggle.min.js"></script>
<table class="table table-striped" style="width: 100%;">
  <thead>
    <tr>
      <th style="width: 5%;">No</th>
      <th>Nama</th>
      <th>Chat</th>
      <th>Waktu</th>
      <th>Balasan</th>
      <th style="width: 15%; text-align:center ;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1;
    foreach ($tampildata as $row) :
    ?>
      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $row->userid ?></td>
        <td><?= $row->chat ?></td>
        <td><?= $row->time ?></td>
        <td>
          <?php if ($row->chat_aktif == '1') : ?>
            <span class="badge badge-success">Dibalas</span>
          <?php else : ?>
            <span class="badge badge-danger">Belum Dibalas</span>
          <?php endif; ?>
        </td>
        <td style="text-align: center;">
          <!-- <button class="btn btn-warning btn-sm" onclick="edit(<?= $row->chat_id ?>)">
            <i class="fa fa-edit"></i>
          </button> -->
          <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->chat_id; ?>" data-chat_aktif="<?= $row->chat_aktif; ?>" data-userid="<?= $row->userid; ?>" data-chat="<?= $row->chat; ?>" data-balas_chat="<?= $row->balas_chat; ?>">Edit</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<form action="/chat/update" method="post">
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
              <input type="hidden" name="chat_id" id="chat_id" class="chat_id">
              <input type="text" class="form-control userid" name="userid" placeholder="user id" readonly>
            </div>
            <div class="col-6">
              <label>Chat Aktif</label>
              <input name="chat_aktif" id="chat_aktif" class="form-control chat_aktif">
            </div>
          </div>
          <div class="form-group">
            <label>Chat</label>
            <textarea name="chat" id="chat" class="form-control chat" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label>balas chat</label>
            <textarea name="balas_chat" id="balas_chat" class="form-control balas_chat" rows="3"></textarea>
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
<!-- End Modal Edit Product-->
<script>
  $(document).ready(function() {
    $('.btn-edit').on('click', function() {
      // get data from button edit
      const id = $(this).data('id');
      const userid = $(this).data('userid');
      const chat = $(this).data('chat');
      const chat_aktif = $(this).data('chat_aktif');
      const balas_chat = $(this).data('balas_chat');

      // Set data to Form Edit
      $('.chat_id').val(id);
      $('.userid').val(userid);
      $('.chat').val(chat);
      $('.chat_aktif').val(chat_aktif);
      $('.balas_chat').val(balas_chat);
      // Call Modal Edit
      $('#editModal').modal('show');
    });
  });

  function edit(kode) {
    window.location.href = ('/chat/edit/' + kode);
  }
</script>
<?= $this->endSection('isi'); ?>