<?php
/*$_POST["tipo"] = 3;
$_POST["id_usuario"] = 3;
$_POST["id_otro"] = 71;*/
if(isset($_POST['tipo']))
{	
	$tipo 		=	$_POST["tipo"];
	include('conex.inc');
    if($tipo=="1" || $tipo==1)
    {
    	$fecha  	= date("Y-m-d H:i:s");
		$id_envia 	= $_POST['envia'];
		$id_recibe  = $_POST['recibe'];
		$tipo_mensaje  		= 'Mensaje';
		$mensaje  	= $_POST['mensaje'];

	    $sql = "INSERT INTO mensajes (fecha_hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
	    $sql.= "VALUES ('$fecha',$id_envia, $id_recibe,'$tipo_mensaje','$mensaje','Pendiente','no')";

	    $insertar = mysqli_query($db,$sql);
	    echo "Enviado";
    }

    if($tipo=="2" || $tipo==2)
    {
    	$id_usuario 	= $_POST['id_usuario'];
    	$sql      = "SELECT * FROM mensajes WHERE id_usuario_envia=".$id_usuario." OR id_usuario_recibe=".$id_usuario;
    	$resultado    = mysqli_query($db,$sql);
    	$contador     = mysqli_num_rows($resultado);
    	if($contador>0)
    	{
    		$json = "{ 'USUARIOS': [";
    		$sql = "SELECT DISTINCT id_usuario_envia, estado FROM mensajes WHERE id_usuario_envia=".$id_usuario." OR id_usuario_recibe=".$id_usuario. "  AND tipo_mensaje='Mensaje' ORDER BY fecha_hora DESC";
		    $resultado    = mysqli_query($db,$sql);
		    $contador     = mysqli_num_rows($resultado);
		    if($contador>0)
		    {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		    		$id_usuario_envia 	= $lista['id_usuario_envia'];
		    		$estado 			= $lista['estado'];
		    		if($id_usuario_envia!=$id_usuario)
		    		{
		    			$sql1 			= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario_envia;
		    			$resultado1 		= mysqli_query($db,$sql1);
		    			$contador1 		= mysqli_num_rows($resultado1);
		    			if($contador1>0)
		    			{
		    				$lista1 = mysqli_fetch_array($resultado1);
		    				$nombres = $lista1['nombres'];
		    				$nombres = explode(" ", $nombres);
		    				$nombres = $nombres[0];
		    				$apellidos = $lista1['apellidos'];
		    				$apellidos = explode(" ", $apellidos);
		    				$apellidos = $apellidos[0];
		    				
		    				$json.= "{'ID_USUARIO':$id_usuario_envia,'NOMBRE':'".$nombres." ".$apellidos."', 'ESTADO':'$estado'},";
		    			}
		    		}
		    	}
		    }
		    if(strlen($json)>20)
		    {  	$json = substr($json, 0, -1);    }
		    $json.= "]}";
		}
		else
		{
			$json = "No tienes mensajes.";
		}
		echo $json;
    }

    if($tipo=="3" || $tipo==3)
    {
    	$id_usuario 	= $_POST['id_usuario'];
    	$id_otro 		= $_POST['id_otro'];
    	$sql      = "SELECT * FROM mensajes WHERE id_usuario_envia=".$id_usuario." AND id_usuario_recibe=".$id_otro." OR id_usuario_recibe=".$id_usuario." AND id_usuario_envia=".$id_otro." AND tipo_mensaje='Mensaje' ORDER BY fecha_hora ASC";
    	$resultado    = mysqli_query($db,$sql);
    	$contador     = mysqli_num_rows($resultado);
    	if($contador>0)
    	{
    		$json = "{ 'MENSAJES': [";
    		while ($lista = mysqli_fetch_array($resultado))
    		{
    			$id_mensaje 	= $lista['id_mensaje'];
    			list($fecha,$hora) 	= explode(" ", $lista['fecha_hora']);
                $hora = substr($hora, 0,-3);
    			$id_usuario_envia = $lista['id_usuario_envia'];
    			$id_usuario_recibe = $lista['id_usuario_recibe'];
    			$mensaje 		= $lista['mensaje'];
    			$estado 		= $lista['estado'];

    			$sql1       	= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario_envia;
    			$resultado1     = mysqli_query($db,$sql1);
    			$contador1    	= mysqli_num_rows($resultado1);
    			if($contador1>0)
    			{
    				$lista1 	= mysqli_fetch_array($resultado1);
    				$nombres 	= $lista1['nombres'];
    				$nombres 	= explode(" ", $nombres);
    				$apellidos 	= $lista1['apellidos'];
    				$apellidos 	= explode(" ", $apellidos);

    				$json.= "{'ID_MENSAJE':".$id_mensaje.",'FECHA':'".$fecha."', 'HORA':'".$hora."','ID_ENVIA':".$id_usuario_envia.",'ID_RECIBE':".$id_usuario_recibe.",'MENSAJE':'".$mensaje."', 'ESTADO':'".$estado."'},";
    			}

    			$sql = "UPDATE mensajes SET estado='Visto' WHERE id_mensaje=".$id_mensaje." AND id_usuario_recibe=".$id_usuario." AND estado='Pendiente'";
    			$actualizar = mysqli_query($db,$sql);
    		}
    		if(strlen($json)>20)
		    {  	$json = substr($json, 0, -1);    }
    		$json.= "]}";
    	}
    	else
    	{
    		$json = "No hay mensajes con este usuario.";
    	}
    	echo $json;
    }
}
?>