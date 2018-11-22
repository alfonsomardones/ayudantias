
<?php
if ($_SERVER['PHP_SELF']=='/hmapp/nosotros/index.php' || $_SERVER['PHP_SELF']=='/hmapp/contacto/index.php' || $_SERVER['PHP_SELF']=='/hmapp/login/index.php' || $_SERVER['PHP_SELF']=='/hmapp/index.php' || $_SERVER['PHP_SELF']=='/hmapp/home/index.php' || $_SERVER['PHP_SELF']=='/hmapp/usuarios/index.php'  || $_SERVER['PHP_SELF']=='/hmapp/instituciones/index.php' || $_SERVER['PHP_SELF']=='/hmapp/carreras/index.php' || $_SERVER['PHP_SELF']=='/hmapp/ayudantes/index.php') {
	$dir = '/hmapp/';
	if($_SERVER['PHP_SELF']=='/hmapp/index.php')
	{$dir = '';}
	echo '
	<script type="text/javascript" src="'.$dir.'js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="'.$dir.'js/popper.min.js"></script>
	<script type="text/javascript" src="'.$dir.'js/bootstrap.js"></script>
	<script type="text/javascript" src="'.$dir.'js/mensajes.js"></script>
	<script type="text/javascript" src="'.$dir.'js/sesion.js"></script>';
	if(isset($_SESSION['tipo_usuario']))
	{
		if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
		{
			echo '
			<script type="text/javascript" src="'.$dir.'js/rut.js"></script>
			<script type="text/javascript" src="'.$dir.'js/admin_usuarios.js"></script>
			<script type="text/javascript" src="'.$dir.'js/regiones_comunas.js"></script>
			<script type="text/javascript" src="'.$dir.'js/formularios.js"></script>
			';
		}
	}
}
?>