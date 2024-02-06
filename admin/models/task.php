<?php
class Task {
    // public function getAllTask() {
    //     include '../../sys/config.php';

    //     $eventId = $_SESSION['event']['id'];

    //     $sql = "SELECT id, taskName, start, duration, parentTaskId, progress FROM task WHERE eventId = :eventId";
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

    public function getTaskByEventId($eventId) {
        include '../../sys/config.php';
        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM task WHERE eventId = :eventId");
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


        // Lấy ID của task vừa được tạo
        $lastInsertId = $conn->lastInsertId();
        $conn = null;
        return $lastInsertId;
    }

    public function deleteTask($taskId) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM task WHERE id= :taskId");
        $db->bindParam(':taskId', $taskId);
        $db->execute();
        $conn = null;
        return true;
    }

    public function updateTask($taskId, $taskName, $start, $duration) {
        include '../../sys/config.php';
        
        $query = "UPDATE task SET taskName = :taskName, start = :start, duration = :duration WHERE id = :id";
        $db = $conn->prepare($query);
        $db->bindParam(':taskName', $taskName);
        $db->bindParam(':start', $start);
        $db->bindParam(':duration', $duration);
        $db->bindParam(':id', $taskId);
        
        $db->execute();
        $conn = null;
        return true;
    }

    public function addIncharge($inchargeID, $id) {
        include '../../sys/config.php';
        
        $db = $conn->prepare("UPDATE task SET inchargeID= :inchargeID WHERE id= :id");
        $db->bindParam(':id',$id);
        $db->bindParam(':inchargeID', $inchargeID);
        
        $db->execute();
        $conn = null;
        return "Update inchargeTask sucessfully!";

    }

    public function getNotDoneTask($userId) {
        include '../../sys/config.php';

        // Truy vấn danh sách task có status = 0 và inchargeID = user ID
        $query = "SELECT * FROM task WHERE status = 0 AND inchargeID = :userId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $tasks = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $row;
        }

        $conn = null;

        // Kiểm tra và trả về dữ liệu người dùng
        if ($tasks!== false) {
            return $tasks;
        } else {
            return null;
        }
    }
}
?>
