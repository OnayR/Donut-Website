<?php
session_start();
require_once "../config.php";

$username = $_SESSION["username"];
$sql = "SELECT * FROM medewerker WHERE medewerkerusername = '$username'";

$stmt = $pdo->query($sql);

$medewerker = $stmt->fetch();

if ($medewerker['medewerkerusername'] === $username) {
} else {
    echo "Invalid username or password.";
    header("location: ../index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin <?php echo $username ?></title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="sidebar">
        <a class="active" href="admin.php">Home</a>
        <a href="createadmin.php">Create User</a>
        <a href="createproduct.php">Create Product</a>
        <a class="index" href="../index.php">Back to website</a>
    </div>

    <div class="content" id="home">
        <h2>Welcome <?php echo $username ?>!</h2>
        <p>Admin page</p>
    </div>
    </body>
</html>