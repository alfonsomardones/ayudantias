<?php
if(!isset($_SESSION))
{session_start();}

if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<div class="col-6 col-md-1">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_id" placeholder="ID" title="BUSCAR POR ID"';
				if(isset($_GET['id']))
				{echo ' value="'.$_GET['id'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_nombre" placeholder="NOMBRE" title="BUSCAR POR NOMBRE"';
				if(isset($_GET['nombre']))
				{echo ' value="'.$_GET['nombre'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-12 col-md-2">
			<div class="form-group">
				<button class="btn btn-info btn-block btn-sm" title="REALIZAR BÚSQUEDA" onclick="mostrarFacultades()"><span class="glyphicon glyphicon-search d-block d-md-none"></span><span class="d-none d-md-block"> BUSCAR</span></button>
			</div>
		</div>
		';
	}
}
?>