<?php 

session_start();
if (!isset($_SESSION['nom']))
    header("Location:content/login.php");

?>