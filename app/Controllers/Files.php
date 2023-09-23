<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;
use App\Models\UsersModel;
use App\Models\BeritaAcara;


class Files extends BaseController
{
    public function __construct()
    {
        if (session('id_user') == null) {
            header('Location: ' . base_url('/'));
            exit();
        }
    }

    function getPenetapan($id_penetapan)
    {
        $penetapanModel = new PenetapanModel();
        $data = $penetapanModel->where('id_penetapan', $id_penetapan)->first();
        return $this->response->download('uploads/penetapan/' . $data['nama_file_penetapan'], null)->setFileName('Penetapan_' . $data['tgl_upload'] . '.pdf');
    }

    //hapus penetapan
    public function delPenetapan($id_penetapan, $id_user)
    {
        $penetapanModel = new PenetapanModel();
        $userModel = new UsersModel();
        $penetapanModel->where('id_penetapan', $id_penetapan)->delete();
        $this->logmodel->insert(['id_user' => $id_user, 'action' => 'Delete Data']);
        // session
        $this->session->setFlashdata('message', 'Dihapus');
        // kirim WA
        $waPanitera = $userModel->getWhatsapp(3);
        $waPanmud = $userModel->getWhatsapp(4);
        $waBhp = $userModel->getWhatsapp(5);
        sendMessage("$waPanitera,$waPanmud,$waBhp", session('name'), 'Menghapus Penetapan');
        return redirect()->to('user');
    }


    function getBerita($id_penetapan)
    {
        $beritaModel = new BeritaAcara();
        $data = $beritaModel->where('id_penetapan', $id_penetapan)->first();
        return $this->response->download('uploads/berita_acara/' . $data['nama_file_berita'], null)->setFileName($data['nomor_berita'] . '_' . $data['tgl_upload'] . '.pdf');
    }

    //hapus penetapan
    public function delBerita($id_penetapan, $id_user)
    {
        $beritaModel = new BeritaAcara();
        $userModel = new UsersModel();

        $beritaModel->where('id_penetapan', $id_penetapan)->delete();
        $this->logmodel->insert(['id_user' => session('id_user'), 'action' => "Delete Berita Acara Nomor "]);
        // session
        $this->session->setFlashdata('message', 'Dihapus');
        // kirim WA
        $waPanitera = $userModel->getWhatsapp(3);
        $waPanmud = $userModel->getWhatsapp(4);
        $waSatker = $userModel->getWhatsappbyid($id_user);
        sendMessage("$waPanitera,$waPanmud,$waSatker", session('name'), 'Menghapus Berita Acara');
        return redirect()->to('/bhp');
    }
}
