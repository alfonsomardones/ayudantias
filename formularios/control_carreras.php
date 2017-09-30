<?php
include("../datos/conex.inc");
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['control_carreras']=='si')
	{
		$sql 			= "SELECT * FROM carreras";
		$resultado 		= mysqli_query($db,$sql);
		$contador 		= mysqli_num_rows($resultado);
		if($contador>0)
		{
			echo "<div class='input-group'><input type='text' id='FiltroCarreras' onkeyup='FiltroCarreras()' placeholder='Buscar carrera ...' class='form-control'></div>";
			echo "<table id='TablaCarreras' class='table table-striped'>
					<tr>
						<th>Nombre</th>
						<th COLSPAN='2'>Operaciones</th>
					</tr>";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_carrera 		= $lista['id_carrera'];
				$nombre 				= $lista['nombre'];
				echo "<tr id='filaTablaCarreras".$id_carrera."'>
					<td><input type='text' value='$id_carrera' name='input_id".$id_carrera."' id='input_id".$id_carrera."' class='sr-only'>
						<input type='text' value='$nombre' name='input_nombre".$id_carrera."' id='input_nombre".$id_carrera."' class='form-control' >
					</td>
					<td><input type='button' value='Guardar' onclick='comprobar_actualizar_carrera(".$id_carrera.")' class='btn btn-primary'></td>
					<td><input type='button' value='Borrar' onclick='BorrarCarrera(".$id_carrera.")' class='btn btn-primary'></td>
				</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo '<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No existen carreras registradas.</strong></div>';
		}
	}
	else
	{
		echo '<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes permisos.</strong></div>';
	}
}
?>