<?php
require_once '../app/core/connect.php';

class LopModel
{
    private $conn;

    public function __construct()
    {
        $db = new Connect();
        $this->conn = $db->connect();
    }

    /**
     * 1. Lấy toàn bộ danh sách lớp học
     */
    public function getAllClass()
    {
        $sql = "SELECT * FROM lops";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 2. Thêm một lớp học mới
     * Chủ động check trùng ma_lop trước khi insert
     */
    public function createClass($malop, $tenlop, $ghichu)
    {
        // Kiểm tra xem ma_lop đã tồn tại hay chưa để tránh trùng Khóa chính (Primary Key)
        $checkSql = "SELECT COUNT(*) FROM lops WHERE ma_lop = :ma_lop";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([':ma_lop' => $malop]);
        if ($checkStmt->fetchColumn() > 0) {
            throw new \Exception("Mã lớp '{$malop}' đã tồn tại trên hệ thống!");
        }

        $sql = "INSERT INTO lops (ma_lop, ten_lop, ghi_chu) VALUES (:ma_lop, :ten_lop, :ghi_chu)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':ma_lop', $malop);
        $stmt->bindParam(':ten_lop', $tenlop);
        $stmt->bindParam(':ghi_chu', $ghichu);

        return $stmt->execute();
    }

    /**
     * 3. Lấy thông tin chi tiết của 1 lớp học theo ma_lop
     */
    public function getClassById($malop)
    {
        $sql = "SELECT * FROM lops WHERE ma_lop = :ma_lop";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_lop', $malop);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 4. Cập nhật thông tin lớp học theo ma_lop
     */
    public function updateClass($malop, $tenlop, $ghichu)
    {
        // Kiểm tra xem lớp học có tồn tại hay không trước khi update
        $checkSql = "SELECT COUNT(*) FROM lops WHERE ma_lop = :ma_lop";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([':ma_lop' => $malop]);
        if ($checkStmt->fetchColumn() == 0) {
            throw new \Exception("Lớp học có mã '{$malop}' không tồn tại để cập nhật!");
        }

        $sql = "UPDATE lops SET ten_lop = :ten_lop, ghi_chu = :ghi_chu WHERE ma_lop = :ma_lop";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':ma_lop', $malop);
        $stmt->bindParam(':ten_lop', $tenlop);
        $stmt->bindParam(':ghi_chu', $ghichu);

        return $stmt->execute();
    }

    /**
     * 5. Xóa lớp học sử dụng Transaction
     */
    public function deleteClass($malop)
    {
        try {
            $this->conn->beginTransaction();

            // 1. Xóa tất cả sinh viên thuộc mã lớp này trước để tránh lỗi khóa ngoại
            $sqlDeleteStudents = "DELETE FROM sinhviens WHERE ma_lop = :ma_lop";
            $stmtStudents = $this->conn->prepare($sqlDeleteStudents);
            $stmtStudents->execute([':ma_lop' => $malop]);

            // 2. Xóa chính lớp học đó
            $sqlDeleteClass = "DELETE FROM lops WHERE ma_lop = :ma_lop";
            $stmtClass = $this->conn->prepare($sqlDeleteClass);
            $stmtClass->execute([':ma_lop' => $malop]);

            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            $this->conn->rollBack();
            // Đẩy tiếp Exception ra ngoài để Controller xử lý hiển thị thông báo
            throw $e;
        }
    }
}
