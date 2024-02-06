<?php
class MediaTask {
    public function getAllMediaTask() {
        include '../../sys/config.php';

        $mediaId = $_SESSION['media']['id'];
        
        $query = "
            SELECT md.date, mt.title, mt.time, u.username AS incharge
            FROM media_detail md
            INNER JOIN mediadetail_task mt ON md.id = mt.mediaDetailId
            INNER JOIN user u ON mt.inchargeTaskId = u.id
            WHERE md.mediaId = :mediaId
        ";
        
        $db = $conn->prepare($query);
        $db->bindParam(':mediaId', $mediaId, PDO::PARAM_INT);
        $db->execute();
        
        $eventsArr = [];
        while ($row = $db->fetch(PDO::FETCH_ASSOC)) {
            $eventDate = strtotime($row['date']);
            $event = [
                'day' => (int)date('d', $eventDate),   // Chuyển thành kiểu số nguyên
                'month' => (int)date('m', $eventDate), // Chuyển thành kiểu số nguyên
                'year' => (int)date('Y', $eventDate), 
                'events' => [
                    [
                        'title' => $row['title'],
                        'time' => $row['time'],
                        'incharge' => $row['incharge']
                    ]
                ]
            ];
            
            $eventsArr[] = $event; 
        }
    
        $conn = null;
        if ($eventsArr !== false) {
            return $eventsArr;
        } else {
            return null;
        }
    }

    public function getMediaTaskByDate($date) {
        include '../../sys/config.php';

        // Chuẩn bị câu truy vấn
        $db = $conn->prepare("SELECT * FROM media WHERE date = :date");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':date' => $date));

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

    public function getMediaDetailIdByDate($date) {
        include '../../sys/config.php';
    
        try {
            // Chuẩn bị câu truy vấn
            $db = $conn->prepare("SELECT id FROM media_detail WHERE date = :date");
            $db->setFetchMode(PDO::FETCH_ASSOC);
            $db->execute(array(':date' => $date));
    
            $result = $db->fetch();
    
            // Đóng kết nối cơ sở dữ liệu
            $conn = null;
    
            // Kiểm tra và trả về dữ liệu người dùng
            if ($result !== false) {
                return $result['id']; // Sửa tại đây để lấy cột id trong $result
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    


    public function inputMediaTask($date, $mediaId) {
        include '../../sys/config.php';
        $query = "INSERT INTO media_detail (date, mediaId) VALUES (:date, :mediaId)";
        $db = $conn->prepare($query);
        $db->bindParam(':date', $date);
        $db->bindParam(':mediaId', $mediaId);

        $db->execute();
        $conn = null;
        return true;
    }

    public function inputMediaTaskDetail($title, $time, $incharge, $mediaDetailId ) {
        include '../../sys/config.php';
        echo $mediaDetailId;
        echo "Xin chào";
        $query = "INSERT INTO mediadetail_task (title, time, inchargeTaskId, mediaDetailId) VALUES (:title, :time, :inchargeTaskId, :mediaDetailId)";
        $db = $conn->prepare($query);
        $db->bindParam(':title', $title);
        $db->bindParam(':time', $time);
        $db->bindParam(':inchargeTaskId', $incharge);
        $db->bindParam(':mediaDetailId', $mediaDetailId);

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

    public function checkExist($date) {
        include '../../sys/config.php';
        
        $query = "
            SELECT COUNT(*) AS count
            FROM media_detail
            WHERE date = :date
        ";
        
        $db = $conn->prepare($query);
        $db->bindParam(':date', $date, PDO::PARAM_STR);
        $db->execute();
        
        $row = $db->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];
        $conn = null;
        return $count > 0;
    }
    
}
?>


from head import *

from collections import defaultdict

def dijkstra(edges, strat_node, end_node):

    g = defaultdict(list) 

    for start, end, weight in edges: 

        g[start].append((weight, end)) 

    q, visited = [(0, strat_node,())], set()

    while q:        

        (cost,v1,path) = heappop(q)

        if v1 not in visited:

            visited.add(v1)

            path = (v1, path)            

            if v1 == end_node:

                return (cost, path)

            for c, v2 in g.get(v1, ()):

                if v2 not in visited:

                    heappush(q, (cost+c, v2, path))

        print (q)   

    return float(“inf”)

if __name__ == “__main__”:

    

    edges = [

        (“A”, “B”, 7),

        (“A”, “D”, 5),

        (“B”, “C”, 8),

        (“B”, “D”, 9),

        (“B”, “E”, 7),

        (“C”, “E”, 5),

        (“D”, “E”, 7),

        (“D”, “F”, 6),

        (“E”, “F”, 8),

        (“E”, “G”, 9),

        (“F”, “G”, 11)

    ]

    

    print (“=== Dijkstra ===”)

    print (“A >> G:”)

    print (dijkstra(edges, “A”, “G”))

 === Dijkstra ===