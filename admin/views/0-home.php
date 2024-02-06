
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if ($_SESSION===[]) {
    header("location: 0-login.php");
} 
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PClub Home</title>
    <link rel="stylesheet" href="public/css/home.css" type ="text/css" media = "screen">
    <link rel="stylesheet" href="public/css/frame.css" type ="text/css" media = "screen">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" type="image/png" href="public/img/logo/2.png"/>
</head>

<body>
    <section class="main-body">
        <?php
            include 'layout/navBar.php';
            include 'layout/userOptionBlock.php';
        ?>
        <!------------------------------------ Body ------------------------------------------------->
        <section class="body-container">
            <?php
                include 'layout/header.php';
            ?>
            <!------------------------------Body Content------------------------------------------------>
            <section class="body-content" style="margin: 0; padding: 0;">
                <div class="banner">
                    <img src="public/img/banner/banner.png" alt="">
                </div>
                <p style="font-size: 2rem; font-weight: 900; margin: 2rem;">Dashboard</p>
                <div class="dashboard">
                    <div class="dashboard-detail">
                        <div class="icon-box">
                            <i class='bx bx-task'></i>
                        </div>
                        <div class="dashboard-information">
                            <p>Not-done tasks in this week</p>
                            <p class="number">
                                <?php
                                    // Kết nối tới CSDL
                                    include '../../sys/config.php';
                                    
                                    // Lấy ID của nhân sự từ session
                                    $userId = $_SESSION['user']['id'];
                                    
                                    // Truy vấn để đếm số lượng task có trạng thái = 0 cho nhân sự có ID tương ứng
                                    $query = "SELECT COUNT(*) as taskCount FROM task WHERE inchargeID = :userId AND status = 0";
                                    $db = $conn->prepare($query);
                                    $db->bindParam(':userId', $userId);
                                    $db->execute();
                                    
                                    $result = $db->fetch(PDO::FETCH_ASSOC);
                                    $taskCount = $result['taskCount'];
                                    
                                    // Trả về số lượng task
                                    echo $taskCount;
                                ?>
                            </p>
                            <a href="">More Detail</a>
                        </div>
                    </div>
                    <div class="dashboard-detail">
                        <div class="icon-box">
                            <i class='bx bxs-calendar-event'></i>
                        </div>
                        <div class="dashboard-information">
                            <p>Events in this week</p>
                            <p class="number">
                                <?php
                                // Kết nối tới CSDL
                                include '../../sys/config.php';

                                // Lấy ngày hiện tại
                                $currentDate = date('Y-m-d');

                                // Tính ngày cuối cùng của tuần hiện tại
                                $lastDayOfWeek = date('Y-m-d', strtotime('this week +6 days'));

                                // Truy vấn để đếm số lượng event kết thúc trong tuần hiện tại
                                $query = "SELECT COUNT(*) as eventCount FROM event WHERE end BETWEEN :currentDate AND :lastDayOfWeek";
                                $db = $conn->prepare($query);
                                $db->bindParam(':currentDate', $currentDate);
                                $db->bindParam(':lastDayOfWeek', $lastDayOfWeek);
                                $db->execute();

                                $result = $db->fetch(PDO::FETCH_ASSOC);
                                $eventCount = $result['eventCount'];

                                // Trả về số lượng event
                                echo $eventCount;
                                ?>
                            </p>
                            <a href="">More Detail</a>
                        </div>
                    </div>
                    <div class="dashboard-detail">
                        <div class="icon-box">
                            <i class='bx bx-message-dots'></i>
                        </div>
                        <div class="dashboard-information">
                            <p>Not-done Media Tasks in this week</p>
                            <p class="number">
                                <?php
                                include '../../sys/config.php';

                                // Lấy ID của người dùng từ session
                                $inchargeTaskId = $_SESSION['user']['id'];

                                // Chuẩn bị câu truy vấn SQL
                                $query = "SELECT COUNT(*) AS taskCount FROM mediadetail_task WHERE inchargeTaskId = :inchargeTaskId AND status = 0";

                                // Chuẩn bị và thực thi câu truy vấn
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':inchargeTaskId', $inchargeTaskId, PDO::PARAM_INT);
                                $stmt->execute();

                                // Lấy kết quả
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $taskCount = $result['taskCount'];

                                // In ra số lượng task
                                echo $taskCount;
                                ?>

                            </p>
                            <a href="">More Detail</a>
                        </div>
                    </div>
                </div>

            </section>
        </section>
    </section>
    <!---------------------------------Footer------------------------------------------------>
    <?php
        include 'layout/footer.php';
    ?>
</body>
</html>