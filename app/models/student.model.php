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

    public function getAllStudent($page = 1, $limit = 10, $search = "")
    {
        $offset = ($page - 1) * $limit;


        $query = "SELECT * FROM sinhviens ORDER BY id LiMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $queryCount = "SELECT COUNT(*) FROM sinhviens";
        $stmt = $this->conn->query($queryCount);
        $total = $stmt->fetchColumn();

        $totalPage = ceil($total / $limit);


        return [
            "currentPage" => $page,
            "totalPage" => $totalPage,
            "students" => $result
        ];
    }

    public function createStudent($hoten, $gioitinh, $mssv)
    {
        $query = "INSERT INTO sinhviens (hoten, gioitinh, mssv) VALUES (:hoten, :gioitinh, :mssv)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        return $stmt->execute();
    }

    public function getStudentById($id)
    {
        $query = "SELECT * FROM sinhviens WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về 1 mảng chứa thông tin sinh viên hoặc false nếu không thấy
    }

    public function updateStudent($id, $hoten, $gioitinh, $mssv)
    {
        $query = "UPDATE sinhviens 
                  SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind các tham số dữ liệu mới
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);

        return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại
    }

    public function deleteStudent($id)
    {
        $query = "DELETE FROM sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại
    }
}
