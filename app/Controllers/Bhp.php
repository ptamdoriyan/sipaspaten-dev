<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;
use App\Models\UsersModel;
use App\Models\BeritaAcara;

class Bhp extends BaseController
{

    public function __construct()
    {
        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(5, session('role_id'));
    }

    //method index. sebagai tampilan awal.
    public function index()
    {
        //
        $penetapanModel = new PenetapanModel();
        $data['penetapan'] = $penetapanModel->bhpGetDataAll();
        $data['penetapan_aproved'] = $penetapanModel->orderBy('tgl_upload', 'DESC')->where(['status' => 2])->findAll();
        // $data['allPutusan'] = $putusanModel->bhpGetDataAll();
        return view('bhp/user_bhp', $data);
    }

    //view data all PA, untuk kebutuhan Grafik
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

    //tampilan saat klik add berita acara
    public function addData($id_penetapan)
    {
        $penetapanModel = new PenetapanModel();
        $data['penetapan'] = $penetapanModel->bhpGetDatabyLink($id_penetapan);
        return view('bhp/bhp_add', $data);
    }

    // logic saat add berita acara
    public function addBerita()
    {
        $penetapanModel = new PenetapanModel();
        $userModel = new UsersModel();
        $beritaAcaraModel = new BeritaAcara();

        $validation =  \Config\Services::validation();
        $validation->setRules(['nomor_penetapan' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            # ambil data dan kirim ke database
            $id_berita = rand(1, 99999999999);
            $id_penetapan = $this->request->getVar('id_penetapan');
            $nomor_berita = $this->request->getVar('nomor_berita');;
            $file_berita = $this->request->getFile('berita_acara');
            $nama_file_berita = $file_berita->getRandomName();

            //siapkan data untuk diisi di database
            $data = [
                'id_berita' => $id_berita,
                'id_penetapan' => $id_penetapan,
                'nomor_berita' => $nomor_berita,
                'nama_file_berita' => $nama_file_berita,
            ];
            //masukkan data di database
            $beritaAcaraModel->insert($data);
            //pindahkan berkas
            $file_berita->move('uploads/berita_acara/', $nama_file_berita);
            $this->logmodel->insert(['id_user' => session('name'), 'action' => "Upload Berita Acara Nomor $nomor_berita"]);
            //buat flash data
            $this->session->setFlashdata('message', 'Diupload');
            //persiapan kirim pesan
            $waPanitera = $userModel->getWhatsapp(3);
            $waPanmud = $userModel->getWhatsapp(4);
            $waPA = $this->request->getVar('whatsapp_user');
            $nomor_penetapan = $this->request->getVar('nomor_penetapan');
            sendMessage("$waPanitera,$waPanmud, $waPA", session('name'), "Mengupload Berita Acara Untuk Penetapan Nomor $nomor_penetapan");
            return redirect()->to('/bhp');
        }
        ##############################################

    }
}
