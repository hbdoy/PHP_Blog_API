<?php
    function writeNewData($path, $data){
        $fp = fopen($path, "w") or die("檔案無法開啟");
        fputs($fp, $data);
        fclose($fp);
        return 1;
    }
?>