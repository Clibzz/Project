<?php
    session_start();
    include_once("connection.php"); 

    if (!isset($_SESSION['user_id'])){
        header("Location: index.php?message");
    }
    
    if (isset($_POST['overview'])) {
        header("Location: overview.php");
    }
   
    
    if (isset($_POST['delete'])) {
        if ($cart_id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT)) { 
            $delstmt = mysqli_prepare($conn, "
                    DELETE 
                    FROM    cart
                    WHERE   cart_id = ?
            ") or die(mysqli_error($conn));
            mysqli_stmt_bind_param($delstmt, "i", $cart_id);
            mysqli_stmt_execute($delstmt) or die(mysqli_error($conn));
            mysqli_stmt_close($delstmt); 
        } 
    }
    
    if (isset($_POST['update'])) {
        if ($amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT)){
            if ($cart_id = filter_input(INPUT_POST, 'cart_id', FILTER_SANITIZE_NUMBER_INT)) {
                $stmt = mysqli_prepare($conn, "
                        UPDATE cart
                        SET amount = ?
                        WHERE cart_id = ?                                
                ") or die(mysqli_error($conn));
                mysqli_stmt_bind_param($stmt, 'ii', $amount, $cart_id);
                mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                mysqli_stmt_close($stmt);     
            }
        } else {
            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in the amount field.</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            NHL Webshop
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/headerlogin.php"); ?>
    </head>
    <body>
        <?php
        if ($role_id == 2) {?>
            <div class="flex w60 mb-0 mt-4 mb-2">
                <h1 class="left ml-0">Your cart</h1>
                <a class="right mr-0" href="overview.php"><input class="button pointer white noborder backblue" type="submit" name="overview" value="Order Overview"></a>
            </div><?php
        } else { ?>
            <div class="flex w60 mb-0 mt-4 mb-2">
                <h1 class="left ml-0">Your cart</h1>
            </div><?php
        } ?>
        <form method="post">
            <table class="w60 borderridge">
                <thead class="backblue white">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM product
                    ") or die(mysqli_error($conn));
                    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $product_id, $title, $description, $category, $price, $image);
                    mysqli_stmt_close($stmt);
                    $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM cart
                    WHERE user_id = ?
                    ") or die(mysqli_error($conn));
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $cart_id, $user_id, $image, $title, $amount, $price);
                    if (mysqli_stmt_num_rows($stmt) > 0) { 
                        while (mysqli_stmt_fetch($stmt)) { ?>
                            <tr class="center backgray">
                                <form method="post">
                                    <input type="hidden" name="cart_id" value=<?php echo $cart_id ?>>
                                    <input type="hidden" name="user_id" value=<?php echo $user_id ?>>
                                    <td class="w20 h30"><img class="w30 h20" src="images/<?php echo $image ?>"></td>
                                    <td><a class="black nodec center" href="productpage.php?id=<?php echo $product_id ?>"><?php echo $title ?></a></td>
                                    <td><input class="center buttonsmall" type="text" name="amount" value="<?php echo $amount ?>"></td>
                                    <td><?php echo "&euro;&nbsp;" . $price * $amount?></td>
                                    <td><button class="pointer backblue noborder buttonsmall white" type="submit" name="update">Update</button></td>
                                    <td><button class="pointer backblue white noborder buttonsmall" type="submit" name="delete" value=<?php echo $cart_id ?> class="pointer backblue noborder buttonsmall white">Delete</button></td>
                                </form>
                            </tr><?php
                        }
                    } else {
                        echo "<div class='alert-danger bold pt-1 pb-1 w60'>Your cart doesn't contain any products, please add some products to your shopping cart.</div>";
                        mysqli_stmt_close($stmt);
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </body>
</html>




