<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PClub Home</title>
    <link rel="shortcut icon" type="image/png" href="public/img/logo/2.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/info.css" type="text/css" media="screen">
    <link rel="stylesheet" href="public/css/frame.css" type="text/css" media="screen">
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
            include 'layout/userOptionBlock.php';
        ?>
        <!--Content Body-->
        <section class="body-container">
            <!--Header-->
            <?php
                include 'layout/header.php';
            ?>
            <!------------------------------Body Content------------------------------------------------>
            <section class="body-content" style="margin: 0; padding: 0;">
                <div id="block__left">
                    <div id="block__memberCard">
                        <div id="container__img">
                            <?php
                                $img_src = $_SESSION['user']['ava'];
                                echo "<img src='$img_src'>";
                            ?>
                        </div>
                        <div id="container__info">
                            <p id="name">
                                <?php
                                    echo $_SESSION['user']['name'];
                                ?>
                            </p>
                            <p id="role">
                                <?php
                                    echo $_SESSION['user']['role'];
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="block__right">
                    <div>
                        <div id="block__detailInformation">
                            <p id = "email">email:
                                <?php
                                    echo $_SESSION['user']['email'];
                                ?>
                            </p>
                            <p id="phone">phone: 
                                <?php
                                    echo $_SESSION['user']['phone'];
                                ?>
                            </p>
                            <p id="username">username: 
                                <?php
                                    echo $_SESSION['user']['username'];
                                ?>
                            </p>
                        </div>
                        <div id="block__updateUser">
                            <div>
                                <?php
                                    echo '<button type="button" class="btn btn-primary editUserBtn" data-bs-toggle="modal" data-bs-target="#editUserModal" value='.$_SESSION['user']['id'].'><i class="bx bxs-edit"></i><div>Update</div></button>';
                                ?>

                            </div>
                            <div>
                                <?php
                                    echo '<button type="button" class="btn btn-primary uploadAvaBtn" data-bs-toggle="modal" data-bs-target="#uploadAvaModal" value='.$_SESSION['user']['id'].'><i class="bx bxs-edit"></i><div>Upload Avatar</div></button>';
                                ?>
                            </div>
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
    
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Your Information</h1>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary confirmEdit" name = "confirmEdit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="uploadAvaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Avatar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input class="form-control" type="file" id="formFile" accept=".jgp, .png">
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="public/js/frame.js"></script>
<script src="public/js/4-information.js"></script>

</html>