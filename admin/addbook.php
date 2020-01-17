<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Book</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="display: flex;flex-direction:row;justify-content:center;background-color:#e3f6f5">
    <div>
    <h1 style="color:#272343;font-weight:900;margin-top:50px;margin-left:50px">Add Book</h1>

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
    <div style="max-width:500px;max-height:500px;border-radius:5px;margin-top:50px;padding:50px 50px;background-color:white">
        <form action="/admin/addbook.php" method="POST">
            <div class="form-group">
                <label for="bookid">Book ID</label>
                <input class= "form-control" type="number" name="bookid" value="" id="bookid">
            </div>
            <div class="form-group">
                <label for="bookname">Book Name</label>
                <input type="text" class= "form-control" name="bookname" value="" id="bookname">
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
    </div>
</body>
</html>