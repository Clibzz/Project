<?php
    include_once("connection.php");
    if (isset($_POST['login'])){ 
        if (isset($_POST['username']) && !empty($_POST['username'])){
            if (isset($_POST['password']) && !empty($_POST['password'])){
                if ($username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                    if ($password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                        $stmt = mysqli_prepare($conn, "
                            SELECT user_id,
                                   username,
                                   hash_password
                            FROM user
                            WHERE username = ?
                        ") or die(mysqli_error($conn));
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                        mysqli_stmt_store_result($stmt) or die(mysqli_error($conn));
                        mysqli_stmt_bind_result($stmt, $user_id, $username, $hash_password);
                        mysqli_stmt_fetch($stmt);
                        if(mysqli_stmt_num_rows($stmt) > 0){
                            mysqli_stmt_close($stmt);
                            if(password_verify($password, $hash_password)){
                                $_SESSION["loggedIn"] = true;
                                $_SESSION["user_id"] = $userId;
                                $_SESSION['auth_id'] = $authId;
                                header("Location: homepage.php");
                            }
                        } else {
                            echo "<div class='alert-danger bold'>The username or password is incorrect, please try again.</div>";
                        }
                    } else {
                        echo "<div class='alert-danger bold'>The username or password is incorrect, please try again.</div>";
                    }
                } else {
                    echo "<div class='alert-danger bold'>The username or password is incorrect, please try again.</div>";
                }
            } else {
                echo "<div class='alert-danger bold'>Please fill in a password.</div>";
            }
        } else {
            echo "<div class='alert-danger bold'>Please fill in a username.</div>";
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
        <?php include_once("components/header.html"); ?>
    </head>
    <body>
        <div class="loginbox mt-10">
            <h2>Login</h2>
            <form method="post">
                <p>Username<br></p>
                <input class="inputlogin" type="text" name="username">
                <p>Password<br></p>
                <input class="inputlogin" type="password" name="password">
                <input class="buttonsmall noborder backblue white mb-1 mt-1 center pointer" type="submit" name="login" value="Login">
                <a class="black nodec font-1" href="register.php">Register</a>
            </form>
        </div>
    </body>
</html>
