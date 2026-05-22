<?php
class home
{
    public function index()
    {
        require_once('../app/views/home/home.view.php');
    }

    public function login()
    {
        require_once '../app/views/auth/login.php';
    }
}
