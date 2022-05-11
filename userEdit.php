<?php 
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?message");
}
if ($_SESSION['role_id'] !== 1) {
    header("Location: error.php");
}
if (isset($_POST['update'])) {
    if ($user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT)){
        if ($role_id = filter_input(INPUT_POST, 'role_id', FILTER_SANITIZE_NUMBER_INT)) {
            if ($email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) {
                if ($username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                    if ($birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                        $birthdate = new DateTime($_POST['birthdate']);
                        $birthdate = $birthdate -> format("Y-m-d");
                        list($y, $m, $d) = explode("-", $birthdate);
                        $curdate = date("Y-m-d");
                        list($cur_y, $cur_m, $cur_d) = explode("-", $curdate);
                        if ($birthdate <= $curdate) {
                            $stmt = mysqli_prepare($conn, "
                                    UPDATE user
                                    SET role_id = ?,
                                        email = ?,
                                        username = ?,
                                        birthdate = ?
                                    WHERE user_id = ?                                   
                            ") or die(mysqli_error($conn));
                            mysqli_stmt_bind_param($stmt, 'isssi', $role_id, $email, $username, $birthdate, $user_id);
                            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                            mysqli_stmt_close($stmt);
                            header("Location: userList.php?success");
                        } else {
                            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a valid birthdate.</div>";
                        }
                    } else {
                        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in the birthdate field.</div>";
                    }
                } else {
                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in the username field.</div>";
                }
            } else {
                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in the email address field.</div>";
            }
        } else {
            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please refrain from using special characters in the role_id field.</div>";
        }
    } 
}
if (isset($_POST['delete'])) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $stmt = mysqli_prepare($conn, "
            SELECT *
            FROM user
            WHERE user_id = ?
    ") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $role_id, $email, $username, $password, $birthdate);
    mysqli_stmt_num_rows($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $delstmt = mysqli_prepare($conn, "
            DELETE 
            FROM user
            WHERE user_id = ?
    ") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($delstmt, "i", $user_id);
    mysqli_stmt_execute($delstmt);
    mysqli_stmt_close($delstmt);
    Header("Location: userList.php?deleted");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            NHL Webshop - User Edit
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/header.php"); ?>
    </head>
    <body>
        <?php
            $user_id = $_GET['id'];
            $stmt = mysqli_prepare($conn, "
                    SELECT *
                    FROM user
                    WHERE user_id = ?
            ") or die(mysqli_error($conn));
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $user_id, $role_id, $email, $username, $password, $birthdate);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        ?> 
        <div class="flex">
            <h1 class="mt-4 w60">User Edit</h1>  
        </div>
        <div class="w60">
            <form method="post">
                <p class="pt-2">User_id<br></p>
                <input class="inputlogin" type="text" name="user_id" value=<?php echo $user_id ?> readonly>
                <p class="pt-2">Role_id<br></p>
                <input class="inputlogin" type="text" name="role_id" value=<?php echo $role_id ?>>
                <p class="pt-2">Email address<br></p>
                <input class="inputlogin" type="email" name="email" value=<?php echo $email ?>>
                <p class="pt-2">Username<br></p>
                <input class="inputlogin" type="text" name="username" value=<?php echo $username ?>>
                <p class="pt-2">Birthdate<br></p>
                <input class="inputlogin" type="date" name="birthdate" max="9999-12-31" value=<?php echo $birthdate ?>>
                <button class="nodec mt-2 mb-2 backblue noborder button pointer textcenter white" name="update">Update</button>
                <button class="nodec mt-2 mb-2 backred noborder button pointer textcenter white" name="delete">Delete</button>
            </form>
        </div>
    </body>
