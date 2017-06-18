<?php
    function searchAPost(){
        global $id;
        require 'readFile.php';
        $tmp = readFileToArr("./posts/posts.txt");
        if(!$tmp){
            echo "檔案無法開啟";
            exit;
        }else{
            for($i = 0; $i < count($tmp); $i++){
                if($tmp[$i]['id'] == $id){
                    $res = $tmp[$i];
                    break;
                }
                $res = array(
                    "message" => "沒有這則文章"
                );
            }
        }
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($res);
    }
    searchAPost();
?>