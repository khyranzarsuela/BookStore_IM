<?php
session_start();

if(!isset($_SESSION['staff_id'])){
    header("Location: Login.php");
    exit();
}
?>