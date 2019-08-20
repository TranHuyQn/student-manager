<?php
session_start();
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';

$studentDB = new DBstudent();
if(isset($_SESSION['id']) && $studentDB->isAdmin($_SESSION['id'])){
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $currentStudent = $studentDB->finById($id);
        if(is_string($currentStudent)){
            echo $currentStudent . '<br>';
            echo '<a href="admin.php">Trở về</a>';
            die();
        }
        $studentDB->del($id);
    } else {
        header('location: admin.php', true);
    }
    header('location: admin.php', true);
} else {
    header('location:../index.php');
}
?>