<?php
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?message");
}
if ($_SESSION['role_id'] !== 1) {
    header("Location: error.php");
}
if (isset($_GET['success'])) {
    echo "<div class='alert-success bold pt-1 pb-1 pl-1'>Your edits have been saved succesfully.</div>";
}
if (isset($_GET['deleted'])) {
    echo "<div class='alert-success bold pt-1 pb-1 pl-1'>The account has succesfully been deleted.</div>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            NHL Webshop - User List
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/header.php"); ?>
    </head>
    <body>
        <h1 class="w60 mt-4 mb-2">Users</h1>
        <table class="table w60">
            <thead class="backblue white">
                <tr>
                    <th>User_id</th>
                    <th>Role_id</th>
                    <th>Email address</th>
                    <th>Username</th>
                    <th>Birthdate</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = mysqli_prepare($conn, "
                        SELECT *
                        FROM user
                ") or die(mysqli_error($conn));
                mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $user_id, $role_id, $email, $username, $password, $birthdate);
                if (mysqli_stmt_num_rows($stmt) > 0) { 
                    while (mysqli_stmt_fetch($stmt)) { ?>
                        <tr class="textcenter backgray">
                            <td class="backblue white bold"><input class="backblue textcenter white fontnormal noborder" name="user_id" type="text" value="<?php echo $user_id ?>" readonly></td>
                            <td><?php echo $role_id ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $birthdate ?></td>
                            <td><a class="linkblue nodec" href="userEdit.php?id=<?php echo $user_id; ?>">Edit</a></td>
                        </tr><?php
                    }
                } else {
                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>0 results</div>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>