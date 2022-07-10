<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelchat extends Model
{
    protected $table            = 'chat';
    protected $primaryKey       = 'chat_id';
    protected $allowedFields    = [
        'chat_by', 'chat', 'chat_aktif', 'balas_chat', 'time'
    ];
    function simpanData($data)
    {
        return $this->table('chat')->insert($data);
    }
    public function updateChat($data, $id)
    {
        $query = $this->db->table('chat')->update($data, array('chat_id' => $id));
        return $query;
    }

    public function getChat()
    {
        // $id = $_SESSION['iduser']; // dapatkan id user yg login
        $id = session('iduser');
        $builder = $this->db->table('chat');
        $builder->join('users', 'users.id = chat.chat_by');
        $builder->where('userid', $id);
        $query = $builder->get();
        return $query->getResult();
    }


    public function tampildata()
    {
        $builder = $this->db->table('chat');
        $builder->join('users', 'users.id = chat.chat_by');
        $query = $builder->get();
        return $query->getResult();
    }
}
