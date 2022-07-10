<?php namespace App\Entities;

use CodeIgniter\Entity;

class User extends Entity
{
    public function setPassword(string $pass)
    {
        $salt = uniqid('',true);
        $this->attributes['salt'] = $salt;
        $this->attributes['password'] = md5($salt.$pass);

        return $this;
    }

    public function setAvatar($file)
    {
        $fileName = $file->getRandomName();
        $writePath = './uploads';
        $file->move($writePath, $fileName);
        $this->attributes['avatar'] = $fileName;
        return $this;
    }
}