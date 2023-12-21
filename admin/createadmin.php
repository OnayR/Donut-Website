<?php
session_start();
require_once "../include/config.php";

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
        <a href="admin.php">Home</a>
        <a class="active" href="createadmin.php">Create User</a>
        <a href="createproduct.php">Create Product</a>
        <a href="../index.php">Back to website</a>
    </div>

    <div class="content" id="home">
        <h2>Admin <?php echo $username ?></h2>
        <p>Admin page</p>

        <form method="POST" action="createadmin.php" enctype="multipart/form-data">
            <label for="medewerkerusername">Usernaam</label>
            <input type="text" name="medewerkerusername"><br><br>
            <label for="medewerkerpassword">Password</label>
            <input type="text" name="medewerkerpassword"><br><br>
            <label for="medewerkername">Name</label>
            <input type="text" name="medewerkername"><br><br>
            <label for="medewerkerlastname">Lastname</label>
            <input type="text" name="medewerkerlastname"><br><br>
            <label for="medewerkeremail">Email</label>
            <input type="text" name="medewerkeremail"><br><br>
            <input type="submit" value="add">
        </form>
        <?php

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $idmedewerker = rand(100000, 999999);
                $medewerkerusername = $_POST["medewerkerusername"];
                $medewerkerpassword = $_POST["medewerkerpassword"];
                $medewerkername = $_POST["medewerkername"];
                $medewerkerlastname = $_POST["medewerkerlastname"];
                $medewerkeremail = $_POST["medewerkeremail"];

                $sql = "INSERT INTO medewerker (idmedewerker, medewerkerusername, medewerkerwachtwoord, medewerkervoornaam, medewerkerachternaam, medewerkeremail) 
                VALUES ($idmedewerker, '$medewerkerusername', '$medewerkerpassword', '$medewerkername', '$medewerkerlastname', '$medewerkeremail')";

                $sqlcheck = "SELECT * FROM medewerker WHERE medewerkerusername = '$medewerkerusername'";
                $stmtcheck = $pdo->query($sqlcheck);
                $medewerker = $stmtcheck->fetch();

                $sqlcheckuser = "SELECT * FROM klant WHERE username = '$medewerkerusername'";
                $stmtcheckuser = $pdo->query($sqlcheckuser);
                $klant = $stmtcheckuser->fetch();

                if($medewerkerusername === $klant['username']) {
                    echo "User already exists.";
                    echo "<script>alert('User already exists.')</script>";
                    exit();
                } else {
                if($medewerkerusername === $medewerker['medewerkerusername']) {
                    echo "User already exists.";
                    echo "<script>alert('User already exists.')</script>";
                    exit();
                } else {
                    if($pdo->query($sql)) {
                        echo "User created successfully.";
                    } else {
                        echo "Something went wrong.";
                    }
                }
            }
        }
        ?>
    </div>
    </body>
</html>
