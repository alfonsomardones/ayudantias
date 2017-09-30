<?php
include("../datos/conex.inc");
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if(isset($_SESSION['nombre_tipo_usuario']))
	{	
		if($_SESSION['control_usuarios']=='si')
		{
			$sql 			= "SELECT * FROM usuarios";
			$resultado 		= mysqli_query($db,$sql);
			$contador 		= mysqli_num_rows($resultado);
			if($contador>0)
			{
				echo "<div class='input-group'><input type='text' id='FiltroUsuarios' onkeyup='FiltroUsuarios()' placeholder='Buscar usuario ...' class='form-control'>
				<select id='tipoBuscarUsuario' class='form-control'>
					<option value='nombres'>Nombres</option>
					<option value='apellidos'>Apellidos</option>
					<option value='rut'>Rut</option>
					<option value='correo'>Correo</option>
					<option value='telefono'>Teléfono</option>
				</select></div>";
				echo "<table id='TablaUsuarios' class='table table-striped'>
						<tr>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Rut</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Tipo</th>
							<th>Estado</th>
							<th COLSPAN='2'>Operaciones</th>
						</tr>";
				while ($lista = mysqli_fetch_array($resultado))
				{
					$id_usuario 		= $lista['id_usuario'];
					$nombres 			= $lista['nombres'];
					$apellidos 			= $lista['apellidos'];
					$rut 				= $lista['rut'];
					$fecha_nac 			= $lista['fecha_nacimiento'];
					$telefono 			= $lista['telefono'];
					$correo 			= $lista['correo'];
					$id_tipo_usuario 	= $lista['id_tipo_usuario'];
					$estado 			= $lista['estado'];

					echo "<tr id='filaTablaUsuarios".$id_usuario."'>
						<td>
							<input type='text' value='$nombres' name='input_nombres".$id_usuario."' id='input_nombres".$id_usuario."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_usuario(".$id_usuario.")'>
						</td>
						<td>
							<input type='text' value='$apellidos' name='input_apellidos".$id_usuario."' id='input_apellidos".$id_usuario."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_usuario(".$id_usuario.")'>
						</td>
						<td>
							<input type='text' value='$rut' name='input_rut".$id_usuario."' id='input_rut".$id_usuario."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_usuario(".$id_usuario.")'>
						</td>
						<td>
							<input type='tel' value='$telefono' name='input_telefono".$id_usuario."' id='input_telefono".$id_usuario."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_usuario(".$id_usuario.")'>
						</td>
						<td>
							<input type='text' value='$correo' 	name='input_correo".$id_usuario."' id='input_correo".$id_usuario."' class='form-control' onkeypress='if (event.keyCode == 13) comprobar_actualizar_usuario(".$id_usuario.")'>
						</td>
						<td>";
							$sql2 			= "SELECT * FROM tipo_usuarios";
							$resultado2 		= mysqli_query($db,$sql2);
							$contador2 		= mysqli_num_rows($resultado2);
							if($contador2>0)
							{
								echo "<select name='input_tipo".$id_usuario."' id='input_tipo".$id_usuario."' class='form-control'>";
								while ($lista2 = mysqli_fetch_array($resultado2))
								{
									$id_tipo2 	= $lista2['id_tipo_usuario'];
									$nombre_tipo	= $lista2['nombre'];

									echo "<option value='".$id_tipo2."'";
	    							if($id_tipo_usuario==$id_tipo2){echo " selected";}
	    								echo ">$nombre_tipo</option>";
								}
								echo "</select>";
							}
						echo "</td>
						<td>
							<select id='input_estado".$id_usuario."' name='input_estado".$id_usuario."' class='form-control' >
							<option value='Habilitado' ";
							if($estado=="Habilitado") { echo "selected";}
							echo ">Habilitado</option>";
							echo "<option value='Bloqueado' ";
							if($estado=="Bloqueado") {echo "selected"; }
							echo ">Bloqueado</option></select>
						<input type='text' value='$id_usuario' name='input_id".$id_usuario."' id='input_id".$id_usuario."' class='sr-only'>
						<input type='text' value='$fecha_nac' name='input_fecha_nac".$id_usuario."' id='input_fecha_nac".$id_usuario."' class='sr-only'>
						</td>
						<td><input type='button' value='Guardar' onclick='comprobar_actualizar_usuario(".$id_usuario.")' class='btn btn-primary'></td>
						<td><input type='button' value='Borrar' onclick='comprobar_borrar(".$id_usuario.")' class='btn btn-primary'></td>
					</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo '<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No existen usuarios.</strong></div>';
			}
		}
		else
		{
			echo '<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes permisos.</strong></div>';
		}
	}
	else
	{
		echo '<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No eres un usuario Administrador.</strong></div>';
	}
}
else
{
	echo '<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No has iniciado sesión.</strong></div>';


}
?>