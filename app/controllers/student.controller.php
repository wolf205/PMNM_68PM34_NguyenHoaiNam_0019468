<?php
class student
{
    public function index()
    {
        // trả về view
        require_once '../app/views/student/index.php';
    }

    public function create()
    {
        require_once '../app/views/student/create.php';
    }
}
