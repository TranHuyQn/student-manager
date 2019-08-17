<?php
session_start();
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';
if (isset($_SESSION['id'])) {
    if($_SESSION['id'] == '9'){ //id = 9 là admin
        header('location:admin.php');
    } else {
        $id = $_SESSION['id'];
        $studentDB = new DBstudent();
        $student = $studentDB->finById($id);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>List Student</title>
        </head>
        <body>
        <?php include_once '../header.php' ?>
        <table border="1" cellspacing="0" style="margin-top: auto">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </tr>
            <tr>
                <td><?php echo $student->getName(); ?></td>
                <td><?php echo $student->getEmail(); ?></td>
                <td>
                    <span><a href="update.php?id=<?php echo $student->getId(); ?>"><button>Update</button></a></span>
                </td>
            </tr>
        </table>
        </body>
        </html>
        <?php
    }
} else {
    header('location:../index.php');
} ?>