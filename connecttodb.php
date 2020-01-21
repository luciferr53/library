<?php
    function connecttodb(){
        $host = 'localhost';
        $dbname = "library";
        $username = "root";
        $password = "sqlpassword";
        $pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $pdo;
    }
    function connecttoredis(){
        $redis = new Redis();
        $redis->connect("127.0.0.1",6379);
        return $redis;
    }
?>