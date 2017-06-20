<?php
    session_start();
    function chkLogin(){
        if(isset($_SESSION['isAdmin'])){
            require 'readFile.php';
            $tmp = readFileToArrNoPass("./authors/authors.txt");
            $i = count($tmp) - 1;
            $found = 0;
            while($i >= 0){
                if($_SESSION['username'] == $tmp[$i]["username"]){
                    $found = 1;
                    break;
                }
                $i--;
            }
            if($found){
                $res = $tmp[$i];
            }
        }else{
            $res = array(
                "message" => "沒有登入"
            );
        }
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=utf-8");
        header('Access-Control-Allow-Origin:*');
        echo json_encode($res);
    }
    chkLogin();
?>