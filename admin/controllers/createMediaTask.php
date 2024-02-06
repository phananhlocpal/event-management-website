<?php
session_start();
include '../models/mediaTask.php';
$mediaModelTask = new MediaTask();
$mediaId = $_SESSION['media']['id'];

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $title = $_POST['title'];
    $time = $_POST['time'];
    $incharge = $_POST['incharge'];
    echo $date;
    if ($mediaModelTask->checkExist($date)) {
        $mediaDetailId = $mediaModelTask->getMediaDetailIdByDate($date);
        $mediaModelTask->inputMediaTaskDetail($title, $time, $incharge, $mediaDetailId);
    } else {
        $mediaModelTask->inputMediaTask($date, $mediaId);
        $mediaDetailId = $mediaModelTask->getMediaDetailIdByDate($date);
        echo "<script>alert($mediaDetailId)</script>";
        $mediaModelTask->inputMediaTaskDetail($title, $time, $incharge, $mediaDetailId );
    }
    echo "Sucess";
}

?>
