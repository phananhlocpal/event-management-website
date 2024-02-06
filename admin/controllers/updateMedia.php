<?php
include '../models/media.php';
$m = new Media();

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['end'])) {
    $m->updateMedia($_POST['id'], $_POST['name'], $_POST['description'], $_POST['end']);
}
?>