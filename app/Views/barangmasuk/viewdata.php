<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Data Transaksi Barang Masuk
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<button type="button" class="btn btn-sm btn-primary " onclick="location.href=('/barangmasuk/index')">
  <i class="fa fa-plus-circle"></i> input transaksi
</button>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= form_open('barangmasuk/data') ?>
<div class="input-group mb-3">
  <input type="text" class="form-control" name="cari" value="<?= $cari; ?>" placeholder="Cari Berdasarkan Faktur" autofocus>
  <div class="input-group-append">
    <button class="btn btn-outline-info" type="submit" id="tombolcari" name="tombolcari">
      <i class="fa fa-search"></i>
    </button>
  </div>
</div>
<?= form_close(); ?>
<?= "<span class=\"badge badge-success\"> Total Data : $totaldata</span>" ?>
<table class="table table-sm table-bordered table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Faktur</th>
      <th>Nama Suplier</th>
      <th>Tanggal</th>
      <th>Jumlah Item</th>
      <th>Total Harga (Rp)</th>
      <th style="text-align: center;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1 + (($nohalaman - 1) * 10);
    foreach ($tampildata as $row) :
    ?>
      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $row['faktur']; ?></td>
        <td><?= $row['supnama']; ?></td>
        <td><?= date('d-m-Y', strtotime($row['tglfaktur'])); ?></td>
        <td style="text-align: center;">
          <?php
          $db = \Config\Database::connect();
          $jumlahItem = $db->table('detail_barangmasuk')->where('detfaktur', $row['faktur'])->countAllResults();
          ?>
          <span style="cursor:pointer ; font-weight: bold; color: blue; " onclick="detailItem('<?= $row['faktur']; ?>')"><?= $jumlahItem; ?></span>
        </td>
        <td>
          <?= number_format($row['totalharga'], 0, ",", "."); ?>
        </td>

        <td style="text-align: center;">
          <button class="btn btn-sm btn-outline-info" title="Edit Transaksi" onclick="edit('<?= sha1($row['faktur']) ?>')">
            <i class="fa fa-edit"></i>
          </button>
          &nbsp;
          <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="hapusTransaksi('<?= $row['faktur'] ?>')">
            <i class="fa fa-trash-alt"></i>
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="viewmodal" style="display: none;"></div>
<div class="float-left mt-4">
  <?= $pager->links('barangmasuk', 'paging'); ?>
</div>

<script>
  function hapusTransaksi(faktur) {
    Swal.fire({
      title: 'Hapus Transaksi',
      text: "Yakin ingin menghapus transaksi?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "post",
          url: "/barangmasuk/hapusTransaksi",
          data: {
            faktur: faktur
          },
          dataType: "json",
          success: function(response) {
            if (response.sukses) {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.sukses
              }).then((result) => {
                window.location.reload();
              })
            }
          },
          error: function(xhr, ajaxOptions, ThrownError) {
            alert(xhr.status + '\n' + ThrownError)
          }
        });
      }
    })
  }

  function edit(faktur) {
    window.location.href = ('/barangmasuk/edit/') + faktur;
  }

  function detailItem(faktur) {
    $.ajax({
      type: "post",
      url: "/barangmasuk/detailItem",
      data: {
        faktur: faktur
      },
      dataType: "json",
      success: function(response) {
        if (response.data) {
          $('.viewmodal').html(response.data).show();
          $('#modalitem').modal('show');
        }
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }
</script>

<?= $this->endSection('isi'); ?>