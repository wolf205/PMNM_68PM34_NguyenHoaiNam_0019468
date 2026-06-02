<?php
require_once '../app/core/controller.php';
class student extends Controller
{
    public function index()
    {
        $student = $this->model("student");
        $data = $student->getAllStudent();

        $this->view("layouts/mainLayout", "student/index", $data);
    }

    public function create()
    {
        $this->view("layouts/mainLayout", "student/create", []);
    }
    public function store()
    {
        $hoten = $_POST['hoten'] ?? '';
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = $_POST['mssv'] ?? '';

        $result = $this->model("student")->createStudent($hoten, $gioitinh, $mssv);

        if ($result) {
            header("Location: /student/index");
        } else {
            echo "Failed to create student.";
        }
    }
}
