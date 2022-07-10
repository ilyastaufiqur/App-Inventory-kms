<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\Modelbarangkeluar;
use App\Models\Modeldatabarang;
use App\Models\Modeldatabarangkeluar;
use App\Models\Modeldetailbarangkeluar;
use App\Models\Modelpelanggan;
use App\Models\Modeltempbarangkeluar;
use Config\Services;
use CodeIgniter\HTTP\Response;

class Barangkeluar extends BaseController
{
    private function buatFaktur()
    {
        $tanggalSekarang = date('Y-m-d');
        $modelBarangKeluar = new Modelbarangkeluar();

        $hasil = $modelBarangKeluar->nomorFakturAuto($tanggalSekarang)->getRowArray();
        $data = $hasil['nofaktur'];

        $lastNoUrut = substr($data, -4);
        // nomor urut ditambah 1
        $nextNoUrut = intval($lastNoUrut) + 1;
        // buat format nomor transaksi berikutnya
        $noFaktur = date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);
        return $noFaktur;
    }
    public function buatNoFaktur()
    {
        $tanggalSekarang = $this->request->getPost('tanggal');
        $modelBarangKeluar = new Modelbarangkeluar();

        $hasil = $modelBarangKeluar->nomorFakturAuto($tanggalSekarang)->getRowArray();
        $data = $hasil['nofaktur'];

        $lastNoUrut = substr($data, -4);
        // nomor urut ditambah 1
        $nextNoUrut = intval($lastNoUrut) + 1;
        // buat format nomor transaksi berikutnya
        $noFaktur = date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);

        $json = [
            'nofaktur' => $noFaktur
        ];
        echo json_encode($json);
    }
    public function data()
    {
        return view('barangkeluar/viewdata');
    }

    public function listData()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $request = Services::request();
        $datamodel = new Modeldatabarangkeluar($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables($tglawal, $tglakhir);
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tombolCetak = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"cetak('" . $list->faktur . "')\"><i class=\"fa fa-print\"></i></button>";
                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->faktur . "')\"><i class=\"fa fa-trash-alt\"></i></button>";
                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-warning\" onclick=\"edit('" . $list->faktur . "')\"><i class=\"fa fa-edit\"></i></button>";

                $row[] = $no;
                $row[] = $list->faktur;
                $row[] = $list->tglfaktur;
                $row[] = $list->pelnama;
                $row[] = number_format($list->totalharga, 0, ",", ".");
                $row[] = $tombolCetak . " " . $tombolHapus . " " . $tombolEdit;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all($tglawal, $tglakhir),
                "recordsFiltered" => $datamodel->count_filtered($tglawal, $tglakhir),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function input()
    {
        $data = [
            'nofaktur' => $this->buatFaktur(),
        ];
        return view('barangkeluar/forminput', $data);
    }

    public function tampilDataTemp()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');

            $modalTempBarangKeluar = new Modeltempbarangkeluar;
            $dataTemp = $modalTempBarangKeluar->tampilDataTemp($nofaktur);
            $data = [
                'tampildata' => $dataTemp
            ];
            $json = [
                'data' => view('barangkeluar/datatemp', $data)
            ];
            echo json_encode($json);
        }
    }
    public function ambilDataBarang()
    {
        if ($this->request->isAJAX()) {
            $kodebarang = $this->request->getPost('kodebarang');
            $modelBarang = new Modelbarang();
            $cekData = $modelBarang->find($kodebarang);
            if ($cekData == null) {
                $json = [
                    'error' => 'Maaf data tidak ditemukan'
                ];
            } else {
                $data = [
                    'namabarang' => $cekData['brgnama'],
                    'hargajual' => $cekData['brgharga'],
                ];
                $json = [
                    'sukses' => $data
                ];
            }
            echo json_encode($json);
        }
    }
    public function simpanItem()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');
            $kodebarang = $this->request->getPost('kodebarang');
            $namabarang = $this->request->getPost('namabarang');
            $jml = $this->request->getPost('jml');
            $hargajual = $this->request->getPost('hargajual');

            $tempBarangKeluar = new Modeltempbarangkeluar();
            $modelBarang = new Modelbarang();
            $ambilDataBarang = $modelBarang->find($kodebarang);
            $stokBarang = $ambilDataBarang['brgstok'];

            if ($jml > intval($stokBarang)) {
                $json = [
                    'error' => 'Maaf stok tidak mencukupi'
                ];
            } else {
                $tempBarangKeluar->insert([
                    'detfaktur' => $nofaktur,
                    'detbrgkode' => $kodebarang,
                    'dethargajual' => $hargajual,
                    'detjml' => $jml,
                    'detsubtotal' => intval($jml) * intval($hargajual)

                ]);

                $json = [
                    'sukses' => 'item berhasil ditambahkan'
                ];
            }

            echo json_encode($json);
        }
    }
    public function hapusItem()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $modelTempBarangKeluar = new Modeltempbarangkeluar();
            $modelTempBarangKeluar->delete($id);
            $json = [
                'sukses' => 'Berhasil Dihapus'
            ];
            echo json_encode($json);
        }
    }

    public function modalCariBarang()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('barangkeluar/modalcaribarang')
            ];
            echo json_encode($json);
        }
    }
    public function listDataBarang()
    {
        $request = Services::request();
        $datamodel = new Modeldatabarang($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tombolPilih = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"pilih('" . $list->brgkode . "')\">Pilih</button>";
                $row[] = $no;
                $row[] = $list->brgkode;
                $row[] = $list->brgnama;
                $row[] = number_format($list->brgharga, 0, ",", ".");
                $row[] = number_format($list->brgstok, 0, ",", ".");
                $row[] = $tombolPilih;
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
    public function modalPembayaran()
    {
        $nofaktur = $this->request->getPost('nofaktur');
        $tglfaktur = $this->request->getPost('tglfaktur');
        $idpelanggan = $this->request->getPost('idpelanggan');
        $totalharga = $this->request->getPost('totalharga');

        $modelTem =  new Modeltempbarangkeluar();
        $cekdata = $modelTem->tampilDataTemp($nofaktur);
        if ($cekdata->getNumRows() > 0) {
            $data = [
                'nofaktur' => $nofaktur,
                'totalharga' => $totalharga,
                'tglfaktur' => $tglfaktur,
                'idpelanggan' => $idpelanggan,
            ];
            $json = [
                'data' => view('barangkeluar/modalpembayaran', $data)
            ];
        } else {
            $json = [
                'error' => 'Maaf item belum ada'
            ];
        }
        echo json_encode($json);
    }

    public function simpanPembayaran()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');
            $tglfaktur = $this->request->getPost('tglfaktur');
            $idpelanggan = $this->request->getPost('idpelanggan');
            $totalbayar = str_replace(".", "", $this->request->getPost('totalbayar'));
            $jumlahuang = str_replace(".", "", $this->request->getPost('jumlahuang'));
            $sisauang = str_replace(".", "", $this->request->getPost('sisauang'));


            $modelBarangKeluar =  new Modelbarangkeluar();
            $modelBarangKeluar->insert([
                'faktur' => $nofaktur,
                'tglfaktur' => $tglfaktur,
                'idpel' => $idpelanggan,
                'totalharga' => $totalbayar,
                'jumlahuang' => $jumlahuang,
                'sisauang' => $sisauang

            ]);
            $modelTemp = new Modeltempbarangkeluar();
            $dataTemp = $modelTemp->getWhere(['detfaktur' => $nofaktur]);
            $fieldDetail = [];
            foreach ($dataTemp->getResultArray() as $row) {
                $fieldDetail[] = [
                    'detfaktur' => $row['detfaktur'],
                    'detbrgkode' => $row['detbrgkode'],
                    'dethargajual' => $row['dethargajual'],
                    'detjml' => $row['detjml'],
                    'detsubtotal' => $row['detsubtotal'],
                ];
            }
            $modelDetail = new Modeldetailbarangkeluar();
            $modelDetail->insertBatch($fieldDetail);

            // hapus temp
            $modelTemp->hapusData($nofaktur);
            $json = [
                'sukses' => 'Transaksi Berhasil disimpan',
                'cetakfaktur' => site_url('barangkeluar/cetakfaktur/' . $nofaktur)
            ];

            echo json_encode($json);
        }
    }
    public function cetakfaktur($faktur)
    {
        $modelBarangKeluar = new Modelbarangkeluar();
        $modelDetail = new Modeldetailbarangkeluar();
        $modelPelanggan  = new Modelpelanggan();

        $cekData = $modelBarangKeluar->find($faktur);
        $dataPelanggan = $modelPelanggan->find($cekData['idpel']);
        $namaPelanggan = ($dataPelanggan != null) ? $dataPelanggan['pelnama'] : '-';
        if ($cekData != null) {
            $data = [
                'faktur' => $faktur,
                'tanggal' => $cekData['tglfaktur'],
                'namapelanggan' => $namaPelanggan,
                'detailbarang' => $modelDetail->tampilDataTemp($faktur),
                'jumlahuang' => $cekData['jumlahuang'],
                'sisauang' => $cekData['sisauang'],
            ];
            return view('barangkeluar/cetakfaktur', $data);
        } else {
            return redirect()->to(site_url('barangkeluar/input'));
        }
    }

    public function hapusTransaksi()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $modelBarangKeluar = new Modelbarangkeluar();
            $db = \Config\Database::connect();
            $db->table('detail_barangkeluar')->delete(['detfaktur' => $faktur]);
            $modelBarangKeluar->delete($faktur);

            $json = [
                'sukses' => 'Transaksi Berhasil Dihapus'
            ];
            echo json_encode($json);
        }
    }

    public function edit($faktur)
    {
        $modelBarangKeluar = new Modelbarangkeluar();
        $modelPelanggan = new Modelpelanggan();
        $rowData = $modelBarangKeluar->find($faktur);
        $rowPelanggan = $modelPelanggan->find($rowData['idpel']);

        $data = [
            'nofaktur' => $faktur,
            'tanggal' => $rowData['tglfaktur'],
            'pelanggan' => $rowPelanggan['pelnama'],

        ];
        return view('barangkeluar/formedit', $data);
    }

    public function ambilTotalHarga()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');
            $modelDetail = new Modeldetailbarangkeluar();

            $totalHarga = $modelDetail->ambilTotalHarga($nofaktur);
            $json = [
                'totalharga' => "Total: " . "Rp." . number_format($totalHarga, 0, ",", ".")
            ];
            echo json_encode($json);
        }
    }
    public function tampilDataDetail()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');

            $modelDetail = new Modeldetailbarangkeluar();
            $dataTemp = $modelDetail->tampilDataTemp($nofaktur);
            $data = [
                'tampildata' => $dataTemp
            ];
            $json = [
                'data' => view('barangkeluar/datadetail', $data)
            ];
            echo json_encode($json);
        }
    }
    public function hapusItemDetail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $modelDetail = new Modeldetailbarangkeluar();
            $modelBarangKeluar =  new Modelbarangkeluar();

            $rowData = $modelDetail->find($id);
            $noFaktur = $rowData['detfaktur'];

            $modelDetail->delete($id);

            $totalHarga = $modelDetail->ambilTotalHarga($noFaktur);

            // update total harga 
            $modelBarangKeluar->update($noFaktur, [
                'totalharga' => $totalHarga
            ]);


            $json = [
                'sukses' => 'Berhasil Dihapus'
            ];
            echo json_encode($json);
        }
    }

    public function editItem()
    {
        if ($this->request->isAJAX()) {

            $iddetail = $this->request->getPost('iddetail');
            $jml = $this->request->getPost('jml');

            $modelDetail = new Modeldetailbarangkeluar();
            $modelBarangKeluar = new Modelbarangkeluar();

            $rowData = $modelDetail->find($iddetail);
            $noFaktur = $rowData['detfaktur'];
            $hargajual = $rowData['dethargajual'];

            // lakukan update table detail
            $modelDetail->update($iddetail, [
                'detjml' => $jml,
                'detsubtotal' => intval($hargajual) * $jml
            ]);

            // ambil total harga
            $totalHarga = $modelDetail->ambilTotalHarga($noFaktur);

            // update barang keluar
            $modelBarangKeluar->update($noFaktur, [
                'totalharga' => $totalHarga
            ]);

            $json = [
                'sukses' => 'Item Berhasil diupdate'
            ];

            echo json_encode($json);
        }
    }

    public function simpanItemDetail()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');
            $kodebarang = $this->request->getPost('kodebarang');
            $namabarang = $this->request->getPost('namabarang');
            $jml = $this->request->getPost('jml');
            $hargajual = $this->request->getPost('hargajual');

            $detailBarangKeluar = new Modeldetailbarangkeluar();
            $modelBarangKeluar = new Modelbarangkeluar();
            $modelBarang = new Modelbarang();
            $ambilDataBarang = $modelBarang->find($kodebarang);
            $stokBarang = $ambilDataBarang['brgstok'];

            if ($jml > intval($stokBarang)) {
                $json = [
                    'error' => 'Maaf stok tidak mencukupi'
                ];
            } else {
                $detailBarangKeluar->insert([
                    'detfaktur' => $nofaktur,
                    'detbrgkode' => $kodebarang,
                    'dethargajual' => $hargajual,
                    'detjml' => $jml,
                    'detsubtotal' => $jml * $hargajual

                ]);



                // ambil total harga
                $totalHarga = $detailBarangKeluar->ambilTotalHarga($nofaktur);

                // update barang keluar
                $modelBarangKeluar->update($nofaktur, [
                    'totalharga' => $totalHarga
                ]);

                $json = [
                    'sukses' => 'item berhasil ditambahkan'
                ];
            }

            echo json_encode($json);
        }
    }
}
