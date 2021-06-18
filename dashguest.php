<?php
//verificacao se existe um usuario logado

session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
	//acesso apenas ao privilégio guest
	if($user_data['privileges'] != "guest"){
		die("acess denied");
	}

?>

<?php

	//get valores
  $value_temp = file_get_contents("api/files/temperature/value.txt");
  $date_temp = file_get_contents("api/files/temperature/date.txt");
  
  $value_lumi = file_get_contents("api/files/luminosity/value.txt");
  $date_lumi = file_get_contents("api/files/luminosity/date.txt");
  
  $value_humi = file_get_contents("api/files/humidity/value.txt");
  $date_humi = file_get_contents("api/files/humidity/date.txt");
  
  $value_door = file_get_contents("api/files/door/value.txt");
  $date_door = file_get_contents("api/files/door/date.txt");
  
  $value_lamp = file_get_contents("api/files/lamp/value.txt");
  $date_lamp = file_get_contents("api/files/lamp/date.txt");
  
  $value_motion = file_get_contents("api/files/motion/value.txt");
  $date_motion = file_get_contents("api/files/motion/date.txt");
  
  $value_fire = file_get_contents("api/files/fire/value.txt");
  $date_fire = file_get_contents("api/files/fire/date.txt");
  
  
	//qualificacao da badges da tabela de sensores e verificacao para alertas//
	
	//temperature
	if($value_temp > 35){
		echo '<script>alert("Very hot outside, be careful!")</script>';
		$temp_warn = "very hot";
		//toca alrme para avisar o utilizador
		exec('C:\\UniServerZ\\www\\SmartHouse\\python\\sound.py');
	}
	else if($value_temp > 27 && $value_temp < 35){
		$temp_warn = "hot";
	}
	else if($value_temp > 20 && $value_temp < 27){
		$temp_warn = "good";
	}
	else if($value_temp > 10 && $value_temp < 20){
		$temp_warn = "cold";
	}
	else{
		echo '<script>alert("Very cold outside, be careful!")</script>';
		$temp_warn = "very cold";
		//toca alrme para avisar o utilizador
		exec('C:\\UniServerZ\\www\\SmartHouse\\python\\sound.py');
	}
	
	//humidity
	if($value_humi < 20){
	  $humi_warn = "dry";
	}
	else if($value_humi > 20 && $value_humi < 40){
		$humi_warn = "semi dry";
	}
	else if($value_humi > 40 && $value_humi < 60){
		$humi_warn = "semi humid";
	}
	else if($value_humi > 60 && $value_humi < 80){
		$humi_warn = "humid";
	}
	else{
		$humi_warn = "very humid";
	}
	
	//luminosity
	if($value_lumi == 1){
	  $lumi_warn = "Day time";
	  $value_lumi = "Light";
	}
	else if($value_lumi == 0){
		$lumi_warn = "Night Time";
		$value_lumi = "No light";
	}
	
	//motion
	if($value_motion == 1){
		$motion_warn = "Someone here";
		$value_motion = "Motion";
		
	}else if($value_motion == 0){
		$motion_warn = "No one here";
		$value_motion = "No motion";
	}
	
	//fire
	if($value_fire == 0){
		$fire_warn = "No fire";
		$value_fire = "No";
	}else if($value_fire == 1){
		$fire_warn = "Fire";
		echo '<script>alert("Theres a fire, call the fire department!! Fire Sprinkler activated. ")</script>';
		//toca alrme para avisar o utilizador
		exec('C:\\UniServerZ\\www\\SmartHouse\\python\\sound.py');
		$value_fire = "Yes";
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
			<a href="dashguest.php">
				<i class='bx bx-grid-alt' ></i>
				<span class="links_name">Dashboard</span>
			</a>
			<span class="tooltip">Dashboard</span>
		</li>
		<li>
			<a href="analyticsguest.php">
				<i class='bx bx-pie-chart-alt-2' ></i>
				<span class="links_name">Analytics</span>
			</a>
			<span class="tooltip">Analytics</span>
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

		<div class="container">
	
			<!-- divs dos 4 icons iniciais -->
	
			<div class="row">
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-body"><img src="imgs/sunicon.png" alt="sun image" class="icons">
							<br><b>Luminosity: 
								<?php echo $value_lumi ?></b>
						</div>
					</div>
					<br><br>
					<div class="card text-center cardcolor">
						<div class="card-body"><img src="imgs/tempicon.png" alt="temperature image" class="icons">
							<br><b>Temperature: <?php echo $value_temp; ?>º</b>
						</div>
					</div>	
				</div>
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-body">
							<?php //fazer a mudanca de imagem
								if($value_door == 1){
									echo '<img src="imgs/dooricon.png" alt="door image" class="icons">';
								}else if($value_door == 0){
									echo '<img src="imgs/closeddooricon.png" alt="door image" class="icons">';
								}
							?>
							<br><b>Door: 
								<?php //mudanca de texto
									if($value_door == 0){
										echo "Closed";	
									}elseif($value_door == 1){
										echo "Open";
									}else{
										echo "Error";
									}
								?></b>
						</div>
					</div>
					<br><br>
					<div class="card text-center cardcolor">
						<div class="card-body">
							<?php
								if($value_lamp == 2){
									echo '<img src="imgs/lamponicon.png" alt="lamp image" class="icons">';
								}else if($value_lamp == 0){
									echo '<img src="imgs/lampicon.png" alt="lamp image" class="icons">';
								}
							?>
							<br><b>Lamp: 
								<?php
									if($value_lamp == 0){
										echo "Off";	
									}elseif($value_lamp == 2){
										echo "On";
									}else{
										echo "Error";
									}
								?></b></b>
						</div>
					</div>
				</div>
			
				<!-- calendario -->
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="calendar">
							<div class="calendar-header">
								<span class="month-picker" id="month-picker">February</span>
								<div class="year-picker">
									<span id="year">2021</span>
								</div>
							</div>
							<div class="calendar-body">
								<div class="calendar-week-day">
									<div>Sun</div>
									<div>Mon</div>
									<div>Tue</div>
									<div>Wed</div>
									<div>Thu</div>
									<div>Fri</div>
									<div>Sat</div>
								</div>
								<div class="calendar-days"></div>
							</div>
							<div class="month-list"></div>
							<br><br><br>
						</div>
					</div>
				</div>
				<!-- fim de calendario -->
			</div>
	
    
			<br><br>
			<!-- tabela de sensores -->
			<!-- faltam 2 sensores -->
			<div class="row">
				<div class="col-sm-12">
					<div class="card cardcolor">
						<div class="card-header textcolor"><b>Sensor Table</b></div>
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr class="textcolor">
										<th scope="col">IoT Device Type</th>
										<th scope="col">Value</th>
										<th scope="col">Update date</th>
										<th scope="col">Warnings</th>
									</tr>
								</thead>
								<tbody>
									<tr class="textcolor">
										<td>Temperature Sensor</td>
										<td><?php echo $value_temp; ?>º</td>
										<td><?php echo $date_temp; ?></td>
										<td><span class="badge badge-pill badge-info"><?php echo $temp_warn ?></span></td>
									</tr>
									<tr class="textcolor">
										<td>Humidity Sensor</td>
										<td><?php echo $value_humi; ?>%</td>
										<td><?php echo $date_humi; ?></td>
										<td><span class="badge badge-pill badge-primary"><?php echo $humi_warn ?></span></td>
									</tr>
									<tr class="textcolor">
										<td>Luminosity Sensor</td>
										<td><?php echo $value_lumi; ?></td>
										<td><?php echo $date_lumi; ?></td>
										<td><span class="badge badge-pill badge-info"><?php echo $lumi_warn ?></span></td>
									</tr>
									<tr class="textcolor">
										<td>Motion Sensor</td>
										<td><?php echo $value_motion?></td>
										<td><?php echo $date_motion; ?></td>
										<td><span class="badge badge-pill badge-primary"><?php echo $motion_warn ?></span></td>
									</tr>
									<tr class="textcolor">
										<td>Fire Sensor</td>
										<td><?php echo $value_fire; ?></td>
										<td><?php echo $date_fire; ?></td>
										<td><span class="badge badge-pill badge-info"><?php echo $fire_warn ?></span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>   
		</div>
	</div>
	
						<!-- #######  SCRIPTS  ###### -->
	
	<script>
	//script para deixar a sidebar interativa
	
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
	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>