<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<style>
    body {
        text-align: center;
    }
</style>

<body>
    <h1>Login</h1>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username"><br><br>
        <label for="name">Voornaam:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="lastname">Achternaam:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="telefoon">Telefoon:</label>
        <input type="text" id="telefoon" name="telefoon"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="register">
    </form>
    <a href="login.php">login</a>
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

        $singleusername = $stmt->fetch();

    if ($pdo->query($usernamecheck)) {
        if($username === $singleusername['username']) {
            echo "Error: Please choose a different username";
        } else {
        if ($pdo->query($sql)) {
            $_SESSION["loggedin"] = true;
            echo "New record created successfully";
            header('location: index.php');
        }
    }
    }
}