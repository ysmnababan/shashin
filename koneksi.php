<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shashin";


    // making connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // checking connection
    if ($conn->connect_error){
        die("Connection error" .$conn->connect_error);
    }
    // echo "Connection established.";
?>