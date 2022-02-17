<?php 
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: index.php?message");
}
if (isset($_POST['addproduct'])) {
    header("Location: addProduct.php");
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
        <div class="row">
            <h2 class="pt-4"><b>Select one of the following categories<br></b></h2>
            <p class="pt-1"><a class="blue pointer" href="productpage.php">Phones</a> - Computers - Components - Smart Watches - Smart Home<br><br></p>
        </div>

        <?php 
        

        if ($role_id == 1) {?>
            <div class="flex">
               <h1 class="mt-4 pl-4">Found products</h1>
               <form method="post">
                    <input class="button pointer white noborder backblue mt-6 ml-0 mb-2 mr-4" type="submit" name="addproduct" value="Add Product">
                </form>
            </div><?php
        } else { ?>
            <div class="flex row">
                <h1 class="mt-4 mb-2 ml-0">Found products</h1>
            </div><?php
        }?>

        <div class="row">
            <div class="flex">
                <div class="box border flex ml-0 center block mb-2 mr-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
                <div class="box border flex ml-0 center block mb-2 mr-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
                <div class="box border flex ml-0 center block mb-2 mr-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
                <div class="box border flex ml-0 center block mb-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
            </div>
            <div class="flex">
                <div class="box border flex ml-0 center block mb-2 mr-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
                <div class="box border flex ml-0 center block mb-2 mr-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
                <div class="box border flex ml-0 center block mb-2 mr-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
                <div class="box border flex ml-0 center block mb-2">
                    <img src="images/iphone13smallmed.png" alt="iPhone13">
                    <p><b>&euro;25,99</b></p>
                </div>
            </div>       
        </div>
    </body>
</html>
