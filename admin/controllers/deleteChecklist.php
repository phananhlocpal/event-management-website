<?php
include '../models/checklist.php';
$c = new Checklist();

if (isset($_POST['id'])) {
    $c->deleteChecklist($_POST['id']);
}
?>