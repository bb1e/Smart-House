<?php
//verificação se existe um usuário logado
session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
	//acesso apenas ao privilégio admin
	if($user_data['privileges'] != "admin"){
		die("acess denied");
	}

?>



<?php
	//get valores
	
	$value_door = file_get_contents("api/files/door/value.txt");
	$value_window = file_get_contents("api/files/window/value.txt");
	$value_garagedoor = file_get_contents("api/files/garagedoor/value.txt");
	$value_lamp = file_get_contents("api/files/lamp/value.txt");
	$value_fan = file_get_contents("api/files/fan/value.txt");

?>

<?php
	/* validação dos posts de cada botão sempre que é ativado
		é escrito no ficheiro o valor contrário ao q ele 
		apresenta na altura tornando operacional a função
		on/off */
	
	//fan
	if(isset($_POST['fan']) && $value_fan == 0){  //há um post e a fan está desligada
		file_put_contents("api/files/fan/value.txt", 2); //envia o valor ligada para a ligar
	}else if(isset($_POST['fan']) && $value_fan == 2){ //vice versa
		file_put_contents("api/files/fan/value.txt", 0);
	}
	
	//door
	if(isset($_POST['door']) && $value_door == 0){
		file_put_contents("api/files/door/value.txt", 1);
	}else if(isset($_POST['door']) && $value_door == 1){
		file_put_contents("api/files/door/value.txt", 0);
	}
	
	//window
	if(isset($_POST['window']) && $value_window == 0){
		file_put_contents("api/files/window/value.txt", 1);
	}else if(isset($_POST['window']) && $value_window == 1){
		file_put_contents("api/files/window/value.txt", 0);
	}
	
	//garagedoor
	if(isset($_POST['garagedoor']) && $value_garagedoor == "Garagem Fechada"){
		file_put_contents("api/files/garagedoor/value.txt", "Garagem Aberta");
	}else if(isset($_POST['garagedoor']) && $value_garagedoor == "Garagem Aberta"){
		file_put_contents("api/files/garagedoor/value.txt", "Garagem Fechada");
	}
	
	//lamp
	if(isset($_POST['lamp']) && $value_lamp == 0){
		file_put_contents("api/files/lamp/value.txt", 2);
	}else if(isset($_POST['lamp']) && $value_lamp == 2){
		file_put_contents("api/files/lamp/value.txt", 0);
	}
	

?>


<?php
	//volta a ler os dados para impedir que haja erros
	
	$value_door = file_get_contents("api/files/door/value.txt");
	$value_window = file_get_contents("api/files/window/value.txt");
	$value_garagedoor = file_get_contents("api/files/garagedoor/value.txt");
	$value_lamp = file_get_contents("api/files/lamp/value.txt");
	$value_fan = file_get_contents("api/files/fan/value.txt");

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
	
					<!-- ########## conteudo da pagina ######## -->
  
	<div class="home_content">
	
		<!-- header da pagina -->
		<div class="row">
			<div class="col-sm-12">
				<video autoplay loop>  
					<source src="imgs/header.mp4" type="video/mp4">
				</video>
			</div>
		</div>
		<!-- fim do header da pagina -->
		<br>
		
		<!-- é aqui que o utilizador vai interagir com objetos do cisco
		 de maneira "automática" -->
		
		<form method="POST">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="card text-center cardcolor">
							<div class="card-body"><img src="imgs/garagedoor.png" alt="garagedoor image" class="icons">
								<div>
									<?php
										/*consoante o dispositivo estiver ligado ou desligado
										escolhe o botão mais indicado - vai ser igual para
										os restantes botões */
										if($value_garagedoor == "Garagem Fechada"){
											echo '<button type="input" type="submit" name="garagedoor" class="btn btn-outline-danger">off</button>';	
										}else if($value_garagedoor == "Garagem Aberta"){
											echo '<button type="input" type="submit" name="garagedoor" class="btn btn-outline-success">on</button>';
										}
									?>
								</div>
							</div>
						</div>
						<br><br>
						<div class="card text-center cardcolor">
							<div class="card-body"><img src="imgs/window.png" alt="window image" class="icons">
								<div>
									<?php
										if($value_window == 0){
											echo '<button type="input" type="submit" name="window" class="btn btn-outline-danger">off</button>';	
										}else if($value_window == 1){
											echo '<button type="input" type="submit" name="window" class="btn btn-outline-success">on</button>';
										}
									?>
								</div>
							</div>
						</div>				
					</div>
					<div class="col-sm-4">
						<div class="card text-center cardcolor">
							<div class="card-body"><img src="imgs/lampicon.png" alt="lamp image" class="icons">
								<div>
									<?php
										if($value_lamp == 0){
											echo '<button type="input" type="submit" name="lamp" class="btn btn-outline-danger">off</button>';	
										}else if($value_lamp == 2){
											echo '<button type="input" type="submit" name="lamp" class="btn btn-outline-success">on</button>';
										}
									?>
								</div>
							</div>
						</div>
						<br><br>
						<div class="card text-center cardcolor">
							<div class="card-body"><img src="imgs/fan.png" alt="fan image" class="icons">
								<div>
									<?php
										if($value_fan == 0){
											echo '<button type="input" type="submit" name="fan" class="btn btn-outline-danger">off</button>';	
										}else if($value_fan == 2){
											echo '<button type="input" type="submit" name="fan" class="btn btn-outline-success">on</button>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-center cardcolor">
							<div class="card-body"><img src="imgs/dooricon.png" alt="door image" class="icons">
								<div>
									<?php
										if($value_door == 0){
											echo '<button type="input" type="submit" name="door" class="btn btn-outline-danger">off</button>';	
										}else if($value_door == 1){
											echo '<button type="input" type="submit" name="door" class="btn btn-outline-success">on</button>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<br><br><br>
						<!-- footer fofinho -->
						<div class="card text-center cardcolor">
							<p><br><i class='bx bx-coffee'></i>Let us do everything while you drink a coffee<i class='bx bx-coffee'></i></p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
				<!-- #######  SCRIPTS  ###### -->
	
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