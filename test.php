<?php 
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);
    $data = $redis->hgetall("user:76722:books");
    echo $data['bookid'];
    echo $data['timestamp'];
?>