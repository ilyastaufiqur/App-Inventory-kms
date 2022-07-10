<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;

class Main extends BaseController
{
    public function __construct()
    {
        $this->barang =  new Modelbarang();
    }
    public function index()
    {
        return view('dasboard-admin/dasboard');
    }

    public function home()
    {
        return view('user_konsul/dasboard');
    }
    public function listdata()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');
            session()->set('cari_barang', $cari);
            redirect()->to('/main/listdata');
        } else {
            $cari = session()->get('cari_barang');
        }

        $totaldata = $cari ? $this->barang->tampildata_cari($cari)->countAllResults() : $this->barang->tampildata()->countAllResults();
        $dataBarang = $cari ? $this->barang->tampildata_cari($cari)->paginate(5, 'barang') : $this->barang->tampildata()->paginate(5, 'barang');
        $nohalaman = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;

        $data = [
            'tampildata' => $dataBarang,
            'pager' => $this->barang->pager,
            'nohalaman' => $nohalaman,
            'totaldata' => $totaldata,
            'cari' => $cari
        ];
        return view('user_konsul/viewbarang', $data);
    }
}
