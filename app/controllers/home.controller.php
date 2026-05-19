<?php
class home
{
    public function index()
    {
        echo "This is Home page";
    }

    public function login()
    {
        require_once '../app/views/auth/login.php';
    }
}
