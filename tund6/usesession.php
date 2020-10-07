<?php
session_start();
//kontrollin kas on sisse loginud
if(!isset($session["userid"])){
    header("Location: page.php");
    exit();
}
//logime v2lja
if(isset($_GET["logout"])){
    session_destroy();
    header("Location: page.php");
    exit();
}
?>
