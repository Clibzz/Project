<?php
    $servername = "localhost";
    $username = "root";
    $database = "nhlwebshop";
    $password = "";

    //Creating a connection
    $conn = new mysqli($servername, $username, $password,$database);

    //Checking the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // echo "Connected successfully";
    }
    ?>