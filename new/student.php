<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "../classes/functions.php";
$admin = false;
if(check_login())
{
    $admin = check_admin();
    if(!$admin){
        header("Location: ../index.php");
    }
}else{
    header("Location: ../index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $result = add_new_student($_POST,$_FILES['photo']);
    if($result == 'success'){
        header("Location: ../students.php");
        die;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.css"
        integrity="sha512-dUOcWaHA4sUKJgO7lxAQ0ugZiWjiDraYNeNJeRKGOIpEq4vroj1DpKcS3jP0K4Js4v6bXk31AAxAxaYt3Oi9xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #preview{
            width: 100%;
            height: 250px;
            object-fit: contain;
            display: none;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <form method="post" id="authentication" enctype="multipart/form-data">
        <h2>Add new student</h2>
        <div id="error" style="display:<?php if($result == 'e' || $result == 'r') echo 'block;'; ?>"><?php if($result=='e') echo "Email"; else echo "Roll Number";?> already exists!</div>
        <ul class="elements">
            <div class="element">
                <label for="roll">Roll Number</label>
                <input type="number" id="roll" name="roll" required>
            </div>
            <div class="element">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="First Last" required pattern="[a-zA-Z]+ [a-zA-Z]+">
            </div>
            <div class="element">
                <label for="grade">Grade</label>
                <select name="grade" id="grade" required>
                    <option value="11">11</option>
                    <option value="12" selected>12</option>
                </select>
            </div>
            <div class="element">
                <label for="faculty">Faculty</label>
                <select name="faculty" id="faculty" required>
                    <option value="Science">Science</option>
                    <option value="Management">Management</option>
                </select>
            </div>
            <div class="element">
                <label for="gender">Gender (for room seperation)</label>
                <select name="gender" id="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="element">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" required>
            </div>
            <div class="element">
                <label for="contact">Contact</label>
                <input type="text" name="contact" id="contact" placeholder="980000000000" required pattern="98[0-9]{8}" maxlength="10">
            </div>
            <div class="element">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" required>
            </div>
            <div class="element">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="element">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="element">
                <label for="pname">Parent's Name</label>
                <input type="text" name="pname" id="pname" placeholder="First Last" required pattern="[a-zA-Z]+ [a-zA-Z]+">
            </div>
            <div class="element">
                <label for="pcontact">Parent's Contact</label>
                <input type="text" name="pcontact" id="pcontact" placeholder="980000000000" required pattern="98[0-9]{8}" maxlength="10">
            </div>
            <div class="element">
                <label for="room">Room Allocation</label>
                <input type="number" name="room" id="room" required>
            </div>
            <div class="element">
                <label>Photo (PNG or JPEG)</label>
                <div style="border:1px solid;">
                    <img id="preview">
                    <input style="border:none;" type="file" name="photo" id="photo" onchange="preview_photo(this);" required accept="image/png,image/jpeg">
                </div>
            </div>
            <button class="button1">Add New Student</button>
        </ul>
    </form>
    <script src="../script.js"></script>
</body>
</html>