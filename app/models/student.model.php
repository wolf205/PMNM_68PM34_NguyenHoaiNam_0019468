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

    public function getAllStudent()
    {
        $query = "SELECT * FROM sinhviens";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}
