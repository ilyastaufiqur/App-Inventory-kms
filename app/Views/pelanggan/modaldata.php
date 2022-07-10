  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <div class="modal fade" id="modaldatapelanggan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Cari Data Pelanggan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table style="width: 100%;" id="datapelanggan" class="table table-bordered table-hover dataTable dtr-inline collapsed">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>No.Telp/HP</th>
                <th style="text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    function listDataPelanggan() {
      let table = $('#datapelanggan').DataTable({
        destroy: true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          "url": "/pelanggan/listData",
          "type": "post",
        },
        "columnDefs": [{
          "targets": [0, 3],
          "orderable": false,
        }, ],
      });
    }

    function pilih(id, nama) {
      $('#namapelanggan').val(nama);
      $('#idpelanggan').val(id);
      $('#modaldatapelanggan').modal('hide');
    }

    function hapus(id, nama) {
      Swal.fire({
        title: 'Hapus Data Pelanggan',
        text: "Yakin ingin menghapus data pelanggan dengan nama" + nama + " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "post",
            url: "/pelanggan/hapus",
            data: {
              id: id
            },
            dataType: "json",
            success: function(response) {
              if (response.sukses) {
                Swal.fire({
                  icon: 'success',
                  title: 'Hapus Data',
                  text: response.sukses
                });
                listDataPelanggan();
              }
            },
            error: function(xhr, ajaxOptions, ThrownError) {
              alert(xhr.status + '\n' + ThrownError)
            }
          });
        }
      })
    }

    $(document).ready(function() {
      listDataPelanggan();
    });
  </script>