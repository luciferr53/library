<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="display: flex;flex-direction:row;justify-content:center;background-color:#e3f6f5">
    <div>
    <h1 style="color:#272343;font-weight:900;margin-top:50px;margin-left:50px">User Login</h1>
    
    <?php 
        session_start();
        if($_SESSION['error']){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }else if($_SESSION['msg']){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <div style="max-width:500px;max-height:500px;border-radius:5px;margin-top:50px;padding:50px 50px;background-color:white">
        <form action="/authenticate.php" method="POST">
            <div class="form-group">
                <label for="username">username</label>
                <input class= "form-control" type="text" name="username" value="" id="username">
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" class= "form-control" name="password" value="" id="password">
            </div>
            <button type="submit" class="btn btn-primary">login</button>
        </form>
    </div>
    </div>
</body>
</html>