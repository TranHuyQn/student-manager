<?php
include_once 'DBconnect.php';
include_once 'Student.php';
include_once 'DBstudent.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = false;
    if (empty($name)) {
        $errorName = "Tên người dùng không được bỏ trống";
        $error = true;
    }
    if (empty($email)) {
        $errorEmail = "Email không được bỏ trống";
        $error = true;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorEmail = "Email không hợp lệ";
            $error = true;
        }
    }
    if (empty($username)) {
        $errorUsername = "username không được bỏ trống";
        $error = true;
    }
    if (empty($password)) {
        $errorPassword = "password không được bỏ trống";
        $error = true;
    }
    if (!$error) {
        $studentDB = new DBstudent();
        if ($studentDB->isDuplicateEmail($email) || $studentDB->isDuplicateUsername($username)) {
            $noti = 'Email hoặc Username đã tồn tại.';
        } else {
            $newStudent = new Student($name, $email, $username, $password);
            $studentDB->create($newStudent);
            header('location: index.php', true);
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
    <title>Register</title>
</head>
<body>
<h2>Register new student</h2>
<?php echo $noti ?>
<div class="table">
    <form method="post" action="">
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" size="20"
                           value="<?php if (isset($name)) echo $name; ?>"><?php echo $errorName ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" size="20"
                           value="<?php if (isset($email)) echo $email; ?>"><?php echo $errorEmail ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" size="20"
                           value="<?php if (isset($username)) echo $username; ?>"><?php echo $errorUsername ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password" size="20"
                           value="<?php if (isset($password)) echo $password; ?>"><?php echo $errorPassword ?>
                </td>
            </tr>
            <tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Register</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>