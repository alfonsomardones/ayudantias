<?php
include("../datos/conex.inc");
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['control_instituciones']=='si')
	{
		$sql 			= "SELECT * FROM instituciones";
		$resultado 		= mysqli_query($db,$sql);
		$contador 		= mysqli_num_rows($resultado);
		if($contador>0)
		{
			echo "<div class='input-group'><input type='text' id='FiltroInstituciones' onkeyup='FiltroInstituciones()' placeholder='Buscar institución ...' class='form-control'></div>";
			echo "<table id='TablaInstituciones' class='table'>
					<tr>
						<th>Nombres</th>
						<th>Logo Institución</th>
						<th>Logo Certificación</th>
						<th COLSPAN='2'>Operaciones</th>
					</tr>";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_institucion 		= $lista['id_institucion'];
				$nombre 				= $lista['nombre'];
				$logo_institucion 		= $lista['logo_institucion'];
				$logo_certificacion 	= $lista['logo_certificacion'];

				echo "<tr id='filaTablaInstitucion".$id_institucion."'>
					<td>
						<input type='text' value='$id_institucion' name='input_id".$id_institucion."' id='input_id".$id_institucion."' class='sr-only'>
						<input type='text' value='$nombre' name='input_nombre".$id_institucion."' id='input_nombre".$id_institucion."' class='form-control'>
					</td>
					<td>
						<input type='text' value='$logo_institucion' name='input_logo_institucion".$id_institucion."' id='input_logo_institucion".$id_institucion."' class='form-control'>
					</td>
					<td>
						<input type='text' value='$logo_certificacion' name='input_logo_certificacion".$id_institucion."' id='input_logo_certificacion".$id_institucion."' class='form-control'>
					</td>
					<td><input type='button' value='Guardar' onclick='comprobar_actualizar_institucion(".$id_institucion.")' class='btn btn-primary'></td>
					<td><input type='button' value='Borrar' onclick='BorrarInstitucion(".$id_institucion.")' class='btn btn-primary'></td>
				</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No existen instituciones registradas.</strong></div>';
		}
	}
	else
	{
		echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes permisos.</strong></div>';
	}
}
else
{
	echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes permisos.</strong></div>';
}
?>