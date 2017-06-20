<?php
    require 'readFile.php';
    function showAllPosts(){
        $res = readFileToArr("./posts/posts.txt");
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=utf-8");
        header('Access-Control-Allow-Origin:*');
        echo json_encode($res);
    }
    showAllPosts();
?>