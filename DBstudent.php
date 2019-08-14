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
        $arr = [];

        foreach ($data as $item) {
            $student = new Student($item['name'], $item['email']);
            $student->id = $item['id'];
            array_push($arr, $student);
        }
        return $arr;
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
        $sql = "UPDATE `students` SET `name`='$name',`email`='$email' WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function finById($id)
    {
        $sql = 'SELECT * FROM students where id=' . $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetch();
        if ($data) {
            $student = new Student($data['name'], $data['email']);
            $student->id = $data['id'];
            return $student;
        } else {
            return 'Người dùng không tồn tại.';
        }
    }
}



