<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function index()
    {
        //
        return view('auth/login_view');
    }

    public function login()
    {
        //inisiasi model
        $session = session();
        $users = new UsersModel();

        //ambil hasil tangkapan dari post
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');


        //form validation
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        //jika lolos validasi
        if ($isDataValid) {
            //ambil data di users
            $user = $users->where('email', $email)->first();
            //cek jika email terdaftar
            if ($user) {
                // jika usernya aktif
                if ($user['is_active'] == 1) {
                    // cek password
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'name' => $user['nama'],
                            'telp' => $user['whatsapp'],
                            'role_id' => $user['role_id'],
                            'uniq_id' => $user['id_uniq']
                        ];
                        //simpan session data
                        $session->set($data);
                        if ($user['role_id'] == 1) {
                            return redirect()->to('admin');
                        }
                        if ($user['role_id'] == 2) {
                            return redirect()->to('pta');
                        }
                        if ($user['role_id'] == 3) {
                            return redirect()->to('bhp');
                        } else {
                            return redirect()->to('user');
                        }
                    } else {
                        $session->setFlashdata('message', 'Maaf Password yang anda masukkan Salah !');
                        return redirect()->to('/');
                    }
                } else {
                    $session->setFlashdata('message', 'Maaf email ini belum diaktifasi, Silahkan hubungi Admin!</div>');
                    return redirect()->to('/');
                }
            } else {
                $session->setFlashdata('message', 'Maaf email ini belum terdaftar!');
                return redirect()->to('/');
            }
        }
        //jika tidak lolos validasi
        return redirect()->to('/');
    }
}
