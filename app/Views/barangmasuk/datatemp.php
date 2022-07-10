<table class="table table-sm table-striped table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Harga Jual</th>
      <th>Harga Beli</th>
      <th>Jumlah</th>
      <th>Sub.Total</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($datatemp->getResultArray() as $row) :
    ?>

      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['brgkode']; ?></td>
        <td><?= $row['brgnama']; ?></td>
        <td style="text-align:right ;">
          <?= number_format($row['dethargajual'], 0, ",", "."); ?>
        </td>
        <td style="text-align:right ;">
          <?= number_format($row['dethargamasuk'], 0, ",", "."); ?>
        </td>
        <td style="text-align:right ;">
          <?= number_format($row['detjml'], 0, ",", "."); ?>
        </td>
        <td style="text-align:right ;">
          <?= number_format($row['detsubtotal'], 0, ",", "."); ?>
        </td>
        <td>
          <button class="btn btn-sm btn-outline-danger" onclick="hapusItem('<?= $row['iddetail']; ?>')">
            <i class="fa fa-trash-alt"></i>
          </button>
        </td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>

<script>
  function hapusItem(id) {
    Swal.fire({
      title: 'Hapus Item',
      text: "Yakin ingin menghapus item?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "post",
          url: "/barangmasuk/hapus",
          data: {
            id: id
          },
          dataType: "json",
          success: function(response) {
            if (response.sukses) {
              dataTemp();
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.sukses

              });
            }
          },
          error: function(xhr, ajaxOptions, ThrownError) {
            alert(xhr.status + '\n' + ThrownError)
          }
        });
      }
    })
  }
</script>