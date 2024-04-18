<?php
include "koneksi.php";
session_start();

// Retrieve the data sent from JavaScript
$product_type   = $_POST['product_type'];
$brand          = $_POST['brand'];
$spec          = $_POST['spec'];
$price          = $_POST['price'];
$rating          = $_POST['rating'];
$img          = $_POST['img'];
$daycount       = $_POST['daycount'];
$rentdate          = $_POST['rentdate'];
$id             = $_SESSION['id'];

$sql = "INSERT INTO `user_transaction`(`product_type`, `brand`, `spec`, `price`, 
`rating`, `img`, `daycount`, `rentdate`, `user_id`) 
VALUES 
('$product_type',
'$brand','$spec','$price',
'$rating','$img','$daycount',
'$rentdate','$id')";

// echo $cameras[$id]->price;
echo ($sql);
// echo '<script>console.log('. $sql . ')</script>';
// echo '<script>console.log(document.getElementById("valueInput").value)</script>';

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
