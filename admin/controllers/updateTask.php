<?php
include '../models/task.php';
$taskModel = new Task();

if (isset($_POST['taskName']) && isset($_POST['start']) && isset($_POST['duration'])) {
    $taskName = $_POST['taskName'] ?? '';
    $start = $_POST['start'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $taskId = $_POST['id'] ?? ''; // Assuming you're sending the taskId from your JavaScript function
    
    // Update the task with the provided data
    $result = $taskModel->updateTask($taskId, $taskName, $start, $duration);
    echo $taskId;
} else {
    echo "Missing required data.";
}
?>
