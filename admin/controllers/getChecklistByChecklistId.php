<?php
include '../models/checklist.php';
$c = new Checklist();
if (isset($_POST['checklistId'])) {
    $result = $c->getChecklistByChecklistId($_POST['checklistId']);
    $result = json_encode($result); 
    echo $result;// Echo the data as JSON
}
?>
