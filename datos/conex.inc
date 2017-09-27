<?php
	$SERVER = "db.inf.uct.cl";
	$USER = "fvelasquez";
	$PASS = "19518701";
	$BASED = "fvelasquez";
	$db = mysqli_connect($SERVER, $USER, $PASS, $BASED) or die("Error conectando a la BBDD");
	mysqli_set_charset($db,'utf8');  
?>