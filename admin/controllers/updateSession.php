<?php
session_start();
include '../models/user.php';
$u = new User();
$user = $u->getUserByUserId($_POST['id']);
$_SESSION['user']['id'] = $user['id'];
$_SESSION['user']['username'] = $user['username'];
$_SESSION['user']['name'] = $user['name'];
$_SESSION['user']['ava'] = $user['ava'];
$_SESSION['user']['phone'] = $user['phone'];
$_SESSION['user']['email'] = $user['email'];
$_SESSION['user']['role'] = $user['role'];

?>