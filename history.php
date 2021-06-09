<?php
//verificação se existe um usuário logado
session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);

?>

<?php

	$lines = file('api/files/humidity/log.txt');
    $flipped = array_reverse($lines); // Reverte o array(1º linha passa a ser a ultima)
    $keep = array_slice($flipped,0, 5); //  mantem as primeiras 5 linhas
    $log_humi= implode("\n", $keep);
    
    $lines1 = file('api/files/temperature/log.txt');
    $flipped1 = array_reverse($lines1);
    $keep1 = array_slice($flipped1,0, 5); 
    $log_temp= implode("\n", $keep1);
    
    $lines2 = file('api/files/luminosity/log.txt');
    $flipped2 = array_reverse($lines2); 
    $keep2 = array_slice($flipped2,0, 5); 
    $log_lumi= implode("\n", $keep2);

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
    <title>History</title>
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
	
	<div class="home_content">
		<div class="row">
		<div class="col-sm-12">
			<video autoplay loop>  
				<source src="imgs/header.mp4" type="video/mp4">
			</video>
		</div>
		</div>
		<br>
		
		<!-- Histórico apenas para os sensores (faltam 2 precisamos no mínimo 5)
		ainda vou mudar isto para meter mais bonito a apresentar a data
		separada do valor -->
		
		<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="card text-center cardcolor">
					<div class="card-header">
						<b>Temperature</b>
						<p>(date hour=>valueº)</p>
					</div>
					<div class="card-body">
					<?php echo nl2br($log_temp); ?> <!--apresenta linha a linha-->
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card text-center cardcolor">
					<div class="card-header">
						<b>Luminosity</b>
						<p>(date hour=>value%)</p>
					</div>
					<div class="card-body">
					<?php echo nl2br($log_lumi); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card text-center cardcolor">
					<div class="card-header">
						<b>Humidity</b>
						<p>(date hour=>value%)</p>
					</div>
					<div class="card-body">
					<?php echo nl2br($log_humi); ?>
					</div>
				</div>
			</div>
		</div>
		
		</div>
		
		</div>
		<br><br>
    </div>
	
	
	<!-- script para a sidebar ficar interativa -->
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


    <!--SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>