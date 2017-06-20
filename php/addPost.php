<?php
    session_start();
    function addAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $data;
            require 'readFile.php';
            $posts_arr = readFileToArr("./posts/posts.txt");
            $authors_arr = readFileToArrNoPass("./authors/authors.txt");
            $author_index = searchAuthorIndexByUsername("./authors/authors.txt", $_SESSION['username']);
            // 任一為空就不接受
            if(!(empty($data['title']) || empty($data['content']) || gettype($data['tags']) != 'array')){
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
                writeNewData("./posts/posts.txt", json_encode($posts_arr));
                $res = $tmp;
            }else{
                $res = array(
                    "message" => "文章標題、內容、tags格式請填妥"
                );
            }
        }else{
            $res = array(
                "message" => "請先登入"
            );
        }
        header("HTTP/1.1 201 Accepted");
        header("Content-Type: application/json; charset=utf-8");
        header('Access-Control-Allow-Origin:*');
        echo json_encode($res);
    }
    addAPost();
?>