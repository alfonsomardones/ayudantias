<?php
if ($_SERVER['PHP_SELF']=='/hmapp/nosotros/index.php' || $_SERVER['PHP_SELF']=='/hmapp/contacto/index.php' || $_SERVER['PHP_SELF']=='/hmapp/login/index.php' || $_SERVER['PHP_SELF']=='/hmapp/index.php' || $_SERVER['PHP_SELF']=='/hmapp/home/index.php' || $_SERVER['PHP_SELF']=='/hmapp/usuarios/index.php'  || $_SERVER['PHP_SELF']=='/hmapp/instituciones/index.php' || $_SERVER['PHP_SELF']=='/hmapp/facultades/index.php' || $_SERVER['PHP_SELF']=='/hmapp/carreras/index.php' || $_SERVER['PHP_SELF']=='/hmapp/ayudantes/index.php' || $_SERVER['PHP_SELF']=='/hmapp/herramientas/index.php' || $_SERVER['PHP_SELF']=='/hmapp/activar/index.php') {
	$dir = '../';
	if($_SERVER['PHP_SELF']=='/hmapp/index.php')
	{
		$dir = '';
		echo '<link rel="stylesheet" type="text/css" href="'.$dir.'css/inicio.css">';
	}
	echo '
	<link rel="stylesheet" type="text/css" href="'.$dir.'css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="'.$dir.'css/estilos_original.css">
	<link rel="stylesheet" type="text/css" href="'.$dir.'css/iconos.css">';
}
?>