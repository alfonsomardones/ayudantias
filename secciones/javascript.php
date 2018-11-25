
<?php
$dir = '/hmapp/';
if($_SERVER['PHP_SELF']=='/hmapp/index.php')
{$dir = '';}

echo '
<script type="text/javascript" src="'.$dir.'js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="'.$dir.'js/popper.min.js"></script>
<script type="text/javascript" src="'.$dir.'js/bootstrap.js"></script>
<script type="text/javascript" src="'.$dir.'js/mensajes.js"></script>
<script type="text/javascript" src="'.$dir.'js/sesion.js"></script>';
if ($_SERVER['PHP_SELF']=='/hmapp/usuarios/index.php')
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<script type="text/javascript" src="'.$dir.'js/rut.js"></script>
		<script type="text/javascript" src="'.$dir.'js/regiones_comunas.js"></script>
		<script type="text/javascript" src="'.$dir.'js/admin_usuarios.js"></script>
		<script type="text/javascript" src="'.$dir.'js/admin_usuarios_inst.js"></script>
		<script type="text/javascript" src="'.$dir.'js/formularios.js"></script>';
	}
}
elseif ($_SERVER['PHP_SELF']=='/hmapp/instituciones/index.php')
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<script type="text/javascript" src="'.$dir.'js/rut.js"></script>
		<script type="text/javascript" src="'.$dir.'js/admin_instituciones.js"></script>
		<script type="text/javascript" src="'.$dir.'js/formularios.js"></script>';
	}

}
elseif ($_SERVER['PHP_SELF']=='/hmapp/facultades/index.php')
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<script type="text/javascript" src="'.$dir.'js/admin_facultades.js"></script>
		<script type="text/javascript" src="'.$dir.'js/formularios.js"></script>';
	}

}
elseif ($_SERVER['PHP_SELF']=='/hmapp/carreras/index.php')
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<script type="text/javascript" src="'.$dir.'js/admin_carreras.js"></script>
		<script type="text/javascript" src="'.$dir.'js/formularios.js"></script>';
	}

}

elseif ($_SERVER['PHP_SELF']=='/hmapp/herramientas/index.php')
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<script type="text/javascript" src="'.$dir.'js/herramientas.js"></script>';
	}

}
?>