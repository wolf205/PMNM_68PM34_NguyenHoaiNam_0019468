<?php
require_once '../app/core/connect.php';

class StudentModel
{
    private $conn;

    public function __construct()
    {
        $db = new Connect();
        $this->conn = $db->connect();
    }

    /**
     * Lấy danh sách sinh viên kèm phân trang và tìm kiếm (gộp gọn câu lệnh SQL)
     */
    public function getAllStudent($page = 1, $limit = 10, $search = "")
    {
        $offset = ($page - 1) * $limit;

        // Tạo từ khóa tìm kiếm (Nếu $search rỗng sẽ thành "%%" - nghĩa là tìm tất cả)
        $searchTerm = "%" . $search . "%";

        // 1. Câu lệnh lấy danh sách sinh viên kèm tên lớp
        $query = "SELECT sv.*, l.ten_lop 
                  FROM sinhviens sv
                  INNER JOIN lops l ON sv.ma_lop = l.ma_lop
                  WHERE (sv.mssv LIKE :search OR sv.hoten LIKE :search OR l.ten_lop LIKE :search)
                  ORDER BY sv.id 
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':search', $searchTerm);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 2. Câu lệnh đếm tổng số dòng lọc theo từ khóa
        $queryCount = "SELECT COUNT(*) 
                       FROM sinhviens sv
                       INNER JOIN lops l ON sv.ma_lop = l.ma_lop
                       WHERE (sv.mssv LIKE :search OR sv.hoten LIKE :search OR l.ten_lop LIKE :search)";

        $stmtCount = $this->conn->prepare($queryCount);
        $stmtCount->bindValue(':search', $searchTerm);
        $stmtCount->execute();
        $total = $stmtCount->fetchColumn();

        $totalPage = ceil($total / $limit);

        return [
            "currentPage" => $page,
            "totalPage" => $totalPage,
            "students" => $result
        ];
    }

    /**
     * Thêm mới sinh viên - Chủ động throw Exception nếu mã lớp không tồn tại
     */
    public function createStudent($hoten, $gioitinh, $mssv, $malop)
    {
        // 1. Kiểm tra xem mã lớp có tồn tại trên hệ thống không
        $checkQuery = "SELECT COUNT(*) FROM lops WHERE ma_lop = :malop";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute([':malop' => $malop]);
        $classExists = $checkStmt->fetchColumn();

        if (!$classExists) {
            throw new \Exception("Mã lớp '{$malop}' không tồn tại trên hệ thống!");
        }

        // 2. Tiến hành chèn dữ liệu
        $query = "INSERT INTO sinhviens (hoten, gioitinh, mssv, ma_lop) 
                  VALUES (:hoten, :gioitinh, :mssv, :malop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);

        return $stmt->execute();
    }

    /**
     * Lấy chi tiết thông tin của 1 sinh viên dựa trên ID (gồm cả tên lớp)
     */
    public function getStudentById($id)
    {
        $query = "SELECT sv.*, l.ten_lop 
                  FROM sinhviens sv
                  INNER JOIN lops l ON sv.ma_lop = l.ma_lop 
                  WHERE sv.id = :id 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cập nhật thông tin sinh viên - Chủ động throw Exception nếu mã lớp không tồn tại
     */
    public function updateStudent($id, $hoten, $gioitinh, $mssv, $malop)
    {
        // 1. Kiểm tra xem mã lớp mới có tồn tại trong bảng lops hay không
        $checkQuery = "SELECT COUNT(*) FROM lops WHERE ma_lop = :malop";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute([':malop' => $malop]);
        $classExists = $checkStmt->fetchColumn();

        if (!$classExists) {
            throw new \Exception("Mã lớp '{$malop}' không tồn tại trên hệ thống!");
        }

        // 2. Tiến hành cập nhật thông tin sinh viên
        $query = "UPDATE sinhviens 
                  SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, ma_lop = :malop 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);

        return $stmt->execute();
    }

    /**
     * Xóa một sinh viên theo ID
     */
    public function deleteStudent($id)
    {
        $query = "DELETE FROM sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xóa lớp học sử dụng Transaction (Xóa sinh viên thuộc lớp trước, xóa lớp sau)
     */
    public function deleteClass($malop)
    {
        try {
            // Khởi động Transaction
            $this->conn->beginTransaction();

            // 1. Xóa tất cả sinh viên thuộc mã lớp này trước
            $sqlDeleteStudents = "DELETE FROM sinhviens WHERE ma_lop = :ma_lop";
            $stmtStudents = $this->conn->prepare($sqlDeleteStudents);
            $stmtStudents->execute([':ma_lop' => $malop]);

            // 2. Xóa lớp học học khỏi hệ thống
            $sqlDeleteClass = "DELETE FROM lops WHERE ma_lop = :ma_lop";
            $stmtClass = $this->conn->prepare($sqlDeleteClass);
            $stmtClass->execute([':ma_lop' => $malop]);

            // Xác nhận lưu mọi thay đổi
            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            // Gặp bất kỳ lỗi nào sẽ hoàn tác toàn bộ dữ liệu ngay lập tức
            $this->conn->rollBack();
            throw $e; // Đẩy tiếp Exception ra ngoài để Controller bắt lấy thông tin lỗi cụ thể
        }
    }
}
