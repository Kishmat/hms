<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "../classes/functions.php";
$admin = false;
if(check_login())
{
    $admin = check_admin();
    if($admin){
        header("Location: ../index.php");
    }
}else{
    header("Location: ../index.php");
}
$error = false;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $error = true;
    $result = submit_complain($_POST);
    if($result == 'success'){
        header("Location: ../index.php");
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
</head>
<body>
    <form method="post" id="authentication" enctype="multipart/form-data">
        <h2>Submit Complain</h2>
        <div id="error" style="display:<?php if(!$result && $error) echo 'block;'; ?>">An unknown error occurred!</div>
        <ul class="elements">
            <div class="element">
                <label for="type">Complain Type</label>
                <select name="type" id="type" required>
                    <option value="Food">Food</option>
                    <option value="Partner">Partner</option>
                    <option value="Room">Room</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="element">
                <label for="text">Complain</label>
                <textarea name="text" id="text" placeholder="Write your complain" required></textarea>
            </div>
            <button class="button1">Submit Complain</button>
        </ul>
    </form>
</body>
</html>