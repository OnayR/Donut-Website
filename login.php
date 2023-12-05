<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <a href="registration.php">register</a>

    <?php
    session_start();
    require_once "config.php";

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
            header("location: index.php");
            echo "Logged in successfully.";
        } else if ($password === $wachtwoorddbmedewerker['medewerkerwachtwoord']) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: admin/admin.php");
            echo "Logged in successfully.";
        } else {
            echo "Invalid username or password.";
            $_SESSION["loggedin"] = false;
        }
    }
} else {
    header("location: index.php");
}
    ?>
</body>
</html>
