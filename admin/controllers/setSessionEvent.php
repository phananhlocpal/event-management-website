<?php
session_start();
include '../models/event.php';
$e = new Event();

if(isset($_POST['eventId'])) {
    $result = $e->getEventByEventId($_POST['eventId']);

    $_SESSION['event']['id'] = $_POST['eventId'];
    $_SESSION['event']['name'] = $result['name'];
    $_SESSION['event']['location'] = $result['location'];
    $_SESSION['event']['start'] = $result['start'];
    $_SESSION['event']['end'] = $result['end'];

    include '../../sys/config.php';
    $inchargeID = $result['inchargeID'];

    // Thực hiện truy vấn để lấy thông tin người phụ trách dựa trên inchargeID
    $query = "SELECT name FROM user WHERE id = :id"; // Thay đổi tên bảng và tên trường tương ứng
    $db = $conn->prepare($query);
    $db->bindParam(':id', $inchargeID, PDO::PARAM_INT);
    $db->execute();

    $inchargeInfo = $db->fetch(PDO::FETCH_ASSOC);
    
    $conn = null;
    // Gán giá trị vào $_SESSION
    $_SESSION['event']['host'] = $inchargeInfo['name'];
    echo "Session set";

} else {
    echo "Error: Event ID not provided";
}
?>
