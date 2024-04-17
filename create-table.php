<?php
    include "koneksi.php";

    $sql1 = "CREATE TABLE IF NOT EXISTS user_login (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(50) NOT NULL,
        lname VARCHAR(50) NOT NULL,
        email VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL 
    )";

    $sql2 = "CREATE TABLE IF NOT EXISTS contact_us (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(50) NOT NULL,
        lname VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        message VARCHAR(255) NOT NULL
    )";

    // login check 
    if ($conn->query($sql1) === TRUE){
        echo "mantap";
    } else {
        echo "table 'user_login' gagal dibuat" .$conn->error;
    }

    if ($conn->query($sql2) === TRUE){
        echo "mantap";
    } else {
        echo "table 'user_login' gagal dibuat" .$conn->error;
    }

?>