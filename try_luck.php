<?php
include "koneksi.php";

session_start();
if (isset($_SESSION['fname'])) {
    // echo $_SESSION['fname'];
    // echo $_SESSION['lname'];
    echo "<script> console.log('here');</script>";
    header("Location: try_luck_logged.php");
    // echo "<script>alert('new session started');</script>";
    // session_unset();
} else {
    // echo "<script> alert('Please Log In First')</script>";
    // header("Location: login.php");

    echo '<h1 id="message"></h1>
    <script>
        // Display a message before redirecting
        document.getElementById("message").innerHTML = "Please login to access the page.";

        // Redirect to the login page after a delay
        setTimeout(function() {
            window.location.href = "login.php";
        }, 1000); // 3000 milliseconds = 3 seconds
    </script>';
}
?>
