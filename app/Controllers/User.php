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
        checkLogin(4, session('role_id'));
    }

    public function index()
    {

        $penetapanModel = new PenetapanModel();
        //ambil data di database
        $id_uniq_user = session('id_uniq_user');
        $data['penetapan'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where('id_uniq_user', $id_uniq_user)->findAll();
        $data['penetapan_approved'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where(['id_uniq_user' => $id_uniq_user, 'status' => 2])->findAll();
        //kirim view
        return view('user/user_pa', $data);
    }

    public function view()
    {
        $model = new PenetapanModel();
        $id_uniq_user = session('id_uniq_user');

        for ($i = 0; $i < 4; $i++) {
            // # code...
            $tanggaljudul = date('M', strtotime("+$i month"));
            $tanggalisi = date("m") + $i;
            $hasilhitung[$tanggaljudul] = $model->SumDataPerPA($id_uniq_user, $tanggalisi);
        }
        print_r(json_encode($hasilhitung));
        die;
    }


    //add data
    public function addData()
    {
        $model = new PenetapanModel();

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
        $id_uniq_user = session('id_uniq_user');
        $nomor_penetapan = $this->request->getVar('nomor_penetapan');
        $status = 1;
        $databerkas = $this->request->getFile('berkas');
        $penetapan_uniq = rand();
        $nama_file_penetapan = $databerkas->getRandomName();

        $data = [
            'id_uniq_user' => $id_uniq_user,
            'nomor_penetapan' => $nomor_penetapan,
            'penetapan_uniq' => $penetapan_uniq,
            'nama_file_penetapan' => $nama_file_penetapan,
            'status' => $status
        ];

        //masukkan data di database
        $model->insert($data);
        //pindahkan berkas
        $databerkas->move('uploads/penetapan/', $nama_file_penetapan);
        $this->logmodel->insert(['id_uniq_user' => $id_uniq_user, 'action' => 'Upload Data']);
        //buat flash data
        $this->session->setFlashdata('message', 'Diupload');
        sendMessage('6282346909192', session('name'), 'Mengupload Penetapan');
        return redirect()->to('user');
    }

    //hapus data
    public function delete($penetapan_uniq, $id_uniq_user)
    {
        $model = new PenetapanModel();
        $model->where('penetapan_uniq', $penetapan_uniq)->delete();
        $this->logmodel->insert(['id_uniq_user' => $id_uniq_user, 'action' => 'Delete Data']);
        $this->session->setFlashdata('message', 'Dihapus');
        sendMessage('6282346909192', session('name'), 'Menghapus Penetapan');
        return redirect()->to('user');
    }


    // download dokumen
    function download($penetapan_uniq)
    {
        $berkas = new PenetapanModel();
        $data = $berkas->where('penetapan_uniq', $penetapan_uniq)->first();
        return $this->response->download('uploads/penetapan/' . $data['nama_file_penetapan'], null)->setFileName('Penetapan_' . $data['tgl_upload'] . '.pdf');
    }
}
