<?php
    function showError(){
		$res = array(
			"message" => "Method Not Allowed"
		);
		http_response_code(405);
		echo json_encode($res);
    }
    // showError();
?>