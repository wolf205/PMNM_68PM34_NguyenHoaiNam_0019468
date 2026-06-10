<?php
require_once '../app/core/controller.php';
class student extends Controller
{
    public function index($page = 1, $limit = 10)
    {
        $student = $this->model("student");
        $data = $student->getAllStudent($page, $limit);
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

    public function edit($id)
    {
        $studentModel = $this->model("student");
        $data['student'] = $studentModel->getStudentById($id);

        if (!$data['student']) {
            echo "Không tìm thấy sinh viên!";
            return;
        }

        $this->view("layouts/mainLayout", "student/edit", $data);
    }

    public function update($id)
    {
        $hoten = $_POST['hoten'] ?? '';
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = $_POST['mssv'] ?? '';

        $result = $this->model("student")->updateStudent($id, $hoten, $gioitinh, $mssv);

        if ($result) {
            header("Location: /student/index");
        } else {
            echo "Cập nhật thất bại.";
        }
    }

    public function delete($id)
    {
        $result = $this->model("student")->deleteStudent($id);

        if ($result) {
            header("Location: /student/index");
        } else {
            echo "Xóa thất bại.";
        }
    }
}
