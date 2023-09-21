<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function index()
    {

        //check session
        switch (session('role_id')) {
            case '1':
                # code...
                return redirect()->to('admin');
                break;
            case '2':
                # code...
                return redirect()->to('pta');
                break;
            case '3':
                # code...
                return redirect()->to('pta');
                break;
            case '4':
                # code...
                return redirect()->to('pta');
                break;
            case '5':
                # code...
                return redirect()->to('bhp');
                break;
            case '6':
                # code...
                return redirect()->to('user');
                break;
            case '7':
                # code...
                return redirect()->to('pta');
                break;

            default:
                # code...

                break;
        }
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
                            'id_user' => $user['id_user'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'whatsapp' => $user['whatsapp'],
                            'role_id' => $user['role_id'],
                        ];
                        //simpan session data

                        $session->set($data);
                        if ($user['role_id'] == 1) {
                            $this->logmodel->insert(['id_user' => $data['id_user'], 'action' => 'Login']);
                            return redirect()->to('admin');
                        }
                        if ($user['role_id'] == 5) {
                            $this->logmodel->insert(['id_user' => $data['id_user'], 'action' => 'Login']);
                            return redirect()->to('bhp');
                        }
                        if ($user['role_id'] == 6) {
                            $this->logmodel->insert(['id_user' => $data['id_user'], 'action' => 'Login']);
                            return redirect()->to('user');
                        } else {
                            $this->logmodel->insert(['id_user' => $data['id_user'], 'action' => 'Login']);
                            return redirect()->to('pta');
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


    public function logout()
    {
        $data = [
            'email',
            'name',
            'telp',
            'role_id',
            'id_uniq',
        ];
        $this->session->remove($data);
        return redirect()->to('/');
    }
}
