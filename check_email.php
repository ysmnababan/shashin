<?php
    include_once 'koneksi.php';

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])){
        $email = $_POST['email'];
        
        $query = "SELECT * FROM user_login WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0){
            echo "exists"; // email already exists
        } else {
            echo "available"; // email is available
        }
    }
?>