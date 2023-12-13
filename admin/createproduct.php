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
        <a href="admin.php">Home</a>
        <a href="createadmin.php">Create User</a>
        <a class="active" href="createproduct.php">Create Product</a>
        <a href="../index.php">Back to website</a>
    </div>

    <div class="content" id="home">
        <h2>Admin <?php echo $username ?></h2>
        <p>Admin page</p>

        <form method="POST" action="createproduct.php" enctype="multipart/form-data">
            <label for="productnaam">Productnaam</label>
            <input type="text" name="productnaam"><br><br>
            <label for="prijs">Prijs</label>
            <input type="number" name="prijs" step=".01"><br><br>
            <label for="producttype">Producttype</label>
            <input type="text" name="producttype"><br><br>
            <label for="productsmaak">Productsmaak</label>
            <input type="text" name="productsmaak"><br><br>
            <label for="productdesc">Productdesc</label>
            <input type="text" name="productdesc"><br><br>
            <label for="productafbeelding">Productafbeelding</label>
            <input type="file" id="productafbeelding" name="productafbeelding"><br><br>
            <input type="submit" value="add">
        </form>

        <?php

            $sql = "SELECT * FROM donut";
            $stmt = $pdo->query($sql);
            $donuts = $stmt->fetchAll();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_FILES['productafbeelding'])){
                    $file_name = $_FILES['productafbeelding']['name'];
                    $file_tmp =$_FILES['productafbeelding']['tmp_name'];
                    $extensions = array("jpeg","jpg","png");
                    if(is_uploaded_file($file_tmp)) {
                        echo "image uploaded";
                        echo "<br>";
                        if(move_uploaded_file($file_tmp, "../Images/saved-donuts/" . $file_name)) {
                            echo "Succesfully uploaded your image.";
                            echo "<br>";
                            echo $file_name;
                        }
                        else {
                            echo "Failed to move your image.";
                        }
                    } else {
                        echo "Failed to upload your image.";
                    }
                }
                
                $iddonut = 0;
                foreach($donuts as $donut) {
                    $iddonut++;
                }
                $productnaam = $_POST['productnaam'];
                $prijs = $_POST['prijs'];
                $producttype = $_POST['producttype'];
                $productsmaak = $_POST['productsmaak'];
                $productdesc = $_POST['productdesc'];
                $productafbeelding = $file_name;

                $sql = "INSERT INTO donut (iddonut, donutnaam, donutprijs, donuttype, smaak, donutimg, donutdesc, totaalverkocht)
                VALUES ($iddonut, '$productnaam', $prijs, '$producttype', '$productsmaak', '$productafbeelding', '$productdesc', '0')";

                $singlename = "SELECT donutnaam FROM donut WHERE donutnaam = '$productnaam'";
                $stmt = $pdo->query($singlename);
                $singlename = $stmt->fetch();

                if($productnaam === $singlename['donutnaam']) {
                    echo "Error: Please choose a different name";
                } else {
                if($pdo->query($sql)) {
                    echo "Product added";
                } else {
                    echo "Error: Please try again";
                }
            }
        }
        ?>
    </div>
    </body>
</html>