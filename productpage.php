<?php
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?message");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        NHL Webshop
    </title>
    <link rel="stylesheet" href="style.css">
    <?php include_once("components/headerlogin.php"); ?>
</head>

<body>
    <div class="w60 flex">
        <div class="flex ml-0 center block mb-2 mr-2">
            <img src="images/iphone13.png" alt="iPhone 13">
            <h2 class="flex m-auto">iPhone 13</h2>
        </div>
        <div>
            <h1>Iphone 13</h1>
            <h2>&euro;69,69</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse non quam id velit rutrum congue sit amet non mauris. Aliquam vitae metus orci. Sed blandit ullamcorper vestibulum. Proin quis bibendum metus. Ut et elit nisl. Quisque et tempor dui, ut molestie elit. Sed ultrices tellus nisi, sit amet auctor turpis varius non. Donec aliquam metus eu quam tempus feugiat. Vestibulum mollis purus non tincidunt pharetra. Aliquam erat volutpat. Cras finibus ipsum et sem commodo pretium.
             Curabitur nec erat eros. Mauris id velit faucibus, egestas dolor sit amet, auctor orci. Aliquam vulputate, turpis nec maximus facilisis, ante nisi rhoncus ligula, sed sodales leo arcu at quam. Duis nec tortor commodo, elementum ligula at, rhoncus dui.</p>
        </div>
    </div>
    <div class="w60 flex">
        <img src="images/iphone13.png" alt="Iphone 13">
        <img src="images/iphone13.png" alt="Iphone 13">
        <img src="images/iphone13.png" alt="Iphone 13">
        <img src="images/iphone13.png" alt="Iphone 13">
    </div>
</body>

</html>