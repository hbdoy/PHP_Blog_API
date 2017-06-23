<?php
    session_start();
    function delAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $id;
            require_once 'readFile.php';
            $tmp = readFileToArr("./posts/posts.txt");
            for($i = 0; $i < count($tmp); $i++){
                if($tmp[$i]['id'] == $id){
                    unset($tmp[$i]);
                    // 重整陣列順序
                    $new = array_values($tmp);
                    require_once 'writeFile.php';
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
    delAPost();
?>