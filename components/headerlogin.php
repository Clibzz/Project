<?php
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
    print_r($_SESSION);
}
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<header>
    <div class="headertext">
        <form method="post">
            <a class="nodec" href="homepage.php"><label class="button pointer nobackground hlabel"><b>NHL WEBSHOP</b></label></a>
            <input class="search" type="text" name="zoeken" placeholder="Zoeken">
            <a href="cart.php"><span class="material-icons pl-6 pr-6 verticalmid">shopping_cart</span></a>
            <button class="buttonsmall nobackground noborder white bold font-2 pointer" type="submit" name="logout">Logout</button>
        </form>
    </div>
</header>