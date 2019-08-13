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
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function create($obj)
    {
        $name = $obj->getName();
        $email = $obj->getEmail();
        $sql = "INSERT INTO students(`name`,`email`) VALUE ('$name','$email')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function del($id)
    {
        $sql = "DELETE FROM `students` WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function update($id, $name, $email)
    {
        $sql ="UPDATE `students` SET `name`='$name',`email`='$email' WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
}

$studentDB = new DBstudent();
