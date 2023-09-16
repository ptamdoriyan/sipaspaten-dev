<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        //kirim view
        return view('user/user_pa');
    }
}
