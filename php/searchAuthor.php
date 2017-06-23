<?php
    session_start();
    function searchAnAuthor(){
        if(isset($_SESSION['isAdmin'])){
            global $id;
            require_once 'readFile.php';
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
            if(isset($res['message'])){
                http_response_code(404);
            }
        }else{
            $res = array(
                "message" => "請先登入"
            );
            http_response_code(401);
        }
        echo json_encode($res);
    }
    searchAnAuthor();
?>