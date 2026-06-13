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
     * 1. Lấy danh sách lớp học có phân trang và tìm kiếm
     */
    public function getAllClass($page = 1, $limit = 10, $search = "")
    {
        $offset = ($page - 1) * $limit;
        $searchTerm = "%" . $search . "%";

        // Lấy danh sách có phân trang
        $sql = "SELECT * FROM lops
                WHERE (ma_lop LIKE :search OR ten_lop LIKE :search OR ghi_chu LIKE :search)
                ORDER BY ma_lop
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', $searchTerm);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Đếm tổng số dòng
        $sqlCount = "SELECT COUNT(*) FROM lops
                     WHERE (ma_lop LIKE :search OR ten_lop LIKE :search OR ghi_chu LIKE :search)";

        $stmtCount = $this->conn->prepare($sqlCount);
        $stmtCount->bindValue(':search', $searchTerm);
        $stmtCount->execute();
        $total = $stmtCount->fetchColumn();

        $totalPage = ceil($total / $limit);

        return [
            "currentPage" => $page,
            "totalPage"   => $totalPage,
            "data"        => $result
        ];
    }

    /**
     * 2. Thêm một lớp học mới
     */
    public function createClass($malop, $tenlop, $ghichu)
    {
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
     * 3. Lấy thông tin chi tiết 1 lớp học theo ma_lop
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
     * 4. Cập nhật thông tin lớp học
     */
    public function updateClass($malop, $tenlop, $ghichu)
    {
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
     * 5. Xóa lớp học dùng Transaction
     */
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
            throw $e;
        }
    }
}
