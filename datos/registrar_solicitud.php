<?php
    include('conex.inc');
    
	$estudiante  	= $_POST['input_estudiante'];
	$ayudante  		= $_POST['input_ayudante'];
	$mensaje  		= $_POST['input_mensaje'];
	$estado  		= "Pendiente";

    $sql = "INSERT INTO solicitudes (id_usuario, id_ayudante, mensaje, estado) ";
    $sql.= "VALUES ($estudiante, $ayudante, '$mensaje', '$estado')";

    $insertar = mysqli_query($db,$sql);
?>