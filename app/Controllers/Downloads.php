<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenetapanModel;

class Downloads extends BaseController
{
    function penetapan($id_penetapan)
    {
        $penetapanModel = new PenetapanModel();
        $data = $penetapanModel->where('id_penetapan', $id_penetapan)->first();
        return $this->response->download('uploads/penetapan/' . $data['nama_file_penetapan'], null)->setFileName('Penetapan_' . $data['tgl_upload'] . '.pdf');
    }
}
