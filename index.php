<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "classes/functions.php";
$logged = false;
$admin = false;
$student = true;
if(check_login())
{
    $logged = true;
    $admin = check_admin();
    if($admin){
        $student = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Mangagement System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.css"
        integrity="sha512-dUOcWaHA4sUKJgO7lxAQ0ugZiWjiDraYNeNJeRKGOIpEq4vroj1DpKcS3jP0K4Js4v6bXk31AAxAxaYt3Oi9xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

    </style>
</head>
<body>
    <?php include("pages/nav.php"); ?>
    <main>
        <?php if($logged): ?>
        <div class="welcome">
            <h1>Welcome to Hotel Management System</h1>
            <p class="info">Easily manage all the hostel activities in a user friendly way</p>

            <ul class="features">
                <li>
                    <i class="ri-group-line"></i>
                    <span>Student Management System</span>
                    <p>Add new students, track their details, and allow them to view their fee status conveniently.</p>
                </li>
                <li>
                    <i class="ri-alert-line"></i>
                    <span>Complaint Management System</span>
                    <p>Efficiently handle complaints; students can submit issues, and admins can track and resolve them.</p>
                </li>
                <li>
                    <i class="ri-hotel-line"></i>
                    <span>Room Allocation System</span>
                    <p>Seamlessly assign and manage student room allocations with detailed records.</p>
                </li>
                <li>
                    <i class="ri-check-double-line"></i>
                    <span>User-Friendly Interface</span>
                    <p>Simplified design ensures ease of use for both admins and students.</p>
                </li>
            </ul>
        </div>
        <?php else: ?>
            <div class="not_logged_in">
                Not logged in!Please Login to continue.
                <a href="auth/login.php"><div class="button1">Log In</div></a>
            </div>
        <?php endif; ?>
    </main>
    <script src="script.js"></script>
</body>
</html>