<?php
    session_start();
    function addAPost(){
        if(isset($_SESSION['isAdmin'])){
            global $data;
            require_once 'readFile.php';
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
                require_once 'writeFile.php';
                $posts_arr[] = $tmp;
                writeNewData("./posts/posts.txt", json_encode($posts_arr));
                $res = $tmp;
            }else{
                $res = array(
                    "message" => "文章標題、內容、tags格式請填妥"
                );
                http_response_code(400);
            }
        }else{
            $res = array(
                "message" => "請先登入"
            );
            http_response_code(401);
        }
        echo json_encode($res);
    }
    addAPost();
?>