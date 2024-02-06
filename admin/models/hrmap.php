<?php
session_start();
class HRMap {

    public function getAllHRMap() {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM hrmap");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute();

        $result = $db->fetchAll();

        // Đóng kết nối cơ sở dữ liệu
        $conn = null;

        // Kiểm tra và trả về dữ liệu người dùng
        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }

    public function getHRMapByEventId() {
        include '../../sys/config.php';
        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM hrmap WHERE eventId = :eventId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':eventId' => $_SESSION['event']['id']));

        $result = $db->fetchAll();

        // Đóng kết nối cơ sở dữ liệu
        $conn = null;

        // Kiểm tra và trả về dữ liệu người dùng
        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }

    public function inputHRMap($title, $link, $eventId) {
        include '../../sys/config.php';

        $query = "INSERT INTO hrmap (title,link,eventId) VALUES (:title, :link, :eventId)";
        $db = $conn->prepare($query);
        $db->bindParam(':title', $title);
        $db->bindParam(':link', $link);
        $db->bindParam(':eventId', $eventId);

        $db->execute();
        $conn = null;
        return true;
    }

    public function deleteHRMap($id) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM hrmap WHERE id= :id");
        $db->bindParam(':id', $id);
        $db->execute();
        $conn = null;
        return true;
    }

    public function updateEvent($eventId, $eventName, $eventDescription, $eventEnd, $eventLocation) {
        include '../../sys/config.php';
        
        $db = $conn->prepare("UPDATE event SET name= :name, description= :description, end= :end, location= :location WHERE id= :id");
        $db->bindParam(':id',$eventId);
        $db->bindParam(':name', $eventName);
        $db->bindParam(':description', $eventDescription);
        $db->bindParam(':end', $eventEnd);
        $db->bindParam(':location', $eventLocation);

        $db->execute();
        $conn = null;
        return true;
    }
}
?>
