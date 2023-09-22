<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;
use App\Models\UsersModel;


class Files extends BaseController
{

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
}
