<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Manajemen Users
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<button class="btn btn-sm btn-primary btntambah" type="button">
  <i class="fa fa-plus"></i>
  Tambah User Baru
</button>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<table class="table table-sm table-bordered" id="datauser" style="width:100% ;">
  <thead>
    <tr>
      <th>nomor</th>
      <th>ID User</th>
      <th>Nama User</th>
      <th>Level</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
<div class="viewmodal" style="display: none;">
</div>

<script>
  $(document).ready(function() {
    $('.btntambah').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/users/formtambah",
        success: function(response) {
          $('.viewmodal').html(response).show();
          $('#modaltambah').on('hidden.bs.modal', function(event) {
            $('#iduser').focus();
          })
          $('#modaltambah').modal('show');
        }
      });
    });
    dataUser = $('#datauser').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/users/listData',
      order: [],
      columns: [{
          data: 'nomor',
          width: 10
        },
        {
          data: 'userid'
        },
        {
          data: 'usernama'
        },
        {
          data: 'levelnama'
        },
        {
          data: 'status',
          orderable: false,
          width: 25
        },
        {
          data: 'aksi',
          orderable: false,
          width: 20
        },
      ]
    });
  });

  function view(userid) {
    $.ajax({
      type: "post",
      url: "/users/formedit",
      data: {
        userid: userid
      },
      success: function(response) {
        $('.viewmodal').html(response).show();
        $('#modaledit').on('hidden.bs.modal', function(event) {
          $('#namalengkap').focus();
        })
        $('#modaledit').modal('show');
      }
    });
  }
</script>
<?= $this->endSection('isi'); ?>