<?php
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?message");
}

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
if (isset($_POST['addtocart'])) {
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
        <?php
        if (isset($_POST['addtocart'])) {
            echo "<div class='alert-success bold pt-1 pb-1 pl-1'>The product has been succesfully added to the cart, 
                click <a class='green' href='cart.php'> here</a> to go to the cart.</div>";
        }
        $product_id = $_GET['id'];
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
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt="Iphone 13">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt="Iphone 13">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt="Iphone 13">
            <img class="w20 borderridge" src="images/<?php echo $image ?>" alt="Iphone 13">
        </div>
    </body>
</html>