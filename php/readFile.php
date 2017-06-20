<?php
    function readFileToArr($path){
        $pf = fopen($path, "r") or die('檔案無法開啟');
        $content = "";
        while(!feof($pf)) {
            // 拿掉空白和換行(CRLF)
            $content .= trim(fgets($pf));
        }
        fclose($pf);
        $res = json_decode($content, true);
        return $res;
    }
    function readFileToArrNoPass($path){
        $res = readFileToArr($path);
        for($i = 0; $i < count($res); $i++){
            unset($res[$i]['password']);
            unset($res[$i]['author']['password']);
        }
        return $res;
    }
    function searchAuthorIndexByUsername($path, $username){
        $res = readFileToArr($path);
        for($i = 0; $i < count($res); $i++){
            if($res[$i]['username'] == $username){
                break;
            }
        }
        return $i;
    }
    // readFileToArr($path);
?>