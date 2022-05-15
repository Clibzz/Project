<?php
include_once("connection.php");
$accountCreated = false;
if (isset($_POST['register'])){
    if ($email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
        if ($username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            if ($password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                $birthdate = new DateTime($_POST['birthdate']);
                $birthdate = $birthdate -> format("Y-m-d");
                list($y, $m, $d) = explode("-", $birthdate);
                $curdate = date("Y-m-d");
                list($cur_y, $cur_m, $cur_d) = explode("-", $curdate);
                if ($birthdate <= $curdate) {
                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
            
                    $stmt = mysqli_prepare($conn, "
                            SELECT username
                            FROM user
                            WHERE username = ?
                    ") or die(mysqli_error($conn));
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                    mysqli_stmt_store_result($stmt) or die(mysqli_error($conn));
                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        mysqli_stmt_close($stmt);

                        $stmt = mysqli_prepare($conn, "
                                SELECT email
                                FROM user
                                WHERE email = ?
                        ") or die(mysqli_error($conn));
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                        mysqli_stmt_store_result($stmt) or die(mysqli_error($conn));
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            mysqli_stmt_close($stmt);
                            $stmt = mysqli_prepare($conn, "
                                    INSERT
                                    INTO user (
                                        user_id,
                                        email,
                                        username,
                                        hash_password,
                                        birthdate
                                    )
                                    VALUES
                                    (
                                        ?,
                                        ?,
                                        ?,
                                        ?,
                                        ?
                                    )
                            ") or die(mysqli_error($conn));
                            mysqli_stmt_bind_param($stmt, "issss", $user_id, $email, $username, $hash_password, $birthdate);
                            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                            mysqli_stmt_store_result($stmt) or die(mysqli_error($conn));
                            mysqli_stmt_close($stmt);
                            ?><div class="alert-success bold pt-1 pb-1 pl-1 nodec">Your account has been registered succesfully!</div><?php
                            $accountCreated = true;
                        } else {
                            echo "<div class='alert-danger bold'>This email address has already been taken, please try again.</div>";
                        }
                    } else {
                        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>This username has already been taken, please try again.</div>";
                    }
                } else {
                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>This birthdate is invalid, please try again.</div>";
                }
            } else {
                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in your password.</div>";
            }
        } else {
            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in your username.</div>";
        } 
    } else {
        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in your email address.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            NHL Webshop - Register
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/header.html"); ?>
    </head>
    <body>
        <?php if($accountCreated == true) {
            echo "<a href='index.php'><div class='backgray bold pt-1 pb-1 pl-1 black pointer'>Go back to the login page</div></a>";
        } ?>
        <div class="loginbox mt-10 h65">
            <h2 class="pt-2">Register</h2>
            <form method="post" action="register.php">
                <p class="pt-5">Email address<br></p>
                <input class="inputlogin" type="email" name="email">
                <p class="pt-5">Username<br></p>
                <input class="inputlogin" type="text" name="username">
                <p class="pt-5">Password<br></p>
                <input class="inputlogin" type="password" name="password">
                <p class="pt-5">Birthdate<br></p>
                <input class="inputlogin" type="date" name="birthdate" max="9999-12-31">
                <input class="nodec mt-2 mb-2 backblue noborder button pointer textcenter white" type="submit" name="register" value="Register">
                <a class="black nodec font-1 pointer" href="index.php">Back to login</a>
            </form>
        </div>
    </body>
</html>
