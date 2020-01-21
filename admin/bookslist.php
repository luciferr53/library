<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="display:flex;flex-direction:row;background-color:#343A40">
    
    <?php
        session_start();
        if($_SESSION['admin']){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                include '../getdata.php';
                if(empty($_POST['bookid']) or empty($_POST['bookname'])){
                    echo "empty field try again";
                }else{
                    if(addbook($_POST['bookid'],$_POST['bookname'])){
                        $_SESSION['msg'] = "Book added Successfully";
                    }else{
                        $_SESSION['msg'] = "There was an error with the server please try again later";
                    }
                    header("Location: http://localhost:8816/admin/bookslist.php");
                    exit;
                }
            }
        }else{
            $_SESSION['msg'] = "Login First";
            header('Location: http://localhost:8816/adminlogin.php');
        }
    
    ?>
    </div>
    <div style="display: flex;flex:1;flex-direction:column;justify-content:space-between;height:100%;margin-top:10px;">
        <span style="color:white;font-size:50px;align-self:center">Menu</span>
        <a href="/admin/bookslist.php"><button class="btn btn-dark">books list</button></a>
        <a href="/admin/userdata.php"><button class="btn btn-dark">user data</button></a>
        <a href="/admin/logout.php"><button class="btn btn-dark">logout</button></a>
    </div>
    <div style="margin-left:50px;max-width:500px;max-height:500px;border-radius:5px;margin-top:50px;padding:50px 50px;background-color:white">
        <h4>Add Book</h4>
        <form action="/admin/bookslist.php" method="POST">
            <div class="form-group">
                <label for="bookid">BookID</label>
                <input class= "form-control" type="number" name="bookid" value="" id="bookid">
            </div>
            <div class="form-group">
                <label for="bookname">Bookname</label>
                <input type="text" class= "form-control" name="bookname" value="" id="bookname">
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
    <div style="display: flex;flex:7;padding-left:50px;padding-top:100px">
        <?php 
            include "../getdata.php";
            if($_SESSION['admin']){
                echo renderbookslist();
            }else{
                $_SESSION['error'] = "please Login first";
                header("Location: http://localhost:8816/adminlogin.php");
                exit;
            }
        ?>
    </div>
    
</body>
</html>