<?php
    session_start();
    function showAllAuthors(){
        if(isset($_SESSION['isAdmin'])){
            require 'readFile.php';
            $res = readFileToArrNoPass("./authors/authors.txt");
        }else{
            $res = array(
                "message" => "請先登入"
            );
        }
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=utf-8");
        header('Access-Control-Allow-Origin:*');
        echo json_encode($res);
    }
    showAllAuthors();
?>