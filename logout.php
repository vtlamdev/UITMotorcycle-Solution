<?php
ob_start();
session_start();
unset($_SESSION['username']);
unset($_SESSION['status']);
header("location: Login.php"); 
?>