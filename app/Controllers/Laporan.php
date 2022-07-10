<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarangkeluar;
use App\Models\Modelbarangmasuk;

class Laporan extends BaseController
{
    public function index()
    {
        return view('laporan/index');
    }
    public function cetak_barang_masuk()
    {
        return view('laporan/viewlaporanbarangmasuk');
    }
    public function cetak_barang_keluar()
    {
        return view('laporan/viewlaporanbarangkeluar');
    }
    public function cetak_barang_masuk_priode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $modelBarangMasuk = new Modelbarangmasuk();
        $dataLaporan = $modelBarangMasuk->laporanPerPriode($tglawal, $tglakhir);
        $data = [
            'datalaporan' => $dataLaporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir
        ];

        return view('laporan/cetakLaporanBarangMasuk', $data);
    }
    public function cetak_barang_keluar_priode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $modelBarangMasuk = new Modelbarangkeluar();
        $dataLaporan = $modelBarangMasuk->laporanPerPriode($tglawal, $tglakhir);
        $data = [
            'datalaporan' => $dataLaporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir
        ];

        return view('laporan/cetakLaporanBarangKeluar', $data);
    }

    public function tampilGrafikBarangMasuk()
    {
        $bulan = $this->request->getPost('bulan');
        $db = \Config\Database::connect();

        $query = $db->query("SELECT tglfaktur AS tgl,totalharga FROM barangmasuk WHERE DATE_FORMAT(tglfaktur, '%Y-%m')= '$bulan' ORDER BY tglfaktur ASC")->getResult();

        $data = [
            'grafik' => $query
        ];
        $json = [
            'data' => view('laporan/grafikbarangmasuk', $data)
        ];

        echo json_encode($json);
    }
    public function tampilGrafikBarangKeluar()
    {
        $bulan = $this->request->getPost('bulan');
        $db = \Config\Database::connect();

        $query = $db->query("SELECT tglfaktur AS tgl,totalharga FROM barangkeluar WHERE DATE_FORMAT(tglfaktur, '%Y-%m')= '$bulan' ORDER BY tglfaktur ASC")->getResult();

        $data = [
            'grafik' => $query
        ];
        $json = [
            'data' => view('laporan/grafikbarangkeluar', $data)
        ];

        echo json_encode($json);
    }
}
