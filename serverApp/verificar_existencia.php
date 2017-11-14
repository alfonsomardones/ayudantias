<?php
    include('conex.inc');
    
	$tipo  		= $_POST['input_tipo'];
	$dato  		= $_POST['input_dato'];
	$valor		= 'no';

	if($tipo=='usuario')
	{
		$sql 		= "SELECT * FROM usuarios WHERE rut='$dato' OR correo='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='datos')
	{
		$dato = md5($dato);
		$sql 		= "SELECT * FROM usuarios WHERE clave='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='rut')
	{
		$sql 		= "SELECT * FROM usuarios WHERE rut='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='correo')
	{
		$sql 		= "SELECT * FROM usuarios WHERE correo='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='telefono')
	{
		$sql 		= "SELECT * FROM usuarios WHERE telefono='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='institucion')
	{
		$sql 		= "SELECT * FROM instituciones WHERE nombre='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='carrera')
	{
		$sql 		= "SELECT * FROM carreras WHERE nombre='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	else
	{
		$usuario = $tipo;
		$clave = md5($dato);
		$sql 		= "SELECT * FROM usuarios WHERE (correo='$usuario' OR rut='$usuario') AND clave='$clave' AND estado='Habilitado'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	echo $valor;
?>