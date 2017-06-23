<?php
    function searchAPost(){
        global $id;
        require_once 'readFile.php';
        $tmp = readFileToArr("./posts/posts.txt");
        for($i = 0; $i < count($tmp); $i++){
            if($tmp[$i]['id'] == $id){
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
        echo json_encode($res);
    }
    searchAPost();
?>