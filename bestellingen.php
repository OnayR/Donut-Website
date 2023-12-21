<?php
require_once "include/config.php";
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$sql = "SELECT * FROM klant WHERE username = '" . $_SESSION['username'] . "'";
    $stmt = $pdo->query($sql);
    $klant = $stmt->fetch();

$sqlbestellingcheck = "SELECT * FROM bestelling WHERE idklant = '" . $klant['idklant'] . "'";
$stmtbestelling = $pdo->query($sqlbestellingcheck);
$bestellingcheck = $stmtbestelling->fetchAll();

$sqldonutbestellingcheck = "SELECT * FROM donutbestelling";
$stmtdonutbestelling = $pdo->query($sqldonutbestellingcheck);
$donutbestellingcheck = $stmtdonutbestelling->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="css/bestelling.css">
</head>
<body>
    <div>
        <h1 class="headertext">Order History</h1>
    </div>
    <div class="navbar">
        <li><a href="index.php" class="navbarcontent">Home</a></li><br>
        <li><a href="bestellingen.php" class="navbarcontent">Order History</a></li><br>
        <li><a href="logout.php" class="navbarcontent">Logout</a></li>
    </div>
    <div class="bestellingcontainer">
    <?php
    foreach($bestellingcheck as $bestelling) {
        ?> <div class="bestelling">
            <div class="besteldatum"> <?php
        echo $bestelling['besteldatum'];
        ?> </div>
            <div class="bestelinformatie"> <?php
        foreach($donutbestellingcheck as $donutbestelling) {
            if($donutbestelling['idbestelling'] == $bestelling['idbestelling']) {
                echo $donutbestelling['donutnaam'] . " " . $donutbestelling['aantal'] . " stuk besteld." . "<br>";
            }
        }
        echo "<hr>";
        echo "Totaalprijs: €" . $bestelling['prijstotaal'];
        ?></div>
     </div> <?php
    }
    ?>
    </div>
</body>
</html>