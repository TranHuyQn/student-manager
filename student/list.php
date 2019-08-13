<?php
include_once '../DBconnect.php';
include_once '../Student.php';
include_once '../DBstudent.php';

$data = $students->getAll();
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
<table border="1" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th></th>
    </tr>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><?php echo $item['id'] ?></td>
            <td><?php echo $item['name'] ?></td>
            <td>
                <span><a href="update.php?id=<?php echo $item['id'] ?>&name=<?php echo $item['name']?>">Update</a></span>
                <span><a href="del.php?id=<?php echo $item['id'] ?>">Delete</a></span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="create.php" type="button">Add new student</a>
</body>
</html>
