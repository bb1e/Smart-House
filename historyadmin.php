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
	//preparação dos dados para as tabelas//

	//humidity
	$lines = file('api/files/humidity/log.txt');
    $flipped = array_reverse($lines); // Reverte o array(1º linha passa a ser a ultima)
    $keep = array_slice($flipped,0, 5); //  mantem as primeiras 5 linhas
	file_put_contents("api/files/humidity/log.txt", $keep);
    
	//temperature
    $lines1 = file('api/files/temperature/log.txt');
    $flipped1 = array_reverse($lines1);
    $keep1 = array_slice($flipped1,0, 5); 
	file_put_contents("api/files/temperature/log.txt", $keep1);
    
	//luminosity
    $lines2 = file('api/files/luminosity/log.txt');
    $flipped2 = array_reverse($lines2); 
    $keep2 = array_slice($flipped2,0, 5); 
    file_put_contents("api/files/luminosity/log.txt", $keep2);
	
	//motion
	$lines3 = file('api/files/motion/log.txt');
    $flipped3 = array_reverse($lines3); 
    $keep3 = array_slice($flipped3,0, 5); 
    file_put_contents("api/files/motion/log.txt", $keep3);
	
	//fire
	$lines4 = file('api/files/fire/log.txt');
    $flipped4 = array_reverse($lines4); 
    $keep4 = array_slice($flipped4,0, 5); 
    file_put_contents("api/files/fire/log.txt", $keep4);

	
//separação dos logs em data e valor
	
	//temperature
	$file = fopen( "api/files/temperature/log.txt", "r" );
		$index=-1;
		$arrayValue=[];
		$arrayHour=[];
		while ((( $line = fgets( $file )) !== false) && ( $index++ < 5 )) {
			$piecesValue = explode(";", $line);
			
			
			$piecesHourAux = explode(";", $line);
			$piecesHour = explode(" ", $piecesHourAux[0]);
			
			$arrayValue[$index]=$piecesValue[1];
			$arrayHour[$index]=$piecesHour[1];
		}
	fclose( $file );
	
	//humidity
	$file1 = fopen( "api/files/humidity/log.txt", "r" );
		$index1=-1;
		$arrayValue1=[];
		$arrayHour1=[];
		while ((( $line1 = fgets( $file1 )) !== false) && ( $index1++ < 5 )) {
			$piecesValue1 = explode(";", $line1);
			
			
			$piecesHourAux1 = explode(";", $line1);
			$piecesHour1 = explode(" ", $piecesHourAux1[0]);
			
			$arrayValue1[$index1]=$piecesValue1[1];
			$arrayHour1[$index1]=$piecesHour1[1];
		}
	fclose( $file1 );	
	
	//luminosity
	$file2 = fopen( "api/files/luminosity/log.txt", "r" );
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
	
	//motion
	$file3 = fopen( "api/files/motion/log.txt", "r" );
		$index3=-1;
		$arrayValue3=[];
		$arrayHour3=[];
		while ((( $line3 = fgets( $file3 )) !== false) && ( $index3++ < 5 )) {
			$piecesValue3 = explode(";", $line3);
			
			
			$piecesHourAux3 = explode(";", $line3);
			$piecesHour3 = explode(" ", $piecesHourAux3[0]);
			
			$arrayValue3[$index3]=$piecesValue3[1];
			$arrayHour3[$index3]=$piecesHour3[1];
		}
	fclose( $file3 );
	
	//fire
	$file4 = fopen( "api/files/fire/log.txt", "r" );
		$index4=-1;
		$arrayValue4=[];
		$arrayHour4=[];
		while ((( $line4 = fgets( $file4 )) !== false) && ( $index4++ < 5 )) {
			$piecesValue4 = explode(";", $line4);
			
			
			$piecesHourAux4 = explode(";", $line4);
			$piecesHour4 = explode(" ", $piecesHourAux4[0]);
			
			$arrayValue4[$index4]=$piecesValue4[1];
			$arrayHour4[$index4]=$piecesHour4[1];
		}
	fclose( $file4 );

	
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
		
		<!-- Histórico apenas para os sensores -->
		
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-header">
							<b>Temperature</b>
						</div>
						<div class="card-body">
							<table class="table table-bordered">
								<tbody>
									<tr class="textcolor">
										<td>DATE</td>
										<td>VALUE</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour[0]; ?></td>
										<td><?php echo $arrayValue[0]; ?>º</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour[1]; ?></td>
										<td><?php echo $arrayValue[1]; ?>º</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour[2]; ?></td>
										<td><?php echo $arrayValue[2]; ?>º</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour[3]; ?></td>
										<td><?php echo $arrayValue[3]; ?>º</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour[4]; ?></td>
										<td><?php echo $arrayValue[4]; ?>º</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-header">
							<b>Luminosity</b>
						</div>
						<div class="card-body">
							<table class="table table-bordered">
								<tbody>
									<tr class="textcolor">
										<td>DATE</td>
										<td>VALUE</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour2[0]; ?></td>
										<td><?php
													if($arrayValue2[0] == 0){
														echo "No light";
													}else{
														echo "Light";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour2[1]; ?></td>
										<td><?php
													if($arrayValue2[1] == 0){
														echo "No light";
													}else{
														echo "Light";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour2[2]; ?></td>
										<td><?php
													if($arrayValue2[2] == 0){
														echo "No light";
													}else{
														echo "Light";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour2[3]; ?></td>
										<td><?php
													if($arrayValue2[3] == 0){
														echo "No light";
													}else{
														echo "Light";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour2[4]; ?></td>
										<td><?php
													if($arrayValue2[4] == 0){
														echo "No light";
													}else{
														echo "Light";
													}
											?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-header">
							<b>Humidity</b>
						</div>
						<div class="card-body">
							<table class="table table-bordered">
								<tbody>
									<tr class="textcolor">
										<td>DATE</td>
										<td>VALUE</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour1[0]; ?></td>
										<td><?php echo $arrayValue1[0]; ?>%</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour1[1]; ?></td>
										<td><?php echo $arrayValue1[1]; ?>%</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour1[2]; ?></td>
										<td><?php echo $arrayValue1[2]; ?>%</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour1[3]; ?></td>
										<td><?php echo $arrayValue1[3]; ?>%</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour1[4]; ?></td>
										<td><?php echo $arrayValue1[4]; ?>%</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-header">
							<b>MOTION</b>
						</div>
						<div class="card-body">
							<table class="table table-bordered">
								<tbody>
									<tr class="textcolor">
										<td>DATE</td>
										<td>VALUE</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour3[0]; ?></td>
										<td><?php
													if($arrayValue3[0] == 1){
														echo "Motion";
													}else{
														echo "No motion";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour3[1]; ?></td>
										<td><?php
													if($arrayValue3[1] == 1){
														echo "Motion";
													}else{
														echo "No motion";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour3[2]; ?></td>
										<td><?php
													if($arrayValue3[2] == 1){
														echo "Motion";
													}else{
														echo "No motion";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour3[3]; ?></td>
										<td><?php
													if($arrayValue3[3] == 1){
														echo "Motion";
													}else{
														echo "No motion";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour3[4]; ?></td>
										<td><?php
													if($arrayValue3[4] == 1){
														echo "Motion";
													}else{
														echo "No motion";
													}
											?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card text-center cardcolor">
						<div class="card-header">
							<b>FIRE</b>
						</div>
						<div class="card-body">
							<table class="table table-bordered">
								<tbody>
									<tr class="textcolor">
										<td>DATE</td>
										<td>VALUE</td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour4[0]; ?></td>
										<td><?php
													if($arrayValue4[0] == 0){
														echo "No";
													}else{
														echo "Yes";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour4[1]; ?></td>
										<td><?php
													if($arrayValue4[1] == 0){
														echo "No";
													}else{
														echo "Yes";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour4[2]; ?></td>
										<td><?php
													if($arrayValue4[2] == 0){
														echo "No";
													}else{
														echo "Yes";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour4[3]; ?></td>
										<td><?php
													if($arrayValue4[3] == 0){
														echo "No";
													}else{
														echo "Yes";
													}
											?></td>
									</tr>
									<tr class="textcolor">
										<td><?php echo $arrayHour4[4]; ?></td>
										<td><?php
													if($arrayValue4[4] == 0){
														echo "No";
													}else{
														echo "Yes";
													}
											?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	
						<!-- #######  SCRIPTS  ###### -->
	
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>