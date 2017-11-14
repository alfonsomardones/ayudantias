<?php

    include('conex.inc');

    $tipo = $_POST["tipo"];
    $sql  = "";
    if($tipo == "carreras"){
    	$sql = "SELECT nombre FROM carreras";
    }
    if($tipo == "especialidades"){
    	$sql = "SELECT nombre FROM especialidades";
    }
    $resultado  = mysqli_query($db,$sql);
    $contador   = mysqli_num_rows($resultado);
    if ($contador<0) {
    	echo "Error";
    }

    else {
    	$nombres = "";
    	while ($lista = mysqli_fetch_array($resultado)) {
            	$nombres.= $lista['nombre']."-";
           }
        $nombres = substr($nombres, 0,-1);
        echo $nombres;
    }
?>