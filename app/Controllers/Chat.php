<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelchat;
use App\Models\Modellogin;
use App\Models\Modeluser;
use \Hermawan\DataTables\DataTable;

class Chat extends BaseController
{
    protected $chat;
    protected $simpan_session;
    public function __construct()
    {
        helper('form');
        $this->chat = new Modelchat();
        $this->login = new Modellogin();
        $this->validation = \Config\Services::validation();
        $this->simpan_session = session();
    }

    public function index_admin()
    {

        $dataChat = $this->chat->tampildata();
        $data = [
            'tampildata' => $dataChat
        ];
        return view('chat/viewchat', $data);
    }

    public function update()
    {
        $model = new Modelchat();
        $id = $this->request->getPost('chat_id');
        $data = array(
            'chat_aktif'       => $this->request->getPost('chat_aktif'),
            'balas_chat' => $this->request->getPost('balas_chat'),
        );
        $model->updateChat($data, $id);
        return redirect()->to('/chat/index_admin');
    }


    // ==============================================
    public function index()
    {
        $data['chat'] = $this->chat->getChat();
        return view('user_konsul/home', $data);
    }
    public function tambah()
    {
        $db = \Config\Database::connect();
        $iduser = session()->iduser;
        $data = [
            'datausers' => $db->table('users')->where('userlevelid !=', '1')
                ->where('userlevelid !=', '2')
                ->where('userid =', $iduser)
                ->get()
        ];
        echo view('user_konsul/tambahchat', $data);

        // $modelusers = new Modeluser();
        // $data = [
        //     'datausers' => $modelusers->findAll(),
        // ];
        // return view('user_konsul/tambahchat', $data);
    }

    public function simpandata()
    {
        $namauser = $this->request->getVar('chat_by');
        $chat = $this->request->getVar('chat');


        $validation = \Config\Services::validation();

        $valid =  $this->validate([
            'chat' => [
                'rules' => 'required',
                'label' => 'chat',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'chat_by' => [
                'rules' => 'required',
                'label' => 'User ID',
                'errors' => [
                    'required' => '{field} Harus Dipilih',
                ]
            ]
        ]);

        if (!$valid) {
            $sess_Pesan = [
                'error' =>
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    ' . $validation->listErrors() . '
              </div>'
            ];

            session()->setFlashdata($sess_Pesan);
            return redirect()->to('/chat/tambah');
        } else {
            $this->chat->insert([
                'chat_by' => $namauser,
                'chat' => $chat
            ]);

            $pesan_sukses = [
                'sukses' =>
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    Selamat <strong>' .  session()->get('namauser') . '</strong> pesan berhasil dikirim
                </div>'
            ];
            session()->setFlashdata($pesan_sukses);
            return redirect()->to('/chat/index');
        }
    }
}
