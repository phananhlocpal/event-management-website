<?php

include '../models/hrmap.php';
$HRMapModel = new HRMap();

if (isset($_POST['title']) && isset($_POST['link'])) {
    $title = $_POST['title'] ?? '';
    $link = $_POST['link'] ?? ''; 
    echo $link;
    $HRMapModel->inputHRMap($title, $link, $_SESSION['event']['id']);
    echo "Input success!";
} else {
    echo "<script>alert('That bai');</script>";
}
?>
