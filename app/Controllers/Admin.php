<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;

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

    public function user_management()
    {
        echo "User Management";
    }
}
