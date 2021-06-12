<?php
//verificação se existe um usuário logado
session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);

?>



<?php
	//get valores
	$value_coffee = file_get_contents("api/files/coffee/value.txt");
	$value_ac = file_get_contents("api/files/ac/value.txt");
	$value_heater = file_get_contents("api/files/heater/value.txt");
	$value_blinds = file_get_contents("api/files/blinds/value.txt");
	$value_garagedoor = file_get_contents("api/files/garagedoor/value.txt");
	$value_grass = file_get_contents("api/files/grass/value.txt");
	$value_inside = file_get_contents("api/files/inside/value.txt");
	$value_outside = file_get_contents("api/files/outside/value.txt");
	$value_speaker = file_get_contents("api/files/speaker/value.txt");

?>

<?php
	/* validação dos posts de cada botão sempre que é ativado
		é escrito no ficheiro o valor contrário ao q ele 
		apresenta na altura tornando operacional a função
		on/off */
		
	if(isset($_POST['coffee']) && $value_coffee == 0){
		file_put_contents("api/files/coffee/value.txt", 1);
	}else if(isset($_POST['coffee']) && $value_coffee == 1){
		file_put_contents("api/files/coffee/value.txt", 0);
	}
	
	if(isset($_POST['ac']) && $value_ac == 0){
		file_put_contents("api/files/ac/value.txt", 1);
	}else if(isset($_POST['ac']) && $value_ac == 1){
		file_put_contents("api/files/ac/value.txt", 0);
	}
	
	if(isset($_POST['heater']) && $value_heater == 0){
		file_put_contents("api/files/heater/value.txt", 1);
	}else if(isset($_POST['heater']) && $value_heater == 1){
		file_put_contents("api/files/heater/value.txt", 0);
	}
	
	if(isset($_POST['blinds']) && $value_blinds == 0){
		file_put_contents("api/files/blinds/value.txt", 1);
	}else if(isset($_POST['blinds']) && $value_blinds == 1){
		file_put_contents("api/files/blinds/value.txt", 0);
	}
	
	if(isset($_POST['garagedoor']) && $value_garagedoor == 0){
		file_put_contents("api/files/garagedoor/value.txt", 1);
	}else if(isset($_POST['garagedoor']) && $value_garagedoor == 1){
		file_put_contents("api/files/garagedoor/value.txt", 0);
	}
	
	if(isset($_POST['grass']) && $value_grass == 0){
		file_put_contents("api/files/grass/value.txt", 1);
	}else if(isset($_POST['grass']) && $value_grass == 1){
		file_put_contents("api/files/grass/value.txt", 0);
	}
	
	if(isset($_POST['inside']) && $value_inside == 0){
		file_put_contents("api/files/inside/value.txt", 1);
	}else if(isset($_POST['inside']) && $value_inside == 1){
		file_put_contents("api/files/inside/value.txt", 0);
	}
	
	if(isset($_POST['outside']) && $value_outside == 0){
		file_put_contents("api/files/outside/value.txt", 1);
	}else if(isset($_POST['outside']) && $value_outside == 1){
		file_put_contents("api/files/outside/value.txt", 0);
	}
	
	if(isset($_POST['speaker']) && $value_speaker == 0){
		file_put_contents("api/files/speaker/value.txt", 1);
	}else if(isset($_POST['speaker']) && $value_speaker == 1){
		file_put_contents("api/files/speaker/value.txt", 0);
	}

?>


<?php
	//volta a ler os dados para impedir que haja erros
	$value_coffee = file_get_contents("api/files/coffee/value.txt");
	$value_ac = file_get_contents("api/files/ac/value.txt");
	$value_heater = file_get_contents("api/files/heater/value.txt");
	$value_blinds = file_get_contents("api/files/blinds/value.txt");
	$value_garagedoor = file_get_contents("api/files/garagedoor/value.txt");
	$value_grass = file_get_contents("api/files/grass/value.txt");
	$value_inside = file_get_contents("api/files/inside/value.txt");
	$value_outside = file_get_contents("api/files/outside/value.txt");
	$value_speaker = file_get_contents("api/files/speaker/value.txt");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="58">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
	<link href="style.css" rel="stylesheet">
	<link href="button.css" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Smart Objects</title>
</head>
<body>
	<!-- sidebar -->
	 <div class="sidebar">
    <div class="logo_content">
      <div class="logo">
        <i class='bx bx-home-heart' ></i>
        <div class="logo_name">Smart House</div>
      </div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav_list">
      <li>
        <a href="dashadmin.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="smartobjectsadmin.php">
          <i class='bx bx-coffee'></i>
          <span class="links_name">Smart Objects</span>
        </a>
		<span class="tooltip">Smart Objects</span>
      </li>
      <li>
        <a href="historyadmin.php">
          <i class='bx bx-archive-in' ></i>
          <span class="links_name">History</span>
        </a>
		<span class="tooltip">History</span>
      </li>
      <li>
        <a href="analyticsadmin.php">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="links_name">Analytics</span>
        </a>
		<span class="tooltip">Analytics</span>
      </li>
	  <li>
        <a href="picturesadmin.php">
          <i class='bx bx-photo-album'></i>
          <span class="links_name">Pictures</span>
        </a>
		<span class="tooltip">Pictures</span>
      </li>
	  <li>
        <a href="adminspace.php">
          <i class='bx bx-user'></i>
          <span class="links_name">Admin Space</span>
        </a>
		<span class="tooltip">Admin Space</span>
      </li>
    </ul>
      <div class="logout">
		<div>
	    <a href="logout.php">
        <i class='bx bx-log-out' id="log_out" ></i>
		</a>
		<span class="tooltip">Logout</span>
		</div>
      </div>
  </div>
	<!-- fim da sidebar -->
  
	<div class="home_content">
	
	<!-- é aqui que o utilizador vai interagir com objetos do cisco
		 de maneira "automática" -->

		<div class="row">
			<div class="col-sm-12">
				<video autoplay loop>  
					<source src="imgs/header.mp4" type="video/mp4">
				</video>
			</div>
		</div>
		<br>
		<form method="POST">
		<div class="container">
        <div class="row">
			<div class="col-sm-4">
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/coffee.png" alt="coffee image" class="icons">
						<div>
						<?php
						/*consoante o dispositivo estiver ligado ou desligado
						 escolhe o botão mais indicado - vai ser igual para
						 os restantes botões */
						if($value_coffee == 0){
							echo '<button type="input" type="submit" name="coffee" class="btn btn-outline-danger">off</button>';	
						}else if($value_coffee == 1){
							echo '<button type="input" type="submit" name="coffee" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
				<br><br>
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/blinds.png" alt="blinds image" class="icons">
						<div>
						<?php
						if($value_blinds == 0){
							echo '<button type="input" type="submit" name="blinds" class="btn btn-outline-danger">off</button>';	
						}else if($value_blinds == 1){
							echo '<button type="input" type="submit" name="blinds" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
				<br><br>
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/outside.png" alt="outside lamp image" class="icons">
						<div>
						<?php
						if($value_outside == 0){
							echo '<button type="input" type="submit" name="outside" class="btn btn-outline-danger">off</button>';	
						}else if($value_outside == 1){
							echo '<button type="input" type="submit" name="outside" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>				
			</div>
			<div class="col-sm-4">
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/ac.png" alt="ac image" class="icons">
						<div>
						<?php
						if($value_ac == 0){
							echo '<button type="input" type="submit" name="ac" class="btn btn-outline-danger">off</button>';	
						}else if($value_ac == 1){
							echo '<button type="input" type="submit" name="ac" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
				<br><br>
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/inside.png" alt="inside light image" class="icons">
						<div>
						<?php
						if($value_inside == 0){
							echo '<button type="input" type="submit" name="inside" class="btn btn-outline-danger">off</button>';	
						}else if($value_inside == 1){
							echo '<button type="input" type="submit" name="inside" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
				</div>
				<br><br>
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/garagedoor.png" alt="garage door image" class="icons">
						<div>
						<?php
						if($value_garagedoor == 0){
							echo '<button type="input" type="submit" name="garagedoor" class="btn btn-outline-danger">off</button>';	
						}else if($value_garagedoor == 1){
							echo '<button type="input" type="submit" name="garagedoor" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
			</div>
			<div class="col-sm-4">
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/heater.png" alt="heater image" class="icons">
						<div>
						<?php
						if($value_heater == 0){
							echo '<button type="input" type="submit" name="heater" class="btn btn-outline-danger">off</button>';	
						}else if($value_heater == 1){
							echo '<button type="input" type="submit" name="heater" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
				<br><br>
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/speaker.png" alt="speaker image" class="icons">
						<div>
						<?php
						if($value_speaker == 0){
							echo '<button type="input" type="submit" name="speaker" class="btn btn-outline-danger">off</button>';	
						}else if($value_speaker == 1){
							echo '<button type="input" type="submit" name="speaker" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
				<br><br>
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/grass.png" alt="grass image" class="icons">
						<div>
						<?php
						if($value_grass == 0){
							echo '<button type="input" type="submit" name="grass" class="btn btn-outline-danger">off</button>';	
						}else if($value_grass == 1){
							echo '<button type="input" type="submit" name="grass" class="btn btn-outline-success">on</button>';
						}
						?>
						</div>
					</div>
                </div>
			</div>
			<div class="col-sm-12">
			<br><br><br>
				<div class="card text-center cardcolor">
					<p><br><i class='bx bx-coffee'></i>Let us do everything while you drink a coffee<i class='bx bx-coffee'></i></p>
				</div>
			</div>
		</div>
		</div>
		</form>
	
	</div>
	<script>
	//código js da sidebar
   let btn = document.querySelector("#btn");
   let sidebar = document.querySelector(".sidebar");

   btn.onclick = function() {
     sidebar.classList.toggle("active");
     if(btn.classList.contains("bx-menu")){
       btn.classList.replace("bx-menu" , "bx-menu-alt-right");
     }else{
       btn.classList.replace("bx-menu-alt-right", "bx-menu");
     }
   }

  </script>


    <!--SCRIPTS-->
	<script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>