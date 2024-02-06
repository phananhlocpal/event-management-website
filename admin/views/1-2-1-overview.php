<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PClub Home</title>
    <link rel="shortcut icon" type="image/png" href="../public/img/logo/2.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="public/css/frame.css">
    <link rel="stylesheet" href="public/css/event.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php
    session_start();
    if ($_SESSION===[]) {
        header("location: 0-login.php");
    }
?>
<body>
    <section class="main-body">
        <!--Nav-bar-->
        <?php
            include 'layout/navBar.php';
        ?>
        <!--Content Body-->
        <section class="body-container">
            <?php
                include 'layout/header.php';
            ?>  
            <!----------------------Edit page content here----------------------->
            <section class="body-content address">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="0-home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="1-1-list-event.php">List Event</a></li>
                        <li class="breadcrumb-item"><a href="1-2-1-overview.php">
                                <?php echo $_SESSION['event']['name'];?>
                            </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                    </ol>
                </nav>
                <div class="overview-container">
                    <div class="overview-left">
                        <div class="title">
                            <div class="overview-logo">
                                <img src="public/img/logo/2.png" alt="">
                            </div>
                            <div class="detail-title">
                                <p>Master Plan</p>
                                <p id="event-name">
                                    <?php echo $_SESSION['event']['name'];?>
                                </p>
                            </div>
                        </div>
                        <div class="process">
                            <p>Process</p>
                            <div class="process-bar">
                                <?php
                                                               
                                    $eventStart = strval($_SESSION['event']['start']);
                                    $eventEnd = strval($_SESSION['event']['end']);

                                    // Lấy thời điểm hiện tại
                                    $currentDate = strval(date("Y-m-d"));

                                    // Tính số ngày đã trôi qua từ thời điểm start
                                    $daysElapsed = max(0, min((strtotime($currentDate) - strtotime($eventStart)) / (60 * 60 * 24), strtotime($eventEnd) - strtotime($eventStart)) / (60 * 60 * 24));

                                    $totalDays = max(1, (strtotime($eventEnd) - strtotime($eventStart)) / (60 * 60 * 24));

                                    // Tính toán tiến độ dự án
                                    $progressPercentage = round(($daysElapsed / $totalDays) * 100);
                                    echo '<div class="proces-bar-inner" style = "width:'.$progressPercentage.'%"></div>';
                                ?>
                            </div>
                        </div>
                        <div class="percentage">
                            <p>
                                <?php
                                echo $progressPercentage . "%";
                                ?>
                            </p>
                        </div>
                        <p class="overview-title">Overview Information</p>
                        <div class="date">
                            <p>Date</p>
                            <p class="detail">
                                <?php
                                    echo $_SESSION['event']['end'];
                                ?>
                            </p>
                        </div>
                        <div class="location">
                            <p>Location</p>
                            <p class="detail">
                                <?php
                                    echo $_SESSION['event']['location'];
                                ?>
                            </p>
                        </div>
                        <div class="host">
                            <p>Host</p>
                            <p class="detail">
                                <?php
                                    if ($_SESSION['event']['host'] == "") {
                                        echo "None";
                                    } else {
                                        echo $_SESSION['event']['host'];
                                    };
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="overview-right">
                        <p style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">Your not-done</p>
                        <div class="not-done-task">
                            
                        </div>
                    </div>
                </div>
                <?php
                    include 'layout/eventFooter.php';
                ?>
            </section>
        </section>
    </section>
    <?php
        include 'layout/footer.php';
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="public/js/frame.js"></script>
<script src="public/js/1-2-1-overview.js"></script>

</html>