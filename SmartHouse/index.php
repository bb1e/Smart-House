<?php
    $username="Bruna"; 
    $password="12345"; 
	$username2="Rafael";
    $password2="54321";
    session_start();
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
            <?php
                if(isset($_POST['username']) && isset($_POST['password'])){
                    if(($_POST['username']==$username || $_POST['username']==$username2) && $_POST['password']==$password || $_POST['password']==$password2){
                        $_SESSION["username"]=$_POST['username'];
                        echo '
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Redirecting...
                    </div>';
                    header("refresh:5;url=dashboard.php");
                    }else{
                        echo '
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Authentication failed!
                        </div>';
                    }
                    
                }
            ?>
			<br><br>
            <div class="row">
                <div class="col-sm-4 offset offset-sm-4">
                    <form method="POST">
                        <div class="wrap-login">
                          <a style="text-align: center"><img src="imgs/logo.png" alt="logo" class="loginlogo"></a>              
                        <div class="form-group">
                        <input type="text" class="form-control" id="usr" name="username" placeholder="USERNAME" required style="background-color: transparent">
                        </div>
                        <div class="form-group">
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="PASSWORD" required style="background-color: transparent">
                        </div>
                        <button type="submit" name="submit" class="login-form-btn">LOGIN</button>
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