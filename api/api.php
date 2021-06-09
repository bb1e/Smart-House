<?php

	/*não faço a minima ideia se a autenticação dos pedidos https é suposto
		ser algo assim mas dps vejo isso...*/
	function permitions() {  
		if (isset($_SERVER['HTTP_ORIGIN'])){
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: GET, POST");
			header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
			header('Access-Control-Allow-Credentials: true');      
		}  
	}
	permitions();

    header('Content-Type: text/html; charset=utf-8');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['value']) && isset($_POST['name']) && isset($_POST['date'])){
            file_put_contents("files/" . $_POST['name'] . "/value.txt", $_POST['value']);
            file_put_contents("files/" . $_POST['name'] . "/date.txt", $_POST['date']);
            file_put_contents("files/" . $_POST['name'] . "/log.txt", $_POST['date'].';'.$_POST['value'].PHP_EOL, FILE_APPEND);
        }
    }else if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['name'])){
			
            echo file_get_contents("files/" . $_GET['name'] . "/value.txt");
			
        }else{
			
			http_response_code(403);
            echo "not enough parameters";
        }
    }else{
		
		http_response_code(403);
        echo "method denied";
    }
?>