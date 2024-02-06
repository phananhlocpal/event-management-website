<?php
include '../models/hrmap.php';
$h = new HRMap();
$result = $h->getHRMapByEventId();
echo json_encode($result); // Echo the data as JSON
?>
