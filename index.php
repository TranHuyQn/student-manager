<?php
session_start();
include_once 'DBconnect.php';
if(isset($_SESSION['id'])){
    if($_SESSION['id'] == '9'){ //id = 9 là admin
        header('location:student/admin.php');
    } else {
        header('location:student/list.php');
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST["username"]) && empty($_POST["password"])) {
            echo '<p style="color: red">Không được để trống \'username\' và \'password\'</p>';
        } else {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $Dbconnect = new DBconnect();
            $conn = $Dbconnect->connect();
            $sql = "SELECT * FROM students WHERE username='$username'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $resultUsername = $stmt->rowCount();

            if ($resultUsername != 0) {
                $sql = "SELECT * FROM students WHERE username='$username' and password='$password'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetch();

                if ($result) {
                    $_SESSION['id'] = $result['id'];
                    if ($_SESSION['id'] == '9') {
                        header('location:student/admin.php');
                    } else {
                        header('location:student/list.php');
                    }
                } else {
                    echo 'sai mat khau';
                }
            } else {
                echo 'sai ten dang nhap';
            }
        }
    }
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>login</title>
    </head>
    <body>
    <form method="post">
        <table>
            <tr>
                <td>username</td>
                <td><input name="username"></td>
            </tr>
            <tr>
                <td>password</td>
                <td><input name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">login</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
    </html>
    <?php
}?>