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
                <div class="hr-map-container">
                    <div class="header-container">
                        <p class="title" style="padding: 1rem; color: #003480; font-size: 2rem; font-weight: 600;">List
                            HR Map</p>
                        <div class="create-hr-map">
                            <a href="" id="create-hr-map">
                                <i class='bx bxs-calendar-plus'></i>
                            </a>
                        </div>
                    </div>
                    <div class="create-hr-map-wrapper">
                        <input type="text" placeholder="Title" id="title">
                        <input type="text" placeholder="Google Sheet Link" id="linkHRMap">
                        <div class="create-hr-map-btn">
                            <div class="create-hr-map-btn">
                                <div id="create-hr-map-btn">
                                    <i class='bx bxs-plus-circle'></i>
                                    <button type="submit" name="addHRMapBtn" id="addHRMapBtn">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="list-hr-map-table">
                            <thead id="title-row">
                                <tr>
                                    <th class="headerTableCell" style = 'width: 50px'>ID</th>
                                    <th class="headerTableCell"style="width: 200px;">Title</th>
                                    <th class="headerTableCell" style="width: 400px;">Google Sheet Link</th>
                                    <th class="headerTableCell" style="width: 50px;">Delete Plan</th>
                                </tr>
                            </thead>
                            <tbody id="detail-row">
    
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    include 'layout/eventFooter.php';
                ?>
            </section>
        </section>
    </section>
    
    <!-- Delete Modal HTML -->
    <div id="deleteHRMapModal" class="modal fade">
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="public/js/frame.js"></script>
<script src="public/js/1-2-3-hr-map.js"> </script>

</html>