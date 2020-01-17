<?php
    function connecttodb(){
        $host = 'localhost';
        $dbname = "library";
        $username = "root";
        $password = "sqlpassword";
        $pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $pdo;
    }

?>