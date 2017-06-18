<?php
    function writeNewData($path, $data){
        if(!$fp = fopen($path, "w")){
            return 0;
            exit;
        }else{
            fputs($fp, $data);
        }
        fclose($fp);
        return 1;
    }
?>