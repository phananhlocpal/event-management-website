<?php
include '../models/task.php';
$t = new Task();

if (isset($_POST['incharge'])) {
    $result = $t->addIncharge($_POST['incharge'], $_POST['id']);
    echo $result;
}
?>