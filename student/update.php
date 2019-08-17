<?php
session_start();
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';
if (isset($_SESSION['id'])) {
    if ($_SESSION['id'] == '9') { //id = 9 là admin
        $id = $_GET['id'];
    } else {
        $id = $_SESSION['id'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $error = false;
        if (empty($name)) {
            $errorName = 'name không được để trống';
            $error = true;
        }
        if (empty($email)) {
            $errorEmail = 'email không được để trống';
            $error = true;
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorEmail = "Email không hợp lệ";
                $error = true;
            }
        }
        if (!$error) {
            $studentDB = new DBstudent();
            $currentStudent = $studentDB->finById($id);
            $students = $studentDB->getAll();
            $duplicateError = false;
            foreach ($students as $key => $student) {
                if ($email == $student->getEmail() && $email != $currentStudent->getEmail()) {
                    $duplicateError = true;
                }
            }
            if ($duplicateError) {
                $errorEmail = 'Email đã tồn tại.';
            } else {
                $studentDB->update($id, $name, $email);
                header('location: list.php', true);
            }
        }
    } else {
        $studentDB = new DBstudent();
        $currentStudent = $studentDB->finById($id);
        if (is_string($currentStudent)) {
            echo $currentStudent . '<br>';
            echo '<a href="admin.php">Trở về</a>';
            die();
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
        <title>Update info</title>
    </head>
    <body>
    <?php include_once '../header.php' ?>
    <h2>Updata infomation</h2>
    <?php ?>
    <div class="table">
        <form method="post" action="">
            <table>
                <tr>
                    <td>ID</td>
                    <td>
                        <?php echo $id ?>
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name"
                               value="<?php echo isset($name) ? $name : $currentStudent->getName(); ?>"><?php echo $errorName ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email"
                               value="<?php echo isset($email) ? $email : $currentStudent->getEmail(); ?>"><?php echo $errorEmail ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit">Update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </body>
    </html>
    <?php
} else {
    header('location:../index.php');
} ?>