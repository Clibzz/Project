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
    <div class="w60 flex">
        <form method="post">
            <a class="nodec pointer white mr-3" href="homepage.php"><label class="button pointer nobackground hlabel"><b>NHL WEBSHOP</b></label></a>
            <input class="search mr-5" type="text" name="zoeken" placeholder="Zoeken">
        </form>
            <?php
            if ($role_id == 1) {?>
                <a class="pointer white" href="userList.php"><span class="material-icons verticalmid ml-3 mr-3">manage_accounts</span></a>
                <a class="pointer white" href="cart.php"><span class="material-icons ml-3 mr-3 verticalmid">shopping_cart</span></a>
                <form method="post">
                    <button class="buttonsmall nobackground noborder white bold font-2 pointer ml-3" type="submit" name="logout">Logout</button>
                </form>
            <?php
            } else {
            ?>
                <a class="pointer white" href="cart.php"><span class="material-icons ml-8 mr-8 verticalmid">shopping_cart</span></a>
                <form method="post">
                    <button class="buttonsmall nobackground noborder white bold font-2 pointer" type="submit" name="logout">Logout</button>
                </form>
            <?php
            }
            ?>

        </form>
    </div>
</header>