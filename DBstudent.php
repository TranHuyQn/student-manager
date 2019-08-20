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
        if ($data) {
            foreach ($data as $item) {
                $student = new Student($item['name'], $item['email'], $item['username'], $item['password']);
                $student->setId($item['id']);
                array_push($arr, $student);
            }
            return $arr;
        } else {
            return 'không có dữ liệu hiển thị';
        }
    }

    public function create($obj)
    {
        $name = $obj->getName();
        $email = $obj->getEmail();
        $username = $obj->getUsername();
        $password = $obj->getPassword();
        $sql = "INSERT INTO students(`name`,`email`,`username`,`password`) VALUE ('$name','$email','$username','$password')";
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
            $student = new Student($data['name'], $data['email'], $data['username'], $data['password']);
            $student->setId($data['id']);
            return $student;
        } else {
            return 'Người dùng không tồn tại.';
        }
    }

    public function isAdmin($id)
    {
        $sql = "SELECT studentId FROM admin";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();
        foreach ($data as $item) {
            if ($item['studentId'] == $id) {
                return true;
            }
        }
        return false;
    }

    public function isDuplicateEmail($email)
    {
        $sql = "SELECT * FROM `students` WHERE `email`='$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        if($result == 0){
            return false;
        }
        return true;
    }

    public function isDuplicateUsername($username)
    {
        $sql = "SELECT * FROM `students` WHERE `username`='$username'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        if($result == 0){
            return false;
        }
        return true;
    }
}



