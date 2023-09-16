<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PutusanModel;

class User extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        // inisiasi model
        $model = new PutusanModel();
        //ambil data di database
        $id_uniq = session('id_uniq');
        $data['putusan'] = $model->orderBy('id_putusan', 'ASC')->where('id_uniq', $id_uniq)->findAll();


        //kirim view
        return view('user/user_pa', $data);
    }

    public function view()
    {
    }



    public function addData()
    {
        $model = new PutusanModel();
        // $session = session();

        // return view('user/user_add');

        if (!$this->request->is('post')) {
            return view('user/user_add');
        }

        $rules = [
            'nomorputusan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('user/user_add');
        }
        //if success
        //ambe data
        $id_uniq = session('id_uniq');
        $nomorputusan = $this->request->getVar('nomorputusan');
        $status = 1;
        $databerkas = $this->request->getFile('berkas');
        $link_putusan = rand();
        $filename = $databerkas->getRandomName();

        $data = [
            'id_uniq' => $id_uniq,
            'nomor_putusan' => $nomorputusan,
            'link_putusan' => $link_putusan,
            'nama_file' => $filename,
            'status' => $status
        ];
        // dd($data);

        //masukkan data di database
        $model->insert($data);
        //pindahkan berkas
        $databerkas->move('uploads/putusan/', $filename);

        return redirect()->to('user');
    }

    function download($id)
    {
        $berkas = new PutusanModel();
        $data = $berkas->where('link_putusan', $id)->first();
        // dd($data);
        // var_dump($data);
        // echo $data['link_dock'];
        // die;
        return $this->response->download('uploads/putusan/' . $data['nama_file'], null)->setFileName('putusan_upload' . $data['tgl_upload'] . '.pdf');
    }
}
