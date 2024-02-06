<?php
session_start();
include '../models/media.php';
$m = new Media();
$result = $m->getMediaInformation($_SESSION['media']['id']);
$result = json_encode($result); 
echo $result;// Echo the data as JSON
?>
