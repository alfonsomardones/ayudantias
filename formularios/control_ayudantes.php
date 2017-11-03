<?php
include("../datos/conex.php");
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if(($_SESSION['nombre_tipo_usuario']=="Administrador Institución") && ($_SESSION['control_ayudantes']=="si"))
	{
		if(isset($_SESSION['id_institucion']))
		{
			$sql1 			= "SELECT * FROM institucion_carrera WHERE id_institucion=".$_SESSION['id_institucion'];
			$resultado1 		= mysqli_query($db,$sql1);
			if(!$resultado1){	echo mysqli_error($db);	}
			$contador1 		= mysqli_num_rows($resultado1);
			if($contador1>0)
			{
				echo "<div class='input-group-btn'>
						<button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i></button>
						<input type='text' id='FiltroAyudantes' placeholder='Buscar ayudante ...' class='form-control' >
						<select id='tipoBuscarUsuario' class='form-control'>
							<option value='nombres'>Nombres</option>
							<option value='estado'>Estado</option>
							<option value='carrera'>Carrera</option>
							<option value='certificacion'>Certificación</option>
						</select></div>
					<div class='container-fluid'>
						<div class='table-responsive'>
							<table id='TablaAyudantes' class='table table-striped'>
							<tr>
								<th>Carrera</th>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Certificación</th>
								<th>Operaciones</th>
							</tr>";
				while ($lista1 = mysqli_fetch_array($resultado1))
				{
					$id_institucion_carrera = $lista1['id_institucion_carrera'];
					$id_carrera 			= $lista1['id_carrera'];

					$sql2 	= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera." ORDER BY nombre ASC";
					$resultado2 	= mysqli_query($db,$sql2);
					if(!$resultado2){	echo mysqli_error($db);		}
					$contador2 		= mysqli_num_rows($resultado2);
					if ($contador2>0)
					{
						$lista2 	= mysqli_fetch_array($resultado2);
						$nombre_carrera 	= $lista2['nombre'];
					}

					$sql3 	= "SELECT * FROM ayudantes WHERE id_institucion_carrera=".$id_institucion_carrera;
					$resultado3 	= mysqli_query($db,$sql3);
					if(!$resultado3){	echo mysqli_error($db);	}
					$contador3 		= mysqli_num_rows($resultado3);
					if($contador3>0)
					{
						while ($lista3 = mysqli_fetch_array($resultado3))
						{
							$id_ayudante 	= $lista3['id_ayudante'];
							$id_usuario 	= $lista3['id_usuario'];
							$id_certificacion	= $lista3['id_certificacion'];

							$sql4 	= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
							$resultado4 		= mysqli_query($db,$sql4);
							if(!$resultado4){	echo mysqli_error($db);		}
							$contador4 		= mysqli_num_rows($resultado4);
							if($contador4>0)
							{
								$lista4 = mysqli_fetch_array($resultado4);
								$nombres 		= $lista4['nombres'];
								$apellidos 		= $lista4['apellidos'];
								$estado 		= $lista4['estado'];

								echo "<tr>";
									echo "<td><input type='text' value='$nombre_carrera' class='form-control' disabled></td>
										<td><input type='text' value='$nombres $apellidos' class='form-control' disabled></td>
										<td><select id='input_estado".$id_usuario."' class='form-control'>
										<option value='Habilitado'";
										if($estado=="Habilitado") { echo " selected "; }
										echo ">Habilitado</option>
										<option value='Bloqueado'";
										if($estado=="Bloqueado") { echo " selected "; }
										echo ">Bloqueado</option>
										</select></td>";
									echo "<td>";
									$sql5 	= "SELECT * FROM certificacion ORDER BY nombre ASC";
									$resultado5 		= mysqli_query($db,$sql5);
									if(!$resultado5){	echo mysqli_error($db);		}
									$contador5 		= mysqli_num_rows($resultado5);
									if($contador5>0)
									{
										echo "<select name='input_certificacion' id='input_certificacion' class='form-control'>";
										while($lista5 = mysqli_fetch_array($resultado5))
										{
											$id_certificacionB = $lista5['id_certificacion'];
											$nombre_certificacion = $lista5['nombre'];
											echo "<option value='$id_certificacionB'";
											if($id_certificacion==$id_certificacionB){ echo " selected";}
											echo ">$nombre_certificacion</option>";
										}
										echo "</select>";
									}
									else{
										echo "<input type='text' value='No hay certificaciones' disabled >";
									}
									echo "</td><td><div class='btn-group'>
											<input type='button' value='Guardar' class='btn btn-primary' disabled>
											<input type='button' value='Desasociar' class='btn btn-danger' onclick='desasociar_ayudante($id_ayudante)'></div></td></tr>";
							}
							else{	echo "<tr><td colspan='4'><input type='text' value='No hay datos de usuario ayudante.' class='form-control' disabled></td>
										<td><div class='btn-group'>
											<input type='button' value='Guardar' class='btn btn-primary' disabled>
											<input type='button' value='Desasociar' class='btn btn-danger' disabled></div></td></tr>";	}
						}
					}
					else
					{
						echo "<tr>
								<td><input type='text' value='$nombre_carrera' class='form-control' disabled></td>
								<td colspan='3'><input type='text' value='No hay ayudantes asociados.' class='form-control' disabled></td>
								<td><div class='btn-group'>
									<input type='button' value='Guardar' class='btn btn-primary' disabled>
									<input type='button' value='Borrar' class='btn btn-danger' disabled></div>
								</td>
							</tr>";
					}
				}
				echo "</table></div></div>";
			}
			else{	echo '<div id="alert-danger-ayudantes" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes institución asociada.</strong></div>';}
		}
		else
		{
			echo '<div id="alert-danger-ayudantes" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes institución asociada.</strong></div>';
		}
	}

	elseif(($_SESSION['nombre_tipo_usuario']=="Administrador Máster") && ($_SESSION['control_ayudantes']=="si"))
	{
		$sql 			= "SELECT * FROM instituciones ORDER BY nombre ASC";
		$resultado 		= mysqli_query($db,$sql);
		if(!$resultado){	echo mysqli_error($db);	}
		$contador 		= mysqli_num_rows($resultado);
		if($contador>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_institucion = $lista['id_institucion'];
				$nombre_institucion = $lista['nombre'];
				echo "
				<h2>$nombre_institucion</h2>
				<div class='container-fluid'>
					<div class='table-responsive'>
						<table id='TablaAyudantes$id_institucion' class='table table-striped'>
						<tr>
							<th>Carrera</th>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Certificación</th>
							<th>Operaciones</th>
						</tr>";
				$sql1 			= "SELECT * FROM institucion_carrera WHERE id_institucion=".$id_institucion;
				$resultado1 		= mysqli_query($db,$sql1);
				if(!$resultado1){	echo mysqli_error($db);		}
				$contador1 		= mysqli_num_rows($resultado1);
				if($contador1>0)
				{
					while ($lista1 = mysqli_fetch_array($resultado1))
					{
						$id_institucion_carrera = $lista1['id_institucion_carrera'];
						$id_carrera 			= $lista1['id_carrera'];

						$sql2 	= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera." ORDER BY nombre ASC";
						$resultado2 	= mysqli_query($db,$sql2);
						if(!$resultado2){	echo mysqli_error($db);		}
						$contador2 		= mysqli_num_rows($resultado2);
						if ($contador2>0)
						{
							$lista2 	= mysqli_fetch_array($resultado2);
							$nombre_carrera 	= $lista2['nombre'];
						}

						$sql3 	= "SELECT * FROM ayudantes WHERE id_institucion_carrera=".$id_institucion_carrera;
						$resultado3 	= mysqli_query($db,$sql3);
						if(!$resultado3){	echo mysqli_error($db);	}
						$contador3 		= mysqli_num_rows($resultado3);
						if($contador3>0)
						{
							while ($lista3 = mysqli_fetch_array($resultado3))
							{
								$id_ayudante 	= $lista3['id_ayudante'];
								$id_usuario 	= $lista3['id_usuario'];
								$id_certificacion	= $lista3['id_certificacion'];

								$sql4 	= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
								$resultado4 		= mysqli_query($db,$sql4);
								if(!$resultado4){	echo mysqli_error($db);		}
								$contador4 		= mysqli_num_rows($resultado4);
								if($contador4>0)
								{
									$lista4 = mysqli_fetch_array($resultado4);
									$nombres 		= $lista4['nombres'];
									$apellidos 		= $lista4['apellidos'];
									$estado 		= $lista4['estado'];

									echo "<tr>";
										echo "<td><input type='text' value='$nombre_carrera' class='form-control' disabled></td>
												<td><input type='text' value='$nombres $apellidos'class='form-control' disabled></td>
												<td><select id='input_estado".$id_usuario."' class='form-control'>
												<option value='Habilitado'";
												if($estado=="Habilitado") { echo " selected "; }
												echo ">Habilitado</option>
												<option value='Bloqueado'";
												if($estado=="Bloqueado") { echo " selected "; }
												echo ">Bloqueado</option>
												</select></td>";
									echo "<td>";
									$sql5 	= "SELECT * FROM certificacion ORDER BY nombre ASC";
									$resultado5 		= mysqli_query($db,$sql5);
									if(!$resultado5){	echo mysqli_error($db);		}
									$contador5 		= mysqli_num_rows($resultado5);
									if($contador5>0)
									{
										echo "<select name='input_certificacion' id='input_certificacion' class='form-control'>";
										while($lista5 = mysqli_fetch_array($resultado5))
										{
											$id_certificacionB = $lista5['id_certificacion'];
											$nombre_certificacion = $lista5['nombre'];
											echo "<option value='$id_certificacionB'";
											if($id_certificacion==$id_certificacionB){ echo " selected";}
											echo ">$nombre_certificacion</option>";
										}
										echo "</select>";
									}
									else
									{
										echo "<input type='text' value='No hay certificaciones' disabled>";
									}
									echo "</td>";
										echo "<td><div class='btn-group'>
											<input type='button' value='Guardar' class='btn btn-primary' disabled>
											<input type='button' value='Desasociar' class='btn btn-danger' onclick='desasociar_ayudante($id_ayudante)'></div></td>";
									echo "</tr>";
		
								}
								else
								{
									echo "<tr><td colspan='4'><input type='text' value='No hay datos de usuario ayudante.' class='form-control' disabled></td>
											<td><div class='btn-group'>
												<input type='button' value='Guardar' class='btn btn-primary' disabled>
												<input type='button' value='Borrar' class='btn btn-danger' disabled></div></td></tr>";
								}
							}
						}
						else{	echo "<tr>
										<td><input type='text' value='$nombre_carrera' class='form-control' disabled></td>
										<td colspan='3'><input type='text' value='No hay ayudantes asociados.' class='form-control' disabled></td>
										<td><div class='btn-group'><input type='button' value='Guardar' class='btn btn-primary' disabled>
												<input type='button' value='Borrar' class='btn btn-danger' disabled></div></td>
									</tr>";
								}
					}
				}
				else{	echo "<tr><td colspan='4'><input type='text' value='No hay carreras asociadas a intituciones.' class='form-control' disabled></td>
					<td><div class='btn-group'><input type='button' value='Guardar' class='btn btn-primary' disabled>
												<input type='button' value='Borrar' class='btn btn-danger' disabled></div></td></tr>";	}
				echo "</table></div></div>";
			}
		}
		else{	echo '<div id="alert-danger-ayudantes" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No hay instituciones registradas.</strong></div>';	}
	}
	else{	echo '<div id="alert-danger-ayudantes" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No eres ningín tupo de administrador.</strong></div>';	} 
}
else{	echo " no eres usuario, sal de aquí";}
?>