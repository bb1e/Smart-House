<?php 
/*esta é a api que eu tinha experimentado fazer para a base de dados
	mas dava erro no rester*/
	
	include("connection.php");
    
	
    if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$name = $_POST['name'];
		$value = $_POST['value'];
		$date = $_POST['date'];
		$log = $_POST['date'].';'.$_POST['value'];
		
        if(isset($_POST['value']) && isset($_POST['name']) && isset($_POST['date'])){
			
			$query = "insert into db_values (name,value,date,log) values ('$name','$value','$date', '$log')";
            mysqli_query($con, $query);
        }
    }else if($_SERVER['REQUEST_METHOD']=='GET'){
		
		$name = $_GET['name'];
		
        if(isset($_GET['name'])){
			
			$query = "select * from db_values where name = '$name' limit 1";
			$result = mysqli_query($con, $query);
            
        }else{
            echo "not enough parameters";
        }
    }else{
        echo "method denied";
    }
?>