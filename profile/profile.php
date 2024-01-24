<?php
require_once '../include/config.php';
session_start();

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<div class="sidebar">
        <a class="active" href="admin.php">Home</a>
        <a href="edituser.php">edit user</a>
        <a href="deleteuser.php">delete user</a>
        <a class="index" href="../main/index.php">Back to website</a>
    </div>

    <div class="content" id="home">
        <h2 class="title">Welcome <?php echo $username ?>!</h2>
        <p>Admin page</p>
    </div>

</body>
</html>
