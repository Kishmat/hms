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

$complains = get_complains();
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
        .complains{
            max-width: 600px;
            width: 90%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            height: 100vh;
            overflow-y: auto;
        }
        .complain{
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: #1e1e1e;
            padding: 25px 15px;
            border-radius: 12px;
        }
        .complain .info{
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php include("pages/nav.php"); ?>
    <main>
        <section class="contents">
            <h1>Complains</h1>

            <?php 
                if(is_array($complains)){
                    echo "<ul class='complains'>";
                    foreach($complains as $complain){
                        $name = get_std_name($complain['roll']);
                        echo "
                        <li class='complain'>
                        <div class='info'><div class='title'>By :</div><a href='#' class='link'><span>$name</span></a></div>
                        <div class='info'><div class='title'>Type :</div><span>$complain[type]</span></div>
                        <br>
                        <div class='text'>$complain[text]</div>
                        <button class='logout' onclick='delete_complain($complain[id]);'>Delete</button>
                        </li>";
                    }
                    echo "</ul>";
                }else{
                    echo "<p class='no_result'>No results to show!</p>";
                }
            ?>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>