<?php
include '../models/mediaTaskDetail.php';
$m = new MediaTaskDetail();

if (isset($_POST['mediaTaskDetailId'])) {
    $m->deleteMediaTaskDetail($_POST['mediaTaskDetailId']);
}
?>