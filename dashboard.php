<?php
//verificacao se existe um usuario logado
session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);

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
  
  
	//qualificacao da badges da tabela de sensores
	if($value_temp > 35){
	  $temp_warn = "very hot";
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
		$temp_warn = "very cold";
	}
	
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
	
	if($value_lumi < 30){
	  $lumi_warn = "low";
	}
	else if($value_humi > 30 && $value_humi < 70){
		$lumi_warn = "medium";
	}
	else{
		$lumi_warn = "high";
	}
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  
	<div class="home_content">
    <div class="row">
		<div class="col-sm-12">
			<video autoplay loop>  
				<source src="imgs/header.mp4" type="video/mp4">
			</video>
		</div>
    </div>  
	<br><br>

    <div id="main" class="container">
	<?php include("dashvalues.php"); ?>
        <div class="row">
			<div class="col-sm-4">
                <div class="card text-center cardcolor">
                    <div class="card-body"><img src="imgs/sunicon.png" alt="sun image" class="icons">
					<br><b>Luminosity: <?php echo $value_lumi; ?>%</b>
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
                    <div id="main" class="card-body">
					<?php //fazer a mudan?a de imagem
						if($value_door == 1){
							echo '<img src="imgs/dooricon.png" alt="door image" class="icons">';
						}else if($value_door == 0){
							echo '<img src="imgs/closeddooricon.png" alt="door image" class="icons">';
						}
					?>
					<br><b>Door: <?php //mudanca de texto
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
                    <div class="card-body" id="div_refresh">
					<?php
						if($value_lamp == 1){
							echo '<img src="imgs/lamponicon.png" alt="lamp image" class="icons">';
						}else if($value_lamp == 0){
							echo '<img src="imgs/lampicon.png" alt="lamp image" class="icons">';
						}
					?>
					<br><b>Lamp: <?php
									if($value_lamp == 0){
										echo "Off";	
									}elseif($value_lamp == 1){
										echo "On";
									}else{
										echo "Error";
									}
								 ?></b></b>
					</div>
                </div>
		
			</div>
			<!-- calend?rio -->
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
			<!-- fim de calend?rio -->
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
                              <td>Temperature</td>
                                <td><?php echo $value_temp; ?>º</td>
                                <td><?php echo $date_temp; ?></td>
                                <td><span class="badge badge-pill badge-info"><?php echo $temp_warn ?></span></td>
                              </tr>
                              <tr class="textcolor">
                                <td>Humidity</td>
                                <td><?php echo $value_humi; ?>%</td>
                                <td><?php echo $date_humi; ?></td>
                                <td><span class="badge badge-pill badge-primary"><?php echo $humi_warn ?></span></td>
                              </tr>
                              <tr class="textcolor">
                                <td>Luminosity</td>
                                <td><?php echo $value_lumi; ?>%</td>
                                <td><?php echo $date_lumi; ?></td>
                                <td><span class="badge badge-pill badge-info"><?php echo $lumi_warn ?></span></td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>   
    </div>
	</div>
	
	
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
	
	<script>
	//tentativa de c?digo ajax mas fds n?o est? a funcionar
	
        setInterval(function() {
            
        }, 2000);
    
	</script>
	<script>
		function updateDiv()
		{ 
			$( "#main" ).load(dashvalues.php + " #main" );
		} }, 1000);
		$("#main").load(" #main");
	</script>
	
	<script src="calendar.js"></script>

    <!--SCRIPTS-->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>