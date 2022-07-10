<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelsatuan;

class Satuan extends BaseController
{
    // fungsi untuk memanggil model
    public function __construct()
    {
        $this->satuan =  new Modelsatuan();
    }
    // fungsi untuk ke index
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_satuan', $cari);
            redirect()->to('/satuan/index');
        } else {
            $cari = session()->get('cari_satuan');
        }

        $dataSatuan = $cari ? $this->satuan->cariData($cari)->paginate(5, 'satuan') : $this->satuan->paginate(5, 'satuan');

        $nohalaman = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $data = [
            'tampildata' => $dataSatuan,
            'pager' => $this->satuan->pager,
            'nohalaman' => $nohalaman,
            'cari' => $cari
        ];
        return view('satuan/viewsatuan', $data);
    }
    // fungsi untuk tambah data
    public function formtambah()
    {
        return view('satuan/formtambah');
    }

    // fungsi simpan data
    public function simpandata()
    {
        $namasatuan = $this->request->getPost('namasatuan');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namasatuan' => [
                'rules' => 'required',
                'label' => 'satuan',
                'errors' => [
                    'required' => 'Nama {field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaSatuan' => '<br> <div class = "alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/formtambah');
        } else {
            $this->satuan->insert([
                'satnama' => $namasatuan
            ]);
            $pesan = [
                'sukses' => '<br> <div class = "alert alert-success">' . "Data Satuan Berhasil Ditambahkan..." . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/index');
        }
    }

    // fungsi edit
    public function formedit($id)
    {
        $rowData =  $this->satuan->find($id);

        if ($rowData) {

            $data = [
                'id' => $id,
                'nama' => $rowData['satnama']
            ];
            return view('satuan/formedit', $data);
        } else {
            exit('Data tidak Ditemukan');
        }
    }

    // fungsi update data
    public function updatedata()
    {
        $idsatuan = $this->request->getPost('idsatuan');
        $namasatuan = $this->request->getPost('namasatuan');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namasatuan' => [
                'rules' => 'required',
                'label' => 'satuan',
                'errors' => [
                    'required' => 'Nama {field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaSatuan' => '<br> <div class = "alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/formedit/' . $idsatuan);
        } else {
            $this->satuan->update($idsatuan, [
                'satnama' => $namasatuan
            ]);
            $pesan = [
                'sukses' => '<br> <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                   Data satuan berhasil diupdate
                 </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/index');
        }
    }

    public function hapus($id)
    {
        $rowData =  $this->satuan->find($id);

        if ($rowData) {
            $this->satuan->delete($id);
            $pesan = [
                'sukses' => '<br> <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                   Data satuan berhasil dihapus
                 </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('satuan/index');
        } else {
            exit('Data tidak Ditemukan');
        }
    }
}
