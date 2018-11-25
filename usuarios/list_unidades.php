<?php
if(!isset($_SESSION))
{session_start();}
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		include('../datos/conexion.php');
		$id = '';
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			
			$sql = 'SELECT id_unidad FROM administradores_instituciones WHERE id_usuario='.$id;
			$resultados = mysqli_query($db, $sql);
			$contador = mysqli_num_rows($resultados);
			if($contador==1)
			{
				$lista = mysqli_fetch_assoc($resultados);
				$id = $lista['id_unidad'];
			}
		}


		$sql = 'SELECT * FROM unidades';
		$resultados = mysqli_query($db, $sql);
		$contador = mysqli_num_rows($resultados);
		if($contador>0)
		{
			echo '
			<select class="form-control" id="unidades">
				<option value="">SELECCIONE UNIDAD</option>';
			while($lista = mysqli_fetch_assoc($resultados))
			{
				$id_unidad = $lista['id_unidad'];
				$unidad 	= $lista['nombre'];
				echo '<option value="'.$id_unidad.'"';
				if($id!='' && $id_unidad==$id)
				{echo ' selected';}
				echo '>'.$unidad.'</option>';
			}
			echo '</select>';
		}
		else
		{
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">NO HAY UNIDADES REGISTRADAS<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
		}
	}
	else
	{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">NO TIENES PERMISOS PARA LISTAR LAS UNIDADES<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
	}
}
else
{
	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">NO HAS INICIADO SESIÓN<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
}
?>