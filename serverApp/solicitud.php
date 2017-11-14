<?php
if(isset($_POST["tipo"]))
{
	include('conex.inc');
	$tipo = $_POST["tipo"];
	$json = "";
	if($tipo == "1" || $tipo ==1)
	{
		$id_usuario 		= $_POST["id_usuario"];
		$id_ayudante		= $_POST["id_ayudante"];
		$comentario			= $_POST["comentario"];
		$fecha 				= $_POST["fecha"];
		list($dia,$mes,$año) = explode("-", $fecha);
		$fecha 				= "$año-$mes-$dia";
		$inicio				= $_POST["hora_inicio"];
		$termino			= $_POST["hora_termino"];

		$sql = "INSERT INTO solicitudes (id_usuario, id_ayudante, mensaje, estado, notificacion, fecha_sesion, hora_inicio, hora_termino) ";
	    $sql.= "VALUES ($id_usuario,$id_ayudante,'$comentario', 'Pendiente','no', '$fecha','$inicio','$termino')";
	    $insertar = mysqli_query($db,$sql);
	    if(!$insertar){	echo mysqli_error($db);	}

	    $sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor,fecha) ";
	    $sql.= "VALUES ($id_usuario,'Envio de solicitud', '','$comentario','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);
	    $json = "Solicitud enviada.";
	}
	if($tipo == "2" || $tipo ==2)
	{
		// BUSCA AL AYUDANTE
		$id_usuario 		= $_POST["id_usuario"];
		$sql = "SELECT * FROM ayudantes WHERE id_usuario=$id_usuario";
	    $resultado  = mysqli_query($db,$sql);
	    $contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$lista = mysqli_fetch_array($resultado);
		    $id_ayudante 	= $lista['id_ayudante'];
		}

		// BUSCA TODAS LAS SOLICITUDES QUE TENGA EL AYUDANTE
    	$sql = "SELECT * FROM solicitudes WHERE id_ayudante=$id_ayudante";
	    $resultado  = mysqli_query($db,$sql);
	    $contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'SOLICITUDES': [";
			$total = "";
			while($lista = mysqli_fetch_array($resultado))
		    {
		    	$id_solicitud 	= $lista['id_solicitud'];
		    	$id 			= $lista['id_usuario'];
		    	$mensaje 		= $lista['mensaje'];
		    	$estado 		= $lista['estado'];
		    	$fecha 			= $lista['fecha_sesion'];
		    	$inicio 		= $lista['hora_inicio'];
		    	$termino 		= $lista['hora_termino'];

		    	$sql1 = "SELECT * FROM usuarios WHERE id_usuario=".$id;
			    $resultado1  = mysqli_query($db,$sql1);
			    $contador1   = mysqli_num_rows($resultado1);
				if ($contador1>0)
				{
				    while($lista1 = mysqli_fetch_array($resultado1))
				    {
				    	$nombres 	= $lista1['nombres'];
				    	$apellidos 	= $lista1['apellidos'];
				    	$nombres = explode(" ", $nombres);
				    	$apellidos = explode(" ", $apellidos);
				    	$nombre_completo = $nombres[0]." ".$apellidos[0];
				    }
				}
				else
				{
					$nombre_completo = "No hay datos";
				}

				$total.= "{'ID_SOLICITUD':$id_solicitud,'ID_USUARIO':$id,'NOMBRE':'$nombre_completo', 'MENSAJE':'$mensaje', 'FECHA':'$fecha', 'HORA_INICIO':'$inicio','HORA_TERMINO':'$termino','ESTADO':'$estado'},";

		    }
		    if(strlen($total)>0)
		    {
		    	$total = substr($total, 0, -1);
		    	$json.= $total;
		    }
			$json.= "]}";
		}
		else
		{
			$json = "No tienes solicitudes.";
		}
	}

	if($tipo == "3" || $tipo ==3)
	{
		$id_usuario 		= $_POST["id_usuario"];
		$sql = "SELECT * FROM ayudantes WHERE id_usuario=".$id_usuario;
	    $resultado  = mysqli_query($db,$sql);
	    $contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$lista = mysqli_fetch_array($resultado);
		    $id_ayudante 	= $lista['id_ayudante'];
		}
    	$sql = "SELECT * FROM solicitudes WHERE id_ayudante=$id_ayudante AND estado='Pendiente'";
	    $resultado  = mysqli_query($db,$sql);
	    $contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'SOLICITUDES': [";
			$total = "";
			while($lista = mysqli_fetch_array($resultado))
		    {
		    	$id_solicitud 	= $lista['id_solicitud'];
		    	$id 		 	= $lista['id_usuario'];
		    	$mensaje 		= $lista['mensaje'];
		    	$estado 		= $lista['estado'];
		    	$fecha 			= $lista['fecha_sesion'];
		    	$inicio 		= $lista['hora_inicio'];
		    	$termino 		= $lista['hora_termino'];

		    	$sql1 = "SELECT * FROM usuarios WHERE id_usuario=".$id;
			    $resultado1  = mysqli_query($db,$sql1);
			    $contador1   = mysqli_num_rows($resultado1);
				if ($contador1>0)
				{
				    while($lista1 = mysqli_fetch_array($resultado1))
				    {
				    	$nombres 	= $lista1['nombres'];
				    	$apellidos 	= $lista1['apellidos'];
				    	$nombres = explode(" ", $nombres);
				    	$apellidos = explode(" ", $apellidos);
				    	$nombre_completo = $nombres[0]." ".$apellidos[0];
				    }
				}
				else
				{
					$nombre_completo = "No hay datos";
				}

				$total.= "{'ID_SOLICITUD':$id_solicitud,'ID_USUARIO':$id,'NOMBRE':'$nombre_completo', 'MENSAJE':'$mensaje', 'FECHA':'$fecha', 'HORA_INICIO':'$inicio','HORA_TERMINO':'$termino','ESTADO':'$estado'},";
		    }
		    if(strlen($total)>0)
		    {
		    	$total = substr($total, 0, -1);
		    	$json.= $total;
		    }
			$json.= "]}";
		}
		else
		{
			$json = "No hay solicitudes pendientes.";
		}
	}

	if($tipo == "4" || $tipo ==4)
	{
		$id_solicitud 	= $_POST["id_solicitud"];
		// ESTADO PUEDE SER: CANCELADO - ACEPTADO
		$estado 		= $_POST["estado"];
		if($estado=="Aceptar")		{ $estado = "Aceptado";}
		if($estado=="Rechazar")		{ $estado = "Rechazado";}
		$sql = "UPDATE solicitudes SET estado='$estado' WHERE id_solicitud=".$id_solicitud;
	    $actualizar = mysqli_query($db,$sql);

	    if($estado=="Aceptado")
	    {
	    	$fecha  	= date("Y-m-d H:i:s");

	    	$sql = "SELECT * FROM solicitudes WHERE id_solicitud=".$id_solicitud;
			$resultado 	= mysqli_query($db,$sql);
			$contador 	= mysqli_num_rows($resultado);
			if ($contador>0)
			{
				$lista = mysqli_fetch_array($resultado);
				$id_ayudante = $lista['id_ayudante'];
				$id_usuario = $lista['id_usuario'];
			}

	    	$sql = "SELECT * FROM ayudantes WHERE id_ayudante=".$id_ayudante;
			$resultado 	= mysqli_query($db,$sql);
			$contador 	= mysqli_num_rows($resultado);
			if ($contador>0)
			{
				$lista = mysqli_fetch_array($resultado);
				$id_usuario_ayudante = $lista['id_usuario'];
			}

		    $sql = "INSERT INTO mensajes (fecha_hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
		    $sql.= "VALUES ('$fecha',".$id_usuario.",".$id_usuario_ayudante.",'Mensaje','[MENSAJE AUTOMÁTICO | SOLICITUD ENVIADA]','Pendiente','no')";
		    $insertar = mysqli_query($db,$sql);

		    $sql = "INSERT INTO mensajes (fecha_hora , id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
			$sql.= "VALUES ('$fecha',".$id_usuario_ayudante.",".$id_usuario.",'Mensaje','[MENSAJE AUTOMÁTICO | SOLICITUD ACEPTADA]','Pendiente','no')";
		    $insertar = mysqli_query($db,$sql);


			$sql = "INSERT INTO registro_sesion (id_solicitud, estado) ";
			$sql.= "VALUES ($id_solicitud, 'Pendiente')";
			$insertar = mysqli_query($db,$sql);
			if(!$insertar){	echo mysqli_error($db);	}
	    }
	    $json = $estado;
	}
	echo $json;
}

?>