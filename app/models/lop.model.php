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

    // 1. Lấy toàn bộ danh sách lớp học
    public function getAllClass()
    {
        try {
            $sql = "SELECT * FROM lops";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // 2. Thêm một lớp học mới (ma_lop thường tự động tăng nên không cần truyền vào)
    public function createClass($malop, $tenlop, $ghichu)
    {
        try {
            $sql = "INSERT INTO lops (ma_lop, ten_lop, ghi_chu) VALUES (:ma_lop, :ten_lop, :ghi_chu)";
            $stmt = $this->conn->prepare($sql);

            // Ràng buộc dữ liệu để tránh SQL Injection
            $stmt->bindParam(':ma_lop', $malop);
            $stmt->bindParam(':ten_lop', $tenlop);
            $stmt->bindParam(':ghi_chu', $ghichu);

            return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // 3. Lấy thông tin chi tiết của 1 lớp học theo ma_lop
    public function getClassById($malop)
    {
        try {
            $sql = "SELECT * FROM lops WHERE ma_lop = :ma_lop";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ma_lop', $malop);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về 1 mảng chứa dữ liệu của lớp đó
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

    // 4. Cập nhật thông tin lớp học theo ma_lop
    public function updateClass($malop, $tenlop, $ghichu)
    {
        try {
            $sql = "UPDATE lops SET ten_lop = :ten_lop, ghi_chu = :ghi_chu WHERE ma_lop = :ma_lop";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':ma_lop', $malop);
            $stmt->bindParam(':ten_lop', $tenlop);
            $stmt->bindParam(':ghi_chu', $ghichu);

            return $stmt->execute(); // Trả về true nếu thành công
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function deleteClass($malop)
    {
        try {

            $this->conn->beginTransaction();

            $sqlDeleteStudents = "DELETE FROM sinhviens WHERE ma_lop = :ma_lop";
            $stmtStudents = $this->conn->prepare($sqlDeleteStudents);
            $stmtStudents->execute([':ma_lop' => $malop]);

            $sqlDeleteClass = "DELETE FROM lops WHERE ma_lop = :ma_lop";
            $stmtClass = $this->conn->prepare($sqlDeleteClass);
            $stmtClass->execute([':ma_lop' => $malop]);

            $this->conn->commit();

            return true;
        } catch (\Exception $e) {
            $this->conn->rollBack();
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
