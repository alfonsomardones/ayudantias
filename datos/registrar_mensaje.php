<?php
    include('conex.inc');
    
    $fecha  		= date('d-m-Y');
	$hora  			= date('h:i:s');
	$envia  		= $_POST['input_envia'];
	$recibe  		= $_POST['input_recibe'];
	$tipo_mensaje  	= $_POST['input_tipo'];
	$mensaje  		= $_POST['input_mensaje'];
	$estado  		= $_POST['input_estado'];


    $sql = "INSERT INTO mensajes (fecha, hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje ,mensaje, estado) ";
    $sql.= "VALUES ('$fecha','$hora',$envia, $recibe, '$tipo_mensaje', '$mensaje', '$estado')";

    $insertar = mysqli_query($db,$sql);
?>