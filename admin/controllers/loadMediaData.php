<?php
include '../models/media.php';
$m = new Media();
$result = $m->getAllMedia();
echo json_encode($result); // Echo the data as JSON
?>
