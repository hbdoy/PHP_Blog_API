<?php
    $reqArr = apache_request_headers();
    http_response_code();
    header("Content-Type: application/json; charset=utf-8");
    if(isset($reqArr['Origin'])){
        header("Access-Control-Allow-Origin: {$reqArr['Origin']}");
    }else{
        header("Access-Control-Allow-Origin: *");
    }
    header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
?>