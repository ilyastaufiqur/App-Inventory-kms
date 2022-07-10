<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\Modeltempbarangmasuk;
use App\Models\Modelbarangmasuk;
use App\Models\Modeldetailbarangmasuk;
use App\Models\Modelsuplier;
use CodeIgniter\HTTP\Request;
use CodeIgniter\Model;

class Barangmasuk extends BaseController
{
    public function index()
    {
        return view('barangmasuk/forminput');
    }

    public function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelTemp = new Modeltempbarangmasuk();
            $data = [
                'datatemp' => $modelTemp->tampilDataTemp($faktur)
            ];

            $json = [
                'data' => view('barangmasuk/datatemp', $data)
            ];
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function ambilDataBarang()
    {
        if ($this->request->isAJAX()) {
            $kodebarang = $this->request->getPost('kodebarang');
            $modelbarang = new Modelbarang();
            $ambilData = $modelbarang->find($kodebarang);

            if ($ambilData == null) {
                $json = [
                    'error' => 'Data Barang tidak ditemukan'
                ];
            } else {
                $data = [
                    'namabarang' => $ambilData['brgnama'],
                    'hargajual' => $ambilData['brgharga']
                ];
                $json = [
                    'sukses' => $data
                ];
            }
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $hargajual = $this->request->getPost('hargajual');
            $hargabeli = $this->request->getPost('hargabeli');
            $kodebarang = $this->request->getPost('kodebarang');
            $jumlah = $this->request->getPost('jumlah');

            $modelTempBarang = new Modeltempbarangmasuk();

            $modelTempBarang->insert([
                'detfaktur' => $faktur,
                'detbrgkode' => $kodebarang,
                'dethargajual' => $hargajual,
                'dethargamasuk' => $hargabeli,
                'detjml' => $jumlah,
                'detsubtotal' => intval($jumlah) * intval($hargabeli)
            ]);
            $json = [
                'sukses' => 'item berhasil ditambahkan'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $modelTempBarang = new Modeltempbarangmasuk();
            $modelTempBarang->delete($id);
            $json = [
                'sukses' => 'item berhasil dihapus'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function cariDataBarang()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('barangmasuk/modalcaribarang')
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function detailCariBarang()
    {
        if ($this->request->isAJAX()) {
            $cari = $this->request->getPost('cari');

            $modalBarang = new Modelbarang();
            $data =  $modalBarang->tampildata_cari($cari)->get();
            if ($data != null) {

                $json = [
                    'data' => view('barangmasuk/detaildatabarang', [
                        'tampildata' => $data
                    ])
                ];

                echo json_encode($json);
            }
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function selesaiTransaksi()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $tglfaktur = $this->request->getPost('tglfaktur');
            $idsuplier = $this->request->getPost('idsuplier');

            $modelTemp = new Modeltempbarangmasuk();
            $dataTemp = $modelTemp->getWhere(['detfaktur' => $faktur]);

            if ($dataTemp->getNumRows() == 0) {
                $json = [
                    'error' => 'Maaf, Data item untuk faktur ini belum ada...'
                ];
            } else {
                // Simpan Kedalam Table Masuk
                $modelBarangMasuk = new Modelbarangmasuk();
                $totalSubTotal = 0;

                foreach ($dataTemp->getResultArray() as $total) :
                    $totalSubTotal += intval($total['detsubtotal']);
                endforeach;

                $modelBarangMasuk->insert([
                    'faktur' => $faktur,
                    'idsup' => $idsuplier,
                    'tglfaktur' => $tglfaktur,
                    'totalharga' => $totalSubTotal
                ]);
                // Simpan ke Table detail barang masuk
                $modalDetailBarangMasuk = new Modeldetailbarangmasuk();
                foreach ($dataTemp->getResultArray() as $row) :
                    $modalDetailBarangMasuk->insert([
                        'detfaktur' => $row['detfaktur'],
                        'detbrgkode' => $row['detbrgkode'],
                        'dethargamasuk' => $row['dethargamasuk'],
                        'dethargajual' => $row['dethargajual'],
                        'detjml' => $row['detjml'],
                        'detsubtotal' => $row['detsubtotal'],
                    ]);
                endforeach;

                // Hapus data yang ada di table temporari berdasarkan faktur
                $modelTemp->emptyTable();

                $json = [
                    'sukses' => 'Transaksi berhasil disimpan'
                ];
            }
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function data()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari =  $this->request->getPost('cari');
            session()->set('cari_faktur');
            redirect()->to('/barangmasuk/data');
        } else {
            $cari = session()->get('cari_faktur');
        }

        // $dataBarangMasuk = $cari ? $modelBarangMasuk->tampildata_cari($cari)->paginate(10, 'barangmasuk') :
        //     $modelBarangMasuk->paginate(10, 'barangmasuk');

        $modelBarangMasuk = new Modelbarangmasuk();
        $dataBarangmasuk = $cari ? $modelBarangMasuk->tampildata_cari($cari)->paginate(10, 'barangmasuk') : $modelBarangMasuk->tampildata()->paginate(10, 'barangmasuk');
        $totaldata = $cari ? $modelBarangMasuk->tampildata_cari($cari)->countAllResults() : $modelBarangMasuk->countAllResults();
        $nohalaman = $this->request->getVar('page_barangmasuk') ? $this->request->getVar('page_barangmasuk') : 1;

        $data = [
            'tampildata' => $dataBarangmasuk,
            'pager' => $modelBarangMasuk->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari
        ];

        return view('barangmasuk/viewdata', $data);
    }

    function detailItem()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelDetail = new Modeldetailbarangmasuk();


            $data = [
                'tampildatadetail' => $modelDetail->dataDetail($faktur)
            ];
            $json = [
                'data' => view('barangmasuk/modaldetailitem', $data)
            ];
            echo json_encode($json);
        }
    }

    function edit($faktur)
    {
        $modelBarangMasuk = new Modelbarangmasuk();
        $cekFaktur = $modelBarangMasuk->cekFaktur($faktur);

        if ($cekFaktur->getNumRows() > 0) {
            $row = $cekFaktur->getRowArray();

            $data = [
                'nofaktur' => $row['faktur'],
                'tanggal' => $row['tglfaktur']
            ];
            return view('barangmasuk/formedit', $data);
        } else {
            exit('Data Tidak Ditemukan');
        }
    }

    function dataDetail()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelDetail = new Modeldetailbarangmasuk();
            $data = [
                'datadetail' => $modelDetail->dataDetail($faktur)

            ];

            $totalHargaFaktur = number_format($modelDetail->ambilTotalHarga($faktur), 0, ",", ".");

            $json = [
                'data' => view('barangmasuk/datadetail', $data),
                'totalharga' => $totalHargaFaktur
            ];
            echo json_encode($json);
        }
    }
    function editItem()
    {
        if ($this->request->isAJAX()) {
            $iddetail = $this->request->getPost('iddetail');
            $modelDetail = new Modeldetailbarangmasuk();
            $ambilData = $modelDetail->ambilDetailBerdasarkanID($iddetail);

            $row = $ambilData->getRowArray();

            $data = [
                'kodebarang' => $row['detbrgkode'],
                'namabarang' => $row['brgnama'],
                'hargajual' => $row['dethargajual'],
                'hargabeli' => $row['dethargamasuk'],
                'jumlah' => $row['detjml'],
            ];

            $json = [
                'sukses' => $data
            ];
            echo json_encode($json);
        }
    }

    function simpanDetail()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $hargajual = $this->request->getPost('hargajual');
            $hargabeli = $this->request->getPost('hargabeli');
            $kodebarang = $this->request->getPost('kodebarang');
            $jumlah = $this->request->getPost('jumlah');

            $modelDetail = new Modeldetailbarangmasuk();
            $modelBarangMasuk =  new Modelbarangmasuk();

            $modelDetail->insert([
                'detfaktur' => $faktur,
                'detbrgkode' => $kodebarang,
                'dethargajual' => $hargajual,
                'dethargamasuk' => $hargabeli,
                'detjml' => $jumlah,
                'detsubtotal' => intval($jumlah) * intval($hargabeli)
            ]);
            $updateTotalHarga = $modelDetail->ambilTotalHarga($faktur);
            $modelBarangMasuk->update($faktur, [
                'totalharga' => $updateTotalHarga
            ]);
            $json = [
                'sukses' => 'item berhasil ditambahkan'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    function updateItem()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $hargajual = $this->request->getPost('hargajual');
            $hargabeli = $this->request->getPost('hargabeli');
            $kodebarang = $this->request->getPost('kodebarang');
            $jumlah = $this->request->getPost('jumlah');
            $iddetail = $this->request->getPost('iddetail');

            $modelDetail = new Modeldetailbarangmasuk();
            $modelBarangMasuk = new Modelbarangmasuk();

            $modelDetail->update($iddetail, [
                'dethargajual' => $hargajual,
                'dethargamasuk' => $hargabeli,
                'detjml' => $jumlah,
                'detsubtotal' => intval($jumlah) * intval($hargabeli)
            ]);
            $updateTotalHarga = $modelDetail->ambilTotalHarga($faktur);
            $modelBarangMasuk->update($faktur, [
                'totalharga' => $updateTotalHarga
            ]);
            $json = [
                'sukses' => 'item berhasil diupdate'
            ];
            echo json_encode($json);
        }
    }
    function hapusItemDetail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $faktur = $this->request->getPost('faktur');


            $modelDetail = new Modeldetailbarangmasuk();
            $modelBarangMasuk = new Modelbarangmasuk();
            $modelDetail->delete($id);
            $updateTotalHarga = $modelDetail->ambilTotalHarga($faktur);
            $modelBarangMasuk->update($faktur, [
                'totalharga' => $updateTotalHarga
            ]);
            $json = [
                'sukses' => 'item berhasil dihapus'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function hapusTransaksi()
    {
        $faktur = $this->request->getPost('faktur');
        $db = \Config\Database::connect();
        $modelBarangMasuk = new Modelbarangmasuk();
        $db->table('detail_barangmasuk')->delete(['detfaktur' => $faktur]);
        $modelBarangMasuk->delete($faktur);

        $json = [
            'sukses' => "Transaksi Dengan Faktur :  <strong> $faktur </strong>"
        ];
        echo json_encode($json);
    }
}
