<?php
    require 'readFile.php';
    function showAllPosts(){
        $res = readFileToArr("./posts/posts.txt");
        if(!$res){
            echo "檔案無法開啟";
            exit;
        }else{
            header("HTTP/1.1 200 OK");
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($res);
        }
    }
    showAllPosts();
?>