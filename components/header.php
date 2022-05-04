<?php
include_once("connection.php");
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
    print_r($_SESSION);
}

$stmt = mysqli_prepare($conn, "
    SELECT *
    FROM user
    WHERE user_id = ?
") or die(mysqli_error($conn));
$role_id = $_SESSION['role_id'];
$user_id = $_SESSION['user_id'];
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<header class="backblue flex">
    <form class="w60" method="post">
        <a class="mr-10 white bold nodec font-3" href="homepage.php"><b>NHL WEBSHOP</b></a>
        <input class="ml-10 pr-6 search" type="text" name="search" placeholder="Search">
        <?php
        if ($role_id == 1) {?>
            <button class="right ml-5 backblue noborder white bold font-3 pointer mt-1 mb-1" type="submit" name="logout">Logout</button>
            <a class="right" href="cart.php"><span class="material-icons white mr-5 ml-5 mt-1 mb-1">shopping_cart</span></a>
            <a class="right" href="userList.php"><span class="material-icons white mr-5 mt-1 mb-1">manage_accounts</span></a>
            
        <?php
        } else {
        ?>
            <button class="right ml-10 backblue noborder white bold font-3 pointer mt-1 mb-1" type="submit" name="logout">Logout</button>
            <a class="right" href="cart.php"><span class="material-icons white mr-10 mt-1 mb-1">shopping_cart</span></a>
        <?php
        }
        ?>
    </form>
</header>