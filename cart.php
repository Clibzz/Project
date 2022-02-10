<?php
include_once("connection.php");
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            NHL Webshop
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/headerlogin.html"); ?>
    </head>
    <body>
        <h1 class="content mt-6 mb-0.5">Your cart</h1>
        <div class="row mb-1 backgray">
                <div class="imgcart flex ml-1.5 pb-1">
                    <img src="images/iphone13.png" alt="iPhone13">
                    <h2>iPhone 13</h2>
                    <p class="amount flex mb-2 ml-1 pr-1 bold">Amount</p>
                    <input class="amount flex ml-1 number mb-2" type="text" name="amount">
                    <label class="mb-3 bold pt-5 ml-10">&euro; &nbsp; <?php echo 32 . "," . 98; ?></label>
                    <label name="cancel" class="red pointer bold pt-2">X</label>
                </div>
            </div>
            <div class="row mb-1 backgray">
                <div class="imgcart flex ml-1.5 pb-1">
                    <img src="images/iphone13.png" alt="iPhone13">
                    <h2>iPhone 13</h2>
                    <p class="amount flex mb-2 ml-1 pr-1 bold">Amount</p>
                    <input class="amount flex ml-1 number mb-2" type="text" name="amount">
                    <label class="mb-3 bold pt-5 ml-10">&euro; &nbsp; <?php echo 32 . "," . 98; ?></label>
                    <label name="cancel" class="red pointer bold pt-2">X</label>
                </div>
            </div>
            <div class="row mb-1 backgray">
                <div class="imgcart flex ml-1.5 pb-1">
                    <img src="images/iphone13.png" alt="iPhone13">
                    <h2>iPhone 13</h2>
                    <p class="amount flex mb-2 ml-1 pr-1 bold">Amount</p>
                    <input class="amount flex ml-1 number mb-2" type="text" name="amount">
                    <label class="mb-3 bold pt-5 ml-10">&euro; &nbsp; <?php echo 32 . "," . 98; ?></label>
                    <label name="cancel" class="red pointer bold pt-2">X</label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="right">
                    <p class="total ml-1 right mb-3 bold">Total &nbsp; &euro; &nbsp; <?php echo 230 . "," . 24; ?></p>
                    <form method="post">
                        <input class="button pointer white noborder backgreen ml-1 right" type="submit" name="checkout" value="Checkout">
                        <input class="button pointer white noborder backblue right" type="submit" name="update" value="Update">
                    </form>
                </div>
            </div>    
    </body>
</html>
    


