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

    </body>
</html>