<?php
session_start();
include '../models/checklist.php';
$c = new Checklist();
$eventId = $_SESSION['event']['id'];
$result = $c->getChecklistByEventId($eventId);
echo json_encode($result); // Echo the data as JSON
?>
