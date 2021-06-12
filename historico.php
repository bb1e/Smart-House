<!DOCTYPE html>
<html lang="pt">

<!--Página desenvolvida por Alexandre Silva (2201716) e Marcos Sousa (2201729)-->
	

	
	<?php
		session_start();
		
		/*Verificação dos dados de acesso*/
			include("connection.php");
			include("functions.php");
			$user_data = check_login($con);
		
		if (isset ($_GET["sensor"])){
			$nome=$_GET["sensor"];
		}
		elseif (isset ($_GET["atuador"])){
			$nome=$_GET["atuador"];
		}
		elseif (isset ($_GET["dispositivo"])){
			$nome=$_GET["dispositivo"];
		}
		
		/*Guarda a divisão recebida pelo get na variável $divisão*/
		//$divisao=$_GET["divisao"];
		$line_num=0;
		
		//https://www.hscripts.com/tutorials/php/file-functions/reading-lines.php
		/*Guarda num vetor todos os registos de $nome na divisao $divisao*/
		//$array = file("api/files/$divisao/$nome/log.txt");
		/*RESULTADO: ARRAY ([0] => data/hora, valor, texto, alerta; [1] => data/hora, valor, texto, alerta; [?] => data/hora, valor, texto, alerta; ....)*/
		//Teste: print_r($array);
		
		
		/* Funcao que lê:
			1ºparametro: indice $line_num do array $array
			2ºparametro: respetivo $array
		*/
		function splitline($line_num, $array) {
			$split = explode(";", $array[$line_num]);
			return $split;
		}
	
		/* Função que devolve o bloco de indice 2, proveniente do $split. Neste caso, é o texto */
		function getTexto($split) {
			echo $split[2];
		}
		
		/* Função que devolve o bloco de indice 3, proveniente do $split. Neste caso, é o alerta */
		function getAlerta($split) {
			echo $split[3];
		}
	
		/* Função que devolve o bloco de indice 0, proveniente do $split. Neste caso, é a data/hora */
		function getData($split) {
			echo $split[0];
		}
		
		/* Função que devolve o bloco de indice 1, proveniente do $split. Neste caso, é o valor */
		function getValor($split) {
			echo $split[1];
		}
		

	?>
	
	<?php
		/* Grafico - Bloco de codigo 1 */
		   
		/* Guardar no array $piecesValue as ultimas 10 variaveis do historico*/
		$file = fopen( "api/files/door/log.txt", "r" );
		$index=-1;
		$arrayValue=[];
		$arrayHour=[];
		while ((( $line = fgets( $file )) !== false) && ( $index++ < 10 )) {
			$piecesValue = explode(";", $line);
			
			
			$piecesHourAux = explode(";", $line);
			$piecesHour = explode(" ", $piecesHourAux[0]);
			
			$arrayValue[$index]=$piecesValue[1];
			$arrayHour[$index]=$piecesHour[1];
		}
		fclose( $file );
		
		// Data to draw graph for purchased products
		$dataPoints = array(
			array("label"=> "$arrayHour[0]", "y"=> $arrayValue[0]),
			array("label"=> "$arrayHour[1]", "y"=> $arrayValue[1]),
			array("label"=> "$arrayHour[2]", "y"=> $arrayValue[2]),
			array("label"=> "$arrayHour[3]", "y"=> $arrayValue[3]),
			array("label"=> "$arrayHour[4]", "y"=> $arrayValue[4]),
			array("label"=> "$arrayHour[5]", "y"=> $arrayValue[5]),
			array("label"=> "$arrayHour[6]", "y"=> $arrayValue[6]),
			array("label"=> "$arrayHour[7]", "y"=> $arrayValue[7]),
			array("label"=> "$arrayHour[8]", "y"=> $arrayValue[8]),
			array("label"=> "$arrayHour[9]", "y"=> $arrayValue[9])
		);
		   
	?>
	
	<head>
		<title>SmartRest - Histórico (<?php echo $nome;?>)</title>
		
		<!--Required meta tags-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!--Bootstrap JS-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		
		<!-- CSS Style File -->
		<link rel="stylesheet" href="page_style.css">
		
		
		<!-- Grafico - Bloco de codigo 2 -->
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js">
		</script>
		<script>
			window.onload = function () {
			   
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					title:{
						text: "Últimos 20 registos de <?php echo $nome?>"
					},    
					axisY: {
						title: "Valores",
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
						color: "#5bc0de",
						name: "valor",
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
			   
			}
		</script>
		<!-- Fim do codigo do grafico -->
		
	</head>

	<body>
		<!--Barra de navegação-->
		<nav class="navbar navbar-expand-lg navbar-dark bg-info">
		
			<img class="logo" src="images/logo_final_projeto.png" alt="Logótipo Silva&Sousa">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div class="vl"></div>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		  
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php">Início</a>
						&nbsp;&nbsp;
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="sala.php">Sala</a>
						&nbsp;&nbsp;
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="cozinha.php">Cozinha</a>
						&nbsp;&nbsp;
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="exterior.php">Exterior</a>
						&nbsp;&nbsp;
					</li>
				</ul>
				
				<table>
					<tr><td><a class="btn btn-outline-light my-2 my-sm-0" href="logout.php" role="button">Logout</a><br></td></tr>
					<tr><td style="color: white; text-align: center;"><i><?php echo $_SESSION['username'];?></i></td></tr>
				</table>
			</div>
		</nav>
		
		<br>
		
		<!--Jumbotron-->
		<div class="jumbotron">
			<h1>HISTÓRICO</h1>
			<p><?php echo $nome; ?></p>
		</div>

		<!--Tabela de histórico-->
		<div class="card" style="background-color: #f2f2f2">
			<table class="table">
				<thead style="background-color: #a6a6a6">
					<tr class="custom">
						<th>Valor</th>
						<th>Data de Atualização</th>
						<th>Estado de Alertas</th>
					</tr>
				</thead>
				<tbody style="background-color: #f2f2f2">
					<tr class="custom">
						<?php
							/* Atualização numero 1 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 2 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 3 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 4 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 5 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 6 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 7 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 8 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 9 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
					<tr class="custom">
						<?php
							/* Atualização numero 10 dos valores a utilizar nas funções dos cartões */
							$split=splitline($line_num, $array);
							$line_num++;
						?>
						<td><?php getValor($split); ?></td>
						<td><?php getData($split); ?></td>
						<td><span class="badge badge-<?php getAlerta($split); ?>"><?php getTexto($split); ?></span></td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<br>
		<br>
		
		<!-- Grafico - Bloco de codigo 3 -->
		<!-- https://www.geeksforgeeks.org/how-to-make-dynamic-chart-in-php-using-canvasjs/ -->
		<div id="chartContainer" style="height: 500px; width: 100%;"></div>
		<br><br><br><br><br>
		
		<!--Informação-->
		<footer class="bg-info" style="text-align: center; color: white;">@ Silva & Sousa 2021. Todos os direitos reservados<br>Ultima Atualização: 02-05-2021</footer>
		
		<!--Bootstrap Bundle-->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		
	</body>
</html>