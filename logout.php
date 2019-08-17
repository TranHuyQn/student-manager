<?php
session_start();
if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
    header('location:index.php');
} else {
    header('location:index.php');
}