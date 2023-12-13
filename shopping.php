<?php
include 'Donut.php';
include_once "config.php";
session_start();

$donutprijzen = $_SESSION['donutprijzen'];

$bestellingarray = array();
$aantalarray = array();
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
          $donuttotaal = 0.0;
      // print_r($donutprijzen);
      foreach($donutprijzen as $donut){

          $donutnaam = $donut->get_name();

          $sql = "SELECT * FROM donut WHERE donutnaam = '$donutnaam'";
          $stmt = $pdo->query($sql);
          $donuts = $stmt->fetch();


          if($donut->get_price() == 0) {
              echo "";
            } else {
              $donuttotaal =$donuttotaal + $donut->get_price() * $donuts['donutprijs'];

              // Moest boven de eerste echo staan zodat de eerste form niet onder de eerste echo kwam te staan.
              echo "<form action='shopping.php' method='post'>";
              echo $donut->get_name() . " " . $donut->get_price() . "x " . "€" . $donuts['donutprijs'] . " = " . "€" . ($donuts['donutprijs'] * $donut->get_price());
              ?>
              <button type="submit" name="delete" value="<?php echo $donut->get_name(); ?>" class="delete">X</button>
              <button type="submit" name="add" value="<?php echo $donut->get_name(); ?>" class="plus">+</button>
              <button type="submit" name="remove" value="<?php echo $donut->get_name(); ?>" class="min">-</button>
              <?php
              echo "<br>";
              echo "€" . $donut->get_price() * $donuts['donutprijs'];
              echo "<br>";
              echo "<hr>";
              echo "<br>";
              array_push($bestellingarray, $donut->get_name());
              array_push($aantalarray, $donut->get_price());
            }
          }
          echo "Totaal:";
          echo "<br>";
          echo "€" . $donuttotaal;
          echo "<br>";
          ?>
          <button type="submit" name="bestel" value="bestel" class="bestel">Bestel</button>
          </form>
        </div>
    </header>
</body>
</html>

<?php

$sqlbestellingcheck = "SELECT * FROM bestelling";
  $stmtbestelling = $pdo->query($sqlbestellingcheck);
  $bestellingcheck = $stmtbestelling->fetchAll();

  $sqldonutbestellingcheck = "SELECT * FROM donutbestelling";
  $stmtdonutbestelling = $pdo->query($sqldonutbestellingcheck);
  $donutbestellingcheck = $stmtdonutbestelling->fetchAll();

$sql = "SELECT * FROM klant WHERE username = '" . $_SESSION['username'] . "'";
  $stmt = $pdo->query($sql);
  $klant = $stmt->fetch();


// Add
if(isset($_POST['add'])) {
  $donutnaam = $_POST['add'];
  foreach($donutprijzen as $donut) {
    if($donut->get_name() == $donutnaam) {
      $donut->add();
    }
  }
  header("location: shopping.php");
}

// Remove
if(isset($_POST['remove'])) {
  $donutnaam = $_POST['remove'];
  foreach($donutprijzen as $donut) {
    if($donut->get_name() == $donutnaam) {
      $donut->remove();
    }
  }
  header("location: shopping.php");
}

// Delete
if(isset($_POST['delete'])) {
  $donutnaam = $_POST['delete'];
  foreach($donutprijzen as $donut) {
    if($donut->get_name() == $donutnaam) {
      $donut->delete();
    }
  }
  header("location: shopping.php");
}

$iddonutbestelling = 0;
foreach($donutbestellingcheck as $donutbestelling) {
  $iddonutbestelling++;
}

// Bestelling
if(isset($_POST['bestel'])) {

  $idbestelling = 0;
  foreach($bestellingcheck as $bestelling) {
    $idbestelling++;
  }

  foreach($bestellingarray as $bestelling => $aantal) {

    $sql = "SELECT * FROM donut WHERE donutnaam = '$aantal'";
    $stmt = $pdo->query($sql);
    $donuts = $stmt->fetch();

    $sqldonutbestelling = "INSERT INTO donutbestelling (iddonutbestelling, iddonut, idbestelling, aantal, prijs, donutnaam)
     VALUES ('$iddonutbestelling', '" . $donuts['iddonut'] . "', '$idbestelling', '" . $aantalarray[$bestelling] . "', $aantalarray[$bestelling] * '" . $donuts['donutprijs'] . "', '$aantal')";
    $stmtdonutbestelling = $pdo->query($sqldonutbestelling);

    $sqldonutaantal = "UPDATE donut SET totaalverkocht = totaalverkocht + '" . $aantalarray[$bestelling] . "' WHERE donutnaam = '$aantal'";
    $stmtdonutaantal = $pdo->query($sqldonutaantal);

    $iddonutbestelling++;
  }
  
  $sqlbestelling = "INSERT INTO bestelling (idbestelling, idklant, besteldatum, prijstotaal)
   VALUES ('$idbestelling', '" . $klant['idklant'] . "', '" . date("Y-m-d") . "', '$donuttotaal')";
  $stmtbestelling = $pdo->query($sqlbestelling);

  echo "<script>alert('Bestelling geplaatst!')</script>";
}
?>