<?php

namespace App\Models;

use CodeIgniter\Model;

class Modellogin extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'userid';
    protected $allowedFields    = [
        'userid', 'usernama', 'userpassword', 'userlevelid', 'useraktif'
    ];

    public function simpanRegister($data)
    {
        return $this->table('users')->insert($data);
    }
}
