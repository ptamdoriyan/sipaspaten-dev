<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PutusanModel;

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
        $putusanModel = new PutusanModel();
        $data['putusan'] = $putusanModel->bhpGetDataAll();
        $data['putusan_aproved'] = $putusanModel->orderBy('tgl_upload', 'DESC')->where(['status' => 2])->findAll();
        // $data['allPutusan'] = $putusanModel->bhpGetDataAll();
        return view('bhp/user_bhp', $data);
    }

    public function addData($link_putusan)
    {
        $putusanModel = new PutusanModel();
        $data['penetapan'] = $putusanModel->bhpGetDatabyLink($link_putusan);
        return view('bhp/bhp_add', $data);
    }

    public function bhPutusan()
    {
        $putusanModel = new PutusanModel();
        $link_putusan = $this->request->getVar('link_putusan');
        $data['penetapan'] = $putusanModel->bhpGetDatabyLink($link_putusan);

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nomor_ba' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            # code...

            $nomor_ba = $this->request->getVar('nomor_ba');
            $status = 2;
            $databerkas = $this->request->getFile('berita_acara');
            $filename = $databerkas->getRandomName();
            $field = [
                'nama_file_ba' => $filename,
                'nomor_ba' => $nomor_ba,
                'status' => $status
            ];
            $putusanModel->update($data['penetapan']['id_putusan'], $field);
            $databerkas->move('uploads/berita_acara/', $filename);
            $this->logmodel->insert(['id_uniq' => session('id_uniq'), 'action' => 'Upload Berita Acara']);
            $this->session->setFlashdata('message', 'Diupload');
            $nomorPutusan = $data['penetapan']['nomor_putusan'];
            sendMessage($data['penetapan']['whatsapp'], session('name'), "Mengupload Berita Acara Untuk Penetapan Nomor $nomorPutusan");
            return redirect()->to('/bhp');
        }
    }


    function download($link_putusan)
    {
        $berkas = new PutusanModel();
        $data = $berkas->where('link_putusan', $link_putusan)->first();
        // dd($data);
        // var_dump($data);
        // echo $data['link_dock'];
        // die;
        return $this->response->download('uploads/berita_acara/' . $data['nama_file_ba'], null)->setFileName('berita_acara_' . $data['tgl_upload'] . '.pdf');
    }
}
