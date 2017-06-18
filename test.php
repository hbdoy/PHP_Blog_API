<?php
    $method = $_SERVER['REQUEST_METHOD'];
    // echo "Your method is $method<br>";
    $tmp_str = $_SERVER['REQUEST_URI'];
    $tmp_arr = explode('/', $tmp_str);
    // echo $tmp_str."<br>";
    // print_r($tmp_arr);
    // echo "<br>";

    // $tmp_arr[3]起為要的參數
    if(!empty($tmp_arr[3])){
		$type = $tmp_arr[3];

		if($method == "GET"){
			if($type == "posts"){
				if(empty($tmp_arr[4])){
					// echo "You need All Posts!<br>";
                    if(!(include 'php/getAllPosts.php')){
                        echo "請稍後再試";
                    }
				}else if(!empty($tmp_arr[4]) && is_numeric($tmp_arr[4])){
					$id = $tmp_arr[4];
					// echo "You need a post in $id!<br>";
                    if(!(include 'php/searchPost.php')){
                        echo "請稍後再試";
                    }
				}else{
                    echo "Method Not Allowed<br>";
                }
			}else if($type == "authors"){
				if(empty($tmp_arr[4])){
					// echo "You need All authors!<br>";
                    if(!(include 'php/getAllAuthors.php')){
                        echo "請稍後再試";
                    }
				}else if(!empty($tmp_arr[4])){
					$id = $tmp_arr[4];
					// echo "You need an author in $id!<br>";
                    if(!(include 'php/searchAuthor.php')){
                        echo "請稍後再試";
                    }
				}
			}else{
                echo "Method Not Allowed";
            }
		}

		else if($method == "POST"){
			$data = json_decode(file_get_contents("php://input"), true);
			// print_r($data);
			if($type == "login"){
				// echo "You need login!<br>";
                if(!(include 'php/login.php')){
                    echo "請稍後再試";
                }
			}else if($type == "posts"){
				// echo "You need create a new post!<br>";
                if(!(include 'php/addPost.php')){
                    echo "請稍後再試";
                }
			}else{
                echo "Method Not Allowed";
            }
		}

		else if($method == "PATCH"){
			$data = json_decode(file_get_contents("php://input"), true);
			if($type == "posts"){
				if(!empty($tmp_arr[4])){
					$id = $tmp_arr[4];
					// echo "You need patch a post in $id!<br>";
					if(!(include 'php/editPost.php')){
                    	echo "請稍後再試";
                	}
				}else{
                    echo "Method Not Allowed";
                }
			}else if($type == "authors"){
				if(!empty($tmp_arr[4])){
					$id = $tmp_arr[4];
					// echo "You need patch an author in $id!<br>";
					if(!(include 'php/editAuthor.php')){
                    	echo "請稍後再試";
                	}
				}else{
                    echo "Method Not Allowed";
                }
			}else{
                echo "Method Not Allowed";
            }
		}

		else if($method == "DELETE"){
			if($type == "posts"){
				if(!empty($tmp_arr[4])){
					$id = $tmp_arr[4];
					// echo "You need delete a post in $id!<br>";
					if(!(include 'php/delPost.php')){
                    	echo "請稍後再試";
                	}
				}else{
                    echo "Method Not Allowed";
                }
			}else{
                echo "Method Not Allowed";
            }
		}
	}
    else{
        echo "Method Not Allowed";
    }
?>