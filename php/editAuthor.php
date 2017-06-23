<?php
    session_start();
    function editAnAuthor(){
        if(isset($_SESSION['isAdmin'])){
            global $id, $data;
            require_once 'readFile.php';
            $tmp = readFileToArr("./authors/authors.txt");
            for($i = 0; $i < count($tmp); $i++){
                if($tmp[$i]['username'] == $id){
                    foreach($data as $key => $value){
                        if(!empty($value)){
                            switch($key){
                                case 'password':
                                    $tmp[$i]['password'] = htmlspecialchars($value);
                                    break;
                                case 'name':
                                    $tmp[$i]['name'] = htmlspecialchars($value);
                                    break;
                                case 'gender':
                                    $tmp[$i]['gender'] = htmlspecialchars($value);
                                    break;
                                case 'address':
                                    $tmp[$i]['address'] = htmlspecialchars($value);
                                    break;
                            }
                        }
                    }
                    // 寫入檔案保存
                    require_once 'writeFile.php';
                    writeNewData("./authors/authors.txt", json_encode($tmp));
                    // 不顯示密碼
                    unset($tmp[$i]['password']);
                    $res = $tmp[$i];
                    break;
                }
                $res = array(
                    "message" => "沒有這個使用者"
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
    editAnAuthor();
?>