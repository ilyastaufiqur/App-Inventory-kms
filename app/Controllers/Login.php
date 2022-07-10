<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modellogin;
use App\Models\Modelkonsultasi;

class Login extends BaseController
{
    protected $konsul;
    public function __construct()
    {
        $this->regis = new Modellogin();
        $this->konsul = new Modelkonsultasi();
    }
    public function index()
    {
        return view('login/index');
    }
    public function cekUser()
    {
        $iduser = $this->request->getPost('iduser');
        $password = $this->request->getPost('password');
        $validation = \Config\Services::Validation();
        $valid = $this->validate([
            'iduser' => [
                'label' => 'ID User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $sesiError = [
                'errIduser' => $validation->getError('iduser'),
                'errPassword' => $validation->getError('password'),
            ];
            session()->setFlashdata($sesiError);
            return redirect()->to(site_url('/login/index'));
        } else {
            $modelLogin =  new Modellogin();
            $cekUserLogin = $modelLogin->find($iduser);
            if ($cekUserLogin == null) {
                $sesiError = [
                    'errIduser' => 'maaf user tidak terdaftar'
                ];
                session()->setFlashdata($sesiError);
                return redirect()->to(site_url('/login/index'));
            } else {
                if ($cekUserLogin['useraktif'] != '1') {
                    $sesiError = [
                        'errIduser' => 'aktifkan akun terlebih dahulu'
                    ];
                    session()->setFlashdata($sesiError);
                    return redirect()->to(site_url('/login/index'));
                } else {

                    $passwordUser = $cekUserLogin['userpassword'];
                    if (password_verify($password, $passwordUser)) {
                        $idlevel = $cekUserLogin['userlevelid'];
                        $simpan_session = [
                            'iduser' => $iduser,
                            'namauser' => $cekUserLogin['usernama'],
                            'idlevel' => $idlevel
                        ];
                        if ($idlevel == 1 || $idlevel == 2) {
                            session()->set($simpan_session);

                            return redirect()->to('/main/index');
                        } else {
                            session()->set($simpan_session);
                            return redirect()->to('/main/home');
                        }
                    } else {
                        $sesiError = [
                            'errPassword' => 'maaf password salah'
                        ];
                        session()->setFlashdata($sesiError);
                        return redirect()->to(site_url('/login/index'));
                    }
                }
            }
        }
    }
    public function keluar()
    {
        session()->destroy();
        return redirect()->to('/login/index');
    }

    public function register()
    {
        return view('login/register');
    }

    public function simpanRegister()
    {
        $validation = \Config\Services::Validation();
        $valid = $this->validate([
            'iduser' => [
                'label' => 'ID User',
                'rules' => 'required|is_unique[users.userid]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unqiue' => '{field} sudah ada...'
                ]
            ],
            'namauser' => [
                'label' => 'nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'label' => 'confirm password',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => '{field} tidak cocok',
                ]
            ]
        ]);
        if (!$valid) {
            // jika tidak valid
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(site_url('/login/register'));
        } else {
            //jika valid simpan register
            $data = [
                'userid' => $this->request->getPost('iduser'),
                'usernama' => $this->request->getPost('namauser'),
                'userpassword' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'userlevelid' => 3
            ];
            $this->regis->simpanRegister($data);
            session()->setFlashdata('pesan', 'Berhasil Registrasi');
            return redirect()->to(site_url('/login/index'));
        }
    }
    public function aktifasi()
    {
        return view('login/aktifasi');
    }
    public function simpan()
    {
        $judul = $this->request->getPost("judul");
        $nama = $this->request->getPost("nama");
        $email = $this->request->getPost("email");
        $konsul_pesan = $this->request->getPost("pesan_konsul");

        $data = [
            'judul'  => $judul,
            'nama'  => $nama,
            'email' => $email,
            'pesan_konsul'  => $konsul_pesan,
        ];


        $simpan = $this->konsul->simpanData($data);
        if ($simpan) {

            $pesan_sukses = [
                'sukses' =>
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    Konsultasi dengan Judul <strong>' . $judul . '</strong> berhasil dikirim ,mohon tunggu balasan email
                    <strong class="text-danger">di kontak spam</strong>
                </div>'
            ];
            session()->setFlashdata($pesan_sukses);
            return redirect()->to('login/aktifasi');
        } else {
            echo '<script>alert("pesan gagal dikirim") window.location(' . base_url('/konsultasi') . ')</script>';
        }
    }
}
