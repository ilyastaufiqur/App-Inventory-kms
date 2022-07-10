<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarangmasuk extends Model
{
    protected $table            = 'barangmasuk';
    protected $primaryKey       = 'faktur';
    protected $allowedFields    = [
        'faktur', 'idsup', 'tglfaktur', 'totalharga'
    ];
    public function tampildata()
    {
        return $this->table('barangmasuk')->join('suplier', 'idsup=supid');
    }
    public function tampildata_cari($cari)
    {
        return $this->table('barangmasuk')
            ->like('faktur', $cari);
    }

    public function cekFaktur($faktur)
    {
        return $this->table('barangmasuk')->getWhere([
            'sha1(faktur)' => $faktur
        ]);
    }

    public function laporanPerPriode($tglawal, $tglakhir)
    {
        return $this->table('barangmasuk')->where('tglfaktur >=', $tglawal)->where('tglfaktur <=', $tglakhir)->get();
    }
}
