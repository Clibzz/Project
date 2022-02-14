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
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<header class="w100">
    <div class="headertext">
        <form method="post">
            <a class="nodec pointer white" href="homepage.php"><label class="button pointer nobackground hlabel"><b>NHL WEBSHOP</b></label></a>
            <input class="search mr-3" type="text" name="zoeken" placeholder="Zoeken">
            <?php
            if ($role_id == 1) {
                ?><a class="pointer white" href="addInternUser.php"><span class="material-icons verticalmid ml-2 mr-2">manage_accounts</span></a>
                <a class="pointer white" href="cart.php"><span class="material-icons ml-2 mr-2 verticalmid">shopping_cart</span></a>
                <button class="buttonsmall nobackground noborder white bold font-2 pointer ml-4" type="submit" name="logout">Logout</button><?php
            } else {
                ?><a class="pointer white" href="cart.php"><span class="material-icons ml-8 mr-8 verticalmid">shopping_cart</span></a>
                <button class="buttonsmall nobackground noborder white bold font-2 pointer" type="submit" name="logout">Logout</button><?php
            } ?>
            
        </form>
    </div>
</header>
