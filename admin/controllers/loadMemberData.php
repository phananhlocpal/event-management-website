<?php
include '../models/user.php';
$u = new User();
$result = $u->getAllUser();
echo json_encode($result); // Echo the data as JSON
?>
