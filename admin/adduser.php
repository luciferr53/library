<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="display: flex;flex-direction:row;justify-content:center;background-color:#e3f6f5">
    <div>
    <h1 style="color:#272343;font-weight:900;margin-top:50px;">User Registeration </h1>
    
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
    <div>
        <?php
            if($_SESSION['msg']){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
    </div>
    <div style="max-width:500px;max-height:500px;border-radius:5px;margin-top:50px;padding:50px 50px;background-color:white">
        <form action="/admin/adduser.php" method="POST">
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
        </div>
</body>
</html>