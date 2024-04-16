<?php
    include "koneksi.php";

    $sql = "CREATE TABLE IF NOT EXISTS user_login (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(50) NOT NULL,
        lname VARCHAR(50) NOT NULL,
        email VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL 
    )";

    // login check 
    if ($conn->query($sql) === TRUE){
        echo "mantap";
    } else {
        echo "table 'user_login' gagal dibuat" .$conn->error;
    }
?>