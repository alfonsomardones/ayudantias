<?php
include("../datos/conex.php");
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
			echo "<div class='input-group-btn'><button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i></button><input type='text' id='FiltroInstituciones' onkeyup='FiltroInstituciones()' placeholder='Buscar institución ...' class='form-control'></div>";
			echo "<div class='container-fluid'>
					<div class='table-responsive'>
						<table id='TablaInstituciones' class='table table-striped'>
					<tr>
						<th>Nombres</th>
						<th>Logo Institución</th>
						<th>Operaciones</th>
					</tr>";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_institucion 		= $lista['id_institucion'];
				$nombre 				= $lista['nombre'];
				$logo_institucion 		= $lista['logo_institucion'];

				echo "<tr id='filaTablaInstitucion".$id_institucion."'>
					<td>
						<input type='text' value='$id_institucion' name='input_id".$id_institucion."' id='input_id".$id_institucion."' class='sr-only'>
						<input type='text' value='$nombre' name='input_nombre".$id_institucion."' id='input_nombre".$id_institucion."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_institucion(".$id_institucion.")'>
					</td>
					<td>
						<input name='subir_logo_institucion' type='file' class='form-control'/>
					</td>
					<td><div class='btn-group'><input type='button' value='Guardar' onclick='comprobar_actualizar_institucion(".$id_institucion.")' class='btn btn-primary'>
					<input type='button' value='Borrar' onclick='BorrarInstitucion(".$id_institucion.")' class='btn btn-danger'></div></td>
				</tr>";
			}
			echo "</table></div></div>";
		}
		else
		{
			echo "</table></div></div>";
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