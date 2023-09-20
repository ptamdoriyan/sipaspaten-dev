<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PutusanModel;
use App\Models\UsersModel;

class User extends BaseController
{
    protected $helpers = ['form'];

    public function __construct()
    {

        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(4, session('role_id'));
    }

    public function index()
    {
        // if (!isset($_SESSION['name'])) {
        //     return redirect()->to('/');
        // }
        // inisiasi model
        $model = new PutusanModel();
        //ambil data di database
        $id_uniq = session('id_uniq');
        $data['putusan'] = $model->orderBy('tgl_upload', 'DESC')->where('id_uniq', $id_uniq)->findAll();
        $data['putusan_aproved'] = $model->orderBy('tgl_upload', 'DESC')->where(['id_uniq' => $id_uniq, 'status' => 2])->findAll();
        //kirim view
        return view('user/user_pa', $data);
    }

    public function view()
    {
        $model = new PutusanModel();
        $id_uniq = session('id_uniq');

        for ($i = 0; $i < 4; $i++) {
            // # code...
            $tanggaljudul = date('M', strtotime("+$i month"));
            $tanggalisi = date("m") + $i;
            $hasilhitung[$tanggaljudul] = $model->SumDataPerPA($id_uniq, $tanggalisi);
        }
        print_r(json_encode($hasilhitung));
        die;
    }


    //add data
    public function addData()
    {
        $model = new PutusanModel();

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
            'nama_file_ba' => null,
            'nomor_ba' => null,
            'status' => $status
        ];
        // dd($data);

        //masukkan data di database
        $model->insert($data);
        //pindahkan berkas
        $databerkas->move('uploads/putusan/', $filename);
        $this->logmodel->insert(['id_uniq' => $data['id_uniq'], 'action' => 'Upload Data']);
        //buat flash data
        $this->session->setFlashdata('message', 'Diupload');
        sendMessage('6282346909192', session('name'), 'Mengupload Putusan');
        return redirect()->to('user');
    }

    //hapus data
    public function delete($link_putusan, $id_uniq)
    {
        $model = new PutusanModel();
        $model->where('link_putusan', $link_putusan)->delete();
        $this->logmodel->insert(['id_uniq' => $id_uniq, 'action' => 'Delete Data']);
        $this->session->setFlashdata('message', 'Dihapus');
        sendMessage('6282346909192', session('name'), 'Menghapus Putusan');
        return redirect()->to('user');
    }


    // download dokumen
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
