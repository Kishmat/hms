<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "classes/functions.php";
if(check_admin()){
    header("Location: index.php");
    die;
}

$details = get_student($_SESSION['userid']);
$name = get_std_name($details['roll']);
$p_name = "$details[p_fname] $details[p_lname]";
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
</head>
<body>
    <?php include("pages/nav.php"); ?>
    <main>
        <ul class="details">
            <img src="<?=$details['photo'];?>" alt="Profile Picture">
            <li class="detail"><p class="title">Roll Number</p><p class="value"><?=$details['roll'];?></p></li>   
            <li class="detail"><p class="title">Name</p><p class="value"><?=$name;?></p></li>   
            <li class="detail"><p class="title">Gender</p><p class="value"><?=$details['gender'];?></p></li>   
            <li class="detail"><p class="title">Date of Birth</p><p class="value"><?=$details['dob'];?></p></li>   
            <li class="detail"><p class="title">Contact</p><p class="value"><?=$details['contact'];?></p></li>   
            <li class="detail"><p class="title">Address</p><p class="value"><?=$details['address'];?></p></li>   
            <li class="detail"><p class="title">Email</p><p class="value"><?=$details['email'];?></p></li>   
            <li class="detail"><p class="title">Grade</p><p class="value"><?=$details['grade'];?></p></li>   
            <li class="detail"><p class="title">Faculty</p><p class="value"><?=$details['faculty'];?></p></li>   
            <li class="detail"><p class="title">Parent's Name</p><p class="value"><?=$p_name;?></p></li>   
            <li class="detail"><p class="title">Parent's Contact</p><p class="value"><?=$details['p_contact'];?></p></li>   
            <li class="detail"><p class="title">Room</p><p class="value"><?=$details['room'];?></p></li>   
            </ul>
    </main>
    <script src="script.js"></script>
</body>
</html>