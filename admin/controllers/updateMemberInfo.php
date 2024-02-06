<?php
include '../models/user.php';
$u = new User();

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['username']) && isset($_POST['password'])) {
    $u->updateUserInfo( $_POST['name'], $_POST['email'], $_POST['phone'],$_POST['username'], $_POST['password'], $_POST['id']);
}
?>