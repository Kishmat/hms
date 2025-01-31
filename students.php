<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "classes/functions.php";
$admin = false;
if(check_login())
{
    $admin = check_admin();
    if(!$admin){
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}

$students = get_students();
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
        <section class="contents">
            <h1>Students</h1>
            <a href="new/student.php"><button class="button1"><i class="ri-add-line"></i> Add New</button></a>
            <?php if(is_array($students)): ?>
            <table>
                <tr class="head">
                    <th>Actions</th>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Faculty</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Parent's Name</th>
                    <th>Parent's Contact</th>
                    <th>Current Room</th>
                    <th>Admission Date</th>
                    <th>Fee Status</th>
                </tr>
                <?php 
                    foreach($students as $student)
                    {
                        $name = $student['fname'] . " " . $student['lname'];
                        $p_name = $student['p_fname'] . " " . $student['p_lname'];
                        $status = "Not Paid";
                        if($student['status'])
                            $status = "Paid";
                        echo "<tr>
                            <td class='action'><a onclick='edit_student($student[roll]);' class='link'>Edit</a><a onclick='delete_student($student[roll]);' class='link r'>Delete</a></td>
                            <td>$student[roll]</td>
                            <td>$name</td>
                            <td>$student[grade]</td>
                            <td>$student[faculty]</td>
                            <td>$student[gender]</td>
                            <td>$student[dob]</td>
                            <td>$student[contact]</td>
                            <td>$student[address]</td>
                            <td><a href='$student[photo]' target='_blank' class='link'>View Photo</a></td>
                            <td>$student[email]</td>
                            <td>$p_name</td>
                            <td>$student[p_contact]</td>
                            <td>$student[room]</td>
                            <td>$student[admission]</td>
                            <td>$status</td></tr>";
                    }
                ?>
            </table>
            <?php else: ?>
            <p class="no_result">No results to show!</p>
             <?php endif; ?>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>