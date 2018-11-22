<?php
if(!isset($_SESSION))
{session_start();}
if(isset($_SESSION['id_usuario']))
{header("location: ../");}
?>
<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>HelpMeApp - Login</title>
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
		include('../login/formulario.php');
		include('../secciones/desarrollo.php');
		?> 
		
		<!-- JAVASCRIPT -->
		<?php
		include('../secciones/javascript.php');
		?> 
	</body>
</html>