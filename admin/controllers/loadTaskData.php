<?php
session_start();
include '../models/task.php';
$t = new Task();
$result = $t->getTaskByEventId($_SESSION['event']['id']);
echo json_encode($result); // Echo the data as JSON
?>
