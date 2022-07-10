<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkonsultasi extends Model
{
    protected $table            = 'konsultasi';
    protected $primaryKey       = 'konsul_id';
    protected $allowedFields    = [
        'judul', 'nama', 'email', 'pesan_konsul', 'pesan_aktif', 'tanggal'
    ];

    public function cariData($cari)
    {
        return $this->table('konsultasi')->like('nama', $cari);
    }

    function simpanData($data)
    {
        return $this->table('konsultasi')->insert($data);
    }

    public function tampil()
    {
        return $this->table('konsultasi')->findAll();
    }
    public function ambilPesanBerdasarkanId($id)
    {
        return $this->table('konsultasi')->where('konsul_id', $id)->get();
    }
    public function updateProduct($data, $konsul_id)
    {
        $query = $this->db->table('konsultasi')->update($data, array('konsul_id' => $konsul_id));
        return $query;
    }
    public function updateKonsul($data, $id)
    {
        $query = $this->db->table('konsultasi')->update($data, array('konsul_id' => $id));
        return $query;
    }
    protected $returnType = 'App\Entities\Konsultasi';
    protected $useTimestamps = false;
}
