<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarangkeluar extends Model
{

    protected $table            = 'barangkeluar';
    protected $primaryKey       = 'faktur';
    protected $allowedFields    = [
        'faktur', 'tglfaktur', 'idpel', 'totalharga', 'jumlahuang', 'sisauang'
    ];
    public function nomorFakturAuto($tanggalSekarang)
    {
        return $this->table('barangkeluar')->select('max(faktur) as nofaktur')->where('tglfaktur', $tanggalSekarang)->get();
    }
    public function laporanPerPriode($tglawal, $tglakhir)
    {
        return $this->table('barangkeluar')->where('tglfaktur >=', $tglawal)->where('tglfaktur <=', $tglakhir)->get();
    }
}
