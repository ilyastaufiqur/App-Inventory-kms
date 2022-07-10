<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Input Barang Masuk
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
  'class' => 'btn btn-warning btn-sm',
  'onclick' => "location.href=('" . site_url('/barangmasuk/data') . "')"
]) ?>

<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<div class="form-row">
  <div class="form-group col-lg-4">
    <label for="">Input Faktur Barang masuk
    </label>
    <input type="text" class="form-control" placeholder="No.Faktur" name="faktur" id="faktur">
  </div>
  <div class="col">
    <label for="">Tanggal Faktur</label>
    <input type="date" class="form-control" name="tglfaktur" id="tglfaktur" value="<?= date('Y-m-d') ?>">
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <label for="">Cari Suplier</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nama Suplier" id="namasuplier" name="namasuplier" readonly>
        <input type="hidden" name="idsuplier" id="idsuplier">
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" id="tombolCariSuplier" title="Cari Suplier">
            <i class="fa fa-search"></i>
          </button>
          <button class="btn btn-outline-success" type="button" id="tombolTambahSuplier" title="Tambah Suplier">
            <i class="fa fa-plus-square"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header bg-info">
    Input Barang
  </div>
  <div class="card-body">
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="">Kode Barang</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Kode Barang" name="kdbarang" id="kdbarang">
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="button" id="tombolCariBarang">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <label for="">Nama Barang</label>
        <input type="text" class="form-control" name="namabarang" id="namabarang" readonly>
      </div>
      <div class="col-md-2">
        <label for="">Harga Jual</label>
        <input type="text" class="form-control" name="hargajual" id="hargajual" readonly>
      </div>
      <div class="col-md-2">
        <label for="">Harga Beli</label>
        <input type="number" class="form-control" name="hargabeli" id="hargabeli">
      </div>
      <div class="col-md-1">
        <label for="">Jumlah</label>
        <input type="number" class="form-control" name="jumlah" id="jumlah">
      </div>
      <div class="col-md-1">
        <label for="">Aksi</label>
        <div class="input-group">
          <button class="btn btn-sm btn-primary" title="Tambah Item" id="tombolTambahItem">
            <i class="fa fa-plus-square"></i>
          </button> &nbsp;
          <button class="btn btn-sm btn-warning" title="Reload Data" id="tombolReload">
            <i class="fa fa-sync-alt"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="row" id="tampilDataTemp">
    </div>
    <div class="row justify-content-end">
      <button type="button" class="btn btn-lg btn-success" id="tombolSelesaiTransaksi">
        <i class="fa fa-save"></i> Selesai Transaksi
      </button>
    </div>
  </div>
</div>

<div style="display: none;" class="modalcaribarang">

</div>
<div style="display: none;" class="viewmodal"></div>

<script>
  // jquery Faktur
  function dataTemp() {
    let faktur = $('#faktur').val();
    $.ajax({
      type: "post",
      url: "/barangmasuk/dataTemp",
      data: {
        faktur: faktur
      },
      dataType: "json",
      success: function(response) {
        if (response.data) {
          $('#tampilDataTemp').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }

  function kosong() {
    $('#kdbarang').val('');
    $('#namabarang').val('');
    $('#hargajual').val('');
    $('#hargabeli').val('');
    $('#jumlah').val('');
    $('#kdbarang').focus();

  }

  function ambilDataBarang() {
    let kodebarang = $('#kdbarang').val();
    $.ajax({
      type: "post",
      url: "/barangmasuk/ambilDataBarang",
      data: {
        kodebarang: kodebarang
      },
      dataType: "json",
      success: function(response) {
        if (response.sukses) {
          let data = response.sukses;
          $('#namabarang').val(data.namabarang);
          $('#hargajual').val(data.hargajual);
          $('#hargabeli').focus();
        }
        if (response.error) {
          alert(response.error);
          kosong();
        }
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }

  $(document).ready(function() {
    dataTemp();
    // jquery barang
    $('#kdbarang').keydown(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        ambilDataBarang();
      }
    });

    $('#tombolTambahItem').click(function(e) {
      e.preventDefault();
      let faktur = $('#faktur').val();
      let kodebarang = $('#kdbarang').val();
      let hargabeli = $('#hargabeli').val();
      let jumlah = $('#jumlah').val();
      let hargajual = $('#hargajual').val();

      if (faktur.length == 0) {
        Swal.fire({
          icon: 'error',
          title: 'Error...',
          text: 'Maaf Faktur tidak boleh kosong',
        })
      } else if (kodebarang.length == 0) {
        Swal.fire({
          icon: 'error',
          title: 'Error...',
          text: 'Maaf Kode Barang tidak boleh kosong',
        })
      } else if (hargabeli == '') {
        Swal.fire({
          icon: 'error',
          title: 'Error...',
          text: 'Maaf Harga Beli tidak boleh kosong',
        })
      } else if (jumlah == '') {
        Swal.fire({
          icon: 'error',
          title: 'Error...',
          text: 'Maaf Jumlah tidak boleh kosong',
        })
      } else {
        $.ajax({
          type: "post",
          url: "/barangmasuk/simpanTemp",
          data: {
            faktur: faktur,
            kodebarang: kodebarang,
            hargabeli: hargabeli,
            hargajual: hargajual,
            jumlah: jumlah,


          },
          dataType: "json",
          success: function(response) {
            alert(response.sukses);
            kosong();
            dataTemp();
          },
          error: function(xhr, ajaxOptions, ThrownError) {
            alert(xhr.status + '\n' + ThrownError)
          }
        });
      }
    });

    $('#tombolReload').click(function(e) {
      e.preventDefault();
      dataTemp();
    });

    $('#tombolCariBarang').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/barangmasuk/cariDataBarang",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            $('.modalcaribarang').html(response.data).show();
            $('#modalcaribarang').modal('show');
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    });

    $('#tombolSelesaiTransaksi').click(function(e) {
      e.preventDefault();
      let faktur = $('#faktur').val();

      if (faktur.length == 0) {
        Swal.fire({
          title: 'Pesan',
          icon: "warning",
          text: 'Maaf Faktur tidka boleh kosong'
        });
      } else {
        Swal.fire({
          title: 'Selesai Transaksi ?',
          text: "Yakin ingin simpan Transaksi ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Simpan'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: "post",
              url: "/barangmasuk/selesaiTransaksi",
              data: {
                faktur: faktur,
                tglfaktur: $('#tglfaktur').val(),
                idsuplier: $('#idsuplier').val(),
              },
              dataType: "json",
              success: function(response) {
                if (response.error) {
                  Swal.fire({
                    title: 'Error',
                    icon: "error",
                    text: response.error
                  });
                }
                if (response.sukses) {
                  Swal.fire({
                    title: 'Berhasil',
                    icon: "success",
                    text: response.sukses
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.reload();
                    }
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
    });

    $('#tombolTambahSuplier').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/suplier/formtambah",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            $('.viewmodal').html(response.data).show();
            $('#modaltambahsuplier').modal('show');
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });

    });

    $('#tombolCariSuplier').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/suplier/modalData",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            $('.viewmodal').html(response.data).show();
            $('#modaldatasuplier').modal('show');
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    });

  });
</script>

<?= $this->endSection('isi'); ?>