<?php
	require_once 'php/header.php';
	require_once 'php/methodNotAllowed.php';
	$method = $_SERVER['REQUEST_METHOD'];
    $tmp_str = $_SERVER['REQUEST_URI'];
    $tmp_arr = explode('/', $tmp_str);

    // $tmp_arr[1]起為要的參數
    if(!empty($tmp_arr[1])){
		$type = $tmp_arr[1];

		if($method == "GET"){
			if($type == "posts"){
				if(empty($tmp_arr[2])){
                    require_once 'php/getAllPosts.php';
				}else if(!empty($tmp_arr[2]) && is_numeric($tmp_arr[2])){
					$id = $tmp_arr[2];
                    require_once 'php/searchPost.php';
				}else{
					showError();
                }
			}else if($type == "authors"){
				if(empty($tmp_arr[2])){
                    require_once 'php/getAllAuthors.php';
				}else if(!empty($tmp_arr[2])){
					$id = $tmp_arr[2];
                    require_once 'php/searchAuthor.php';
				}
			}else if($type == "login"){
				require_once 'php/checkLogin.php';
			}else{
				showError();
            }
		}

		else if($method == "POST"){
			$data = json_decode(file_get_contents("php://input"), true);
			if($type == "login"){
                require_once 'php/login.php';
			}else if($type == "posts"){
                require_once 'php/addPost.php';
			}else{
				showError();
            }
		}

		else if($method == "PATCH"){
			$data = json_decode(file_get_contents("php://input"), true);
			if($type == "posts"){
				if(!empty($tmp_arr[2])){
					$id = $tmp_arr[2];
					require_once 'php/editPost.php';
				}else{
					showError();
                }
			}else if($type == "authors"){
				if(!empty($tmp_arr[2])){
					$id = $tmp_arr[2];
					require_once 'php/editAuthor.php';
				}else{
					showError();
                }
			}else{
				showError();
            }
		}

		else if($method == "DELETE"){
			if($type == "posts"){
				if(!empty($tmp_arr[2])){
					$id = $tmp_arr[2];
					require_once 'php/delPost.php';
				}else{
					showError();
                }
			}else{
				showError();
            }
		}

		else if($method == "OPTIONS"){
			if(isset($reqArr['Access-Control-Request-Headers'])){
				header("Access-Control-Allow-Headers: {$reqArr['Access-Control-Request-Headers']}");
			}else{
				header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
			}
		}
	}
    else{
		showError();
    }
?>