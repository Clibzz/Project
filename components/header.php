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
<header class="backblue">
    <div class="flex pt-2 w60">
        <a class="white font-3 bold ml-0 nodec" href="homepage.php">NHL WEBSHOP</a>
        <form method="get">
            <input class="search" placeholder="Search" type="text" name="search">
        </form>
            <?php
            if ($role_id == 1) {?>
                <a href="userList.php"><span class="material-icons white verticalmid">manage_accounts</span></a>
                <a href="cart.php"><span class="material-icons white verticalmid">shopping_cart</span></a>
                <form class="mr-0" method="post">
                    <button name="logout" class="pointer white noborder nobackground font-3 bold">Logout</button>
                </form>
            <?php
            } else {
            ?>
                <span class="material-icons white verticalmid">shopping_cart</span>
                <form class="mr-0" method="post">
                    <button name="logout" class="pointer white noborder nobackground font-3 bold">Logout</button>
                </form>
            <?php
            }
            ?>
        </form>
    </div>
</header>