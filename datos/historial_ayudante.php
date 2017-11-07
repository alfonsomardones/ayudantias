<?php
session_start();
if(isset($_SESSION['id_usuario']))
{
	if(isset($_POST['cod']))
	{
		$id_ayudante = $_POST['cod'];
		include('conex.php');
		
		$sql 		= "SELECT * FROM solicitudes WHERE id_ayudante=".$id_ayudante;
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$sql 		= "SELECT * FROM solicitudes WHERE id_ayudante=".$id_ayudante." AND estado='Aceptado'";
			$resultado1 	= mysqli_query($db,$sql);
			$aceptados 	= mysqli_num_rows($resultado1);
			$sql 		= "SELECT * FROM solicitudes WHERE id_ayudante=".$id_ayudante." AND estado='Rechazado'";
			$resultado2 	= mysqli_query($db,$sql);
			$rechazados 	= mysqli_num_rows($resultado2);
			echo "<label>Aceptados: ".$aceptados." - Rechazados: ".$rechazados."</label>";

			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_solicitud 	= $lista['id_solicitud'];
				$id_usuario 	= $lista['id_usuario'];
				$mensaje 		= $lista['mensaje'];
				if($mensaje==""){
					$mensaje = "Sin mensaje";
				}
				$estado 		= $lista['estado'];
				if($estado=="Aceptado")
				{	$estado = "<span class='glyphicon glyphicon-ok-sign'></span>";}
				else
				{	$estado = "<span class='glyphicon glyphicon-ban-circle'></span>";		}
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

					echo "<p>ID SOLICITUD: ".$id_solicitud." - ESTUDIANTE: ".$nombres[0]." ".$apellidos[0]." - ".$estado."</p>";
				}
			}
		}
		else
		{
			echo "No tiene historial";
		}
	}
	else
	{
	    header("location: error.php");
	}
}
else
{
	echo "no tienes permiso";
}
?>