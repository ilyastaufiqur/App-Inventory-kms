<?= $this->extend('main/layout_user'); ?>


<?= $this->section('isi_user'); ?>
<?= form_open_multipart('chat/simpandata'); ?>
<?= session()->getFlashdata('error'); ?>
<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">User id</label>
  <div class="col-sm-4">
    <select name="chat_by" id="chat_by" class="form-control" readonly="true">
      <option> - Cari User ID Anda - </option>
      <?php foreach ($datausers->getResultArray() as $user) :  ?>
        <option selected value="<?= $user['id']; ?>"><?= $user['userid']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label">Pesan</label>
  <div class="col-sm-4">
    <textarea name="chat" class="form-control" id="chat" rows="6"></textarea>
  </div>
</div>
<div class="form-group row">
  <label for="" class="col-sm-4 col-form-label"></label>
  <div class="col-sm-8">
    <input type="submit" value="simpan" class="btn btn-success">
  </div>
</div>
<?= form_close(); ?>

<?= $this->endSection('isi_user'); ?>