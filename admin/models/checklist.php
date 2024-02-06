<?php
class Checklist {
    public function getAllChecklist() {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM equipment");
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

    public function getChecklistByEventId($eventId) {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM equipment WHERE eventId = :eventId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':eventId' => $eventId));

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

    
    public function getChecklistByChecklistId($checklistId) {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM equipment WHERE id = :checklistId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':checklistId' => $checklistId));

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


    public function inputChecklist($name, $description, $unit, $quantity, $vendor, $class, $inchargeId, $eventId) {
        include '../../sys/config.php';

        $query = "INSERT INTO equipment (name, description, unit, quantity, vendor, class, inchargeId, eventId) VALUES (:name, :description, :unit, :quantity, :vendor, :class, :inchargeId, :eventId)";
        $db = $conn->prepare($query);
        $db->bindParam(':name', $name);
        $db->bindParam(':description', $description);
        $db->bindParam(':unit', $unit);
        $db->bindParam(':quantity', $quantity);
        $db->bindParam(':vendor', $vendor);
        $db->bindParam(':class', $class);
        $db->bindParam(':inchargeId', $inchargeId);
        $db->bindParam(':eventId', $eventId);

        $db->execute();
        $conn = null;
        return true;
    }

    public function deleteChecklist($checklistId) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM equipment WHERE id= :checklistId");
        $db->bindParam(':checklistId', $checklistId);
        $db->execute();
        $conn = null;
        return true;
    }

    public function updateChecklist($description, $quantity, $vendor, $id) {
        include '../../sys/config.php';
        
        $db = $conn->prepare("UPDATE equipment SET description= :description, quantity= :quantity, vendor= :vendor WHERE id = :id");
        $db->bindParam(':description',$description);
        $db->bindParam(':quantity', $quantity);
        $db->bindParam(':vendor', $vendor);
        $db->bindParam(':id', $id);

        $db->execute();
        $conn = null;
        return true;
    }
}
?>
