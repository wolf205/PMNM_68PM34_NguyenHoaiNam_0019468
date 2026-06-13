<?php
require_once '../app/core/controller.php';

class Lop extends Controller
{
    // 1. Hiển thị danh sách lớp học
    public function index($page = 1, $limit = 10)
    {
        $lop = $this->model("lop");

        // Vì hàm getAllClass ở model trước chưa phân trang, tạm thời lấy hết dữ liệu
        // Nếu sau này bạn tối ưu phân trang, có thể truyền thêm $page, $limit vào hàm này
        $data = $lop->getAllClass();

        // Gọi view hiển thị giao diện danh sách lớp
        $this->view("layouts/mainLayout", "lop/index", $data);
    }

    // 2. Hiển thị form tạo mới lớp học
    public function create()
    {
        $this->view("layouts/mainLayout", "lop/create", []);
    }

    // 3. Xử lý lưu lớp học mới vào cơ sở dữ liệu
    public function store()
    {
        $malop = $_POST['ma_lop'] ?? '';
        $tenlop = $_POST['ten_lop'] ?? '';
        $ghichu = $_POST['ghi_chu'] ?? '';

        $result = $this->model("lop")->createClass($malop, $tenlop, $ghichu);

        if ($result) {
            // Chuyển hướng về trang danh sách lớp học nếu thành công
            header("Location: /lop/index");
            exit();
        } else {
            echo "Thêm mới lớp học thất bại.";
        }
    }

    // 4. Hiển thị form chỉnh sửa lớp học theo ma_lop
    public function edit($malop)
    {
        $lopModel = $this->model("lop");
        $data['lop'] = $lopModel->getClassById($malop);

        if (!$data['lop']) {
            echo "Không tìm thấy lớp học!";
            return;
        }

        $this->view("layouts/mainLayout", "lop/edit", $data);
    }

    // 5. Xử lý cập nhật thông tin lớp học vào cơ sở dữ liệu
    public function update($malop)
    {
        $tenlop = $_POST['ten_lop'] ?? '';
        $ghichu = $_POST['ghi_chu'] ?? '';

        $result = $this->model("lop")->updateClass($malop, $tenlop, $ghichu);

        if ($result) {
            // Chuyển hướng về trang danh sách lớp học nếu thành công
            header("Location: /lop/index");
            exit();
        } else {
            echo "Cập nhật thông tin lớp học thất bại.";
        }
    }

    public function delete($malop)
    {
        $result = $this->model("lop")->deleteClass($malop);

        if ($result) {
            header("Location: /lop/index");
            exit();
        } else {
            echo "Xoá lớp học thất bại";
        }
    }
}
