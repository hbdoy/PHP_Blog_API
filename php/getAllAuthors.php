<?php
    session_start();
    function showAllAuthors(){
        if(isset($_SESSION['isAdmin'])){
            require_once 'readFile.php';
            $res = readFileToArrNoPass("./authors/authors.txt");
        }else{
            $res = array(
                "message" => "請先登入"
            );
            http_response_code(401);
        }
        echo json_encode($res);
    }
    showAllAuthors();
?>