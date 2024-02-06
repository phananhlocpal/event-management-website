<?php
session_start();
include '../models/task.php';
$taskModel = new Task();

if (isset($_POST['taskName']) && isset($_POST['start']) && isset($_POST['duration'])) {
    $taskName = $_POST['taskName'] ?? '';
    $start = $_POST['start'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $eventId = $_SESSION['event']['id'];
    $parentTaskId =  $_POST['parentTaskId'];
    $lastInsertId = $taskModel->inputChildTask($taskName, $start, $duration, $eventId, $parentTaskId);
    echo $lastInsertId;;
} else {
    echo "<script>alert('That bai');</script>";
}
?>
