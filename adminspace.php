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
		<br><br>
	
		<!-- ## tabela com todos os users existentes na plataforma ## -->
	
		<div id="main" class="container">
			<div class="col-sm-12">
                <div class="card text-center cardcolor">
                    <div class="card-body">
						<?php
							$sql = "SELECT user_id,user_name,privileges FROM users;";
							$result = mysqli_query($con, $sql);
						?>
						<table class='table table-bordered table-striped'>
							<tr class="textcolor">
								<td>USER ID</td>
								<td>NAME</td>
								<td>PRIVILEGE</td>
							</tr>
							<?php
								$i=0;
								while($row = mysqli_fetch_array($result)) {
							?>
							<tr class="textcolor">
								<td><?php echo $row['user_id']; ?></td>
								<td><?php echo $row['user_name']; ?></td>
								<td><?php echo $row['privileges']; ?></td>
							</tr>
							<?php
								$i++;
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
				<!-- #######  SCRIPTS  ###### -->
				
	<script>
	//script para a side bar
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