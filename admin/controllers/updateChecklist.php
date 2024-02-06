<?php
include '../models/checklist.php';
$c = new Checklist();

if (isset($_POST['id'])  && isset($_POST['quantity']) && isset($_POST['vendor'])) {
    $c->updateChecklist($_POST['description'], $_POST['quantity'], $_POST['vendor'], $_POST['id']);
}
?>