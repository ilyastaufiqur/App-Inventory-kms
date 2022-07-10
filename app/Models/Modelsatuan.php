<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsatuan extends Model
{
    protected $table            = 'satuan';
    protected $primaryKey       = 'satid';
    protected $allowedFields    = [
        'satid', 'satnama'
    ];
    public function cariData($cari)
    {
        return $this->table('satuan')->like('satnama', $cari);
    }
}
