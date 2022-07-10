<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Edit Transaksi Barang Keluar
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<button type="button" class="btn btn-sm btn-warning " onclick="location.href=('/barangkeluar/data')">
  <i class="fa fa-backward"></i> kembali
</button>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<style>
  table#datadetail tbody tr:hover {
    cursor: pointer;
    background-color: red;
    color: white;
    font-weight: bold;
  }
</style>
<table class="table table-striped table-sm">
  <tr>
    <input type="hidden" id="nofaktur" value="<?= $nofaktur; ?>">
    <td style="width: 20%;">No.Faktur</td>
    <td style="width: 2%;">:</td>
    <td style="width: 28%;"><?= $nofaktur; ?></td>
    <td rowspan="3" style="width: 50%; font-weight: bold; color: blue; font-size: 18pt; text-align: center; vertical-align: middle;" id="labelTotalHarga">

    </td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>:</td>
    <td><?= $tanggal; ?></td>
  </tr>
  <tr>
    <td>Nama Pelanggan</td>
    <td>:</td>
    <td><?= $pelanggan; ?></td>
  </tr>
</table>
<div class="row mt-3">
  <div class="col-lg-2">
    <div class="form-group">
      <label for="">Kode Barang</label>
      <input type="hidden" id="iddetail">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="kodebarang" id="kodebarang">
        <div class="input-group-append">
          <button class="btn btn-outline-info" type="button" id="tombolCariBarang">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <label for="">Nama Barang</label>
      <input type="text" class="form-control" name="namabarang" id="namabarang" readonly>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <label for="">Harga Jual</label>
      <input type="text" class="form-control" name="hargajual" id="hargajual" readonly>
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <label for="">Qty</label>
      <input type="number" class="form-control" name="jml" id="jml" value="1">
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <label for="">Aksi</label>
      <div class="input-group mb-3">
        <button type="button" class="btn btn-success ml-1" title="Simpan Item" id="tombolSimpanItem">
          <i class="fa fa-save"></i>
        </button>
        <button class="btn btn-primary ml-1" type="button" style="display:none ;" title="tombol edit" id="tombolEditItem">
          <i class="fa fa-edit"></i>
        </button>
        <button class="btn btn-default ml-1" type="button" style="display:none ;" title="batalkan" id="tombolBatal">
          <i class="fa fa-sync-alt"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col-lg-12 tampilDataDetail">

  </div>
</div>
<div style="display: none;" class="viewmodal">

</div>

<script>
  function ambilDataBarang() {
    let kodebarang = $('#kodebarang').val();
    if (kodebarang.length == 0) {
      Swal.fire('Error', 'Kode barang harus di inputkan', 'error');
      kosong();
    } else {
      $.ajax({
        type: "post",
        url: "/barangkeluar/ambilDataBarang",
        data: {
          kodebarang: kodebarang
        },
        dataType: "json",
        success: function(response) {
          if (response.error) {
            Swal.fire('Error', response.error, 'error');
            kosong();
          }
          if (response.sukses) {
            let data = response.sukses;
            $('#namabarang').val(data.namabarang);
            $('#hargajual').val(data.hargajual);
            $('#jml').focus();
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    }

  }

  function ambilTotalHarga() {
    let nofaktur = $('#nofaktur').val();
    $.ajax({
      type: "post",
      url: "/barangkeluar/ambilTotalHarga",
      data: {
        nofaktur: nofaktur
      },
      dataType: "json",
      success: function(response) {
        $('#labelTotalHarga').html(response.totalharga);
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }

  function kosong() {
    $('#kodebarang').val('');
    $('#namabarang').val('');
    $('#hargajual').val('');
    $('#jml').val('1');
    $('#kodebarang').focus();
  }

  function tampilDataDetail() {
    let faktur = $('#nofaktur').val();
    $.ajax({
      type: "post",
      url: "/barangkeluar/tampilDataDetail",
      data: {
        nofaktur: faktur
      },
      dataType: "json",
      beforeSend: function() {
        $('.tampilDataDetail').html('<i class="fa fa-spin fa-spinner"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.tampilDataDetail').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }

  function simpanItem() {
    let nofaktur = $('#nofaktur').val();
    let kodebarang = $('#kodebarang').val();
    let namabarang = $('#namabarang').val();
    let hargajual = $('#hargajual').val();
    let jml = $('#jml').val();
    if (kodebarang.length == 0) {
      Swal.fire('Error', 'Data barang harus di inputkan', 'error');
      kosong();
    } else {
      $.ajax({
        type: "post",
        url: "/barangkeluar/simpanItemDetail",
        data: {
          nofaktur: nofaktur,
          kodebarang: kodebarang,
          namabarang: namabarang,
          jml: jml,
          hargajual: hargajual
        },
        dataType: "json",
        success: function(response) {
          if (response.error) {
            Swal.fire('Error', response.error, 'error');
            kosong();
          }
          if (response.sukses) {
            Swal.fire('Berhasil', response.sukses, 'success');
            tampilDataDetail();
            ambilTotalHarga();
            kosong();
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    }
  }
  $(document).ready(function() {
    ambilTotalHarga();
    tampilDataDetail();
    $('#tombolSimpanItem').click(function(e) {
      e.preventDefault();
      simpanItem();
    });

    $('#tombolCariBarang').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/barangkeluar/modalCariBarang",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            $('.viewmodal').html(response.data).show();
            $('#modalcaribarang').modal('show');
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    });

    $('#tombolEditItem').click(function(e) {
      e.preventDefault();
      $.ajax({
        type: "post",
        url: "/barangkeluar/editItem",
        data: {
          iddetail: $('#iddetail').val(),
          jml: $('#jml').val()
        },
        dataType: "json",
        success: function(response) {
          if (response.sukses) {
            Swal.fire({
              'icon': 'success',
              'title': 'Berhasil',
              'text': response.sukses
            });
            tampilDataDetail();
            ambilTotalHarga();
            kosong();
            $('#kodebarang').prop('readonly', false)
            $('#tombolCariBarang').prop('disabled', false)
            $('#tombolSimpanItem').fadeIn();
            $('#tombolEditItem').fadeOut();
            $('#tombolBatal').fadeOut();
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