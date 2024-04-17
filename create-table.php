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

    $sql3 = "CREATE TABLE IF NOT EXISTS user_profile (
        profile_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50),
        address VARCHAR(255),
        address2 VARCHAR(255),
        country VARCHAR(50),
        state VARCHAR(50),
        zipcode VARCHAR(10),
        payment VARCHAR(5),
        namecard VARCHAR(50),
        cc_no VARCHAR(50),
        cc_exp VARCHAR(5),
        cvv VARCHAR(3),
        voucher VARCHAR(3),
        balance INT,
        user_id INT UNIQUE NOT NULL,
        CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES user_login(id)
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

    if ($conn->query($sql3) === TRUE){
        echo "mantap";
    } else {
        echo "table 'user_login' gagal dibuat" .$conn->error;
    }

?>