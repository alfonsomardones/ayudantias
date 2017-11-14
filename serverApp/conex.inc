<?php
	$servidor = "db.inf.uct.cl";
	$usuario = "fvelasquez";
	$pass = "19518701";
	$baseD = "fvelasquez";
	$db = mysqli_connect($servidor, $usuario, $pass, $baseD) or die("Error conectando a la BBDD");
	mysqli_set_charset($db,'utf8');  
?>