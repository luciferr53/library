<!DOCTYPE html>
<html lang="en">
<head>
    <title>UserBooks</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="display:flex;flex-direction:row;background-color:#343A40">
<div style="display: flex;flex:1;flex-direction:column;justify-content:space-between;height:100%;padding-top:10px;background-color:#343A40">
            <span style="color:white;font-size:50px;align-self:center">Menu</span>
            <a href="/userbooks.php"><button class="btn btn-dark">books list</button></a>
            <a href="/userhistory.php"><button class="btn btn-dark">issue history</button></a>
            <a href="/logout.php"><button class="btn btn-dark">logout</button></a>
    </div>
        <div style="display: flex;flex:7;flex-direction:row;justify-content:center;padding-left:50px;padding-top:100px;">
        <?php 
            session_start();    
            include 'getdata.php';
            if($_SESSION['userid']){
                echo renderuserbookslist();
            }
            else{
                $_SESSION['error'] = "Please Login First";
                header('Location: http://localhost:8816/Login.php');
                exit;
            }
        ?>
        </div>
    
    
</body>
</html>