<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password']; 

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			
			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					/*verifica se a password digitada é igual ao código 
					  encriptado q está na base de dados*/
					if(password_verify($password, $user_data['password']) && $user_data['privileges'] == "user")
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: dashboard.php");
						die;
					
					}else if(password_verify($password, $user_data['password']) && $user_data['privileges'] == "visitor")
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: dashvisitor.php");
						die;
					
					}else if(password_verify($password, $user_data['password']) && $user_data['privileges'] == "admin")
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: dashadmin.php");
						die;
						
					}else{
						
						echo '<div class="alert alert-danger" ;style="text-align:center">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<center>Wrong username or password!
								</div>';
					}
				}
			}
			
			
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Page</title>
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
						
                        <button type="submit" name="submit" class="login-form-btn">LOGIN</button>
						<br>
						<a href="signup.php">Click to Signup</a><br><br>
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