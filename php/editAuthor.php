<?php
    session_start();
    function editAnAuthor(){
        if(isset($_SESSION['isAdmin'])){
            global $id, $data;
            require 'readFile.php';
            $tmp = readFileToArr("./authors/authors.txt");
            if(!$tmp){
                echo "檔案無法開啟";
                exit;
            }else{
                for($i = 0; $i < count($tmp); $i++){
                    if($tmp[$i]['username'] == $id){
                        $tmp[$i]['password'] = htmlspecialchars($data['password']);
                        $tmp[$i]['name'] = htmlspecialchars($data['name']);
                        $tmp[$i]['gender'] = htmlspecialchars($data['gender']);
                        $tmp[$i]['address'] = htmlspecialchars($data['address']);
                        require 'writeFile.php';
                        writeNewData("./authors/authors.txt", json_encode($tmp));
                        unset($tmp[$i]['password']);
                        $res = $tmp[$i];
                        break;
                    }
                    $res = array(
                        "message" => "沒有這個使用者"
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
    editAnAuthor();
?>