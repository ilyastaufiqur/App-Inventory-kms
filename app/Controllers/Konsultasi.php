<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelkonsultasi;

class Konsultasi extends BaseController
{

    protected $konsul;
    public function __construct()
    {
        helper('form');
        $this->konsul = new Modelkonsultasi();
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }
    // ========== fungsi index halaman admin ===========
    public function index_admin()
    {
        // $model = $this->konsul->tampil();
        // $data = [
        //     'tampil' => $model,
        // ];

        // return view('konsultasi/index', $data);

        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_konsultasi', $cari);
            redirect()->to('/konsultasi/index_admin');
        } else {
            $cari = session()->get('cari_satuan');
        }
        $dataKonsul = $cari ? $this->konsul->cariData($cari)->paginate(5, 'konsultasi') : $this->konsul->paginate(5, 'konsultasi');
        $nohalaman = $this->request->getVar('page_konsultasi') ? $this->request->getVar('page_konsultasi') : 1;
        $data = [
            'tampil' => $dataKonsul,
            'pager' => $this->konsul->pager,
            'nohalaman' => $nohalaman,
            'cari' => $cari
        ];
        return view('konsultasi/index', $data);
    }
    public function balasKonsul($kode)
    {
        $cekData = $this->konsul->find($kode);

        if ($cekData) {

            $data = [
                'judul' => $cekData->judul,
                'nama' => $cekData->nama,
                'email' => $cekData->email,
                'konsul_pesan' => $cekData->pesan_konsul,
            ];
            return view('konsultasi/balaskonsul', $data);
        } else {
            $pesan_error = [
                'error' =>
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Data Barang tidak ditemukan...
                </div>'
            ];
            session()->setFlashdata($pesan_error);
            return redirect()->to('/konsultasi/index_admin');
        }
    }

    public function kirim()
    {

        if ($this->request->getMethod() == 'post') {
            $email_tujuan = $this->request->getVar('email');
            $subject = $this->request->getVar('judul');
            $pesan = $this->request->getVar('balas_konsul');

            $email = service('email');
            $email->setTo($email_tujuan);
            $email->setFrom('admin@KomunitasMundhutSayur', 'Konsultasi');

            $email->setSubject($subject);
            $email->setMessage($pesan);

            if ($email->send()) {
                // sukses
                $pesan_sukses = [
                    'sukses' =>
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        Balasan Pesan dengan Judul Konsultasi  <strong>' . $subject . '</strong> berhasil dikirim
                    </div>'
                ];
                session()->setFlashdata($pesan_sukses);
                return redirect()->to('konsultasi/index_admin');
            } else {
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }
        } else {

            return view('konsultasi/index_admin');
        }
    }
    public function update()
    {
        $model = new Modelkonsultasi();
        $id = $this->request->getPost('konsul_id');
        $data = array(
            'pesan_aktif' => $this->request->getPost('pesan_aktif'),
            'nama' => $this->request->getPost('nama'),
        );
        $model->updateKonsul($data, $id);
        return redirect()->to('/konsultasi/index_admin');
    }



    // =============== fungsi index halaman user ===============
    // public function listData()
    // {
    //     return view('user_konsul/listdata');
    // }
    // public function formKonsul()
    // {
    //     return view('user_konsul/form_konsul');
    // }

    // public function simpan()
    // {
    //     $judul = $this->request->getPost("judul");
    //     $nama = $this->request->getPost("nama");
    //     $email = $this->request->getPost("email");
    //     $konsul_pesan = $this->request->getPost("pesan_konsul");

    //     $data = [
    //         'judul'  => $judul,
    //         'nama'  => $nama,
    //         'email' => $email,
    //         'pesan_konsul'  => $konsul_pesan,
    //     ];


    //     $simpan = $this->konsul->simpanData($data);
    //     if ($simpan) {

    //         $pesan_sukses = [
    //             'sukses' =>
    //             '<div class="alert alert-success alert-dismissible">
    //                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    //                 <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
    //                 Konsultasi dengan Judul <strong>' . $judul . '</strong> berhasil dikirim ,mohon tunggu balasan email
    //                 <strong class="text-danger">di kontak spam</strong>
    //             </div>'
    //         ];
    //         session()->setFlashdata($pesan_sukses);
    //         return redirect()->to('konsultasi/formkonsul');
    //     } else {
    //         echo '<script>alert("pesan gagal dikirim") window.location(' . base_url('/konsultasi') . ')</script>';
    //     }
    // }
}
