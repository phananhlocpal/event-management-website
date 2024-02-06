<?php
class Media {

    public function getAllMedia() {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM media");
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

    public function getMediaByMediaId($mediaId) {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM media WHERE id = :mediaId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':mediaId' => $mediaId));

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


    public function inputMedia($name, $description, $start, $end, $eventHostId, $mediaInchargeID) {
        include '../../sys/config.php';

        $query = "INSERT INTO media (name,description,start,end,eventHostId,mediaInchargeID) VALUES (:eventname, :description, :start_date, :end_date, :eventHostId, :mediaInchargeID)";
        $db = $conn->prepare($query);
        $db->bindParam(':eventname', $name);
        $db->bindParam(':description', $description);
        $db->bindParam(':start_date', $start);
        $db->bindParam(':end_date', $end);
        $db->bindParam(':eventHostId', $eventHostId);
        $db->bindParam(':mediaInchargeID', $mediaInchargeID);

        $db->execute();
        $conn = null;
        return true;
    }

    public function deleteMedia($mediaId) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM media WHERE id= :mediaId");
        $db->bindParam(':mediaId', $mediaId);
        $db->execute();
        $conn = null;
        return true;
    }

    public function updateMedia($mediaId, $mediaName, $mediaDescription, $mediaEnd) {
        include '../../sys/config.php';
        
        $db = $conn->prepare("UPDATE media SET name= :name, description= :description, end= :end WHERE id= :id");
        $db->bindParam(':id',$mediaId);
        $db->bindParam(':name', $mediaName);
        $db->bindParam(':description', $mediaDescription);
        $db->bindParam(':end', $mediaEnd);
        
        $db->execute();
        $conn = null;
        return true;
    }

    public function getMediaInformation($mediaId) {
        include '../../sys/config.php';
        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM media WHERE id = :mediaId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':mediaId' => $mediaId));

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
}
?>
