<?php
    include_once("connection.php");
    session_start();
    if(isset($_GET['message'])){
        $message = "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please login before using the webshop.</div>";
        echo $message;
    }
    if (isset($_POST['login'])){ 
        if (isset($_POST['username']) && !empty($_POST['username'])){
            if (isset($_POST['password']) && !empty($_POST['password'])){
                if ($username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                    if ($password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                        $stmt = mysqli_prepare($conn, "
                            SELECT *
                            FROM user
                            WHERE username = ?
                        ") or die(mysqli_error($conn));
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                        mysqli_stmt_store_result($stmt) or die(mysqli_error($conn));
                        mysqli_stmt_bind_result($stmt, $user_id, $role_id, $email, $username, $hash_password, $birthdate);
                        mysqli_stmt_fetch($stmt);
                        if(mysqli_stmt_num_rows($stmt) > 0){
                            mysqli_stmt_close($stmt);
                            if(password_verify($password, $hash_password)){
                                $_SESSION['user_id'] = $user_id;
                                $_SESSION['role_id'] = $role_id;
                                $_SESSION['email'] = $email;
                                $_SESSION['username'] = $username;
                                $_SESSION['password'] = $password;
                                $_SESSION['birthdate'] = $birthdate;
                                header ("Location: homepage.php");
                            } else {
                                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>The username or password is incorrect, please try again.</div>";
                            }
                        } else {
                            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>The username or password is incorrect, please try again.</div>";
                        }
                    } else {
                        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>The username or password is incorrect, please try again.</div>";
                    }
                } else {
                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>The username or password is incorrect, please try again.</div>";
                }
            } else {
                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a password.</div>";
            }
        } else {
            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a username.</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            NHL Webshop - Login
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/header.html"); ?>
    </head>
    <body>
        <div class="loginbox border mt-10">
            <h2 class="pt-2">Login</h2>
            <form method="post">
                <p class="pt-5">Username<br></p>
                <input class="inputlogin" type="text" name="username">
                <p class="pt-5">Password<br></p>
                <input class="inputlogin" type="password" name="password">
                <input class="buttonsmall noborder backblue white mb-1 mt-1 textcenter pointer" type="submit" name="login" value="Login">
                <a class="black nodec font-1 pointer" href="register.php">Register</a>
            </form>
        </div>
    </body>
</html>
