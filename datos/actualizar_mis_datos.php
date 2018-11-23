<?php
$e = 0;
if(!isset($_SESSION))
{session_start();}

if(isset($_SESSION['id_usuario']))
{
	include('conexion.php');
	$sql = 'SELECT * FROM usuarios WHERE id_usuario='.$_SESSION['id_usuario'];
	$resultados = mysqli_query($db, $sql);
	$contador = mysqli_num_rows($resultados);
	if($contador==1)
	{
		$lista = mysqli_fetch_assoc($resultados);
		$nom = $lista['nombres'];
		$nom = explode(' ',$nom);
		$ape = $lista['apellidos'];
		$ape = explode(' ',$ape);
		$_SESSION['nombre'] = $nom[0].' '.$ape[0];
		$_SESSION['sexo'] 	= $lista['sexo'];
		if($lista['imagen']!='')
		{$_SESSION['img'] = $lista['imagen'];}
		else
		{
			if($_SESSION['sexo']=='MASCULINO')
			{$_SESSION['img'] = 'default-masculino.png';}
			else
			{$_SESSION['img'] = 'default-femenino.png';}
		}
		$_SESSION['tipo_usuario'] = $lista['id_tipo_usuario'];
		$e = 1;
	}
	else
	{$e = -105:}
}
else
{$e = -51;}
echo $e;
?>