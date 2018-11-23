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
			{array_push($sql2, 'id_facultad='.$_POST['id']);}
		}
		if(isset($_POST['nombre']))
		{
			if(validarNombre($_POST['nombre']))
			{array_push($sql2, "nombre LIKE '%".todoMayuscula(trim($_POST['nombre']))."%'");}
		}
		if(count($sql2)>1)
		{
			$sql2 = implode(' AND ', $sql2);
		}
		else
		{
			if(count($sql2)==1){
				$sql2 = $sql2[0];
			}
			else
				{$sql2 = '';}
		}
		if(strlen($sql2)>0)
		{$sql2 = 'WHERE '.$sql2;}
		$sql = 'SELECT * FROM facultades '.$sql2.' ORDER BY nombre ASC';
		$resultados = mysqli_query($db, $sql);
		$contador = mysqli_num_rows($resultados);
		if($contador>0)
		{
			echo '
			<div class="col-12">
			<div class="table-responsive">
				<table id="TablaFacultades" class="table table-striped table-hover tablesorter table-sm">
					<thead>
						<tr>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>FECHA DE REGISTRO</th>
							<th>OPERACIONES</th>
						</tr>
					</thead>
					<tbody>
			';
			while ($lista = mysqli_fetch_assoc($resultados))
			{
				$id_facultad 		= $lista["id_facultad"];
				$nombre 			= $lista["nombre"];
				$fecha_registro 	= $lista["fecha_registro"];
				echo '
				<tr id="filaTablaFacultades'.$id_facultad.'">
					<td>'.$id_facultad.'</td>
					<td id="tdNombre'.$id_facultad.'">'.$nombre.'</td>
					<td id="tdFechReg'.$id_facultad.'">'.$fecha_registro.'</td>
					<td>
						<button class="btn btn-info" title="EDITAR FACULTAD" data-toggle="modal" data-target="#modalFacultad" onclick="modalFacultad(2,'.$id_facultad.')" title="EDITAR FACULTAD">EDITAR</button>';
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