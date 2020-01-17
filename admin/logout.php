<?php 
    session_start();
    session_unset();
    $_SESSION['error']="Logout Successfull";
    header("Location: http://localhost:8816/adminlogin.php");
?>