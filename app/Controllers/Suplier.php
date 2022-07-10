<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelsuplier;
use App\Models\Modeldatasuplier;
use Config\Services;

class Suplier extends BaseController
{
    public function formtambah()
    {
        $json = ['data' => view('suplier/modaltambah')];
        echo json_encode($json);
    }

    public function simpan()
    {
        $namasuplier = $this->request->getPost('namasup');
        $telp = $this->request->getPost('telp');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namasup' => [
                'rules' => 'required',
                'label' => 'Nama Suplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'telp' => [
                'rules' => 'required|is_unique[suplier.suptelp]',
                'label' => 'No.Telp/HP',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah dipakai, Mohon masukkan no.telp yang lain!'
                ]
            ],
        ]);
        if (!$valid) {
            $json = [
                'error' => [
                    'errNamaSuplier' => $validation->getError('namasup'),
                    'errTelp' => $validation->getError('telp'),
                ]
            ];
        } else {
            $modelSuplier = new Modelsuplier();
            $modelSuplier->insert([
                'supnama' => $namasuplier,
                'suptelp' => $telp
            ]);

            $rowData = $modelSuplier->ambilDataTerakhir()->getRowArray();

            $json = [
                'sukses' => 'Data Suplier Berhasil Disimpan, ambil data terakhir ?',
                'namasuplier' => $rowData['supnama'],
                'idsuplier' => $rowData['supid'],
            ];
        }
        echo json_encode($json);
    }

    public function modalData()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('suplier/modaldata')
            ];
            echo json_encode($json);
        }
    }
    public function listData()
    {
        $request = Services::request();
        $datamodel = new Modeldatasuplier($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tombolPilih = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"pilih('" . $list->supid . "','" . $list->supnama . "')\">Pilih</button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->supid . "','" . $list->supnama . "')\">Hapus</button>";
                $row[] = $no;
                $row[] = $list->supnama;
                $row[] = $list->suptelp;
                $row[] = $tombolPilih . " " . $tombolHapus;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }
    function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $modelSuplier = new Modelsuplier();
            $modelSuplier->delete($id);

            $json = [
                'sukses' => 'Data pelanggan berhasil dihapus'
            ];
            echo json_encode($json);
        }
    }
}
