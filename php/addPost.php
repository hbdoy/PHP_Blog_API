<?php
    session_start();
    function addAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $data;
            require 'readFile.php';
            $posts_arr = readFileToArr("./posts/posts.txt");
            $authors_arr = readFileToArrNoPass("./authors/authors.txt");
            $author_index = searchAuthorIndexByUsername("./authors/authors.txt", $_SESSION['username']);
            if(!($posts_arr && $authors_arr && ($author_index + 1))){
                echo "檔案無法開啟";
                exit;
            }else{
                $tmp = array(
                    "id" => time(),
                    "title" => htmlspecialchars($data['title']),
                    "content" => htmlspecialchars($data['content']),
                    "created_at" => date("c"),
                    "updated_at" => date("c"),
                    "author" => $authors_arr[$author_index],
                    "tags" => $data["tags"]
                );
                require 'writeFile.php';
                $posts_arr[] = $tmp;
                $res = $tmp;
                writeNewData("./posts/posts.txt", json_encode($posts_arr));
            }
        }else{
            $res = array(
                "message" => "請先登入"
            );
        }
        header("HTTP/1.1 201 Accepted");
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($res);
    }
    addAPost();
?>