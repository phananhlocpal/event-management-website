<?php
session_start();
class MediaTaskDetail {
    // public function getAllMediaTaskDetail() {
    //     include '../../sys/config.php';

    //     $sql = "SELECT id, title, time, inchargeTaskId FROM mediadetail_task WHERE mediaDetailId = :mediaDetailId";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':eventId', $eventId);
    //     $stmt->execute();

    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     $ganttData = array("data" => array(), "links" => array());

    //     if (count($result) > 0) {
    //         foreach ($result as $row) {

    //             $task = array(
    //                 "id" => $row["id"],
    //                 "text" => $row["taskName"],
    //                 "start_date" => $row["start"],
    //                 "duration" => $row["duration"],
    //                 "progress" => $row["progress"],
    //                 "parent" => $row["parentTaskId"]
    //             );
    //             array_push($ganttData["data"], $task);
    //         }
    //     }

    //     header('Content-Type: application/json');
    //     echo json_encode($ganttData);
    // }

    public function getMediaTaskDetailByMediaDetailId($mediaDetailId) {
        include '../../sys/config.php';
        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM task WHERE eventId = :eventId");
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


    public function inputFolderTask($taskName, $start, $duration, $eventId) {
        include '../../sys/config.php';
        echo "<script>alert($start);</script>";
        $query = "INSERT INTO task (taskName, start, duration, eventId) VALUES (:taskName, :start, :duration, :eventId)";
        $db = $conn->prepare($query);
        $db->bindParam(':taskName', $taskName);
        $db->bindParam(':start', $start);
        $db->bindParam(':duration', $duration);
        $db->bindParam(':eventId', $eventId);

        $db->execute();
        $conn = null;
        return true;
    }

    public function inputChildTask($taskName, $start, $duration, $eventId, $parentTaskId) {
        include '../../sys/config.php';
        if ($parentTaskId == null) {
            $query = "INSERT INTO task (taskName, start, duration, eventId) VALUES (:taskName, :start, :duration, :eventId)";
            $db = $conn->prepare($query);
            $db->bindParam(':taskName', $taskName);
            $db->bindParam(':start', $start);
            $db->bindParam(':duration', $duration);
            $db->bindParam(':eventId', $eventId);
        } else {
            $query = "INSERT INTO task (taskName, start, duration, eventId, parentTaskId) VALUES (:taskName, :start, :duration, :eventId, :parentTaskId)";
            $db = $conn->prepare($query);
            $db->bindParam(':taskName', $taskName);
            $db->bindParam(':start', $start);
            $db->bindParam(':duration', $duration);
            $db->bindParam(':eventId', $eventId);
            $db->bindParam(':parentTaskId', $parentTaskId);
        }

        $db->execute();
        $conn = null;
        return true;
    }

    public function deleteTask($taskId) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM task WHERE id= :taskId");
        $db->bindParam(':taskId', $taskId);
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
