<?php
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';

$studentDB = new DBstudent();
$students = $studentDB->getAll();
if (is_string($students)) {
    echo $students . '<br>';
    echo '<a href="create.php" type="button"><button>Add new student</button></a>';
    die();
}
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
<table border="1" cellspacing="0" style="margin-top: auto">
    <tr>
        <th>Stt</th>
        <th>Name</th>
        <th>Email</th>
        <th></th>
    </tr>
    <?php foreach ($students as $key => $student): ?>
        <tr>
            <td><?php echo ++$key; ?></td>
            <td><?php echo $student->getName(); ?></td>
            <td><?php echo $student->getEmail(); ?></td>
            <td>
                <span><a href="update.php?id=<?php echo $student->getId(); ?>"><button>Update</button></a></span>
                <span><a href="del.php?id=<?php echo $student->getId(); ?>"><button>Delete</button></a></span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="create.php" type="button"><button>Add new student</button></a>
</body>
</html>
