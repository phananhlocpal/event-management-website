<?php
include '../models/event.php';
$e = new Event();
if (isset($_GET['eventId'])) {
    $result = $e->getEventByEventId($_GET['eventId']);
    $result = json_encode($result); 
    echo $result;// Echo the data as JSON
}
?>
