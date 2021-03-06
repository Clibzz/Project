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
            NHL Webshop - Home
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/header.php"); ?>
    </head>
    <body>
        <div class="w60">
            <h2 class="mt-4 font-2"><b>Select one of the following categories</b></h2>
            <form method="post" class="pt-2 font-2">
                <input type="submit" class="blue pointer nobackground ml-0 pl-0 noborder font-2" value="Phones" name="phones"> - <input type="submit" class="blue pointer nobackground noborder font-2" value="Computers" name="computers" > - <input type="submit" class="blue pointer nobackground noborder font-2" value="Components" name="components"> - <input type="submit" class="blue pointer nobackground noborder font-2" value="Smart Watches" name="smartwatches"> - <input type="submit" class="blue pointer nobackground noborder font-2 mb-3" value="Smart Home" name="smarthome">
            </form>
        </div>
        <?php 
        if ($role_id == 1) {?>
            <div class="flex w60">
               <h1 class="mt-4 ml-0 pl-0">Found products</h1>
               <form class="mr-0" method="post">
                    <input class="button pointer white noborder borderrad backblue mt-6 mb-2 mr-1 pr-0" type="submit" name="addproduct" value="Add Product">
                </form>
            </div><?php
        } else { ?>
            <div class="flex w60">
                <h1 class="mt-4 mb-2 ml-0">Found products</h1>
            </div><?php
        }
        if (isset($_POST['phones'])){
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
                    WHERE category = 'phones'
            ") or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
            if (mysqli_stmt_num_rows($stmt) > 0) { 
            ?>  <div class="w60"><?php
                    while (mysqli_stmt_fetch($stmt)) { ?>
                        <a href="productpage.php?id=<?php echo $product_id?>">
                            <div class="border ml-0 mb-2 mr-1 pt-1 pb-1 pl-1 pr-1 left">
                                <img class="imagehome" src="images/<?php echo $image ?>" alt="<?php echo $title ?>">
                                <p class="black borderridge textcenter"><b>&euro;<?php echo $price ?></b></p>
                            </div>
                        </a>
                        <?php
                    }?>
                </div><?php
            } else {
                echo "<div class='w60 mt-2 alert-danger bold pt-1 pb-1'>&nbsp;0 results</div>";
            }
        } elseif (isset($_POST['computers'])){
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
                    WHERE category = 'computers'
            ") or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
            if (mysqli_stmt_num_rows($stmt) > 0) { 
            ?>  <div class="w60"><?php
                    while (mysqli_stmt_fetch($stmt)) { ?>
                        <a href="productpage.php?id=<?php echo $product_id?>">
                            <div class="border ml-0 mb-2 mr-1 pt-1 pb-1 pl-1 pr-1 left">
                                <img class="imagehome" src="images/<?php echo $image ?>" alt="<?php echo $title ?>">
                                <p class="black borderridge textcenter"><b>&euro;<?php echo $price ?></b></p>
                            </div>
                        </a>
                        <?php
                    }?>
                </div><?php
            } else {
                echo "<div class='w60 mt-2 alert-danger bold pt-1 pb-1'>&nbsp;0 results</div>";
            }
        } elseif (isset($_POST['components'])){
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
                    WHERE category = 'components'
            ") or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
            if (mysqli_stmt_num_rows($stmt) > 0) { 
            ?>  <div class="w60"><?php
                    while (mysqli_stmt_fetch($stmt)) { ?>
                        <a href="productpage.php?id=<?php echo $product_id?>">
                            <div class="border ml-0 mb-2 mr-1 pt-1 pb-1 pl-1 pr-1 left">
                                <img class="imagehome" src="images/<?php echo $image ?>" alt="<?php echo $title ?>">
                                <p class="black borderridge textcenter"><b>&euro;<?php echo $price ?></b></p>
                            </div>
                        </a>
                        <?php
                    }?>
                </div><?php
            } else {
                echo "<div class='w60 mt-2 alert-danger bold pt-1 pb-1'>&nbsp;0 results</div>";
            }
        } elseif (isset($_POST['smartwatches'])){
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
                    WHERE category = 'smartwatches'
            ") or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
            if (mysqli_stmt_num_rows($stmt) > 0) { 
            ?>  <div class="w60"><?php
                    while (mysqli_stmt_fetch($stmt)) { ?>
                        <a href="productpage.php?id=<?php echo $product_id?>">
                            <div class="border ml-0 mb-2 mr-1 pt-1 pb-1 pl-1 pr-1 left">
                                <img class="imagehome" src="images/<?php echo $image ?>" alt="<?php echo $title ?>">
                                <p class="black borderridge textcenter"><b>&euro;<?php echo $price ?></b></p>
                            </div>
                        </a>
                        <?php
                    }?>
                </div><?php
            } else {
                echo "<div class='w60 mt-2 alert-danger bold pt-1 pb-1'>&nbsp;0 results</div>";
            }
        } elseif (isset($_POST['smarthome'])){
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
                    WHERE category = 'smarthome'
            ") or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
            if (mysqli_stmt_num_rows($stmt) > 0) { 
            ?>  <div class="w60"><?php
                    while (mysqli_stmt_fetch($stmt)) { 
                        ?>
                        <a href="productpage.php?id=<?php echo $product_id?>">
                            <div class="border ml-0 mb-2 mr-1 pt-1 pb-1 pl-1 pr-1 left">
                                <img class="imagehome" src="images/<?php echo $image ?>" alt="<?php echo $title ?>">
                                <p class="black borderridge textcenter"><b>&euro;<?php echo $price ?></b></p>
                            </div>
                        </a>
                        <?php
                    }?>
                </div><?php
            } else {
                echo "<div class='w60 mt-2 alert-danger bold pt-1 pb-1'>&nbsp;0 results</div>";
            }
        } else {
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
            ") or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image, $agelimit);
            if (mysqli_stmt_num_rows($stmt) > 0) { 
                ?> <div class="w60"><?php
                    while (mysqli_stmt_fetch($stmt)) { 
                        ?>  
                        <a href="productpage.php?id=<?php echo $product_id?>">
                            <div class="border ml-0 mb-2 mr-1 pt-1 pb-1 pl-1 pr-1 left">
                                <img class="imagehome" src="images/<?php echo $image ?>" alt="<?php echo $title ?>">
                                <p class="black borderridge textcenter"><b>&euro;<?php echo $price ?></b></p>
                            </div>
                        </a>
                        <?php
                    }?>
                </div><?php
            } else {
                echo "<div class='w60 mt-2 alert-danger bold pt-1 pb-1'>&nbsp;0 results</div>";
            }
        }
        ?>
    </body>
</html>
