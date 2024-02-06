<?php
session_start();

include '../models/mediaTask.php';
$t = new MediaTask();
$result = $t->getAllMediaTask();
echo json_encode($result); // Echo the data as JSON

?>
