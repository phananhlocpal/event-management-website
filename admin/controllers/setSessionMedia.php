<?php
session_start();
include '../models/media.php';
$m = new Media();

if(isset($_POST['mediaId'])) {
    $result = $m->getMediaByMediaId($_POST['mediaId']);

    $_SESSION['media']['id'] = $_POST['mediaId'];
    $_SESSION['media']['name'] = $result['name'];
    $_SESSION['media']['start'] = $result['start'];
    $_SESSION['media']['end'] = $result['end'];
    echo "Session set";
} else {
    echo "Error: Event ID not provided";
}

?>
