<?php
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['name']) && !empty($_POST['email'])) {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $studentDB->update($id, $name, $email);
        }
    }
    header('location: list.php', true);
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
<h2>Updata infomation</h2>
<div class="table">
    <form method="post" action="">
        <table>
            <tr>
                <td>ID</td>
                <td><?php if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        echo $id;
                    } ?>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" size="20" value="<?php echo $_GET['name'] ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" size="20" value="<?php echo $_GET['email'] ?>"></td>
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
