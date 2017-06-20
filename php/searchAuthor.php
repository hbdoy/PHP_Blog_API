<?php
    session_start();
    function searchAnAuthor(){
        if(isset($_SESSION['isAdmin'])){
            global $id;
            require 'readFile.php';
            $tmp = readFileToArrNoPass("./authors/authors.txt");
            for($i = 0; $i < count($tmp); $i++){
                if($tmp[$i]['username'] == $id){
                    $res = $tmp[$i];
                    break;
                }
                $res = array(
                    "message" => "沒有這個使用者"
                );
            }
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
    searchAnAuthor();
?>