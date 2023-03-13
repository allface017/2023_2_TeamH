<?php
session_start();

if(empty($_SESSION["id"])){
    header("Location: Login.php");
    exit();
}
?>
