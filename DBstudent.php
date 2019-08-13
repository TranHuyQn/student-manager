<?php
include_once "DBconnect.php";
include_once "Student.php";

class DBstudent
{
    public $conn;

    public function __construct()
    {
        $db = new DBconnect();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM students';
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function create($obj)
    {
        $name = $obj->getName();
        $sql = "INSERT INTO students(`name`) VALUE ('$name')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function del($id)
    {
        $sql = "DELETE FROM `students` WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function update($name, $id)
    {
        $sql ="UPDATE `students` SET `name`='$name' WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
}

$students = new DBstudent();
