<?php
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?message");
}

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
if (isset($_POST['addtocart'])) {
    //Select everything from the product
    $stmt = mysqli_prepare($conn, "
            SELECT *
            FROM product
            WHERE product_id = ?
    ") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    //Select everything from user to be able to check their age
    $stmt = mysqli_prepare($conn, "
            SELECT *
            FROM user
            WHERE user_id = ".$_SESSION['user_id']."
    ") or die(mysqli_error($conn));
    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $role_id, $email, $username, $hash_password, $birthdate);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    //Split the birthdate in year, month and day
    list($year, $month, $day) = explode("-", $birthdate);
    //Calculate the amount of seconds from January 1st 1970 00:00:00 GMT (mktime) to the birthdate of the user
    $seconds = mktime(0, 0, 0, $month, $day, $year);
    //Substracting the amount of seconds of $seconds from the amount of seconds from mktime till now
    $diff = time() - $seconds;
    //Divide the birthdate in seconds by a year in seconds + (1 day / 1 year) so people whose birthday is today can also buy the product
    $age = $diff / 31556926 + 0.0027397260273973;
    if ($age > 18 ) {
        //Select everything from cart with the same product_id
        $stmt = mysqli_prepare($conn, "
                SELECT *
                FROM cart
                WHERE product_id = ?
        ") or die(mysqli_error($conn));
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $cart_id, $user_id, $product_id, $image, $title, $amount, $price);
        mysqli_stmt_fetch($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);
            //Update the amount of the product in cart if the product already exists there
            $stmt = mysqli_prepare($conn, "
                UPDATE cart
                SET amount = amount + 1
                WHERE product_id = ?
            ") or die(mysqli_error($conn));
            mysqli_stmt_bind_param($stmt, 'i', $product_id);
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_close($stmt);
            
        } else {
            mysqli_stmt_close($stmt);
            //If the product doesn't exist in the cart, add a new row for it
            $stmt = mysqli_prepare($conn, "
                    INSERT
                    INTO cart (
                        cart_id,
                        user_id,
                        product_id,
                        image,
                        title,
                        amount,
                        price
                    )
                    VALUES
                    (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        1,
                        ?
                    )
            ") or die(mysqli_error($conn));
            mysqli_stmt_bind_param($stmt, "iiissd", $cart_id, $user_id, $product_id, $image, $title, $price);
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt) or die(mysqli_error($conn));
            mysqli_stmt_close($stmt);
        }
        echo "<div class='alert-success bold pt-1 pb-1 pl-1'>The product has been succesfully added to the cart.</div>";
    } else {
        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>You're too young to be able to buy this product.</div>";
    }   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            NHL Webshop - Product
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/header.php"); ?>
    </head>
    <body>
        <?php
        $product_id = $_GET['id'];
        //Select all necessary entities of the specific product
        $stmt = mysqli_prepare($conn, "
                SELECT *
                FROM product
                WHERE product_id = ?
        ") or die(mysqli_error($conn));
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        ?>
        <div class="w60 flex">
            <div class="flex ml-0 textcenter block mb-2 mr-2">
                <img class="imagehome mt-5" src="images/<?php echo $image ?>" alt="Product">
            </div>
            <div>
                <h1 class="mt-5 mb-1"><?php echo $title ?></h1>
                <h2>&euro;&nbsp;<?php echo $price ?></h2>
                <p class="mt-3 mb-3"><?php echo $description ?></p>
                <form method="post">
                    <input class="backblue pointer button white bold noborder" name="addtocart" type="submit" value="Buy">
                </form>
            </div>
        </div>
        <div class="w60 flex mt-8">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt=". <?php echo $title ?> .">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt=". <?php echo $title ?> .">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt=". <?php echo $title ?> .">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt=". <?php echo $title ?> .">
        </div>
    </body>
</html>