<?php
session_start();
if(isset($_SESSION['nombre_tipo_usuario']))
{
	if($_SESSION['nombre_tipo_usuario'] == "Administrador Máster" || $_SESSION['nombre_tipo_usuario'] == "Administrador Institución")
	{

		if(isset($_POST['cod']))
		{
			$id_ayudante = $_POST['cod'];
			include('conex.php');
			
			$sql 		= "SELECT * FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante;
			$resultado 	= mysqli_query($db,$sql);
			$contador 	= mysqli_num_rows($resultado);
			if ($contador>0)
			{
				$total = 0;
				$sql 		= "SELECT * FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante;
				$resultado1 	= mysqli_query($db,$sql);
				$cantidad 	= mysqli_num_rows($resultado1);
				if ($cantidad>0)
				{
					while ($lista1 = mysqli_fetch_array($resultado1))
					{
						$valor 		= $lista1['valor'];
						$total = $total + $valor;
					}
				}
				if($total>0) {	$total = $total / $cantidad; }
				echo "Promedio: ".$total;
				while ($lista = mysqli_fetch_array($resultado))
				{
					$id_valoracion 	= $lista['id_valoracion'];
					$id_usuario 	= $lista['id_usuario'];
					$valor 			= $lista['valor'];
					$comentario 		= $lista['comentario'];
					if($comentario==""){
						$comentario = "Sin comentario";
					}

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

						echo "<p>ID VALORACIÓN: ".$id_valoracion." - ESTUDIANTE: ".$nombres[0]." ".$apellidos[0]." - VALOR: ".$valor." - COMENTARIO: ".$comentario."</p>";
					}
				}
			}
			else
			{
				echo "No ha sido valorado";
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
}
else
{
	echo "no tienes permiso";
}
?>