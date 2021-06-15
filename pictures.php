<?php
//verificação se existe um usuário logado
session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
	//acesso apenas ao privilégio user
	if($user_data['privileges'] != "user"){
		die("acess denied");
	}

?>

<?php
	//executar ficheiro python para tirar foto quando é clicado o botão
	if (isset($_POST['take']))
	{
		/*para que funcione é preciso mudar a path do ficheiro para a path 
			onde está o ficheiro na maquina atual*/
		exec('C:\UniServerZ\www\SmartHouse\python\capturaWebcamOpenCV.py');
		
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="58">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
	<link href="style.css" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="calendar.css">
    <title>Smart House</title>
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
			<a href="dashboard.php">
				<i class='bx bx-grid-alt' ></i>
				<span class="links_name">Dashboard</span>
			</a>
			<span class="tooltip">Dashboard</span>
		</li>
		<li>
			<a href="smartobjects.php">
				<i class='bx bx-coffee'></i>
				<span class="links_name">Smart Objects</span>
			</a>
			<span class="tooltip">Smart Objects</span>
		</li>
		<li>
			<a href="history.php">
				<i class='bx bx-archive-in' ></i>
				<span class="links_name">History</span>
			</a>
			<span class="tooltip">History</span>
		</li>
		<li>
			<a href="analytics.php">
				<i class='bx bx-pie-chart-alt-2' ></i>
				<span class="links_name">Analytics</span>
			</a>
			<span class="tooltip">Analytics</span>
		</li>
		<li>
			<a href="pictures.php">
				<i class='bx bx-photo-album'></i>
				<span class="links_name">Pictures</span>
			</a>
			<span class="tooltip">Pictures</span>
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
		<br><br>
	
	
		<!--### apresentacao da ultima foto tirada ##-->
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<div class="card text-center cardcolor">
						<div class="card-header">Last Picture</div>
						<div class="card-body"><img src="imgs/webcam.jpg" alt="web image" width="350px">
							<br><b>
									<?php 
									//mostrar as informacoes da foto
									
										$filename = 'imgs/webcam.jpg';
										if (file_exists($filename)) {
									
											echo "<a> Was last modified: </a>" . date ("F d Y H:i:s.", filemtime($filename));
										}
									?>
							</b>
						</div>
					</div>
				</div>
			
				<!-- aqui é o botão que tira foto -->
				<div class="col-sm-5">
					<div class="card text-center" style="background-color: inherit">
						<div class="card-body">
							<br><br><br><br><br><br>
							<form method="post">
								<button type="submit" name="take" class="btn btn-outline-info btn-lg"><i class='bx bxs-camera'></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<br><br>
		</div>
	</div>
	
				<!-- #######  SCRIPTS  ###### -->
	
	<script>
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
	<script src="calendar.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>