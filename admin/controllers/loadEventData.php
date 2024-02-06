<?php
include '../models/event.php';
$e = new Event();
$result = $e->getAllEvent();
echo json_encode($result); // Echo the data as JSON
?>
