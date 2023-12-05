<?php
$host = "localhost";
$username = "DonotCEO";
$password = "";
$database = "Donot";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br/>";
    die();
}


?>