<?php 
    session_start();
    session_unset();
    $_SESSION['msg']="Logout Successfull";
    header("Location: http://localhost:8816/Login.php");
?>