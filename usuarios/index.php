<?php
if(!isset($_SESSION))
{session_start();}
if(!isset($_SESSION['id_usuario']))
{header("location: ../");}
else
{
	if($_SESSION['tipo_usuario']!='ADMINISTRADOR SUPERIOR')
	{header("location: ../");}
}
?>
<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>HelpMeApp - Usuarios</title>
		<link rel="shortcut icon" href="../img/logos/favicon.ico" type="image/x-icon">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- VERSIÓN MOVIL -->
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<!-- COLOR DE LA BARRA -->
		<meta name="theme-color" content="#2FC4D0" />
		<!-- ESTILOS -->
		<?php
		include('../secciones/estilos.php');
		?>

	</head>
	<body>
		<?php
		include('../secciones/barra_navegacion.php');
		?>
		<div class="container-fluid">
			<div class="row titulo-seccion">
				<div class="col-12 ">
					<h1>Control de Usuarios</h1>
				</div>
			</div>
			<div class="row contenido-seccion">
				<div class="col-0 col-md-8"></div>
				<div class="col-6 col-md-2">
					<button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalUsuario" onclick="modalUsuario(1)" title="REGISTRAR NUEVO USUARIO"><span class="glyphicon glyphicon-user d-block d-md-none"></span><span class="d-none d-md-block"> NUEVO</span></button></div>
				<div class="col-6 col-md-2">
					<button type="button" class="btn btn-outline-info btn-block"  data-toggle="collapse" data-target="#menuUsuarios" aria-expanded="false" aria-controls="menuUsuarios" title="FILTROS DE BÚSQUEDA"><span class="glyphicon glyphicon-filter d-block d-md-none"></span><span class="d-none d-md-block"> FILTROS</span></button>
				</div>
			</div>
			<div class="row collapse " id="menuUsuarios">
				<?php include('menu.php');?>
			</div>
			<div class="row sub-seccion" id="controlUsuarios">
			</div>
		</div>			
		<?php
		include('modal.php');
		include('../login/cerrar.php');
		include('../secciones/desarrollo.php');
		?> 
		
		<!-- JAVASCRIPT -->
		<?php
		include('../secciones/javascript.php');
		?> 
	</body>
</html>