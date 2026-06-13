<?php
require_once '../app/core/controller.php';

class home extends Controller
{
    public function index()
    {
        $this->view("layouts/mainLayout", "home/index", []);
    }
}
