<?php
if(isset($_POST["tipo"]))
{
	include('conex.inc');
	$tipo = $_POST["tipo"];
	$json = "";
	if($tipo == "1" || $tipo ==1)
	{
		$id_usuario 	= $_POST["id_usuario"];
		$id_ayudante	= $_POST["id_ayudante"];
		$valor			= $_POST["valor"];
		$comentario		= $_POST["comentario"];

		$sql = "INSERT INTO valoracion_ayudantes (id_usuario, id_ayudante, valor, comentario) ";
	    $sql.= "VALUES ($id_usuario, $id_ayudante, $valor, '$comentario')";
	    $insertar = mysqli_query($db,$sql);
	    if(!$insertar){	echo mysqli_error($db);	}

	    $sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor,fecha) ";
	    $sql.= "VALUES ($id_usuario,'Valoración a ayudante', '','$valor - $comentario','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);
	    $json =  "Enviado";
	}
	if($tipo == "2" || $tipo ==2)
	{
		// BUSCA AL AYUDANTE
		$id_ayudante 		= $_POST["id_ayudante"];

		// BUSCA TODAS LAS SOLICITUDES QUE TENGA EL AYUDANTE
    	$sql = "SELECT * FROM valoracion_ayudantes WHERE id_ayudante=$id_ayudante";
	    $resultado  = mysqli_query($db,$sql);
	    $contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'VALORACIONES': [";
			$total = "";
			while($lista = mysqli_fetch_array($resultado))
		    {
		    	$id_valoracion 	= $lista['id_valoracion'];
		    	$id 			= $lista['id_usuario'];
		    	$valor 			= $lista['valor'];
		    	$comentario 	= $lista['comentario'];

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

				$total.= "{'ID_VALORACION':$id_valoracion,'NOMBRE':'$nombre_completo', 'VALOR':$valor, 'COMENTARIO':'$comentario'},";

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
		$id_ayudante 		= $_POST["id_ayudante"];
		
    	$sql = "SELECT * FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante." AND id_usuario=".$id_usuario;
	    $resultado  = mysqli_query($db,$sql);
	    $contador   = mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'VALORACIONES': [";
			$total = "";
			while($lista = mysqli_fetch_array($resultado))
		    {
		    	$id_valoracion 	= $lista['id_valoracion'];
		    	$id 		 	= $lista['id_usuario'];
		    	$valor 			= $lista['valor'];
		    	$comentario 	= $lista['comentario'];

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

				$total.= "{'ID_VALORACION':$id_valoracion,'NOMBRE':'$nombre_completo', 'VALOR':$valor, 'COMENTARIO':'$comentario'},";
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
			$json = "No hay valoraciones.";
		}
	}
	echo $json;
}

?>