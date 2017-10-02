<?php
if(isset($_POST['input_tipo']))
{
	include('conex.php');
    
	$tipo  		= $_POST['input_tipo'];
	$dato  		= $_POST['input_dato'];
	$valor		= 'no';

	if($tipo=='existe_usuario')
	{
		$sql 		= "SELECT * FROM usuarios WHERE rut='$dato' OR correo='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$valor='si';
		}
	}

	if($tipo=='obtener_id')
	{
		$sql 		= "SELECT * FROM usuarios WHERE rut='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{
				$valor = $lista['id_usuario'];
			}
		}
	}

	elseif($tipo=='clave_de_usuario')
	{
		$dato = explode("/", $dato);
		$usuario = $dato[0];
		$clave = $dato[1];
		$clave = md5($clave);
		$sql 		= "SELECT * FROM usuarios WHERE rut='$usuario' OR correo='$usuario'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		$valor = "entro al if";
		if ($contador>0)
		{
			$valor = "entro al contador";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$claveBD = $lista['clave'];
				if($clave==$claveBD)
				{
					$valor = 'si';
				}
			}

		}
	}

	elseif($tipo=='usuario_habilitado')
	{
		$usuario = $dato;
		$sql 		= "SELECT * FROM usuarios WHERE (rut='$usuario' OR correo='$usuario') AND estado='Habilitado' ";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='existe_rut')
	{
		$sql 		= "SELECT * FROM usuarios WHERE rut='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='pertenece_rut')
	{
		list($rut, $id) = explode('/', $dato);
		$sql 		= "SELECT * FROM usuarios WHERE id_usuario=$id AND rut='$rut'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='existe_correo')
	{
		$sql 		= "SELECT * FROM usuarios WHERE correo='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='pertenece_correo')
	{
		list($correo, $id) = explode('/', $dato);
		$sql 		= "SELECT * FROM usuarios WHERE id_usuario=$id AND correo='$correo'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='existe_telefono')
	{
		$sql 		= "SELECT * FROM usuarios WHERE telefono='$dato'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			$valor = 'si';
		}
	}

	elseif($tipo=='existe_institucion')
	{
		$institucion = $dato;
		$institucion = strtolower($institucion);
		$sql 		= "SELECT * FROM instituciones";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			while ($lista = mysqli_fetch_array($resultado))
			{
				$instituciones 	= $lista['nombre'];
				$instituciones = strtolower($instituciones);
				if($institucion==$instituciones)
				{
					$valor = 'si';
				}
			}
		}
	}

	elseif($tipo=='cambie_nombre_institucion')
	{
		list($institucion, $id) = explode('/', $dato);
		$sql 		= "SELECT * FROM instituciones WHERE id_institucion=$id AND nombre='$institucion'";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador==0)
		{
			$valor = 'si';
		}
	}

	elseif($tipo=='existe_carrera')
	{
		$carrera = $dato;
		$carrera = strtolower($carrera);
		$sql 		= "SELECT * FROM carreras";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado); 
		if ($contador>0) {
			while ($lista = mysqli_fetch_array($resultado))
			{
				$carreras 	= $lista['nombre'];
				$carreras = strtolower($carreras);
				if($carrera==$carreras)
				{
					$valor = 'si';
				}
			}
		}
	}

	echo $valor;
}
else
{
    header("location: error.php");
}
?>