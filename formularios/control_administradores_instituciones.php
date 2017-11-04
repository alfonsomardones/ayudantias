<?php
include("../datos/conex.php");
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['nombre_tipo_usuario']=="Administrador Máster")
	{
		$sql 			= "SELECT * FROM administrador_institucion";
		$resultado 		= mysqli_query($db,$sql);
		if(!$resultado){	echo mysqli_error($db);	}
		$contador 		= mysqli_num_rows($resultado);
		if($contador>0)
		{
			echo "<div class='container-fluid'>
					<div class='table-responsive'>
						<table id='TablaAdminInstitucion' class='table table-striped'>
						<tr>
							<th>Institución</th>
							<th>Administrador</th>
							<th>Estado</th>
							<th>Operaciones</th>
						</tr>";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_institucion 		= $lista['id_institucion'];
				$id_admin_institucion 	= $lista['id_usuario'];
			
				$sql1 			= "SELECT * FROM instituciones ORDER BY nombre ASC";
				$resultado1 		= mysqli_query($db,$sql1);
				if(!$resultado1){	echo mysqli_error($db);		}
				$contador1 		= mysqli_num_rows($resultado1);
				if($contador1>0)
				{
					echo "<tr>
					<td><select class='form-control' id='input_institucion".$id_admin_institucion."' name='input_institucion'>";
					while ($lista1 = mysqli_fetch_array($resultado1))
					{
						$id = $lista1['id_institucion'];
						$nombre_institucion = $lista1['nombre'];
						echo "<option value='$id'";
						if($id==$id_institucion){ echo " selected ";}
						echo ">$nombre_institucion</option>";
					}
					"</select></td>";

					$sql2 	= "SELECT * FROM usuarios WHERE id_tipo_usuario=3 ORDER BY nombres ASC";
					$resultado2 	= mysqli_query($db,$sql2);
					if(!$resultado2){	echo mysqli_error($db);		}
					$contador2 		= mysqli_num_rows($resultado2);
					if ($contador2>0)
					{
						echo "<td><select class='form-control' id='input_usuario".$id_admin_institucion."' name='input_usuario'>";
						while($lista2 	= mysqli_fetch_array($resultado2))
						{
							$id_usuario = $lista2['id_usuario'];
							$nombres 	= $lista2['nombres'];
							$nombres 	= explode(" ", $nombres);
							$apellidos 	= $lista2['apellidos'];
							$apellidos 	= explode(" ", $apellidos);
							$nombre_completo = $nombres[0]." ".$apellidos[0];
							echo "<option value='$id_usuario'";
							if($id_usuario==$id_admin_institucion){ echo " selected ";}
							echo ">$nombre_completo</option>";
						}
						echo "</select></td>";
						$sql2 	= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
						$resultado2 	= mysqli_query($db,$sql2);
						$lista2 	= mysqli_fetch_array($resultado2);
						$estado = $lista2['estado'];
						echo "<td><select class='form-control' id='input_estado".$id_admin_institucion."'>
							<option value='Habilitado'";
						if($estado=="Habilitado"){ echo " selected";}
						echo ">Habilitado</option>
							<option value='Bloqueado'";
						if($estado=="Bloqueado"){ echo " selected";}
						echo">Bloqueado</option>";
						echo "</select></td>";
						echo "<td><div class='btn-group'>
								<input type='button' value='Guardar' class='btn btn-primary' disabled>
								<input type='button' value='Borrar' onclick='BorrarAdminInstitucion(".$id_usuario.")' class='btn btn-danger'></div></td>";
							echo "</tr>";
					}
					else
					{
						echo "<tr><td colspan='4'>No hay datos de usuarios.$id_usuario</td></tr>";
					}
				}
				else
				{
					echo "<tr><td colspan='4'>No hay datos de instituciones.</td></tr>";
				}
			}
			echo "</table></div></div>";
		}
		else
		{
			echo '<div id="alert-danger-administrador" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No hay administradores asociados a institucion.</strong></div>';
		}

		$sql 			= "SELECT * FROM usuarios WHERE id_tipo_usuario=3 ORDER BY nombres ASC";
		$resultado 		= mysqli_query($db,$sql);
		if(!$resultado){	echo mysqli_error($db);	}
		$contador 		= mysqli_num_rows($resultado);
		if($contador>0)
		{
			$valores = "";
			$valores .= "<h2>Administradores Libres</h2>";
			$valores .= "<div class='container-fluid'>
					<div class='table-responsive'>
						<table id='TablaAdminInstitucionLibres' class='table table-striped'>
						<tr>
							<th>Instituciones</th>
							<th>Administrador</th>
							<th>Estado</th>
							<th>Operaciones</th>
						</tr>";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_usuario 	= $lista['id_usuario'];
				$nombres 		= $lista['nombres'];
				$apellidos 		= $lista['apellidos'];

				$sql1 			= "SELECT * FROM administrador_institucion WHERE id_usuario=".$id_usuario;
				$resultado1 		= mysqli_query($db,$sql1);
				if(!$resultado1){	echo mysqli_error($db);	}
				$contador1 		= mysqli_num_rows($resultado1);
				if($contador1==0)
				{
					$valores.= "<tr>";
					$valores .= "<td><select class='form-control' id='input_institucion".$id_admin_institucion."' name='input_institucion'>";

					$sql0 	= "SELECT * FROM instituciones ORDER BY nombre ASC";
					$resultado0 		= mysqli_query($db,$sql0);
					if(!$resultado0){	echo mysqli_error($db);	}
					$contador0 		= mysqli_num_rows($resultado0);
					$valores.= "<option value='0'>Libre</option>";
					while ($lista0 = mysqli_fetch_array($resultado0))
					{
						$id = $lista0['id_institucion'];
						$nombre_institucion = $lista0['nombre'];
						$valores.= "<option value='$id'>$nombre_institucion</option>";
					}
					"</select></td>";

					$sql2 	= "SELECT * FROM usuarios WHERE id_tipo_usuario=3 ORDER BY nombres ASC";
					$resultado2 	= mysqli_query($db,$sql2);
					if(!$resultado2){	echo mysqli_error($db);		}
					$contador2 		= mysqli_num_rows($resultado2);
					if ($contador2>0)
					{
						$valores.= "<td><select class='form-control' id='input_usuario".$id_admin_institucion."' name='input_usuario'>";
						while($lista2 	= mysqli_fetch_array($resultado2))
						{
							$id_usuario = $lista2['id_usuario'];
							$nombres 	= $lista2['nombres'];
							$nombres 	= explode(" ", $nombres);
							$apellidos 	= $lista2['apellidos'];
							$apellidos 	= explode(" ", $apellidos);
							$nombre_completo = $nombres[0]." ".$apellidos[0];
							$valores.= "<option value='$id_usuario'";
							if($id_usuario==$id_admin_institucion){ $valores.= " selected ";}
							$valores.= ">$nombre_completo</option>";
						}
						$valores.= "</select></td>";
						$sql2 	= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
						$resultado2 	= mysqli_query($db,$sql2);
						$lista2 	= mysqli_fetch_array($resultado2);
						$estado = $lista2['estado'];
						$valores.= "<td><select class='form-control' id='input_estado".$id_admin_institucion."'>
							<option value='Habilitado'";
						if($estado=="Habilitado"){ $valores.= " selected";}
						$valores.= ">Habilitado</option>
							<option value='Bloqueado'";
						if($estado=="Bloqueado"){ $valores.= " selected";}
						$valores.=">Bloqueado</option>";
						$valores.= "</select></td>";
						$valores.= "<td><div class='btn-group'>
								<input type='button' value='Guardar' class='btn btn-primary' disabled>
								<input type='button' value='Borrar Usuario' onclick='BorrarUsuario(".$id_usuario.")' class='btn btn-danger'></div></td>";
							$valores.= "</tr>";
					}
				}
			}
			$valores.= "</table>";
			$valores.= "</div>";
			if(strlen($valores)>500){ echo $valores;}

		}
	}
	else
	{
		echo '<div id="alert-danger-administrador" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes autorización para acceder.</strong></div>';
	}
}
?>