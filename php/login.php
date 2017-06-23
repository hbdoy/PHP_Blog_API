<?php
    function login(){
        require_once 'readFile.php';
        // 要注意全域變數問題
        global $data;
        $tmp = readFileToArr("./authors/authors.txt");
        $i = count($tmp) - 1;
        $found = 0;
        while($i >= 0){
            if($data["username"] == $tmp[$i]["username"]){
                $found = 1;
                break;
            }
            $i--;
        }
        if($found && $data["password"] == $tmp[$i]["password"]){
            // echo "登入成功!";
            $msg = $tmp[$i];
            session_start();
            $_SESSION['isAdmin'] = true;
            $_SESSION['username'] = $tmp[$i]["username"];
            $_SESSION['isAdmin'] = $tmp[$i]["name"];
            // setcookie("username", $tmp[$i]["username"]);
            // setcookie("name", $tmp[$i]["name"]);
        }else{
            // echo "帳號或密碼錯誤!";
            $msg = array(
                "message" => "帳號或密碼錯誤"
            );
            http_response_code(401);
        }
        $res = json_encode($msg);
        echo $res;
    }
    login();
?>