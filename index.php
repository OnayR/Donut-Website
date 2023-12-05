<?php 
session_start();
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>My Webpage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="container">
        <div class="wrapper">
            <img class="slide-image" src="Images/slideshow/Donut-1.jpg">
            <img class="slide-image" src="Images/slideshow/Donut-2.jpg">
            <img class="slide-image" src="Images/slideshow/Donut-3.jpg">
            <img class="slide-image" src="Images/slideshow/Donut-4.jpg">
        </div>
    </div>

    <div class="spacer">
        <p class="hide">a</p>
    </div>

    <h1 class="product-category">best selling</h1>
    <section class="product">
        <button class="pre-btn"><img src="images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="images/arrow.png" alt=""></button>
        <div class="sales">
            <!-- All the products -->
            <?php
        $sql = "SELECT * FROM donut";
        $stmt = $pdo->query($sql);
        $donuts = $stmt->fetchAll();
        
        foreach($donuts as $donut) {
            ?>
            <!DOCTYPE html>
            <div class="specific-sale">
                <div class="product-image">
                    <button class="donut-buy">
                        <h2 class="buyme-text">Buy me!</h2>
                        <p class="info-texts"><?php echo $donut['donutdesc'] ?></p>
                        <img src="Images/saved-donuts/<?php echo $donut['donutimg'] ?>" class="donut-sale">
                    </button>
                </div>
                <div class="product-info">
                    <h1 class="donut-name"><?php echo $donut['donutnaam'] ?></h1>
                    <p class="donut-price">€<?php echo $donut['donutprijs'] ?> st.</p>
                    <input type="number" min="0"></input>
                </div>
        </div>

            </html>
    <?php
        }
    ?>
    </section>

    <header>
        <div class="following">
            <div class="primary-bar">
                <a href="logout.php">a</a>
                <h1 class="text">Welcome to My Webpage</h1>
                <h1 class="text"><a href="index.php">Profile</a></h1>
                <a href="shopping.php"><i class="fa-solid fa-cart-shopping fa-2xl text"></i></a>
            </div>

            <div class="holder">
                <img class="donut" src="Images/Donut.png">
            </div>
    </header>

    <div class="spacer2"></div>
    </div>



    <!--Libraries-->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.28/dist/lenis.min.js"></script>

    <!--Javascript Files-->
    <script defer src="Javascript/script.js"></script>
    <script src="Javascript/Scrollanimations.js"></script>

    <!--fonts/icons-->
    <script src="https://kit.fontawesome.com/0f6a8fd9b7.js" crossorigin="anonymous"></script>
</body>

</html>

<?php

$sql = "SELECT * FROM donut";
        $stmt = $pdo->query($sql);
        $donuts = $stmt->fetchAll();

?>