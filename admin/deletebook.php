<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=="GET"){
        if($_SESSION['admin']){
            if($_GET['bookid']){
                include '../getdata.php';
                if(deletebook($_GET['bookid'])){
                    $_SESSION['msg']="Book successfull deleted";
                }else{
                    $_SESSION['msg']="Some Error With Server please Try Again Later";
                }
                header("Location: http://localhost:8816/admin/bookslist.php");
                exit;
            }
        }else{
            $_SESSION['error'] = "Please Login First";
            header("Location: http://locahost:8816/adminlogin.php");
            exit;
        }
    }else{
        header("Location: http://localhost:8816/adminlogin.php");
        exit();
    }
?>