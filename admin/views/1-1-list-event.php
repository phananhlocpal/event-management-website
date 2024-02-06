<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.5">
    <title>PClub Home</title>
    <link rel="shortcut icon" type="image/png" href="public/img/logo/2.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/frame.css">
    <link rel="stylesheet" href="public/css/event.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php
    session_start();
    if ($_SESSION===[]) {
        header("location: 0-login.php");
    }
    include 'layout/head.php';
?>
<body>
    <section class="main-body">
        <!--Nav-bar-->
        <?php
            include 'layout/navBar.php';
            include 'layout/userOptionBlock.php';
        ?>
        <!--Content Body-->
        <section class="body-container">
            <!--Header-->
            <?php
                include 'layout/header.php';
            ?>
            <section class="body-content">
                <div class="list-event-container">
                    <div class="header-container">
                        <p class="title" style="padding: 1rem; color: #003480; font-size: 2rem; font-weight: 600;">List
                            Event</p>
                        <div class="create-event">
                            <a href="" id="create-event">
                                <i class='bx bxs-calendar-plus'></i>
                            </a>
                        </div>
                    </div>
                    <div class="create-event-wrapper">
                        <form action="" method="POST" autocomplete="off">
                            <input type="text" placeholder="Event Name" id="event-name" name="event-name">
                            <textarea id="description" cols="40" rows="4" placeholder="Description"
                                name="description"></textarea>
                            <input type="date" placeholder="Start" id="start" lable="Start Date" name="start">
                            <input type="date" placeholder="End" id="end" label="End Date" name="end">
                            <select class="form-select selectedHost" id = "inchargeName" aria-label="Default select example">
                                <?php
                                    include '../models/user.php';
                                    $user = new User();
                                    echo "<option disabled>Select Host</option>";
                                    foreach ($user->getAllUser() as $key => $value) {
                                        echo '<option value ='. $value["id"].'>'.$value["name"].'</option>';
                                        }
                                ?>
                            </select>
                            <input type="text" placeholder="Place" id="location" name="place">
                            <div class="create-event-btn">
                                <div id="create-event-btn">
                                    <i class='bx bxs-plus-circle'></i>
                                    <button type="submit" name="addEventBtn" id="addEventBtn">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-container">
                        <table id="list-event-table">
                            <thead id="title-row">
                                <tr>
                                    <th class="headerTableCell">ID</th>
                                    <th class="headerTableCell" style="width: 200px;">Event Name</th>
                                    <th class="headerTableCell" style="width: 300px;">Description</th>
                                    <th class="headerTableCell" style="width: 120px;">Start</th>
                                    <th class="headerTableCell" style="width: 120px;">End</th>
                                    <th class="headerTableCell" style="width: 150px;">Location</th>
                                    <th class="headerTableCell" style="width: 150px;">Host</th>
                                    <th class="headerTableCell" style="width: 150px; text-align: center;">Status</th>
                                    <th class="headerTableCell" style="width: 200px;">View Detail</th>
                                </tr>
                            </thead>

                            <tbody id="detail-row">
                                
                            </tbody>
                        </table>
                    </div>

                </div>

            </section>
        </section>
    </section>
    <!-- ========== Edit Modal HTML ========== -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Event</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" name="edit_eventName" id = "edit_eventName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="edit_eventDescription" id = "edit_eventDescription" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="edit_eventStart" id = "edit_eventStart" class="form-control" required disabled></input>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="edit_eventEnd" id = "edit_eventEnd" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="edit_eventLocation" id = "edit_eventLocation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary confirmEdit" name = "confirmEdit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteEventModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmdelete" action="" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Event</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this event?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger confirmDelete" name="confirmDelete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        include 'layout/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="public/js/frame.js"></script>
    <script src="public/js/1-1-list-event.js"></script>
</body>
</html>