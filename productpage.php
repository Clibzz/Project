<?php 
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])){
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
        <div class="row flex">
            <div class="box border left ml-4 mt-8">
                <img src="images/iphone13.png" alt="iPhone 13">
                <h2>iPhone 13</h2>
            </div>
        </div>
    </body>
</html>


