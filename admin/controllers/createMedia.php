<?php

include '../models/media.php';
$mediaModel = new Media();

if (isset($_POST['name']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['eventHostId']) && isset($_POST['mediaInchargeID'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? ''; 
    $start = $_POST['start'] ?? '';
    $end = $_POST['end'] ?? '';
    $eventHostId = $_POST['eventHostId'] ?? '';
    $mediaInchargeID = $_POST['mediaInchargeID'] ?? '';
    
    $mediaModel->inputMedia($name, $description, $start, $end,  $eventHostId, $mediaInchargeID);
    echo "Input success!";
} else {
    echo "<script>alert('That bai');</script>";
}
?>
