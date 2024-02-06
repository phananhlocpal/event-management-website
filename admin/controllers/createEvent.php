<?php

include '../models/event.php';
$eventModel = new Event();

if (isset($_POST['name']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['inchargeID']) && isset($_POST['location'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? ''; 
    $start = $_POST['start'] ?? '';
    $end = $_POST['end'] ?? '';
    $host = $_POST['inchargeID'] ?? '';
    $place = $_POST['location'] ?? '';
    
    $eventModel->inputEvent($name, $description, $start, $end, $host, $place);
    echo "Input success!";
} else {
    echo "<script>alert('That bai');</script>";
}
?>
