<?php
/*$_POST['tipo'] = 2;
$_POST['id_usuario'] = 25;*/
if(isset($_POST['tipo']))
{	
	$tipo 		=	$_POST["tipo"];
	$json = "";
	if($tipo==1 || $tipo=="1")
	{
		$id = $_POST['id_usuario'];
		include('conex.inc');
		
		$sql 		= "SELECT * FROM ayudantes WHERE id_usuario=".$id;
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$lista = mysqli_fetch_array($resultado);
			$id_ayudante 	= $lista['id_ayudante'];

			$sql 		= "SELECT * FROM solicitudes WHERE id_ayudante=".$id_ayudante;
			$resultado 	= mysqli_query($db,$sql);
			$contador 	= mysqli_num_rows($resultado);
			if ($contador>0)
			{
				$json = "{ 'HISTORIAL': [";
				$total = "";
				while ($lista = mysqli_fetch_array($resultado))
				{
					$id_solicitud 	= $lista['id_solicitud'];
					$id_usuario 	= $lista['id_usuario'];
					$estado 		= $lista['estado'];
					
					$sql1 		= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
					$resultado1 	= mysqli_query($db,$sql1);
					$contador1 	= mysqli_num_rows($resultado1);
					if ($contador1>0)
					{
						$lista1 = mysqli_fetch_array($resultado1);
						$nombres 	= $lista1['nombres'];
						$nombres 	= explode(" ", $nombres);
						$apellidos 	= $lista1['apellidos'];
						$apellidos 	= explode(" ", $apellidos);
						$nombre_completo = $nombres[0]." ".$apellidos[0];

						$total.= "{'ID_SOLICITUD':$id_solicitud,'NOMBRE':'$nombre_completo', 'ESTADO':'$estado'},";
					}
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
				$json = "No hay solicitudes";
			}
		}
		else
		{
			$json = "Ayudante no encontrado";
		}
	}
	else if($tipo==2 || $tipo=="2")
	{
		$id = $_POST['id_usuario'];
		include('conex.inc');
		
		$sql 		= "SELECT * FROM solicitudes WHERE id_usuario=".$id;
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'HISTORIAL': [";
			$total = "";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_solicitud 	= $lista['id_solicitud'];
				$id_ayudante 	= $lista['id_ayudante'];
				$estado 		= $lista['estado'];
					
				$sql1 		= "SELECT * FROM ayudantes WHERE id_ayudante=".$id_ayudante;
				$resultado1 	= mysqli_query($db,$sql1);
				$contador1 	= mysqli_num_rows($resultado1);
				if ($contador1>0)
				{
					$lista1 = mysqli_fetch_array($resultado1);
					$id_usuario 	= $lista1['id_usuario'];

					$sql1 		= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
					$resultado1 	= mysqli_query($db,$sql1);
					$contador1 	= mysqli_num_rows($resultado1);
					if ($contador1>0)
					{
						$lista1 = mysqli_fetch_array($resultado1);
						$nombres 	= $lista1['nombres'];
						$nombres 	= explode(" ", $nombres);
						$apellidos 	= $lista1['apellidos'];
						$apellidos 	= explode(" ", $apellidos);
						$nombre_completo = $nombres[0]." ".$apellidos[0];

						$total.= "{'ID_SOLICITUD':$id_solicitud,'NOMBRE':'$nombre_completo', 'ESTADO':'$estado'},";
					}
					else
					{
						$json = "Los datos de este ayudante no existen";
					}
				}
				else
				{
					$json = "No hay dayos de ayudante";
				}
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
			$json = "No has hecho solicitudes.";
		}
	}

	else if($tipo==3 || $tipo=="3")
	{
		$id = $_POST['id_usuario'];
		$id_ayudante		= $_POST["id_ayudante"];
		include('conex.inc');
		
		$sql 		= "SELECT * FROM solicitudes WHERE id_usuario=".$id." AND id_ayudante=".$id_ayudante;
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'HISTORIAL': [";
			$total = "";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_solicitud 	= $lista['id_solicitud'];
				$id_ayudante 	= $lista['id_ayudante'];
				$estado 		= $lista['estado'];
					
				$sql1 		= "SELECT * FROM ayudantes WHERE id_ayudante=".$id_ayudante;
				$resultado1 	= mysqli_query($db,$sql1);
				$contador1 	= mysqli_num_rows($resultado1);
				if ($contador1>0)
				{
					$lista1 = mysqli_fetch_array($resultado1);
					$id_usuario 	= $lista1['id_usuario'];

					$sql1 		= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
					$resultado1 	= mysqli_query($db,$sql1);
					$contador1 	= mysqli_num_rows($resultado1);
					if ($contador1>0)
					{
						$lista1 = mysqli_fetch_array($resultado1);
						$nombres 	= $lista1['nombres'];
						$nombres 	= explode(" ", $nombres);
						$apellidos 	= $lista1['apellidos'];
						$apellidos 	= explode(" ", $apellidos);
						$nombre_completo = $nombres[0]." ".$apellidos[0];

						$total.= "{'ID_SOLICITUD':$id_solicitud,'NOMBRE':'$nombre_completo', 'ESTADO':'$estado'},";
					}
					else
					{
						$json = "Los datos de este ayudante no existen";
					}
				}
				else
				{
					$json = "No hay dayos de ayudante";
				}
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
			$json = "No has hecho solicitudes.";
		}
	}

	else
	{
	    $json = "No hay tipo";
	}

	echo $json;
}
else
{
	echo "no tienes permiso";
}
?>