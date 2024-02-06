<?php
include '../models/media.php';
$m = new Media();

if (isset($_POST['id'])) {
    $m->deleteMedia($_POST['id']);
}
?>