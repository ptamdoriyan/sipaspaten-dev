<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;
use App\Models\UsersModel;

class User extends BaseController
{
    protected $helpers = ['form'];

    public function __construct()
    {

        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(6, session('role_id'));
    }

    public function index()
    {

        $penetapanModel = new PenetapanModel();
        //ambil data di database
        $id_user = session('id_user');
        $data['penetapan'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where('id_user', $id_user)->findAll();

        $data['penetapan_approved'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where(['id_user' => $id_user, 'status' => 2])->findAll();
        //kirim view
        return view('user/user_pa', $data);
    }

    public function view()
    {
        $penetapanModel = new PenetapanModel();
        $id_user = session('id_user');

        for ($i = 0; $i < 4; $i++) {
            // # code...
            $tanggaljudul = date('M', strtotime("+$i month"));
            $tanggalisi = date("m") + $i;
            $hasilhitung[$tanggaljudul] = $penetapanModel->SumDataPerPA($id_user, $tanggalisi);
        }
        print_r(json_encode($hasilhitung));
        die;
    }


    //add data
    public function addData()
    {
        $penetapanModel = new PenetapanModel();
        $userModel = new UsersModel();

        if (!$this->request->is('post')) {
            return view('user/user_add');
        }

        $rules = [
            'nomor_penetapan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('user/user_add');
        }
        //if success
        //ambe data
        $id_user = session('id_user');
        $nomor_penetapan = $this->request->getVar('nomor_penetapan');
        $status = 1;
        $databerkas = $this->request->getFile('berkas');
        $id_penetapan = rand(1, 99999999999);
        $nama_file_penetapan = $databerkas->getRandomName();

        $data = [

            'id_penetapan' => $id_penetapan,
            'id_user' => $id_user,
            'nomor_penetapan' => $nomor_penetapan,
            'nama_file_penetapan' => $nama_file_penetapan,
            'status' => $status
        ];

        //masukkan data di database
        $penetapanModel->insert($data);
        //pindahkan berkas
        $databerkas->move('uploads/penetapan/', $nama_file_penetapan);
        $this->logmodel->insert(['id_user' => $id_user, 'action' => 'Upload Data']);
        //buat flash data
        $this->session->setFlashdata('message', 'Diupload');
        //persiapan kirim pesan
        $waPanitera = $userModel->getWhatsapp(3);
        $waPanmud = $userModel->getWhatsapp(4);
        $waBhp = $userModel->getWhatsapp(5);
        sendMessage("$waPanitera,$waPanmud,$waBhp", session('name'), 'Mengupload Penetapan');
        return redirect()->to('user');
    }
}
