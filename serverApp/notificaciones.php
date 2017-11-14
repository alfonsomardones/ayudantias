<?php
/*$_POST["tipo"] = '2';
$_POST["id_usuario"] = 71;*/
if(isset($_POST['id_usuario']))
{	
	$tipo 			=	$_POST["tipo"];
	$id_usuario 	=	$_POST["id_usuario"];
	include('conex.inc');
	
	$json = "{ 'NOTIFICACIONES': [";

	$sql      = "SELECT * FROM mensajes WHERE id_usuario_recibe=".$id_usuario." AND estado='Pendiente' AND notificacion='no'";
	$resultado    = mysqli_query($db,$sql);
	$mensajes     = mysqli_num_rows($resultado);
	if($mensajes>0)
	{
		while($lista = mysqli_fetch_array($resultado))
		{
			$id_mensaje = $lista['id_mensaje'];
			$sql = "UPDATE mensajes SET notificacion='si' WHERE id_mensaje=$id_mensaje";
			
			$actualizar = mysqli_query($db,$sql);
		}
	}
	$json.= "{'MENSAJES':$mensajes,";

	$solicitudes = 0;
	if($tipo == "2" || $tipo ==2)
	{
		$sql = "SELECT * FROM ayudantes WHERE id_usuario=$id_usuario";
		$resultado  = mysqli_query($db,$sql);
		$contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$lista = mysqli_fetch_array($resultado);
			$id_ayudante 	= $lista['id_ayudante'];
		}
		$sql      = "SELECT * FROM solicitudes WHERE id_ayudante=".$id_ayudante." AND estado='Pendiente' AND notificacion='no'";
		$resultado    = mysqli_query($db,$sql);
		$solicitudes     = mysqli_num_rows($resultado);
		if($solicitudes>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_solicitud = $lista['id_solicitud'];
				$sql = "UPDATE solicitudes SET notificacion='si' WHERE id_solicitud=$id_solicitud";
				
				$actualizar = mysqli_query($db,$sql);
			}
		}
	}
	$json.= "'SOLICITUDES':$solicitudes}";
	$json.= "]}";
	echo $json;
	
}
else
{
	echo "no tienes permiso";
}
?>