<?php
    session_start();
    function delAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $id;
            require 'readFile.php';
            $tmp = readFileToArr("./posts/posts.txt");
            for($i = 0; $i < count($tmp); $i++){
                if($tmp[$i]['id'] == $id){
                    unset($tmp[$i]);
                    // 重整陣列順序
                    $new = array_values($tmp);
                    require 'writeFile.php';
                    writeNewData("./posts/posts.txt", json_encode($new));
                    $res = array(
                        "remain" => count($new)
                    );
                    break;
                }
                $res = array(
                    "message" => "沒有這則文章"
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
    delAPost();
?>