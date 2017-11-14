<?php
	include('conex.inc');

    $usuario 	= $_POST['input_rut'];
	$usuario 	= strtolower($usuario);
	$clave 		= $_POST['input_clave'];
	$clave1 	= md5($clave);

	//consultar a la BD
	$sql 			= "SELECT * FROM usuarios WHERE rut='$usuario' AND estado='Habilitado' AND (id_tipo_usuario=1 OR id_tipo_usuario=2)";
	$resultado 		= mysqli_query($db,$sql);
	$contador 		= mysqli_num_rows($resultado);
	if($contador>0)
	{
		$lista = mysqli_fetch_array($resultado);
		$id_usuario 	= $lista["id_usuario"];
		$nombres		= $lista["nombres"];
		$apellidos		= $lista["apellidos"];
		$rut 			= $lista["rut"];
		$fecha_nac		= $lista["fecha_nacimiento"];
		$telefono		= $lista["telefono"];
		$correo 		= $lista["correo"];
		$clave2 		= $lista["clave"];
		$tipo			= $lista["id_tipo_usuario"];
		$imagen			= $lista["imagen"];
		$estado			= $lista["estado"];
		$descripcion    = "-";

		$sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor, fecha) ";
	    $sql.= "VALUES ($id_usuario,'Inicio de sesión', 'App','','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);
		//si usuario y contraseña son válidos
		if ($usuario==$rut && $clave1==$clave2)
		{
			if($tipo=="2" || $tipo==2){
				$sql2 			= "SELECT descripcion FROM ayudantes WHERE id_usuario=$id_usuario";
				$resultado1 	= mysqli_query($db,$sql2);
				$lista 			= mysqli_fetch_array($resultado1);
            	$descripcion 	= $lista["descripcion"];
			}
			
			echo "Usuario valido/$id_usuario/$nombres/$apellidos/$rut/$fecha_nac/$telefono/$correo/$clave1/$tipo/$imagen/$estado/$descripcion";
		}
		else{
			echo "Clave Incorrecta!";
		}
	}
	else{
		echo "Usuario No Valido!";
	}

?>