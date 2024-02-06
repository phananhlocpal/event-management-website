<?php
include '../models/hrmap.php';
$h = new HRMap();

if (isset($_POST['id'])) {
    $h->deleteHRMap($_POST['id']);
}
?>