<?php
    session_start();
    function editAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $id, $data;
            require 'readFile.php';
            $tmp = readFileToArrNoPass("./posts/posts.txt");
            for($i = 0; $i < count($tmp); $i++){
                if($tmp[$i]['id'] == $id){
                    foreach($data as $key => $value){
                        if(!empty($value)){
                            switch($key){
                                case 'title':
                                    $tmp[$i]['title'] = htmlspecialchars($data['title']);
                                    break;
                                case 'content':
                                    $tmp[$i]['content'] = htmlspecialchars($data['content']);
                                    break;
                            }
                        }
                    }
                    if(gettype($data['tags']) == "array"){
                        $tmp[$i]['tags'] = $data['tags'];
                    }
                    $tmp[$i]['updated_at'] = date("c");
                    require 'writeFile.php';
                    writeNewData("./posts/posts.txt", json_encode($tmp));
                    $res = $tmp[$i];
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
    editAPost();
?>