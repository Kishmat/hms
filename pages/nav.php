<?php
require_once "classes/functions.php";
$page = str_replace('/hms','',$_SERVER['SCRIPT_NAME']);
$page = str_replace('.php','',$page);
$my_detail = get_my_detail();
?>
<nav>
    <div class="top">
        <div class="logo"><span>HM</span>S</div>
        <ul class="pages">
            <a href="index.php"><li class="<?php if($page == "/index") echo 'active'; ?>" title="Home"><i class="ri-home-4-line"></i> <span>Home</span></li></a>
            <?php if (check_admin()): ?>
                <a href="students.php"><li class="<?php if($page == "/students") echo 'active'; ?>" title="Students"><i class="ri-group-line"></i> <span>Students</span></li></a>
                <a href="complains.php"><li class="<?php if($page == "/complains") echo 'active'; ?>" title="Complaints"><i class="ri-alert-line"></i> <span>Complaints</span></li></a>
            <?php elseif (check_login() && !check_admin()): ?>
                <a href="profile.php"><li class="<?php if($page == "/profile") echo 'active'; ?>" title="Your Profile"><i class="ri-user-line"></i> <span>My Profile</span></li></a>
                <a href="new/complain.php"><li class="<?php if($page == "/new_complain") echo 'active'; ?>" title="Submit Complain"><i class="ri-alert-line"></i> <span>Submit Complain</span></li></a>
            <?php endif; ?>
            <a href="about.html"><li title="About Us"><i class="ri-information-line"></i> <span>About Us</span></li></a>
            <a href="contact.html"><li title="Contact Us"><i class="ri-contacts-line"></i> <span>Contact Us</span></li></a>
        </ul>
    </div>
    <?php
        if(is_array($my_detail))
        {
            $photo = $my_detail['photo'];
            $name = "$my_detail[fname] $my_detail[lname]";
            echo "<div class='info'><img src='$photo'><span>$name</span></div>";
        }elseif(check_admin())
        {
            echo "<div class='info'><span>Admin</span></div>";
        }

        if(check_login())
        {
            echo "<button class='logout' onclick='logout();'>Logout</button>";
        }
    ?>
</nav>
