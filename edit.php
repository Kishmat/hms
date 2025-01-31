<?php
require_once "classes/functions.php";
if(!check_admin()){
    header("Location: index.php");
    die;
}
$roll = $_GET['roll'];
$student_detail = get_student($roll);
if(!is_array($student_detail)){
    header("Location: index.php");
    die;
}
$name = get_std_name($roll);
$p_name = "$student_detail[p_fname] $student_detail[p_lname]";
$science = false;
$c12 = false;
if($student_detail['faculty'] == 'Science')
    $science = true;
if($student_detail['grade'] == '12')
    $c12 = true;

$error = false;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $error = true;
    $result = edit_student($roll, $_POST);
    if($result == 'success')
    {
        header("Location: students.php");
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.css"
        integrity="sha512-dUOcWaHA4sUKJgO7lxAQ0ugZiWjiDraYNeNJeRKGOIpEq4vroj1DpKcS3jP0K4Js4v6bXk31AAxAxaYt3Oi9xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form method="post" id="authentication">
        <h2>Edit student</h2>
        <div id="error" style="display:<?php if(!$result && $error) echo 'block;'; ?>">An unknown error occurred!</div>
        <ul class="elements">
            <div class="element disabled">
                <label>Roll Number</label>
                <input type="text" value="<?=$student_detail['roll'];?>" disabled>
            </div>
            <div class="element disabled">
                <label>Full Name</label>
                <input type="text" value="<?=$name;?>" disabled>
            </div>
            <div class="element">
                <label for="grade">Grade</label>
                <select name="grade" id="grade" required>
                    <option value="11" <?php if(!$c12) echo "selected"; ?>>11</option>
                    <option value="12" <?php if($c12) echo "selected"; ?>>12</option>
                </select>
            </div>
            <div class="element">
                <label for="faculty">Faculty</label>
                <select name="faculty" id="faculty" required>
                    <option value="Science" <?php if($science) echo "selected"; ?>>Science</option>
                    <option value="Management" <?php if(!$science) echo "selected"; ?>>Management</option>
                </select>
            </div>
            <div class="element disabled">
                <label>Gender (for room seperation)</label>
                <input type="text" value="<?=$student_detail['gender']?>" disabled>
            </div>
            <div class="element disabled">
                <label>Date of Birth</label>
                <input type="date" value="<?=$student_detail['dob']?>" disabled>
            </div>
            <div class="element">
                <label for="contact">Contact</label>
                <input type="text" name="contact" id="contact"  value="<?=$student_detail['contact'];?>" required pattern="98[0-9]{8}" maxlength="10">
            </div>
            <div class="element">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" required value="<?=$student_detail['address'];?>">
            </div>
            <div class="element disabled">
                <label>Email</label>
                <input type="text" value="<?=$student_detail['email']?>" disabled>
            </div>
            <div class="element disabled">
                <label>Parent's Name</label>
                <input type="text" value="<?=$p_name?>" disabled>
            </div>
            <div class="element">
                <label for="pcontact">Parent's Contact</label>
                <input type="text" name="pcontact" id="pcontact" required pattern="98[0-9]{8}" maxlength="10" value="<?=$student_detail['p_contact'];?>">
            </div>
            <div class="element">
                <label for="room">Room Allocation</label>
                <input type="number" name="room" id="room" required value="<?=$student_detail['room'];?>">
            </div>
            <button class="button1">Edit Details</button>
        </ul>
    </form>
</body>
</html>