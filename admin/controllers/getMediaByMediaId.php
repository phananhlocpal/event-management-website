<?php
include '../models/media.php';
$m = new Media();
if (isset($_GET['mediaId'])) {
    $result = $m->getMediaByMediaId($_GET['mediaId']);
    $result = json_encode($result); 
    echo $result;// Echo the data as JSON
}
?>
