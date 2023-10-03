<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pta extends BaseController
{


    public function __construct()
    {
        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(2, session('role_id'));
    }


    public function index()
    {
        //
    }
}
