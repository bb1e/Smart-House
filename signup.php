<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password))
		{
			/*função para encriptar a password inserida pelo utilizador
			de forma a garantir uma melhor segurança de dados*/
			$hashpassword = password_hash($password, PASSWORD_DEFAULT);
			
			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password,privileges) values ('$user_id','$user_name','$hashpassword','user')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "error";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signup Page</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
        <link href="style.css" rel="stylesheet">
    </head>
    <body class="wall">

		<video autoplay loop class="bg_video"> 
			<source src="imgs/background.mp4" type="video/mp4">
		</video>	
        <div class="container">
			<br><br>
            <div class="row">
                <div class="col-sm-4 offset offset-sm-4">
                    <form method="POST">
                        <div class="wrap-login">
                          <a style="text-align: center"><img src="imgs/logo.png" alt="logo" class="loginlogo"></a>              
                        <div class="form-group">
                        <input type="text" class="form-control" id="usr" name="user_name" placeholder="USERNAME" Required style="background-color: transparent">
                        </div>
                        <div class="form-group">
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="PASSWORD" Required style="background-color: transparent">
                        </div>
						
                        <button type="submit" name="submit" class="login-form-btn">SIGNUP</button>
						<br>
						<a href="login.php">Click to Login</a><br><br>
						</div>
                    </form>
                </div>
			</div> 
        </div>

       
        <!--SCRIPTS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>