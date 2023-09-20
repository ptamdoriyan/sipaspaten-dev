<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Profile extends BaseController
{

    public function __construct()
    {
        if (session('id_uniq') == null) {
            header('Location: ' . base_url('/'));
            exit();
        }
    }

    public function index()
    {
        //
        $user = new UsersModel();
        $data['user'] = $user->where('id_uniq', session('id_uniq'))->findAll();
        return view('profile/user_profile', $data);
    }
    public function editProfile()
    {

        $usermodel = new UsersModel();
        $id_user = $this->request->getVar('id_user');
        $data = [
            'email' => $this->request->getVar('email'),
            'whatsapp' => $this->request->getVar('whatsapp'),
        ];

        $usermodel->update($id_user, $data);
        $this->logmodel->insert(['id_uniq' => session('id_uniq'), 'action' => 'Update Profile']);
        $this->session->setFlashdata('message', 'Diubah');
        return redirect()->to('/profile');
    }

    public function editPassword()
    {
        $usermodel = new UsersModel();
        $data['user'] = $usermodel->where('id_uniq', session('id_uniq'))->first();


        $id_user = $this->request->getVar('id_user');
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'old_password' => 'required',
            'new_password' => 'required|min_length[6]'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            //ambil password lama dan password baru
            $old_password = $this->request->getVar('old_password');
            $new_password = $this->request->getVar('new_password');
            //cek password sudah sama atau tidak
            if (!password_verify($old_password, $data['user']['password'])) {
                # code...
                // dd($old_password);
                $this->session->setFlashdata('message', 'Password Sebelumnya');
                return redirect()->to('/profile');
            } else {
                $data = [
                    'password' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT)
                ];

                $usermodel->update($id_user, $data);
                $this->logmodel->insert(['id_uniq' => session('id_uniq'), 'action' => 'Update Password']);
                $this->session->setFlashdata('message', 'Diubah');
                return redirect()->to('/profile');
            }
        }
    }
}
