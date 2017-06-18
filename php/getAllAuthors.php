<?php
    session_start();
    function showAllAuthors(){
        if(isset($_SESSION['isAdmin'])){
            require 'readFile.php';
            $res = readFileToArrNoPass("./authors/authors.txt");
            if(!$res){
                echo "檔案無法開啟";
                exit;
            }
        }else{
            $res = array(
                "message" => "請先登入"
            );
        }
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($res);
    }
    showAllAuthors();
?>