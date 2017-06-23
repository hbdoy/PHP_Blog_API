<?php
    session_start();
    function chkLogin(){
        if(isset($_SESSION['isAdmin'])){
            require_once 'readFile.php';
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
            http_response_code(401);
        }
        echo json_encode($res);
    }
    chkLogin();
?>