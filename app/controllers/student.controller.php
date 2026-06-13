<?php
require_once '../app/core/controller.php';

class student extends Controller
{
    // 1. Danh sách sinh viên (phân trang + search)
    public function index($page = 1, $limit = 10)
    {
        $search  = $_GET['search'] ?? '';

        $studentModel = $this->model("student");
        // getAllStudent() trả về ['currentPage', 'totalPage', 'students']
        $result = $studentModel->getAllStudent($page, $limit, $search);

        $this->view("layouts/mainLayout", "student/index", $result);
    }

    // 2. Hiển thị form tạo sinh viên
    public function create()
    {
        // Lấy danh sách lớp để render dropdown chọn lớp
        $lopList = $this->model("lop")->getAllClass();
        $this->view("layouts/mainLayout", "student/create", [
            'lopList' => $lopList['data'] ?? $lopList
        ]);
    }

    // 3. Lưu sinh viên mới
    public function store()
    {
        $hoten    = trim($_POST['hoten']    ?? '');
        $gioitinh = trim($_POST['gioitinh'] ?? '');
        $mssv     = trim($_POST['mssv']     ?? '');
        $malop    = trim($_POST['ma_lop']   ?? '');

        try {
            $this->model("student")->createStudent($hoten, $gioitinh, $mssv, $malop);
            header("Location: /student/index");
            exit();
        } catch (\Exception $e) {
            echo "Thêm sinh viên thất bại: " . $e->getMessage();
        }
    }

    // 4. Hiển thị form sửa sinh viên
    public function edit($id)
    {
        $studentModel    = $this->model("student");
        $data['student'] = $studentModel->getStudentById($id);

        if (!$data['student']) {
            echo "Không tìm thấy sinh viên!";
            return;
        }

        // Lấy danh sách lớp để render dropdown
        $lopResult      = $this->model("lop")->getAllClass();
        $data['lopList'] = $lopResult['data'] ?? $lopResult;

        $this->view("layouts/mainLayout", "student/edit", $data);
    }

    // 5. Cập nhật sinh viên
    public function update($id)
    {
        $hoten    = trim($_POST['hoten']    ?? '');
        $gioitinh = trim($_POST['gioitinh'] ?? '');
        $mssv     = trim($_POST['mssv']     ?? '');
        $malop    = trim($_POST['ma_lop']   ?? '');

        try {
            $this->model("student")->updateStudent($id, $hoten, $gioitinh, $mssv, $malop);
            header("Location: /student/index");
            exit();
        } catch (\Exception $e) {
            echo "Cập nhật sinh viên thất bại: " . $e->getMessage();
        }
    }

    // 6. Xóa sinh viên
    public function delete($id)
    {
        try {
            $this->model("student")->deleteStudent($id);
            header("Location: /student/index");
            exit();
        } catch (\Exception $e) {
            echo "Xóa sinh viên thất bại: " . $e->getMessage();
        }
    }
}
