<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelkategori;

class Kategori extends BaseController
{
    // =================================================== fungsi untuk memanggil model ===================================================

    public function __construct()
    {
        $this->kategori =  new Modelkategori();
    }
    // fungsi untuk ke index
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_kategori', $cari);
            redirect()->to('/kategori/index');
        } else {
            $cari = session()->get('cari_kategori');
        }

        $dataKategori = $cari ? $this->kategori->cariData($cari)->paginate(5, 'kategori') : $this->kategori->paginate(5, 'kategori');

        $nohalaman = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $data = [
            'tampildata' => $dataKategori,
            'pager' => $this->kategori->pager,
            'nohalaman' => $nohalaman,
            'cari' => $cari
        ];
        return view('kategori/viewkategori', $data);
    }
    // =================================================== fungsi untuk tambah data ===================================================

    public function formtambah()
    {
        return view('kategori/formtambah');
    }

    // fungsi simpan data
    public function simpandata()
    {
        $namakategori = $this->request->getPost('namakategori');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namakategori' => [
                'rules' => 'required',
                'label' => 'kategori',
                'errors' => [
                    'required' => 'Nama {field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaKategori' => '<br> <div class = "alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/kategori/formtambah');
        } else {
            $this->kategori->insert([
                'katnama' => $namakategori
            ]);
            $pesan = [
                'sukses' => '<br> <div class = "alert alert-success">' . "Data Kategori Berhasil Ditambahkan..." . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/kategori/index');
        }
    }

    // =================================================== fungsi edit ===================================================
    public function formedit($id)
    {
        $rowData =  $this->kategori->find($id);

        if ($rowData) {

            $data = [
                'id' => $id,
                'nama' => $rowData['katnama']
            ];
            return view('kategori/formedit', $data);
        } else {
            exit('Data tidak Ditemukan');
        }
    }


    // =================================================== fungsi update data ====================================
    public function updatedata()
    {
        $idkategori = $this->request->getPost('idkategori');
        $namakategori = $this->request->getPost('namakategori');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namakategori' => [
                'rules' => 'required',
                'label' => 'kategori',
                'errors' => [
                    'required' => 'Nama {field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaKategori' => '<br> <div class = "alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/kategori/formedit/' . $idkategori);
        } else {
            $this->kategori->update($idkategori, [
                'katnama' => $namakategori
            ]);
            $pesan = [
                'sukses' => '<br> <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Data kategori berhasil diupdate
              </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/kategori/index');
        }
    }

    // ================================================ Fungsi Hapus Data ===============================================

    public function hapus($id)
    {
        $rowData =  $this->kategori->find($id);

        if ($rowData) {
            $this->kategori->delete($id);
            $pesan = [
                'sukses' => '<br> <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Data kategori berhasil dihapus
              </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('kategori/index');
        } else {
            exit('Data tidak Ditemukan');
        }
    }
}
