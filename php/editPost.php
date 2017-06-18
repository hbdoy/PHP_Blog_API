<?php
    session_start();
    function editAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $id, $data;
            require 'readFile.php';
            $tmp = readFileToArrNoPass("./posts/posts.txt");
            if(!$tmp){
                echo "檔案無法開啟";
                exit;
            }else{
                for($i = 0; $i < count($tmp); $i++){
                    if($tmp[$i]['id'] == $id){
                        $tmp[$i]['title'] = htmlspecialchars($data['title']);
                        $tmp[$i]['content'] = htmlspecialchars($data['content']);
                        $tmp[$i]['tags'] = $data['tags'];
                        $tmp[$i]['updated_at'] = date("c");
                        $res = $tmp[$i];
                        require 'writeFile.php';
                        writeNewData("./posts/posts.txt", json_encode($tmp));
                        break;
                    }
                    $res = array(
                        "message" => "沒有這則文章"
                    );
                }
            }
        }else{
            $res = array(
                "message" => "請先登入"
            );
        }
        header("HTTP/1.1 200 OK");
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($res);
    }
    editAPost();
?>