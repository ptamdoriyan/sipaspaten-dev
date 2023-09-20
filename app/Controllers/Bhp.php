<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;

class Bhp extends BaseController
{

    public function __construct()
    {
        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(3, session('role_id'));
    }

    public function index()
    {
        //
        $penetapanModel = new PenetapanModel();
        $data['penetapan'] = $penetapanModel->bhpGetDataAll();
        $data['penetapan_aproved'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where(['status' => 2])->findAll();
        // $data['allPutusan'] = $putusanModel->bhpGetDataAll();
        return view('bhp/user_bhp', $data);
    }

    public function addData($penetapan_uniq)
    {
        $penetapanModel = new PenetapanModel();
        $data['penetapan'] = $penetapanModel->bhpGetDatabyLink($penetapan_uniq);
        return view('bhp/bhp_add', $data);
    }

    public function bhPutusan()
    {
        $penetapanModel = new PenetapanModel();
        $putusan_uniq = $this->request->getVar('putusan_uniq');
        $data['penetapan'] = $penetapanModel->bhpGetDatabyLink($putusan_uniq);

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nomor_ba' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            # code...

        }
    }


    function download($putusan_uniq)
    {
        $penetapanModel = new PenetapanModel();
        $data = $penetapanModel->where('putusan_uniq', $putusan_uniq)->first();
        // dd($data);
        // var_dump($data);
        // echo $data['link_dock'];
        // die;
        return $this->response->download('uploads/berita_acara/' . $data['nama_file_ba'], null)->setFileName('berita_acara_' . $data['tgl_upload'] . '.pdf');
    }
}
