<?php 
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['username']) or empty($_POST['password']) ){
            $_SESSION['error'] = "Invalid Credentials";
            header('Location: http://localhost:8816/Login.php');
            exit;
        }else{
            validate($_POST['username'],$_POST['password']);
        }
    }

    function validate($username,$password){
        include 'connecttodb.php';
        $pdo = connecttodb();
        $stm = $pdo->prepare("SELECT * FROM users where username='$username' AND password='$password'");
        $stm->execute();
        $data = $stm->fetch();
        $count = $stm->rowCount();
        if($count!=0){
            $_SESSION['userid']= $data['id'];
            header('Location: http://localhost:8816/userbooks.php');
            exit;
        }else{
            $_SESSION['error']="Invalid Credentials";
            header('Location: http://localhost:8816/Login.php');
            exit;
        }
    }
    
?>