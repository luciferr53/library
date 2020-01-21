<?php
    function renderuserbookslist(){
        include 'connecttodb.php';
        $redis = connecttoredis();
        $data = $redis->hgetall('books');
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px;' ><tr><th>ID</th><th>NAME</th><th>Action</th></tr><tr>";
        foreach($data as $bookid => $bookname){
            $htmlfortable = $htmlfortable."<td>".$bookid."</td><td>".$bookname."</td><td><a href='/issue.php?bookid=".$bookid."'><button class='btn btn-primary'>issue</button></a></td></tr>";
        }
        $htmlfortable = $htmlfortable."</table>";
        return $htmlfortable;
    }

    function renderissuedbooks($userid){
        include 'connecttodb.php';
        $redis = connecttoredis();
        $data = $redis->hgetall("user:".$userid.":books");
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px'><tr><th>Book Name</th><th>Date Of Issue</th></tr><tr>";
        foreach($data as $bookid=>$timestamp){
            $bookname = $redis->hget('books',$bookid);
            $htmlfortable = $htmlfortable."<td>".$bookname."</td><td>".$timestamp."</td></tr>";           
        }  
        return $htmlfortable."</table>";
    }

    function renderbookslist(){
        include 'connecttodb.php';
        $pdo = connecttodb();
        $redis = connecttoredis();
        $data = $redis->hgetall('books');
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px'><tr><th>ID</th><th>Name</th><th>Last Issuers</th><th>Action</th></tr><tr>";
        foreach($data as $bookid => $bookname){  
            $lastusers = getlastissues($bookid,$pdo);         
            $htmlfortable = $htmlfortable."<td>".$bookid."</td><td>".$bookname."</td><td>".$lastusers."</td><td><a href='/admin/deletebook.php?bookid=".$bookid."'><button class='btn btn-danger'>delete</button></a></td></tr>";  
        }
        $htmlfortable."</table>";
        echo $htmlfortable;
    }
    
    function renderissuelist(){
        include 'connecttodb.php';
        $redis = connecttoredis();
        $keys = $redis->keys('user:*:books');
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px'><tr><th>UserName</th><th>BookName</th><th>Date Of Issue</th></tr><tr>";
        foreach($keys as $key){
            $id = explode(':',$key)[1];
            $data = $redis->hgetall($key);
            foreach($data as $bookid=>$timestamp){
                $username = $redis->hget("user:".$id,"username");
                $bookname = $redis->hget("books",$bookid);
                $htmlfortable = $htmlfortable."<td>".$username."</td><td>".$bookname."</td><td>".$timestamp."</td></tr>";   
            }
        }
        $htmlfortable = $htmlfortable."</table>";
        return $htmlfortable;
    }
    function getlastissues($bookid,$pdo){
        
        $stm = $pdo->prepare("SELECT users.username FROM issuedbooks INNER JOIN users ON users.id = issuedbooks.userid AND issuedbooks.bookid = $bookid ORDER BY issuedbooks.doi DESC LIMIT 3");
        $stm->execute();
        $data = $stm->fetchAll();
        $lastusers = "";
        foreach($data as $row){
            $lastusers = $lastusers.$row['username'].",";
        }
        return $lastusers;
    }
    function addbook($bookid,$bookname){
        include "connecttodb.php";
        include 'updateredis.php';
        $pdo = connecttodb();
        try{
        $stm = $pdo->prepare("INSERT INTO books VALUES($bookid,'$bookname')");
        $stm->execute();
        updateall($pdo);
        return true;
        }catch(PDOException $e){
            return false;
        }
    }

    function issue($bookid,$userid){
        include "connecttodb.php";
        include 'updateredis.php';
        $pdo = connecttodb();
        try{
            $stm = $pdo->prepare("INSERT INTO issuedbooks VALUES(null,$userid,$bookid,CURRENT_TIMESTAMP)");
            $stm->execute();
            updateall($pdo);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    function deletebook($bookid){
        include "connecttodb.php";
        include 'updateredis.php';
        try{
            $pdo = connecttodb();
            $stm= $pdo->prepare("DELETE FROM books WHERE id=$bookid");
            $stm->execute();
            updateall($pdo);
            return true;
        }catch(PDOException $e){
            echo "failed";
            return false;

        }

    }
    function adduser($username,$password){
        include 'connecttodb.php';
        include 'updateredis.php';
        try{
            $pdo = connecttodb();
            $id = random_int(101,99999);
            $stm = $pdo->prepare("INSERT INTO users VALUES($id,'$username','$password')");
            $stm->execute();
            updateall($pdo);
            return true;
        }catch(PDOException $e){
            echo "failed";
            return false;
        }
    }

?>    