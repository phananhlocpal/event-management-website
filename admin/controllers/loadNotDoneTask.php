<?php

?>

<?php
session_start();
$userId = $_SESSION['user']['id'];
include '../models/task.php';
$t = new Task();
$result = $t->getNotDoneTask($userId);
echo json_encode($result); // Echo the data as JSON
?>
