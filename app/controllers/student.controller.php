<?php
require_once '../app/core/controller.php';
class student extends Controller
{
    public function index()
    {
        $student = $this->model("student");
        $data = $student->getAllStudent();

        $this->view("student/index", $data);
    }

    public function create()
    {
        require_once '../app/views/student/create.php';
    }
}
