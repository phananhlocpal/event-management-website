<!-------------------------- Nav-bar --------------------------->
<section class="nav-bar">
    <div class="top">
        <img src="public/img/logo/3.png" alt="PClub Logo" id="full-logo">
        <img src="public/img/logo/4.png" alt="PClub Logo" id="small-logo">
    </div>
    <div class="ava-container">
        <div class="avatar">
            <?php
                $ava_src = $_SESSION['user']['ava'];
                echo "<img src=\"$ava_src\" alt=\"Avatar\">";
            ?>
        </div>
        <div class="user-information">
            <p style="font-size: 1rem; font-weight: 600;">
            <?php
                echo $_SESSION['user']['name'];
            ?></p>
            <p>
            <?php
                echo $_SESSION['user']['role'];
            ?>
            </p>
            <div class="status">
                <div style="width: .5rem; height: .5rem; border-radius: 50%; background-color: greenyellow;"></div>
                <p>Online</p>
            </div>
        </div>
    </div>
    <ul class="component__navbar">
        <li class="block__navbar">
            <a href="../views/0-home.php">
                <i class='bx bxs-home'></i>
                <span class="nav-item">Home</span>
            </a>
            <span class="tooltip">Home</span>
        </li>
        <li class="block__navbar">
            <a href="../views/2-1-list-media.php">
                <i class='bx bxl-meta' ></i>
                <span class="nav-item">Media</span>
            </a>
            <span class="tooltip">Media</span>
        </li>
        <li class="block__navbar">
            <a href="../views/1-1-list-event.php">
                <i class='bx bxs-calendar-event'></i>
                <span class="nav-item">Event</span>
            </a>
            <span class="tooltip">Event</span>
        </li>
        <li class="block__navbar">
            <a href="../views/3-list-member.php">
                <i class='bx bx-male-female' ></i>
                <span class="nav-item">Member</span>
            </a>
            <span class="tooltip">Member</span>
        </li>
    </ul>

</section>