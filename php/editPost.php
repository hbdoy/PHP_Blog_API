<?php
    session_start();
    function editAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $id, $data;
            require_once 'readFile.php';
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
                    require_once 'writeFile.php';
                    writeNewData("./posts/posts.txt", json_encode($tmp));
                    $res = $tmp[$i];
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
    editAPost();
?>