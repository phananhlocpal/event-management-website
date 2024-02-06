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
    <link rel="stylesheet" href="public/css/member.css">
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
                <div class="member-container">
                    <div class="header-container">
                        <p style="padding: 1rem; color: #003480; font-size: 2rem; font-weight: 600;">Member List</p>
                        <?php
                            if ($_SESSION['user']['role'] === "Admin") {
                                echo '<div class="create-member">
                                        <a href="" id="create-member">
                                            <i class="bx bxs-calendar-plus"></i>
                                        </a>
                                    </div>';
                            }
                        ?>
                    </div>
                    <div class="create-member-wrapper">
                        <input type="text" placeholder="Name" id="name">
                        <input type="text" placeholder="Email" id="email">
                        <input type="text" placeholder="Phone Number" id="phone">
                        <select name="" id="role">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                        <div class="create-member-btn">
                            <div id="create-member-btn">
                                <i class='bx bxs-plus-circle'></i>
                                <button type="submit" name="addMemberBtn" id="addMemberBtn">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="member-table">
                            <thead id="title-row">
                                <tr>
                                    <th class="headerTableCell" style="width: 200px;">Id</th>
                                    <th class="headerTableCell" style="width: 200px;">Full Name</th>
                                    <th class="headerTableCell" style="width: 200px;">Email</th>
                                    <th class="headerTableCell" style="width: 200px;">Phone Number</th>
                                    <th class="headerTableCell" style="width: 200px;">Role</th>
                                    <th class="headerTableCell" style="width: 200px;">Edit Member</th>
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
    <?php
        include 'layout/footer.php';
    ?>
    
        <!-- ========== Edit Modal HTML ========== -->
        <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Member</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="edit_memberName" id = "edit_memberName" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="edit_memberEmail" id = "edit_memberEmail" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="edit_memberPhone" id = "edit_memberPhone" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="edit_memberUsername" id = "edit_memberUsername" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="edit_memberPassword" id = "edit_memberPassword" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select id="edit_role" required>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
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
    <div id="deleteMemberModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmdelete" action="" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Member</h4>
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
<script src="public/js/3-list-member.js"></script>

</html>