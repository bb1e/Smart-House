<?php

//conectar e verificar conexão com a base de dados

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "smarthouse_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
