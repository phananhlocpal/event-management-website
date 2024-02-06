<?php
class Event {

    public function getAllEvent() {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM event");
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

    public function getEventByEventId($eventId) {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM event WHERE id = :eventId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':eventId' => $eventId));

        $result = $db->fetch();

        // Đóng kết nối cơ sở dữ liệu
        $conn = null;

        // Kiểm tra và trả về dữ liệu người dùng
        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }


    public function inputEvent($name, $description, $start, $end, $inchargeID, $location) {
        include '../../sys/config.php';

        $query = "INSERT INTO event (name,description,start,end,inchargeID,location) VALUES (:eventname, :description, :start_date, :end_date, :hostID, :location)";
        $db = $conn->prepare($query);
        $db->bindParam(':eventname', $name);
        $db->bindParam(':description', $description);
        $db->bindParam(':start_date', $start);
        $db->bindParam(':end_date', $end);
        $db->bindParam(':hostID', $inchargeID);
        $db->bindParam(':location', $location);

        $db->execute();
        $conn = null;
        return true;
    }

    public function deleteEvent($eventId) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM event WHERE id= :eventId");
        $db->bindParam(':eventId', $eventId);
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
