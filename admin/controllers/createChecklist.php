<?php
session_start();
include '../models/checklist.php';
$checklistModel = new Checklist();

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['unit']) && isset($_POST['quantity']) && isset($_POST['vendor']) && isset($_POST['class']) && isset($_POST['inchargeID'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? ''; 
    $unit = $_POST['unit'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $vendor = $_POST['vendor'] ?? '';
    $class = $_POST['class'] ?? '';
    $inchargeID = $_POST['inchargeID'] ?? '';
    $eventId = $_SESSION['event']['id'];
    
    $checklistModel->inputChecklist($name, $description, $unit, $quantity, $vendor, $class, $inchargeID, $eventId);
    echo "Input success!";
} else {
    echo "<script>alert('That bai');</script>";
}
?>
