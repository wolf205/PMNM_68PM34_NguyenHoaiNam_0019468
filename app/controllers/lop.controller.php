<?php
require_once '../app/core/controller.php';

class Lop extends Controller
{
    // 1. Hiển thị danh sách lớp học (có phân trang + search)
    public function index($page = 1, $limit  = 10, $search = "")
    {
        $lopModel = $this->model("lop");
        // getAllClass() giờ trả về ['currentPage', 'totalPage', 'data']
        $result = $lopModel->getAllClass($page, $limit, $search);

        // Truyền thẳng mảng kết quả vào view (extract sẽ tạo $data, $totalPage, $currentPage)
        $this->view("layouts/mainLayout", "lop/index", $result);
    }

    // 2. Hiển thị form tạo mới lớp học
    public function create()
    {
        $this->view("layouts/mainLayout", "lop/create", []);
    }

    // 3. Lưu lớp học mới
    public function store()
    {
        $malop  = trim($_POST['ma_lop']  ?? '');
        $tenlop = trim($_POST['ten_lop'] ?? '');
        $ghichu = trim($_POST['ghi_chu'] ?? '');

        try {
            $this->model("lop")->createClass($malop, $tenlop, $ghichu);
            header("Location: /lop/index");
            exit();
        } catch (\Exception $e) {
            echo "Thêm lớp học thất bại: " . $e->getMessage();
        }
    }

    // 4. Hiển thị form sửa lớp học
    public function edit($malop)
    {
        $lopModel   = $this->model("lop");
        $data['lop'] = $lopModel->getClassById($malop);

        if (!$data['lop']) {
            echo "Không tìm thấy lớp học!";
            return;
        }

        $this->view("layouts/mainLayout", "lop/edit", $data);
    }

    // 5. Cập nhật lớp học
    public function update($malop)
    {
        $tenlop = trim($_POST['ten_lop'] ?? '');
        $ghichu = trim($_POST['ghi_chu'] ?? '');

        try {
            $this->model("lop")->updateClass($malop, $tenlop, $ghichu);
            header("Location: /lop/index");
            exit();
        } catch (\Exception $e) {
            echo "Cập nhật lớp học thất bại: " . $e->getMessage();
        }
    }

    // 6. Xóa lớp học
    public function delete($malop)
    {
        try {
            $this->model("lop")->deleteClass($malop);
            header("Location: /lop/index");
            exit();
        } catch (\Exception $e) {
            echo "Xóa lớp học thất bại: " . $e->getMessage();
        }
    }
}
