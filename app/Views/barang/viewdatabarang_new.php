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
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<table class="table table-sm table-bordered" id="databarang" style="width:100% ;">
  <thead>
    <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Harga</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
<script>
  $(document).ready(function() {
    $('#databarang').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/barang/lisData'
    });
  });
</script>
<?= $this->endSection('isi'); ?>