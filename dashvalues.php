<?php
/*tecnicamente ist é a página para os valores estarem sempre a fazer reload 
  com ajax */

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