<?php
session_start();
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';

if(isset($_SESSION['id']) && $_SESSION['id'] == '9'){ //id = 9 là admin
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $studentDB = new DBstudent();
        $studentDB->del($id);
    } else {
        header('location: admin.php', true);
    }
    header('location: admin.php', true);
} else {
    header('location:../index.php');
}
?>