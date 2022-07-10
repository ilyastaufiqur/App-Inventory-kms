<?= $this->extend('main/layout_user'); ?>


<?= $this->section('isi_user'); ?>
<style>
  .auto-scroll {
    display: block;
    width: auto;
    height: 320px;
    overflow: auto;
  }

  #target {
    display: none;
  }
</style>

<link rel="stylesheet" href="<?= base_url() ?>/dist/css/chat.css">
<link rel="stylesheet" href="<?= base_url() ?>/dist/css/chat-2.css">
<div class="page-content page-container" id="page-content">
  <div class="padding">
    <div class="row container d-flex justify-content-center">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h2><span style="color: royalblue ; font-weight: bold;"><?= session()->get('namauser'); ?></span></h2>
          </div>
          <div class="card-body">
            <h5 class="card-title">Perhatian</h5>
            <div class="text-danger">
              <span style="font-weight:bold ;">jika ada garis hijau di kolom chat admin artinya pesan anda belom dibalas!!!</span>
              <hr>
            </div>
            <a href="<?= site_url('konsultasi/formKonsul'); ?>" class="btn btn-info">Mau pesan kamu dikirim email ? klik Disini </a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="box box-warning direct-chat direct-chat-warning">
          <div class="box-header with-border">
            <?= session()->getFlashdata('sukses'); ?>
            <?= form_button('', '<i class="fa fa-plus-circle"></i> Mulai Chat', [
              'class' => 'btn btn-primary btn-sm',
              'onclick' => "location.href=('" . site_url('chat/tambah') . "')"
            ]) ?>
            <button class="open-button btn-sm btn-info ml-4" onclick="fungsiSaya()">Lihat Pesan Konsultasi</button>
          </div>
          <div class="direct-chat-msg auto-scroll col-sm-12" id="target">
            <?php
            foreach ($chat as $row) :
            ?>
              <img class="direct-chat-img mb-1" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">
              <small class="direct-chat-name pull-left text-danger text-bold mb-1">
                <?= $row->usernama; ?>
              </small>
              <div class="direct-chat-text col-sm-9">
                <?= $row->chat; ?>
              </div>
              <div class="direct-chat-msg right col-sm-12 mt-1 ml-4">
                <img class="direct-chat-img" src="https://img.icons8.com/office/36/000000/person-female.png" alt="message user image">
                <small class="direct-chat-name text-bold ml-5">team mundhut sayur</small>
                <div class="direct-chat-text col-sm-10">
                  <?= $row->balas_chat; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function fungsiSaya() {

    var x = document.getElementById('target')
    if (x.style.display === 'none') {
      x.style.display = 'block';
    } else {
      x.style.display = 'none';
    }
  }
</script>
<?= $this->endSection('isi_user'); ?>