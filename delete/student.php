<?php
require_once "../classes/functions.php";
if(!check_admin()){
    header("Location: ../index.php");
    die;
}
$roll = $_GET['roll'];
$DB = new Database();
$sql = "DELETE FROM students WHERE roll='$roll' LIMIT 1";
if($DB->save($sql))
{
    header("Location: ../students.php");
    die;
}
?>