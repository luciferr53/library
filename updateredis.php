<?php
    function updatebookslist($redis,$pdo){
        $stm = $pdo->prepare("SELECT *FROM books");
		$stm->execute();
		$data = $stm->fetchall();
		foreach($data as $row){
			$redis->hset("books",$row['id'],$row['name']);
		}
    }
    function updateuserlist($redis,$pdo){
        $stm = $pdo->prepare("SELECT * FROM users");
		$stm->execute();
		$data = $stm->fetchAll();
		foreach($data as $row){
			$redis->hmset("user:".$row['id'],["username"=>$row['username'],"password"=>$row['password']]);
		} 
    }
    function updateissuelist($redis,$pdo){
        $stm = $pdo->prepare("SELECT * FROM issuedbooks");
		$stm->execute();
		$data = $stm->fetchAll();
		foreach($data as $row){
			$redis->hset("user:".$row['userid'].":books",$row['bookid'],$row['doi']);
		}
    }
    function updateall($pdo){
        $redis = new Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->flushAll();
        updatebookslist($redis,$pdo);
        updateissuelist($redis,$pdo);
        updateuserlist($redis,$pdo);
    }
    updateall($pdo = new PDO("mysql:host=localhost;dbname=library","root",'sqlpassword'));
?>