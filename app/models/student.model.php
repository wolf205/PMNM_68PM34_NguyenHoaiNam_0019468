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
}
