<?php


function checkLogin($role, $role_id)
{

    if ($role != $role_id) {
        header('Location: ' . base_url('/'));
        exit();
    }
}
