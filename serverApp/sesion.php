<?php
	include('conex.inc');

    $usuario 	= $_POST['input_rut'];
	$usuario 	= strtolower($usuario);
	$clave 		= $_POST['input_clave'];

	//consultar a la BD
	$sql 			= "SELECT * FROM usuarios WHERE rut='$usuario' AND clave='$clave' AND estado='Habilitado' AND (id_tipo_usuario=1 OR id_tipo_usuario=2)";
	$resultado 		= mysqli_query($db,$sql);
	$contador 		= mysqli_num_rows($resultado);
	if($contador>0)
	{
		$lista = mysqli_fetch_array($resultado);
		$id_usuario 	= $lista["id_usuario"];
		$rutBD 			= $lista["rut"];
		$correoBD 		= $lista["correo"];
		$claveBD 		= $lista["clave"];
		
		//si usuario y contraseña son válidos
		if ($usuario==$rutBD && $clave==$claveBD)
		{
			echo "Usuario valido";
		}
		else{
			echo "Clave Incorrecta!";
		}
	}
	else{
		echo "Usuario No Valido!";
	}

?>