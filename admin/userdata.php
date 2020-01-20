<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body  style="display:flex;flex-direction:row;background-color:#343A40">
    <?php
        session_start();
        if($_SESSION['admin']){
            if($_SERVER['REQUEST_METHOD']=="POST"){
                include "../getdata.php";
                if(empty($_POST['username']) or empty($_POST['password'])){
                    echo "failed";
                    $_SESSION['msg'] = "Empty Field";
                    header('Location: http://localhost:8816/admin/adduser.php');
                    exit;
                }else{
                    if(adduser($_POST['username'],$_POST['password'])){
                        echo "success";
                        $_SESSION['msg'] = "USER Successfull Added";
                        header('Location: http://localhost:8816/admin/bookslist.php');
                        exit;
                    }else{
                        echo "failed";
                        $_SESSION['msg'] = "Server Not Available Please Try Again Later";
                        header('Location: http://localhost:8816/admin/bookslist.php');
                        exit;
                    }
                }
            }
        }else{
            $_SESSION['error'] = "Please Login First";
                header('Location: http://localhost:8816/adminlogin.php');
                exit();
        }
    ?>
    <div style="display: flex;flex:1;flex-direction:column;justify-content:space-between;height:100%;margin-top:10px;">
        <span style="color:white;font-size:50px;align-self:center">Menu</span>
        <a href="/admin/bookslist.php"><button class="btn btn-dark">books list</button></a>
        <a href="/admin/userdata.php"><button class="btn btn-dark">user data</button></a>
        <a href="/admin/adduser.php"><button class="btn btn-dark">add user</button></a>
        <a href="/admin/logout.php"><button class="btn btn-dark">logout</button></a>
    </div>
    <div style="margin-left:50px;max-width:500px;max-height:500px;border-radius:5px;margin-top:50px;padding:50px 50px;background-color:white">
        <h4>Add User</h4>
        <form action="/admin/userdata.php" method="POST">
            <div class="form-group">
                <label for="username">username</label>
                <input class= "form-control" type="text" name="username" value="" id="username">
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" class= "form-control" name="password" value="" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
    <div style="display: flex;flex:7;flex-direction:row;justify-content:center;padding-left:50px;padding-top:100px">
        <?php
            session_start();
            include "../getdata.php";
            if($_SESSION['admin']){
                echo renderissuelist();
            }else{
                $_SESSION['error'] = "please Login first";
                header("Location: http://localhost:8816/adminlogin.php");
                exit;
            }
        ?>
    </div>
</body>
</html>