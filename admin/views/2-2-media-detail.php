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
      <!----------------------Edit page content here----------------------->
      <section class="body-content">
        <p class="address">Home > List Media Plans > Media 1 > Detail Plan</p>
        <div class="calendar-container">
          <div class="container">
            <div class="left">
              <div class="calendar">
                <div class="month">
                  <i class='bx bx-chevron-left prev'></i>
                  <div class="date">december 2015</div>
                  <i class='bx bx-chevron-right next' ></i>
                </div>
                <div class="weekdays">
                  <div>Sun</div>
                  <div>Mon</div>
                  <div>Tue</div>
                  <div>Wed</div>
                  <div>Thu</div>
                  <div>Fri</div>
                  <div>Sat</div>
                </div>
                <div class="days"></div>
                <div class="goto-today">

                  <button class="today-btn">Today</button>
                </div>
              </div>
            </div>
            <div class="right">
              <div class="today-date">
                <div class="event-day">wed</div>
                <div class="event-date">12th december 2022</div>
              </div>
              <div class="events"></div>
              <div class="add-event-wrapper">
                <div class="add-event-header">
                  <div class="title">Add Media Post</div>
                  <i class="bx bx-x close"></i>
                </div>
                <div class="add-event-body">
                  <div class="add-event-input">
                    <p>Media Post Title</p>
                    <input type="text" placeholder="Media Post Title" class="event-name" />
                  </div>
                  <div class="add-event-input">
                    <p>Post Time</p>
                    <input
                      type="time"
                      step="1"
                      class="event-time-from"
                    />
                  </div>
                  <div class="add-event-input">
                    <p>Incharge</p>
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
                </div>
                <div class="add-event-footer">
                  <button class="add-event-btn">Add Event</button>
                </div>
              </div>
            </div>
            <button class="add-event">
              <i class='bx bxs-calendar-event'></i>
            </button>
          </div>

        </div>

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
<script src="public/js/2-2-media-detail.js"></script>

</html>