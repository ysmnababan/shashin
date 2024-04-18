<?php
include "koneksi.php";
session_start();
// Retrieve the data sent from JavaScript
$new = $_POST['new_voucher'];
$is_define = $_POST['is_define'];
echo $is_define ;
echo "-";
$id = $_SESSION['id'];
if ($is_define == 'inputted') {
    echo $new;
    $sql = "UPDATE user_profile
    SET voucher = '$new'
    WHERE user_id = '$id'";
} else {
    $sql = "INSERT INTO user_profile (voucher, user_id) VALUES
    ('$new', '$id')";
}
echo($sql);
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
