<?php
    $method = $_SERVER['REQUEST_METHOD'];
    $tmp_str = $_SERVER['REQUEST_URI'];
    $tmp_arr = explode('/', $tmp_str);
	require 'php/methodNotAllowed.php';

    // $tmp_arr[2]起為要的參數
    if(!empty($tmp_arr[2])){
		$type = $tmp_arr[2];

		if($method == "GET"){
			if($type == "posts"){
				if(empty($tmp_arr[3])){
                    if(!(include 'php/getAllPosts.php')){
                        echo "請稍後再試";
                    }
				}else if(!empty($tmp_arr[3]) && is_numeric($tmp_arr[3])){
					$id = $tmp_arr[3];
                    if(!(include 'php/searchPost.php')){
                        echo "請稍後再試";
                    }
				}else{
					showError();
                }
			}else if($type == "authors"){
				if(empty($tmp_arr[3])){
                    if(!(include 'php/getAllAuthors.php')){
                        echo "請稍後再試";
                    }
				}else if(!empty($tmp_arr[3])){
					$id = $tmp_arr[3];
                    if(!(include 'php/searchAuthor.php')){
                        echo "請稍後再試";
                    }
				}
			}else if($type == "login"){
				if(!(include 'php/checkLogin.php')){
                    echo "請稍後再試";
                }
			}else{
				showError();
            }
		}

		else if($method == "POST"){
			$data = json_decode(file_get_contents("php://input"), true);
			if($type == "login"){
                if(!(include 'php/login.php')){
                    echo "請稍後再試";
                }
			}else if($type == "posts"){
                if(!(include 'php/addPost.php')){
                    echo "請稍後再試";
                }
			}else{
				showError();
            }
		}

		else if($method == "PATCH"){
			$data = json_decode(file_get_contents("php://input"), true);
			if($type == "posts"){
				if(!empty($tmp_arr[3])){
					$id = $tmp_arr[3];
					if(!(include 'php/editPost.php')){
                    	echo "請稍後再試";
                	}
				}else{
					showError();
                }
			}else if($type == "authors"){
				if(!empty($tmp_arr[3])){
					$id = $tmp_arr[3];
					if(!(include 'php/editAuthor.php')){
                    	echo "請稍後再試";
                	}
				}else{
					showError();
                }
			}else{
				showError();
            }
		}

		else if($method == "DELETE"){
			if($type == "posts"){
				if(!empty($tmp_arr[3])){
					$id = $tmp_arr[3];
					if(!(include 'php/delPost.php')){
                    	echo "請稍後再試";
                	}
				}else{
					showError();
                }
			}else{
				showError();
            }
		}
	}
    else{
		showError();
    }
?>