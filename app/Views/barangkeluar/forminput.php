<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Input Transaksi Barang Keluar
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<button type="button" class="btn btn-sm btn-warning " onclick="location.href=('/barangkeluar/data')">
  <i class="fa fa-backward"></i> kembali
</button>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<div class="row">
  <div class="col-lg-4">
    <div class="form-group">
      <label for="">No.Faktur</label>
      <input type="text" id="nofaktur" name="nofaktur" class="form-control" value="<?= $nofaktur; ?>" readonly>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <label for="">Tanggal Faktur</label>
      <input type="date" id="tglfaktur" name="tglfaktur" class="form-control" value="<?= date('Y-m-d') ?>">
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <label for="">Cari pelanggan</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nama Pelanggan" id="namapelanggan" name="namapelanggan" readonly>
        <input type="hidden" name="idpelanggan" id="idpelanggan">
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" id="tombolCariPelanggan" title="Cari Pelanggan">
            <i class="fa fa-search"></i>
          </button>
          <button class="btn btn-outline-success" type="button" id="tombolTambahPelanggan" title="Tambah Pelanggan">
            <i class="fa fa-plus-square"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-2">
    <div class="form-group">
      <label for="">Kode Barang</label>
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
        <button type="button" class="btn btn-success" title="Simpan Item" id="tombolSimpanItem">
          <i class="fa fa-save"></i>
        </button>
        <button type="button" class="btn btn-sm btn-info ml-1" title="Selesai Transaksi" id="tombolSelesaiTransaksi">
          selesai transaksi
        </button>
      </div>
    </div>
  </div>
</div>
<div class="row mt-4">
  <div class="col-lg-12 tampilDataTemp">

  </div>
</div>
<div style="display: none;" class="viewmodal">

</div>

<script>
  function kosong() {
    $('#kodebarang').val('');
    $('#namabarang').val('');
    $('#hargajual').val('');
    $('#jml').val('1');
    $('#kodebarang').focus();
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
        url: "/barangkeluar/simpanItem",
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
            tampilDataTemp();
            kosong();
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    }
  }

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

  function tampilDataTemp() {
    let faktur = $('#nofaktur').val();
    $.ajax({
      type: "post",
      url: "/barangkeluar/tampilDataTemp",
      data: {
        nofaktur: faktur
      },
      dataType: "json",
      beforeSend: function() {
        $('.tampilDataTemp').html('<i class="fa fa-spin fa-spinner"></i>');
      },
      success: function(response) {
        if (response.data) {
          $('.tampilDataTemp').html(response.data);
        }
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }

  function buatNoFaktur() {
    let tanggal = $('#tglfaktur').val();

    $.ajax({
      type: "post",
      url: "/barangkeluar/buatNoFaktur",
      data: {
        tanggal: tanggal
      },
      dataType: "json",
      success: function(response) {
        $('#nofaktur').val(response.nofaktur);
        tampilDataTemp();
      },
      error: function(xhr, ajaxOptions, ThrownError) {
        alert(xhr.status + '\n' + ThrownError)
      }
    });
  }
  $(document).ready(function() {
    tampilDataTemp();
    $('#tglfaktur').change(function(e) {
      buatNoFaktur();

    });

    $('#tombolTambahPelanggan').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/pelanggan/formtambah",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            $('.viewmodal').html(response.data).show();
            $('#modaltambahpelanggan').modal('show');
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });

    });

    $('#tombolCariPelanggan').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: "/pelanggan/modalData",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            $('.viewmodal').html(response.data).show();
            $('#modaldatapelanggan').modal('show');
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    });
    $('#kodebarang').keydown(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        ambilDataBarang();
      }

    });
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
    $('#tombolSelesaiTransaksi').click(function(e) {
      e.preventDefault();
      $.ajax({
        type: "post",
        url: "/barangkeluar/modalPembayaran",
        data: {
          nofaktur: $('#nofaktur').val(),
          tglfaktur: $('#tglfaktur').val(),
          idpelanggan: $('#idpelanggan').val(),
          totalharga: $('#totalharga').val(),

        },
        dataType: "json",
        success: function(response) {
          if (response.error) {
            Swal.fire('Error', response.error, 'error');
          }
          if (response.data) {
            $('.viewmodal').html(response.data).show();
            $('#modalpembayaran').modal('show');
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