<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsuplier extends Model
{
    protected $table            = 'suplier';
    protected $primaryKey       = 'supid';

    protected $allowedFields    = [
        'supnama', 'suptelp'
    ];

    public function ambilDataTerakhir()
    {
        return $this->table('suplier')->limit(1)->orderBy('supid', 'DESC')->get();
    }
}
