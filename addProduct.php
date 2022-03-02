<?php 
include_once("connection.php");
session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: index.php?message");
}

if (isset($_POST['addproduct'])){
    if (!empty($_POST['title'])) {
        if (!empty($_POST['description'])){
            if (!empty($_POST['category'])){
                if (!empty($_POST['price'])) {
                    if ($title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                        if ($description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                            if ($category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                                $price = str_replace(",",".",$_POST["price"]);
                                if ($price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)) {
                                    if (!empty($_FILES['uploaded_file'])){
                                        $path = "./images/";
                                        $path = $path . basename( $_FILES['uploaded_file']['name']);
                                        $fileTypes = ["image/png", "image/jpeg", "image/jpg"];
                                        $uploadedFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['uploaded_file']['tmp_name']);
                                        if (in_array($uploadedFileType, $fileTypes)){
                                            if ($_FILES['uploaded_file']['size'] < 3000001) {
                                                if (file_exists("images/" . $_FILES['uploaded_file']['name'])){ 
                                                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>There already exists a file with that name, please try again.</div>";
                                                } else {
                                                    move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path);
                                                    echo "<div class='alert-success bold pt-1 pb-1 pl-1'>The file ". basename ($_FILES['uploaded_file']['name']). " has been uploaded.</div>";
                                                    $stmt = mysqli_prepare($conn, "
                                                                        INSERT
                                                                        INTO product (
                                                                            product_id,
                                                                            title,
                                                                            description,
                                                                            category,
                                                                            price,
                                                                            image
                                                                        )
                                                                        VALUES (
                                                                            ?,
                                                                            ?,
                                                                            ?,
                                                                            ?,
                                                                            ?,
                                                                            ?
                                                                        )
                                                                    ") OR DIE(mysqli_error($conn));
                            
                                                                    mysqli_stmt_bind_param($stmt, 'isssss', $product_id, $title, $description, $category, $price, $_FILES['uploaded_file']['name']);
                                                                    if (mysqli_stmt_execute($stmt)){
                                                                        mysqli_stmt_close($stmt);
                                                                    }
                                                }
                                            } else {
                                                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>The size of the file is too big, please select a file that's below 5MB.</div>";
                                            }
                                        } else {
                                            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>The file is not the right type, you can only upload PNG, JPEG, JPG or GIF files.</div>";
                                        }
                                    } else {
                                        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please select a file to continue.</div>";
                                    }
                                } else {
                                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a valid price.</div>";
                                }
                            } else {
                                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a valid category.</div>";
                            }
                        } else {
                            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a valid description.</div>";
                        } 
                    } else {
                        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a valid title.</div>";
                    }
                } else {
                    echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a price.</div>";
                }
            } else {
                echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a category.</div>";
            }
        } else {
            echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a description.</div>";
        }
    } else {
        echo "<div class='alert-danger bold pt-1 pb-1 pl-1'>Please fill in a title.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            NHL Webshop
        </title>
        <link rel="stylesheet" href="style.css">
        <?php include_once("components/headerlogin.php"); ?>
    </head>
    <body>
        <div class="row">
            <h1 class="mt-4 mb-2">Add Product</h1>
            <form enctype="multipart/form-data" method="post">
                <p class="pt-2">Title<br></p>
                <input class="inputlogin" type="text" name="title" value=<?php //echo $title ?>>
                <p class="pt-2">Description<br></p>
                <input class="inputlogin" type="text" name="description" value=<?php //echo $description ?>>
                <p class="pt-2">Category<br></p>
                <input class="inputlogin" type="text" name="category" value=<?php //echo $category ?>>
                <p class="pt-2">Price<br></p>
                <input class="inputlogin" type="text" name="price" value=<?php //echo $price ?>>
                <p class="pt-2 mb-1">Image<br></p>
                <input class="inputlogin" type="file" name="uploaded_file" value=<?php //echo $image ?>>
                <button class="nodec mt-2 mb-2 backblue noborder button pointer center white" name="addproduct">Add Product</button>
            </form>
        </div>