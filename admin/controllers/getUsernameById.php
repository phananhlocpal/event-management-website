<?php
// Kết nối vào cơ sở dữ liệu
include '../../sys/config.php';

// Lấy inchargeID từ tham số truy vấn
$inchargeID = $_POST['id'];

// Thực hiện truy vấn để lấy thông tin người phụ trách dựa trên inchargeID
$query = "SELECT username FROM user WHERE id = :id"; // Thay đổi tên bảng và tên trường tương ứng
$db = $conn->prepare($query);
$db->bindParam(':id', $inchargeID, PDO::PARAM_INT);
$db->execute();

// Lấy thông tin người phụ trách
$inchargeInfo = $db->fetch(PDO::FETCH_ASSOC);

// Trả về thông tin dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($inchargeInfo);
?>
