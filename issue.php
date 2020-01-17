<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=="GET"){
        if($_SESSION['userid']){
            include 'getdata.php';
            if(issue($_GET['bookid'],$_SESSION['userid'])){
                $_SESSION['msg'] = "Issue Successfull";
                header('Location: http://localhost:8816/userhistory.php');
                exit;
            }else{
                $_SESSION['msg'] = "Issue failed";
                header('Location: http://localhost:8816/userbooks.php');
                exit;
            }
        }else{
            $_SESSION['msg'] = "Login First";
            header('Location: http://localhost:8816/Login.php');
            exit;
        }
    }
?>