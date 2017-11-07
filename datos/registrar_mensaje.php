<?php
session_start();
if(isset($_POST['input_mensaje']))
{
	include('conex.php');
    
    $fecha  	= date("d-m-Y");
	$hora  		= date("H:i:s");
	if(isset($_POST['input_remitente']))
	{	$correo = $_POST['input_remitente'];	}
	if (isset($_SESSION['id_usuario']))
	{	$id_envia = $_SESSION['id_usuario'];	}
	else
	{	$id_envia  	= 0;	}
	$id_recibe  = $_POST['input_recibe'];
	$tipo  		= $_POST['input_tipo'];
	$mensaje  	= $_POST['input_mensaje'];
	if (!isset($_SESSION['id_usuario'])) {
		$mensaje    = "$correo///$mensaje";
	}

    $sql = "INSERT INTO mensajes (fecha, hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
    $sql.= "VALUES ('$fecha','$hora',$id_envia, $id_recibe,'$tipo','$mensaje','Pendiente','no')";

    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>