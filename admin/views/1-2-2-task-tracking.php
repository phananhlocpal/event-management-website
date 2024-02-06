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
    <link rel="stylesheet" href="../../sys/lib/gantt-master/gantt-master/codebase/dhtmlxgantt.css" type="text/css">
    <link rel="stylesheet" href="public/css/frame.css">
    <link rel="stylesheet" href="public/css/event.css">
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
            <section class="body-content">
                <div class="address">Home > Event > List Events > <span>Event 1</span> > Master Plan > Task Tracking</div>
                <div class="task-tracking-container">
                    <div id="block__taskTrackingHeader">
                        <div class="logo-title">
                            <img src="public/img/logo/2.png" alt="">
                            <div>
                                <p style="font-weight: 600;">Task Tracking</p>
                                <?php
                                    echo '<p id="eventName">'.$_SESSION['event']['name'].'</p>';
                                ?>
                            </div>
                        </div>
                        <div class="other-element">
                            <div class="date-elemet">
                                <div class="date-container">
                                    <label for="startInput">Start Date</label>
                                    <?php
                                        echo '<input type="date" id="startInput" class="start" value ='.$_SESSION['event']['start'].' disable>';
                                    ?>
                                </div>
                                <div class="date-container">
                                    <label for="endInput">End Date</label>
                                    <?php
                                        echo '<input type="date" id="endInput" class="end" value ='.$_SESSION['event']['end'].' disable>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="gantt_here" style='width:100%; height:80%;' data-start-date="<?php echo $_SESSION['event']['start']; ?>" data-end-date="<?php echo $_SESSION['event']['end']; ?>"></div>
                    

                </div>
                <?php
                    include 'layout/eventFooter.php';
                ?>
            </section>
            <div class="modal fade" id="confirmAddInchargeTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Incharge Task</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Incharge Task</label>
                                    <select class="form-select incharge" id = "inchargeName" aria-label="Default select example">
                                        <?php
                                            include '../models/user.php';
                                            $user = new User();
                                            echo "<option disabled>Select Host</option>";
                                            foreach ($user->getAllUser() as $key => $value) {
                                                echo '<option value ='. $value["id"].'>'.$value["name"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary confirmAddInchargeTask" name = "confirmAddInchargeTask">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <?php
        include 'layout/footer.php';
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../sys/lib/gantt-master/gantt-master/codebase/dhtmlxgantt.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="public/js/frame.js"></script>
<script src="public/js/1-2-2-task-tracking.js"></script>

</html>