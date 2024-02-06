<?php
include '../models/user.php';
$u = new User();
if (isset($_GET['memberId'])) {
    $result = $u->getUserByUserId($_GET['memberId']);
    $result = json_encode($result); 
    echo $result;// Echo the data as JSON
}
?>
