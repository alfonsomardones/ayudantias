<?php
include("../datos/conex.php");
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['control_carreras']=='si' && $_SESSION['nombre_tipo_usuario']=='Administrador Máster')
	{
		$sql 			= "SELECT * FROM carreras ORDER BY nombre ASC";
		$resultado 		= mysqli_query($db,$sql);
		$contador 		= mysqli_num_rows($resultado);
		if($contador>0)
		{
			echo "<div class='input-group-btn'><button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i></button><input type='text' id='FiltroCarreras' onkeyup='FiltroCarreras()' placeholder='Buscar carrera ...' class='form-control'></div>";
			echo "<div class='container-fluid'>
						<div class='table-responsive'>
						<table id='TablaCarreras' class='table table-striped'>
					<tr>
						<th>Nombre</th>
						<th>Operaciones</th>
					</tr>";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_carrera 		= $lista['id_carrera'];
				$nombre 				= $lista['nombre'];
				echo "<tr id='filaTablaCarreras".$id_carrera."'>
					<td><input type='text' value='$id_carrera' name='input_id".$id_carrera."' id='input_id".$id_carrera."' class='sr-only'>
						<input type='text' value='$nombre' name='input_nombre".$id_carrera."' id='input_nombre".$id_carrera."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_carrera(".$id_carrera.")'>
					</td>
					<td>
						<div class='btn-group'>
							<input type='button' value='Guardar' onclick='comprobar_actualizar_carrera(".$id_carrera.")' class='btn btn-primary'>
							<input type='button' value='Borrar' onclick='BorrarCarrera(".$id_carrera.")' class='btn btn-danger'>
						</div>
					</td>
				</tr>";
			}
			echo "</table></div></div>";
		}
		else
		{
			echo '<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No existen carreras registradas.</strong></div>';
		}
	}
	elseif(($_SESSION['control_carreras']=='si') && ($_SESSION['nombre_tipo_usuario']=='Administrador Institución'))
	{
		if(isset($_SESSION['id_institucion']))
		{
			$sql 		= "SELECT * FROM institucion_carrera WHERE id_institucion=".$_SESSION['id_institucion'];
			$resultado 		= mysqli_query($db,$sql);
			$contador 		= mysqli_num_rows($resultado);
			if($contador>0)
			{
				echo "<div class='input-group-btn'><button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i></button><input type='text' id='FiltroCarreras' onkeyup='FiltroCarreras()' placeholder='Buscar carrera ...' class='form-control'></div>";
				echo "<div class='container-fluid'>
							<div class='table-responsive'>
							<table id='TablaCarreras' class='table table-striped'>
						<tr>
							<th>Nombre</th>
							<th>Operaciones</th>
						</tr>";
				while ($lista = mysqli_fetch_array($resultado))
				{
					$id_institucion_carrera 		= $lista['id_institucion_carrera'];
					$id_carrera 			= $lista['id_carrera'];

					$sql1 		= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera;
					$resultado1 		= mysqli_query($db,$sql1);
					$contador1 		= mysqli_num_rows($resultado1);
					if($contador1>0)
					{
						while ($lista1 = mysqli_fetch_array($resultado1))
						{
							$nombre 		= $lista1['nombre'];
							echo "<tr id='filaTablaCarreras".$id_carrera."'>
							<td><input type='text' value='$id_institucion_carrera' name='input_institucion_carrera".$id_institucion_carrera."' id='input_institucion_carrera".$id_institucion_carrera."' class='sr-only'>
								<input type='text' value='$nombre' name='input_nombre".$id_carrera."' id='input_nombre".$id_carrera."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_carrera(".$id_carrera.")'>
							</td>
							<td>
								<div class='btn-group'>
									<input type='button' value='Guardar' onclick='comprobar_actualizar_carrera(".$id_carrera.")' class='btn btn-primary'>
									<input type='button' value='Borrar' onclick='BorrarCarrera(".$id_carrera.")' class='btn btn-danger'>
								</div>
							</td>
						</tr>";
						}
					}
					else
					{
						echo "No datos carreras.";
					}
				}
				echo "</table></div></div>";
			}
			else
			{
				echo '<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No existen carreras registradas.</strong></div>';
			}
		}
		else
		{
			echo '<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes id de institucion asociado.</strong></div>';
		}
	}
	else
	{
		echo '<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes permisos.</strong></div>';
	}
}
else
{
	echo "Lo siento, no has iniciado sesión";
}
?>