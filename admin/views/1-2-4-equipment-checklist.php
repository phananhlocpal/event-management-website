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
            <!----------------------Edit page content here----------------------->
            <section class="body-content">
                <div class="address">Home > Event > List Events > <span>Event 1</span> > Master Plan > Equipment Checklist</div>
                <div class="checklist-container">
                    <div class="header-container">
                        <p style="padding: 1rem; color: #003480; font-size: 2rem; font-weight: 600;">Equipment Checklist</p>
                        <div class="create-checklist">
                            <a href="" id="create-checklist">
                                <i class='bx bxs-calendar-plus'></i>
                            </a>
                        </div>
                    </div>
                    <div class="create-checklist-wrapper">
                        <input type="text" placeholder="Name" id="name">
                        <textarea name="" id="description" cols="1" rows="2" placeholder="description"></textarea>
                        <select name="" id="unit">
                            <option value="Carton">Carton</option>
                            <option value="Bag">Bag</option>
                            <option value="Paper">Paper</option>
                        </select>
                        <input type="text" placeholder="Quantity" id="quantity">
                        <input type="text" placeholder="Vendor" id="vendor">
                        <select name="" id="class">
                            <option value="Document">Document</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Logistic">Logistic</option>
                        </select>
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
                        <div class="create-checklist-btn">
                            <div id="create-checklist-btn">
                                <i class='bx bxs-plus-circle'></i>
                                <button type="submit" name="addChecklistBtn" id="addChecklistBtn">Create</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-container">
                        <table id="checklist-table">
                            <thead id="title-row">
                                <tr>
                                    <th class="headerTableCell" style="width: 200px;">Id</th>
                                    <th class="headerTableCell" style="width: 200px;">Name</th>
                                    <th class="headerTableCell" style="width: 200px;">Description</th>
                                    <th class="headerTableCell" style="width: 200px;">Unit</th>
                                    <th class="headerTableCell" style="width: 200px;">Quantity</th>
                                    <th class="headerTableCell" style="width: 200px;">Vendor</th>
                                    <th class="headerTableCell" style="width: 200px;">Class</th>
                                    <th class="headerTableCell" style="width: 200px;">Status</th>
                                    <th class="headerTableCell" style="width: 200px;">In-charge</th>
                                    <th class="headerTableCell" style="width: 200px;">Check</th>
                                    <th class="headerTableCell" style="width: 200px;">View Detail</th>
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
    <?php
        include 'layout/footer.php';
    ?>
        <!-- ========== Edit Modal HTML ========== -->
        <div class="modal fade" id="editChecklistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Equipment Checklist</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="edit_checklistName" id = "edit_checklistName" class="form-control" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="edit_checklistDescription" id = "edit_checklistDescription" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <input type="text" name="edit_checklistUnit" id = "edit_checklistUnit" class="form-control" required disabled></input>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" name="edit_checklistQuantity" id = "edit_checklistQuantity" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Vendor</label>
                            <input type="text" name="edit_checklistVendor" id = "edit_checklistVendor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Class</label>
                            <input type="text" name="edit_checklistClass" id = "edit_checklistClass" class="form-control" required disabled>
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
    <div id="deleteChecklistModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmdelete" action="" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Equipment Checklist</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this equipment?</p>
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
<script src="public/js/1-2-4-equipment-checklist.js"></script>

</html>