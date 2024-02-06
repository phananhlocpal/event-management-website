<?php

include '../models/user.php';
$userModel = new User();

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['role'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? ''; 
    $phone = $_POST['phone'] ?? '';
    $role = $_POST['role'] ?? '';

    $userModel->inputUser($name, $email, $phone, $role);
    echo "Input success!";
} else {
    echo "<script>alert('That bai');</script>";
}
?>
