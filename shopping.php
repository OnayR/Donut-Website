<?php
include 'Donut.php';
include_once "config.php";
session_start();

$donutprijzen = $_SESSION['donutprijzen'];

$chocolate = $donutprijzen[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link  type="text/css" rel="stylesheet" href="css/shopping.css">
</head>
<body>
<header>
        <div class="order">
          <?php
      // print_r($donutprijzen);
      foreach($donutprijzen as $donut){

          $donutnaam = $donut->get_name();

          $sql = "SELECT * FROM donut WHERE donutnaam = '$donutnaam'";
          $stmt = $pdo->query($sql);
          $donuts = $stmt->fetch();

          if($donut->get_price() == 0) {
              echo " ";
            } else {
              // Moest boven de eerste echo staan zodat de eerste form niet onder de eerste echo kwam te staan.
              echo "<form action='shopping.php' method='post'>";
            echo $donut->get_name() . " " . $donut->get_price() . "x " . "€" . $donuts['donutprijs'] . " = " . "€" . ($donuts['donutprijs'] * $donut->get_price());
            ?>
            <button type="submit" name="delete" value="<?php echo $donut->get_name(); ?>">X</button>
            <button type="submit" name="add" value="<?php echo $donut->get_name(); ?>">+</button>
            <button type="submit" name="remove" value="<?php echo $donut->get_name(); ?>">-</button>
            <?php
            echo "<br>";
            echo "€" . $donut->get_price() * $donuts['donutprijs'];
            echo "<br>";
            echo "<hr>";
            echo "<br>";
            }
          }
          ?>
        </div>
    </header>
</body>
</html>

<?php

if(isset($_POST['add'])) {
  $donutnaam = $_POST['add'];
  foreach($donutprijzen as $donut) {
    if($donut->get_name() == $donutnaam) {
      $donut->add();
    }
  }
  header("location: shopping.php");
}

if(isset($_POST['remove'])) {
  $donutnaam = $_POST['remove'];
  foreach($donutprijzen as $donut) {
    if($donut->get_name() == $donutnaam) {
      $donut->remove();
    }
  }
  header("location: shopping.php");
}

if(isset($_POST['delete'])) {
  $donutnaam = $_POST['delete'];
  foreach($donutprijzen as $donut) {
    if($donut->get_name() == $donutnaam) {
      $donut->delete();
    }
  }
  header("location: shopping.php");
}

?>