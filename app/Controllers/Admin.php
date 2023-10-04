<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;
use App\Models\LogsModel;
use App\Models\UsersModel;

class Admin extends BaseController
{

    public function __construct()
    {
        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(1, session('role_id'));
    }

    public function index()
    {
        $penetapanModel = new PenetapanModel();
        $data['penetapan'] = $penetapanModel->bhpGetDataAll();
        $data['penetapan_aproved'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where(['status' => 2])->findAll();
        // $data['allPutusan'] = $putusanModel->bhpGetDataAll();
        return view('admin/index', $data);
    }

    public function viewAllPa()
    {
        $penetapanModel = new PenetapanModel();
        $id_user = session('id_user');

        for ($i = 0; $i < 4; $i++) {
            // # code...
            $tanggaljudul = date('M', strtotime("+$i month"));
            $tanggalisi = date("m") + $i;
            $hasilhitung[$tanggaljudul] = $penetapanModel->SumDataAllPA($tanggalisi);
        }
        return json_encode($hasilhitung);
    }

    public function user_view()
    {
        $userModel = new UsersModel();

        $data['users'] = $userModel->orderBy('role_id', 'ASC')->findAll();
        return view('admin/userview', $data);
    }

    public function userDetail($id_user)
    {
        $logModel = new LogsModel();
        $userModel = new UsersModel();
        $data['user'] = $userModel->where('id_user', $id_user)->first();
        $data['logs'] = $logModel->orderBy('date', 'DESC')->where('id_user', $id_user)->findAll();
        return view('admin/userdetail', $data);
    }

    public function addUser()
    {
        $userModel = new UsersModel();
        $name = $this->request->getVar('user_name');
        $whatsapp = $this->request->getVar('user_whatsapp');
        $email = $this->request->getVar('user_email');
        $password = password_hash('1234', PASSWORD_DEFAULT);
        $role_id = $this->request->getVar('user_role_id');
        $is_active = 1;

        $data = [
            'id_user' => rand(1, 99999999999),
            'name' => $name,
            'whatsapp' => $whatsapp,
            'email' => $email,
            'password' => $password,
            'role_id' => $role_id,
            'is_active' => $is_active,
        ];

        $insert = $userModel->insert($data, false);

        if ($insert) {
            # code...
            $this->logmodel->insert(['id_user' => session('id_user'), 'action' => 'Add User']);
            $this->session->setFlashdata('message', 'ditambahkan');
            return redirect()->to('/admin/user');
        }
    }

    public function resetPassword()
    {
        $userModel = new UsersModel();
        $id_user = $this->request->getVar('id_user');
        $password = password_hash('1234', PASSWORD_DEFAULT);
        $data = [
            'password' =>  $password
        ];
        $eks = $userModel->update($id_user, $data);

        $response = [
            'response' => true,
            'message' => 'success'
        ];
        return json_encode($response);
    }
    public function userOff()
    {
        $userModel = new UsersModel();
        $id_user = $this->request->getVar('id_user');

        $data = [
            'is_active' => 2
        ];
        $eks = $userModel->update($id_user, $data);

        if ($eks) {
            $response = [
                'response' => true,
                'message' => 'success'
            ];
        }
        return json_encode($response);
    }

    public function userOn()
    {
        $userModel = new UsersModel();
        $id_user = $this->request->getVar('id_user');

        $data = [
            'is_active' => 1
        ];
        $eks = $userModel->update($id_user, $data);

        if ($eks) {
            $response = [
                'response' => true,
                'message' => 'success'
            ];
        }
        return json_encode($response);
    }
}
