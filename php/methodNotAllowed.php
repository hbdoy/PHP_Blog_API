<?php
    function showError(){
        header("HTTP/1.1 405 Method Not Allowed");
        header("Content-type: application/json; charset=utf-8");
        header('Access-Control-Allow-Origin:*');
		$res = array(
			"message" => "Method Not Allowed"
		);
		echo json_encode($res);
    }
    // showError();
?>