<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
require_once "../classes/functions.php";

if(check_login())
{
    header("Location: ../index.php");
    die;
}
if(!check_first_time())
{
    header("Location: admin.php");
}
$error = false;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $error = true;
    $result = signup($_POST);
    if($result)
    {
        header("Location: admin.php");
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
    <form method="post" id="authentication">
        <h2>SignUp for Admin</h2>
        <div id="error" style="display:<?php if(!$result && $error) echo 'block;'; ?>">Email already exists</div>
        <ul class="elements">
            <div class="element">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" name="email">
            </div>
            <div class="element">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password">
            </div>
            <div class="element">
                <label for="password2">Confirm Password</label>
                <input type="password" id="password2" placeholder="Confirm Password">
            </div>
            <div class="agree">
                <input type="checkbox" name="remember" id="remember" onchange="accepted_terms(this);">
                <label for="remember">I accept <a class="link" href="#">Terms and Conditions</a></label>
            </div>
            <button type="button" class="button1" onclick="signup();" disabled>Sign Up</button>
        </ul>
    </form>
    <script src="script.js"></script>
</body>
</html>