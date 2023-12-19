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

<header>
        <div class="following">
        <div class="primary-bar-background">
                <p class="hide">a</p>   
            </div>
            <div class="primary-bar">
                <div class="dropdown">
                <span class="text">Profile</span>
                <div class="dropdown-content">
                <a href="bestellingen.php" class="dropdown-text">Orders</a>
                <a class="dropdown-text">Profile</a>
                <a href="logout.php" class="dropdown-text">logout</a>
                </div>
                </div>
                <a href="shopping.php"><i class="fa-solid fa-cart-shopping fa-2xl text"></i></a>
            </div>
        </div>


            <div class="holder">
                <img class="donut" src="Images/Donut.png">
            </div>
    </header>

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

    <h1 class="product-category">Best selling</h1>
    <section class="product">
        <!--<button class="pre-btn"><img src="images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="images/arrow.png" alt=""></button> -->
        <div class="sales">
            <!-- All the products -->
            <?php
        $sql = "SELECT * FROM donut ORDER BY totaalverkocht DESC LIMIT 6";
        $stmt = $pdo->query($sql);
        $donuts = $stmt->fetchAll();
        
        foreach($donuts as $donut) {
            ?>  
            <!DOCTYPE html>
            
            <div class="specific-sale">
                <div class="product-image">
                    <button type="submit" name="donut-buy<?php echo $donut['iddonut'] ?>" class="donut-buy">
                        <h2 class="buyme-text">Buy me!</h2>
                        <p class="info-texts"><?php echo $donut['donutdesc'] ?></p>
                        <img src="Images/saved-donuts/<?php echo $donut['donutimg'] ?>" class="donut-sale">
                    </button>
                </div>
                <div class="product-info">
                    <h1 class="donut-name"><?php echo $donut['donutnaam'] ?></h1>
                    <p class="donut-price">€<?php echo $donut['donutprijs'] ?> st.</p>
                    <form method="POST" action="index.php">
                    <select name="numberOfDonuts<?php echo $donut['iddonut'] ?>" class="donut-amount">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            </html>
    <?php
        }
    ?>

    </section>
    <input type="submit" value="Save in shopping cart" class="submit-button" name="submit-best">
                </form>

    <!-- <div class="spacer">
        <p class="hide">a</p>
    </div> -->
    

    <!-- Second section of products -->
    <h1 class="product-category allproducts">All of our products</h1>
    <section class="product">
    <!--<button class="pre-btn"><img src="images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="images/arrow.png" alt=""></button> -->
    <div class="sales">
        <?php
        $sqlall = "SELECT * FROM donut";
        $stmtall = $pdo->query($sqlall);
        $donutsall = $stmtall->fetchAll();

    foreach($donutsall as $donut) {
            ?>  
            <!DOCTYPE html>
            
            <div class="specific-sale">
                <div class="product-image">
                    <button type="submit" name="donut-buy<?php echo $donut['iddonut'] ?>" class="donut-buy">
                        <h2 class="buyme-text">Buy me!</h2>
                        <p class="info-texts"><?php echo $donut['donutdesc'] ?></p>
                        <img src="Images/saved-donuts/<?php echo $donut['donutimg'] ?>" class="donut-sale">
                    </button>
                </div>
                <div class="product-info">
                    <h1 class="donut-name"><?php echo $donut['donutnaam'] ?></h1>
                    <p class="donut-price">€<?php echo $donut['donutprijs'] ?> st.</p>
                    <form method="POST" action="index.php">
                    <select name="numberOfDonuts<?php echo $donut['iddonut'] ?>" class="donut-amount">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            </html>
    <?php
        }
    ?>

    </section>
    <input type="submit" value="Save in shopping cart" class="submit-button" name="submit-all">
                </form>

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
    include 'Donut.php';

    $donutprijzen = array();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach($donutsall as $donut) {
                $username = $_SESSION["username"];

                $iddonut = $donut['iddonut'];
    
                $sql = "SELECT donutnaam FROM donut WHERE iddonut = '$iddonut'";
                $stmt = $pdo->query($sql);
                $donuts = $stmt->fetchAll();
    
                $amount = $_POST['numberOfDonuts' . $donut['iddonut']];
                $amount = (int)$amount;

                if(isset($_POST['donut-buy' . $donut['iddonut']])) {
                    $amount++;
                  }
                
                $d = new Donut($donut['donutnaam'], $amount);
                array_push($donutprijzen, $d);
            }
            $_SESSION['donutprijzen'] = $donutprijzen;
            $_SESSION['bestelling'] = true;
        }
?>