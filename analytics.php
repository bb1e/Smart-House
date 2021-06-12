<?php
//verificação se existe um usuário logado
session_start();

	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);

?>

<?php
		//guardar apenas as ultimas 5 linhas do log no ficheiro
		$lines1 = file('api/files/temperature/log.txt');
		$flipped1 = array_reverse($lines1);
		$keep1 = array_slice($flipped1,0, 5); 
		file_put_contents("api/files/temperature/log.txt", $keep1);
		
		$lines2 = file('api/files/humidity/log.txt');
		$flipped2 = array_reverse($lines2);
		$keep2 = array_slice($flipped2,0, 5); 
		file_put_contents("api/files/humidity/log.txt", $keep2);

		//valores para graficos
		   
		/* Guardar no array $piecesValue as ultimas 5 variaveis do historico
		   da temperature */

		$file = fopen( "api/files/temperature/log.txt", "r" );
		$arrayValue=[];
		$arrayHour=[];
		$index=-1;
		while ((( $line = fgets( $file )) !== false) && ( $index++ < 5 )) {
			$piecesValue = explode(";", $line);
			
			
			$piecesHourAux = explode(";", $line);
			$piecesHour = explode(" ", $piecesHourAux[0]);
			
			$arrayValue[$index]=$piecesValue[1];
			$arrayHour[$index]=$piecesHour[1];
		}
		fclose( $file );
		
		// Data para fazer o grafico da temperature
		$dataPoints = array(
			array("label"=> "$arrayHour[0]", "y"=> $arrayValue[0]),
			array("label"=> "$arrayHour[1]", "y"=> $arrayValue[1]),
			array("label"=> "$arrayHour[2]", "y"=> $arrayValue[2]),
			array("label"=> "$arrayHour[3]", "y"=> $arrayValue[3]),
			array("label"=> "$arrayHour[4]", "y"=> $arrayValue[4])
		);
		   
 
		/* Guardar no array $piecesValue as ultimas 5 variaveis do historico
		   de humidity */
		   
		$file2 = fopen( "api/files/humidity/log.txt", "r" );
		$index2=-1;
		$arrayValue2=[];
		$arrayHour2=[];
		while ((( $line2 = fgets( $file2 )) !== false) && ( $index2++ < 5 )) {
			$piecesValue2 = explode(";", $line2);
			
			
			$piecesHourAux2 = explode(";", $line2);
			$piecesHour2 = explode(" ", $piecesHourAux2[0]);
			
			$arrayValue2[$index2]=$piecesValue2[1];
			$arrayHour2[$index2]=$piecesHour2[1];
		}
		fclose( $file2 );
		
		// Data para fazer o grafico da humidity
		$dataPoints2 = array(
			array("label"=> "$arrayHour2[0]", "y"=> $arrayValue2[0]),
			array("label"=> "$arrayHour2[1]", "y"=> $arrayValue2[1]),
			array("label"=> "$arrayHour2[2]", "y"=> $arrayValue2[2]),
			array("label"=> "$arrayHour2[3]", "y"=> $arrayValue2[3]),
			array("label"=> "$arrayHour2[4]", "y"=> $arrayValue2[4])
		);
		   
?>
	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
	<link href="style.css" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Analytics</title>
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
		<div class="container">
        <div class="row">
			<div class="col-sm-6">
                <div class="card text-center cardcolor">
                    <div class="card-body">
					<!-- apresenta grafico -->
					<div id="chartContainer" style="height: 500px; width: 100%;"></div>
					</div>
                </div>
			</div>
			<div class="col-sm-6">
                <div class="card text-center cardcolor">
                    <div class="card-body">
					<!-- apresenta grafico -->
					<div id="chartContainer2" style="height: 500px; width: 100%;"></div>
					</div>
                </div>
				
            </div>
		
		</div>
		</div>
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
   
<script>
//codigo para fazer os graficos

	window.onload = function () {
			   
			   
			   //grafico da temperature
			   
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					title:{
						text: "Last 5 records of temperature"
					},    
					axisY: {
						title: "Values",
						titleFontColor: "#5bc0de",
						lineColor: "#404040",
						labelFontColor: "#404040",
						tickColor: "#404040"
					},    
					toolTip: {
						shared: true
					},
					/*legend: {
						cursor:"pointer",
						itemclick: toggleDataSeries
					},*/
					data: [{
						type: "column",
						color: "#0ff1ce",
						name: "value",
						//legendText: "",
						showInLegend: false, 
						dataPoints:<?php echo json_encode($dataPoints,
								JSON_NUMERIC_CHECK); ?>
					}]
				});
				chart.render();
				   
				function toggleDataSeries(e) {
					if (typeof(e.dataSeries.visible) === "undefined"
								|| e.dataSeries.visible) {
						e.dataSeries.visible = false;
					}
					else {
						e.dataSeries.visible = false;
					}
					chart.render();
				}
			   
		
			
				//grafico da humidity
			   
				var chart = new CanvasJS.Chart("chartContainer2", {
					animationEnabled: true,
					title:{
						text: "Last 5 records of humidity"
					},    
					axisY: {
						title: "Values",
						titleFontColor: "#5bc0de",
						lineColor: "#404040",
						labelFontColor: "#404040",
						tickColor: "#404040"
					},    
					toolTip: {
						shared: true
					},
					
					data: [{
						type: "column",
						color: "#fa238f",
						name: "value",
						showInLegend: false, 
						dataPoints:<?php echo json_encode($dataPoints2,
								JSON_NUMERIC_CHECK); ?>
					}]
				});
				chart.render();
				   
				function toggleDataSeries(e) {
					if (typeof(e.dataSeries.visible) === "undefined"
								|| e.dataSeries.visible) {
						e.dataSeries.visible = false;
					}
					else {
						e.dataSeries.visible = false;
					}
					chart.render();
				}
			   
			}
</script>

   
<!--  library canvasJS script -->   
<script src="https://canvasjs.com/assets/script/canvasjs.min.js">

    <!--SCRIPTS-->
	<script src="path/to/chartjs/dist/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>