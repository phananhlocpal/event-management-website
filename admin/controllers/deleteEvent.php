<?php
include '../models/event.php';
$e = new Event();

if (isset($_POST['id'])) {
    $e->deleteEvent($_POST['id']);
}
?>