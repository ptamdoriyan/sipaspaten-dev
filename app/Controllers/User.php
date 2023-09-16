<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        //kirim view
        return view('user/user_pa');
    }

    public function addData()
    {
        if (!$this->request->is('post')) {
            return view('user/useradd');
        }

        $rules = [];

        if (!$this->validate($rules)) {
            return view('user/useradd');
        }

        return view('success');
    }
}
