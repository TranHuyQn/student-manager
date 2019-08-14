<?php
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $student = new Student($name, $email);
        $studentDB = new DBstudent();
        $studentDB->create($student);
        header('location: list.php', true);
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
    <title>Add new student</title>
</head>
<body>
<h2>Add new student</h2>
<div class="table">
    <form method="post" action="">
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" size="20"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" size="20"></td>
            </tr>
            <tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Add</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
