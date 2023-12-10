<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>

<style>
    body {
        text-align: center;
    }
</style>

<body>
    <div class="head-div">
        <div class="head-image">
        <img src="Images/Donut.png">
</div>
    <h1 class="head">Register here</h1>
</div>
    <div class="container">
        <div class="wrapper">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="username" required class="form-input" placeholder="Username"><br><br>
        <input type="text" id="name" name="name" required class="form-input" placeholder="Firstname"><br><br>
        <input type="text" id="lastname" name="lastname" required class="form-input" placeholder="Lastname"><br><br>
        <input type="email" id="email" name="email" required class="form-input" placeholder="Email"><br><br>
        <input type="text" id="telefoon" name="telefoon" class="form-input" placeholder="Phone Number"><br><br>
        <input type="password" id="password" name="password" required class="form-input" placeholder="Password"><br><br>
        <input type="submit" value="register" class="form-button">
    </form>
</div>
<p class="link">Already have an account? <a href="login.php">Login here</a>.</p>
</div>
</body>
</html>

<?php
session_start();

include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idklant = rand(100000, 999999);
    $username = $_POST['username'];
    $name = $_POST['name'];
     $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $password = $_POST['password'];

    $sql = "INSERT INTO klant (idklant, username, klantvoornaam, klantachternaam, klantemail, klanttelefoon, klantwachtwoord)
        VALUES ($idklant, '$username', '$name', '$lastname', '$email', '$telefoon', '$password')";

        $usernamecheck = "SELECT username FROM klant WHERE username = '$username'";
        $stmt = $pdo->query($usernamecheck);
        $singleusername = $stmt->fetch();

        $medewerkercheck = "SELECT medewerkerusername FROM medewerker WHERE medewerkerusername = '$username'";
        $stmtmedewerker = $pdo->query($medewerkercheck);
        $singlemedewerker = $stmtmedewerker->fetch();

        if($username === $singleusername['username']) {
            echo "Error: Please choose a different username";
        } else if ($username === $singlemedewerker['medewerkerusername']) {
            echo "Error: Please choose a different username";
        } else {
        if ($pdo->query($sql)) {
            $_SESSION["loggedin"] = true;
            echo "New record created successfully";
            header('location: index.php');
        }
    }
}