<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devicewidth, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login Page</title>
</head>
<body>
    <div class="head-div">
    <div class="head-image">
        <img src="../Images/Donut.png">
</div>
    <h1 class="head">Welcome Back!</h1>
    
</div>
    <div class="container">
        <h2 class="login-text">Login</h2>
        <div class="wrapper">
            <form method="POST" action="login.php">
                <input type="text" id="username" name="username" required class="form-input" placeholder="Username"><br><br>
                <input type="password" id="password" name="password" required class="form-input" placeholder="Password"><br><br>
                <input type="submit" value="Login" class="form-button">
            </form>
        </div>
<p class="link">Don't have an account? <a href="registration.php">Sign up now</a>.</p>
</div>

    <?php
    session_start();
    require_once '../include/config.php';

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT idklant, username, klantwachtwoord FROM klant WHERE username = '$username'";
        $sqlmedewerker = "SELECT idmedewerker, medewerkerusername, medewerkerwachtwoord FROM medewerker WHERE medewerkerusername = '$username'";

        $stmt = $pdo->query($sql);

        $stmtmedewerker = $pdo->query($sqlmedewerker);

        $wachtwoorddb = $stmt->fetch();

        $wachtwoorddbmedewerker = $stmtmedewerker->fetch();

        if ($password === $wachtwoorddb['klantwachtwoord']) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: ../main/index.php");
            echo "Logged in successfully.";
        } else if ($password === $wachtwoorddbmedewerker['medewerkerwachtwoord']) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: ../admin/admin.php");
            echo "Logged in successfully.";
        } else {
            echo "Invalid username or password.";
            $_SESSION["loggedin"] = false;
        }
    }
} else {
    header("location: ../main/index.php");
}
    ?>
</body>
</html>
