<!-- Modal -->
<div class="modal fade" id="modaltambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?= form_open('users/simpan', ['class' => 'frmsimpan']) ?>
      <div class="modal-body">
        <div class="form-group">
          <label>ID User</label>
          <input type="text" name="iduser" id="iduser" class="form-control form-control-sm" autocomplete="off">
          <div id="msg-iduser" class="invalid-feedback">
          </div>
        </div>
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="namalengkap" id="namalengkap" class="form-control form-control-sm" autocomplete="off">
          <div id="msg-namalengkap" class="invalid-feedback">

          </div>
        </div>
        <div class="form-group">
          <label>Level User</label>
          <select name="level" id="level" class="form-control form-control-sm">
            <option value="" selected>-Pilih-</option>
            <?php foreach ($datalevel->getResultArray() as $l) :  ?>
              <option value="<?= $l['levelid']; ?>"><?= $l['levelnama']; ?></option>
            <?php endforeach; ?>
          </select>
          <div id="msg-level" class="invalid-feedback">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btnsimpan">Simpan</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.frmsimpan').submit(function(e) {
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
          $('.btnsimpan').html('Simpan');
        },
        success: function(response) {
          if (response.error) {
            let err = response.error;
            if (err.iduser) {
              $('#iduser').addClass('is-invalid');
              $('#msg-iduser').html(err.iduser);
            } else {
              $('#iduser').removeClass('is-invalid');
              $('#iduser').addClass('is-valid');
              $('#msg-iduser').html('');
            }
            if (err.namalengkap) {
              $('#namalengkap').addClass('is-invalid');
              $('#msg-namalengkap').html(err.namalengkap);
            }
            if (err.level) {
              $('#level').addClass('is-invalid');
              $('#msg-level').html(err.level);
            }
          } else {
            Swal.fire({
              icon: 'success',
              title: 'berhasil',
              text: response.sukses,
            });
            $('#modaltambah').modal('hide');
            dataUser.ajax.reload();
          }
        },
        error: function(xhr, ajaxOptions, ThrownError) {
          alert(xhr.status + '\n' + ThrownError)
        }
      });
    });
  });
</script>