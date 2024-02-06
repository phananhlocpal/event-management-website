<?php
include '../models/task.php';
$t = new Task();

if (isset($_POST['id'])) {
    $t->deleteTask($_POST['id']);
}
?>