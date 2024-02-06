<?php
include '../models/event.php';
$e = new Event();

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['end']) && isset($_POST['location']) ) {
    $e->updateEvent($_POST['id'], $_POST['name'], $_POST['description'], $_POST['end'],$_POST['location']);
}
?>