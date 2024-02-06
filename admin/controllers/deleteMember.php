<?php
include '../models/user.php';
$u = new User();

if (isset($_POST['id'])) {
    $u->deleteUser($_POST['id']);
}
?>