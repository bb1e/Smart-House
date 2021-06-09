<!DOCTYPE html>
<?php

header('Content-Type: text/html; charset=utf-8');
// Check if image file is a actual image or fake image
if($_SERVER['REQUEST_METHOD']== "POST"){
	echo "POSTeeeee";														//Não está a guardar a imagem
	if(isset($_FILES['file'])){
		print_r($_FILES);
		echo ("".$_FILES["file"]["name"].PHP_EOL);
		echo ("".$_FILES["file"]["size"].PHP_EOL);
		echo ("".$_FILES["file"]["tmp_name"].PHP_EOL);
		move_uploaded_file($_FILES["file"]["tmp_name"],"imgs/webcam.jpg");
	}
	
	else if(isset($_FILES['imagem'])) {
		echo "POST";
		echo ("".$_FILES["imagem"]["name"].PHP_EOL);
		echo ("".$_FILES["imagem"]["size"].PHP_EOL);
		echo ("".$_FILES["imagem"]["tmp_name"].PHP_EOL);
		
		move_uploaded_file($_FILES["imagem"]["tmp_name"],"imgs/webcam.png");
	  
	}else{
		
		echo ("Erro nos dados enviados");
	}
	
}



?>
 

