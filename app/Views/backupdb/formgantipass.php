<?= $this->extend('main/layout'); ?>

<?= $this->section('judul'); ?>
Utility System Password
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Ganti Password
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= form_open('backupdb/updatepassword', ['class' => 'frmupdatepass']) ?>
<div class="form-group row">
  <label for="" class="col-sm-3 col-form-label">Password Lama</label>
  <div class="col-sm-4">
    <input type="password" name="passlama" class="form-control" id="passlama" autocomplete="off">
    <div id="msg-passlama" class="invalid-feedback">
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-3 col-form-label">Password baru</label>
  <div class="col-sm-4">
    <input type="password" name="passbaru" class="form-control" id="passbaru" autocomplete="off">
    <div id="msg-passbaru" class="invalid-feedback">
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
  <div class="col-sm-4">
    <input type="password" name="confirmpass" class="form-control" id="confirmpass" autocomplete="off">
    <div id="msg-confirmpass" class="invalid-feedback">
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-3 col-form-label"></label>
  <div class="col-sm-8">
    <input type="submit" value="Ganti Password" class="btn btn-success btnsimpan mt-4">
  </div>
</div>
<?= form_close(); ?>

<script>
  $(document).ready(function() {
    $('.frmupdatepass').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        cache: false,
        beforeSend: function() {
          $('.btnsimpan').prop('disabled', true)
          $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
        },
        complete: function() {
          $('.btnsimpan').prop('disabled', false)
          $('.btnsimpan').html('Ganti Password');
        },
        success: function(response) {
          if (response.error) {
            let err = response.error;
            if (err.passlama) {
              $('#passlama').addClass('is-invalid');
              $('#msg-passlama').html(err.passlama);
            } else {
              $('#passlama').removeClass('is-invalid');
              $('#passlama').addClass('is-valid');
              $('#msg-passlama').html('');
            }
            if (err.passbaru) {
              $('#passbaru').addClass('is-invalid');
              $('#msg-passbaru').html(err.passbaru);
            } else {
              $('#passbaru').removeClass('is-invalid');
              $('#passbaru').addClass('is-valid');
              $('#msg-passbaru').html('');
            }
            if (err.confirmpass) {
              $('#confirmpass').addClass('is-invalid');
              $('#msg-confirmpass').html(err.confirmpass);
            } else {
              $('#confirmpass').removeClass('is-invalid');
              $('#confirmpass').addClass('is-valid');
              $('#msg-confirmpass').html('');
            }
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Ganti Password',
              text: response.sukses,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = '/login/keluar';
              }
            });
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