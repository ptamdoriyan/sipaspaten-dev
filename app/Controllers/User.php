<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    // protected $helpers = ['form'];
    public function index()
    {
        //kirim view
        return view('user/user_pa');
    }

    public function addData()
    {

        return view('user/user_add');

        // if (!$this->request->is('post')) {
        //     return view('user/user_add');
        // }

        // $rules = [];

        // if (!$this->validate($rules)) {
        //     return view('user/user_add');
        // }
        // //if success
        // return view('success');
    }
}
