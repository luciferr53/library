<?php
    function renderuserbookslist(){
        include 'connecttodb.php';
        $pdo = connecttodb();
        $stm = $pdo->prepare("SELECT * FROM books");
        $stm->execute();
        $data = $stm->fetchAll();
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px;' ><tr><th>ID</th><th>NAME</th><th>Action</th></tr><tr>";
        foreach($data as $book){
            $htmlfortable = $htmlfortable."<td>".$book['id']."</td><td>".$book['name']."</td><td><a href='/issue.php?bookid=".$book['id']."'><button class='btn btn-primary'>issue</button></a></td></tr>";
        }
        $htmlfortable = $htmlfortable."</table>";
        return $htmlfortable;
    }

    function renderissuedbooks($userid){
        include 'connecttodb.php';
        $pdo = connecttodb();
        $stm = $pdo->prepare("SELECT issuedbooks.doi,books.name FROM issuedbooks INNER JOIN books ON books.id=issuedbooks.bookid AND issuedbooks.userid='$userid'");
        $stm->execute();
        $data = $stm->fetchAll();
       
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px'><tr><th>Book Name</th><th>Date Of Issue</th></tr><tr>";
        foreach($data as $row){
            
            $htmlfortable = $htmlfortable."<td>".$row['name']."</td><td>".$row['doi']."</td></tr>";
            
        }
        
        return $htmlfortable;
    }

    function renderbookslist(){
        include 'connecttodb.php';
        $pdo = connecttodb();
        $stm = $pdo->prepare("SELECT * FROM books");
        $stm->execute();
        $data = $stm->fetchAll();
       
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px'><tr><th>ID</th><th>Name</th><th>Action</th></tr><tr>";
        foreach($data as $row){            
            $htmlfortable = $htmlfortable."<td>".$row['id']."</td><td>".$row['name']."</td><td><a href='/admin/deletebook.php?bookid=".$row['id']."'><button class='btn btn-danger'>delete</button></a></td></tr>";
            
        }
        
        return $htmlfortable;
    }
    
    function renderissuelist(){
        include 'connecttodb.php';
        $pdo = connecttodb();
        $stm = $pdo->prepare("SELECT users.username AS username,books.name AS bookname,issuedbooks.doi FROM issuedbooks INNER JOIN users ON issuedbooks.userid=users.id INNER JOIN books ON issuedbooks.bookid=books.id");
        $stm->execute();
        $data = $stm->fetchAll();
        $htmlfortable = "<table class='table table-dark table-bordered;margin-right:50px'><tr><th>UserName</th><th>BookName</th><th>Date Of Issue</th></tr><tr>";
        foreach($data as $row){            
            $htmlfortable = $htmlfortable."<td>".$row['username']."</td><td>".$row['bookname']."</td><td>".$row['doi']."</td></tr>";
            
        }
        $htmlfortable = $htmlfortable."</table>";
        return $htmlfortable;
    }

    function addbook($bookid,$bookname){
        include "connecttodb.php";
        $pdo = connecttodb();
        try{
        $stm = $pdo->prepare("INSERT INTO books VALUES($bookid,'$bookname')");
        $stm->execute();
        return true;
        }catch(PDOException $e){
            return false;
        }
    }

    function issue($bookid,$userid){
        include "connecttodb.php";
        $pdo = connecttodb();
        $date = new DateTime();
        $timestamp = $date->getTimestamp();

        try{
            $stm = $pdo->prepare("INSERT INTO issuedbooks VALUES(null,$userid,$bookid,CURRENT_TIMESTAMP)");
            $stm->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    function deletebook($bookid){
        include "connecttodb.php";
        try{
            $pdo = connecttodb();
            $stm= $pdo->prepare("DELETE FROM books WHERE id=$bookid");
            $stm->execute();
            echo "success";
            return true;
        }catch(PDOException $e){
            echo "failed";
            return false;

        }

    }
    function adduser($username,$password){
        include 'connecttodb.php';
        try{
            $pdo = connecttodb();
            $id = random_int(101,99999);
            $stm = $pdo->prepare("INSERT INTO users VALUES($id,'$username','$password')");
            $stm->execute();
            echo "success";
            return true;
        }catch(PDOException $e){
            echo "failed";
            return false;
        }
    }
?>
