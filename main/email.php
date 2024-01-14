<?php
include_once '../include/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @font-face {
            font-family: Carnero;
            src: url(http://localhost/Donut-Website/Fonts/carnero/CarneroBlack.otf);
        }

        @font-face {
            font-family: Carnero-thin;
            src: url(http://localhost/Donut-Website/Fonts/carnero/CarneroRegular.otf);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url{""};
        }

        .background-image {
            width: 50%;
            left: 25;
            right: 25;
            height: 100vh;
            object-fit: cover;
            position: absolute;
            z-index: -1;
        }

        .emailpage {
            width: 50%;
            height: 100vh;
            margin: 0 auto;
        }

        .thmess {
            font-family: Carnero;
            text-align: right;
            font-size: 32px;
            margin-right: 10px;
        }

        .thmesscontainer {
            width: 100%;
            height: 20%;
        }

        .orderinfo {
            margin-left: 10px;
        }

    </style>
</head>
<body>
    <div class="emailpage">
        <img class="background-image" src="https://i.imgur.com/sLWTRFj.jpg">
        <div class="thmesscontainer">
            <h1 class="thmess">Thank you for you purchase!</h1>
        </div>
        <div class="orderinfocontainer">
            <?php 
                
            ?>
        </div>
        

</div>
</body>
</html>