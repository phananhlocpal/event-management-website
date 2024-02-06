<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PClub Home</title>
    <link rel="shortcut icon" type="image/png" href="public/img/logo/2.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/frame.css">
    <link rel="stylesheet" href="public/css/media.css">
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
                <div class="list-media-container">
                    <div class="header-container">
                        <p class="title" style="padding: 1rem; color: #003480; font-size: 2rem; font-weight: 600;">List
                            Media</p>
                        <div class="create-media">
                            <a href="" id="create-media">
                                <i class='bx bxs-calendar-plus'></i>
                            </a>
                        </div>
                    </div>
                    <div class="create-media-wrapper">
                        <input type="text" placeholder="Media title" id="media-name">
                        <textarea name="" id="description" cols="1" rows="2" placeholder="Description"></textarea>
                        <input type="date" placeholder="Start" id="start">
                        <input type="date" placeholder="End" id="end">
                        <select class="form-select selectedHost" id = "eventHostId" aria-label="Default select example">
                            <?php
                                include '../models/user.php';
                                $user = new User();
                                echo "<option disabled>Select Host</option>";
                                foreach ($user->getAllUser() as $key => $value) {
                                    echo '<option value ='. $value["id"].'>'.$value["name"].'</option>';
                                    };
                            ?>
                        </select>
                        <select class="form-select selectedHost" id = "mediaInchargeID" aria-label="Default select example">
                            <?php
                                echo "<option disabled>Select Host</option>";
                                foreach ($user->getAllUser() as $key => $value) {
                                    echo '<option value ='. $value["id"].'>'.$value["name"].'</option>';
                                    }
                            ?>
                        </select>
                        <div class="create-media-btn">
                            <div id="create-media-btn">
                                <i class='bx bxs-plus-circle'></i>
                                <button type="submit" name="addMediaBtn" id="addMediaBtn">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="list-media-table">
                            <thead id="title-row">
                                <tr>
                                    <th class="headerTableCell" style="min-width: 50px;">No.</th>
                                    <th class="headerTableCell" style="min-width: 150px;">Title</th>
                                    <th class="headerTableCell" style="min-width: 300px;">Description</th>
                                    <th class="headerTableCell" style="min-width: 100px;">Start</th>
                                    <th class="headerTableCell" style="min-width: 100px;">End</th>
                                    <th class="headerTableCell" style="min-width: 100px;">Host of Event</th>
                                    <th class="headerTableCell" style="min-width: 100px;">In-charnge media</th>
                                    <th class="headerTableCell" style="min-width: 150px;">Status</th>
                                    <th class="headerTableCell" style="min-width: 200px;">View Detail</th>
                                </tr>
                            </thead>
                            <tbody id="detail-row">
    
                            </tbody>
                           
                        </table>
                    </div>
                    
                </div>

            </section>
            <?php
                include 'layout/footer.php';
            ?>
        </section>
    </section>
    <!-- ========== Edit Modal HTML ========== -->
    <div class="modal fade" id="editMediaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Media</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Media Name</label>
                            <input type="text" name="edit_mediaName" id = "edit_mediaName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="edit_mediaDescription" id = "edit_mediaDescription" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="edit_mediaStart" id = "edit_mediaStart" class="form-control" required disabled></input>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="edit_mediaEnd" id = "edit_mediaEnd" class="form-control" required>
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
    <div id="deleteMediaModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmdelete" action="" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Media</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this media plan?</p>
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="public/js/frame.js"></script>
<script src="public/js/2-1-list-media.js"> </script>

</html>