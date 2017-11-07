<?php
session_start();
if(isset($_SESSION['id_usuario']))
{
	if(isset($_POST['input_mensaje']))
	{
		include('conex.php');
	    
	    $fecha  	= date("d-m-Y");
		$hora  		= date("H:i:s");
		$id_recibe  = $_POST['input_recibe'];
		$mensaje  	= $_POST['input_mensaje'];

		$sql 		= "SELECT * FROM mensajes WHERE id_usuario_envia=".$id_recibe." AND id_usuario_recibe=".$_SESSION['id_usuario']." OR id_usuario_envia=".$_SESSION['id_usuario']." AND id_usuario_recibe=".$id_recibe;
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador==0)
		{
			$sql = "INSERT INTO mensajes (fecha, hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
		    $sql.= "VALUES ('$fecha','$hora',$id_recibe,".$_SESSION['id_usuario'].",'Mensaje','[MENSAJE INVERSO AUTOMÁTICO | INICIO DE CHAT]','Pendiente','no')";
		    $insertar = mysqli_query($db,$sql);
		}
	    $sql = "INSERT INTO mensajes (fecha, hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
	    $sql.= "VALUES ('$fecha','$hora',".$_SESSION['id_usuario'].", $id_recibe,'Mensaje','$mensaje','Pendiente','no')";
	    $insertar = mysqli_query($db,$sql);
	}
	else
	{
		header("location: error.php");
	}
}
else
{
	echo "debes iniciar sesión";
}
?>