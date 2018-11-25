<?php
$e = 0;
if(!isset($_SESSION))
{session_start();}

include('../datos/mensajes.php');
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		include('../datos/conexion.php');
		include('../datos/validar.php');
		$sql2 = array();
		if(isset($_POST['id']))
		{
			if(validarNumero($_POST['id']))
			{array_push($sql2, 'id_usuario='.$_POST['id']);}
		}
		if(isset($_POST['nombres']))
		{
			if(validarNombre($_POST['nombres']))
			{array_push($sql2, "nombres LIKE '%".mb_strtoupper(trim($_POST['nombres']))."%'");}
		}
		if(isset($_POST['apellidos']))
		{
			if(validarNombre($_POST['apellidos']))
			{array_push($sql2, "apellidos LIKE '%".mb_strtoupper(trim($_POST['apellidos']))."%'");}
		}
		if(isset($_POST['rut']))
		{
			if(strlen($_POST['rut'])>8)
			{
				if(validarRut($_POST['rut']))
				{array_push($sql2, "rut LIKE '%".trim($_POST['rut'])."%'");}
			}
		}
		if(isset($_POST['correo']))
		{
			if(validarCorreo($_POST['correo']))
			{array_push($sql2, "correo LIKE '%".mb_strtoupper(trim($_POST['correo']))."%'");}
		}
		if(isset($_POST['sexo']))
		{
			if(validarSexo($_POST['sexo']))
			{array_push($sql2, "sexo LIKE '%".mb_strtoupper(trim($_POST['sexo']))."%'");}
		}
		if(isset($_POST['estado']))
		{
			if(validarEstado($_POST['estado']))
			{array_push($sql2, "estado LIKE '%".mb_strtoupper(trim($_POST['estado']))."%'");}
		}
		if(isset($_POST['tipo']))
		{
			if(validarTipoUsuario($_POST['tipo']))
			{array_push($sql2, "id_tipo_usuario=".trim($_POST['tipo']));}
		}
		if(isset($_POST['region']))
		{
			if(validarEstado($_POST['region']))
			{array_push($sql2, "region LIKE '%".mb_strtoupper(trim($_POST['region']))."%'");}
		}
		if(isset($_POST['comuna']))
		{
			if(validarEstado($_POST['comuna']))
			{array_push($sql2, "comuna LIKE '%".mb_strtoupper(trim($_POST['comuna']))."%'");}
		}
		array_push($sql2, "id_usuario<>".$_SESSION['id_usuario']);
		if(count($sql2)>1)
		{
			$sql2 = implode(' AND ', $sql2);
		}
		else
		{
			if(count($sql2)==1){
				$sql2 = $sql2[0];
			}
		}
		$sql2 = 'WHERE '.$sql2;
		$sql = 'SELECT * FROM usuarios '.$sql2.' ORDER BY fecha_registro DESC';
		$resultados = mysqli_query($db, $sql);
		$contador = mysqli_num_rows($resultados);
		if($contador>0)
		{
			echo '
			<div class="col-12">
			<div class="table-responsive">
				<table id="TablaUsuarios" class="table table-striped table-hover tablesorter table-sm text-center">
					<thead>
						<tr>
							<th>ID</th>
							<th>IMG</th>
							<th>NOMBRE</th>
							<th>RUT</th>
							<th>CORREO</th>
							<th>TIPO</th>
							<th>ESTADO</th>
							<th>OPERACIONES</th>
						</tr>
					</thead>
					<tbody>
			';
			while ($lista = mysqli_fetch_assoc($resultados))
			{
				$id_usuario 	= $lista["id_usuario"];
				$nombres 		= $lista["nombres"];
				$apellidos		= $lista["apellidos"];
				$rut			= $lista["rut"];
				$sexo			= $lista["sexo"];
				$correo			= $lista["correo"];
				$tipo			= $lista["id_tipo_usuario"];
				if($tipo==1)		{ $tipo = 'AMINISTRADOR SUPERIOR';}
				elseif($tipo==2)	{ $tipo = 'ADMINISTRADOR DE INSTITUCIÓN';}
				elseif($tipo==3)	{ $tipo = 'SUB-ADMINISTRADOR DE INSTITUCIÓN';}
				elseif($tipo==4)	{ $tipo = 'USUARIO';}
				elseif($tipo==5)	{ $tipo = 'AYUDANTE';}

				$estado			= $lista["estado"];
				$img 			= trim($lista["imagen"]);
				if($img=='')
				{$img = '../img/perfil_usuarios/DEFAULT-'.todoMayuscula($sexo).'.png';}
				echo '
				<tr id="filaTablaUsuarios'.$id_usuario.'">
					<td>'.$id_usuario.'</td>
					<td id="tdImg'.$id_usuario.'"><img src="'.$img.'" style="width:30px;"></td>
					<td id="tdNombres'.$id_usuario.'">'.$nombres.' '.$apellidos.'</td>
					<td id="tdRut'.$id_usuario.'">'.$rut.'</td>
					<td id="tdCorreo'.$id_usuario.'">'.$correo.'</td>
					<td id="tdTipo'.$id_usuario.'">'.$tipo.'</td>
					<td id="tdEstado'.$id_usuario.'">'.$estado.'</td>
					<td>
						<button class="btn btn-info" title="EDITAR USUARIO" data-toggle="modal" data-target="#modalUsuario" onclick="modalUsuario(2,'.$id_usuario.')">EDITAR</button>';
						//<button class="btn btn-danger" title="BORRAR USUARIO" data-toggle="modal" data-target="#modalUsuario" onclick="modalUsuario(3,'.$id_usuario.')">BORRAR</button>
						echo '
					</td>
				</tr>';
			}
			echo '</tbody></table></div></div>';
		}
		else
		{echo mostrar_mensaje(mensajes(-101));}
	}
	else
	{echo mostrar_mensaje(mensajes(-52));}
}
else
{echo mostrar_mensaje(mensajes(-51));}
?>