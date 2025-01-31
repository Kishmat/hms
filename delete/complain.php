<?php
require_once "../classes/functions.php";
if(!check_admin()){
    header("Location: ../index.php");
    die;
}
$id = $_GET['id'];
$DB = new Database();
$sql = "DELETE FROM complains WHERE id='$id' LIMIT 1";
if($DB->save($sql))
{
    header("Location: ../complains.php");
    die;
}
?>