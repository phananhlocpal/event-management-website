<!---------------------------------Header------------------------------------------------>
<section class="header">
    <div class="align-justify" >
        <i class='bx bx-menu' style="font-size: 3rem; color: white" id="btn"></i>
    </div>
    <div class="header-information">
        <i class='bx bxs-bell' style="font-size: 2rem; color: white; margin-right: 1.5rem;"></i>
        <div>
            <?php
                $ava_src = $_SESSION['user']['ava'];
                echo "<img src=\"$ava_src\" alt=\"Avatar\" style=\"max-width: 2rem; border-radius: 50%; margin-right: 1.5rem\">";
            ?> 
        </div>
        <p style = "font-size: 1rem; font-weight: 600; color: white; margin-right: 1.5rem">
            <?php
                echo $_SESSION['user']['name'];
            ?>
        </p>
        <i class='bx bxs-down-arrow' style="font-size: 1rem; color: white; margin-right: 1.5rem" id="userOptionBtn"></i>
    </div>
</section>