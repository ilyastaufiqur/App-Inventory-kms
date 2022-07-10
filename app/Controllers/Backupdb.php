<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modeluser;
use Ifsnop\Mysqldump\Mysqldump;

class Backupdb extends BaseController
{
    public function index()
    {
        return view('backupdb/index');
    }

    public function doBackup()
    {
        try {
            $tglsekarang = date('dym');

            $dump =  new Mysqldump('mysql:host=localhost;dbname=dbgudang;port=3306', 'root', '');
            $dump->start('database/backup/dbbackup-' . $tglsekarang . '.sql');
            $pesan  = '<div class="alert alert-success" role="alert">
            Backup Database Berhasil
          </div>';

            session()->setFlashdata(
                'pesan',
                $pesan
            );
            return redirect()->to('/backupdb/index');
        } catch (\Exception $e) {
            $pesan = "mysqldump-php error" . $e->getMessage();
            $pesan  = '<div class="alert alert-success" role="alert">
            Backup Database Berhasil
          </div>';
            session()->setFlashdata('pesan', $pesan);
        }
    }

    public function gantipassword()
    {
        return view('backupdb/formgantipass');
    }

    public function updatepassword()
    {
        if ($this->request->isAJAX()) {
            $iduser = session()->iduser;
            $passlama = $this->request->getPost('passlama');
            $passbaru = $this->request->getPost('passbaru');
            $confirmpass = $this->request->getPost('confirmpass');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'passlama' => [
                    'rules' => 'required',
                    'label' => 'password lama',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],  'passbaru' => [
                    'rules' => 'required',
                    'label' => 'password baru',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],  'confirmpass' => [
                    'rules' => 'required|matches[passbaru]',
                    'label' => 'confirm password',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'matches' => '{field} tidak cocok',
                    ]
                ]
            ]);
            if (!$valid) {
                $error = [
                    'passlama' => $validation->getError('passlama'),
                    'passbaru' => $validation->getError('passbaru'),
                    'confirmpass' => $validation->getError('confirmpass'),
                ];
                $json = [
                    'error' => $error
                ];
            } else {
                $modelUser = new Modeluser();
                $rowData = $modelUser->find($iduser);
                $passUser = $rowData['userpassword'];

                if (password_verify($passlama, $passUser)) {
                    $hashPasswordBaru = password_hash($passbaru, PASSWORD_DEFAULT);
                    $modelUser->update($iduser, [
                        'userpassword' => $hashPasswordBaru
                    ]);
                    $json = [
                        'sukses' => 'Password Berhasil Diganti'
                    ];
                } else {
                    $error = [
                        'passlama' => 'Password Lama tidak ditemukan'
                    ];
                    $json = [
                        'error' => $error
                    ];
                }
            }
            echo json_encode($json);
        }
    }
}
