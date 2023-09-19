<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Bhp extends BaseController
{

    public function __construct()
    {
        helper(['whatsapp_helper', 'login_helper']);
        checkLogin(3, session('role_id'));
    }

    public function index()
    {
        //
        echo "ini controller BHP";
    }
}
