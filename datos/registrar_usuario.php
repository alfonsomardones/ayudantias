<?php
    include('conex.inc');
    
    $nombres  		= $_POST['input_nombres'];
    $apellidos     	= $_POST['input_apellidos'];
    $rut     		= $_POST['input_rut'];
    $fecha_nac     	= $_POST['input_fecha_nac'];
	list($año, $mes, $dia) = split('[/.-]', $fecha_nac);
	$fecha_nac = "$dia-$mes-$año";
    $telefono     	= $_POST['input_telefono'];
    $correo       	= $_POST['input_correo'];
    $correo         = strtolower($correo);
    $clave       	= $_POST['input_clave'];
    $clave 			= md5($clave); 
    $tipo       	= $_POST['input_tipo'];
    $imagen			= "-";
    $estado			= "Habilitado";

    $sql = "INSERT INTO usuarios (nombres, apellidos, rut, fecha_nacimiento, telefono, correo, clave, id_tipo_usuario, imagen, estado) ";
    $sql.= "VALUES ('$nombres','$apellidos','$rut','$fecha_nac','$telefono','$correo','$clave',$tipo,'$imagen','$estado')";

    $insertar = mysqli_query($db,$sql);

    if($tipo=='2' || $tipo==2)
    {
    	// BUSCAR INSTITUCION INDEPENDIENTE
    	$sql1 			= "SELECT * FROM instituciones WHERE nombre='Independiente'";
		$resultado1 		= mysqli_query($db,$sql1);
		$contador1 		= mysqli_num_rows($resultado1);
		if($contador1>0)
		{
			while ($lista1 = mysqli_fetch_array($resultado1))
			{
				$id_institucion 	= $lista1['id_institucion'];
			}
		}

		// BUSCAR CARRERA INDEPENDIENTE
		$sql2 			= "SELECT * FROM carreras WHERE nombre='Independiente'";
		$resultado2 		= mysqli_query($db,$sql2);
		$contador2 		= mysqli_num_rows($resultado2);
		if($contador2>0)
		{
			while ($lista2 = mysqli_fetch_array($resultado2))
			{
				$id_carrera 	= $lista2['id_carrera'];
			}
		}

		// BUSCAR INSTITUCION-CARRERA INDEPENDIENTE
		$sql3 			= "SELECT * FROM institucion_carrera WHERE id_institucion=$id_institucion AND id_carrera=$id_carrera";
		$resultado3 		= mysqli_query($db,$sql3);
		$contador3 		= mysqli_num_rows($resultado3);
		if($contador3>0)
		{
			while ($lista3 = mysqli_fetch_array($resultado3))
			{
				$id_institucion_carrera 	= $lista3['id_institucion_carrera'];
			}
		}

		// AGREGAR AYUDANTE A INDEPENDIENTE
    	$sql4 			= "SELECT * FROM usuarios WHERE rut='$rut' AND correo='$correo'";
		$resultado4 		= mysqli_query($db,$sql4);
		$contador4 		= mysqli_num_rows($resultado4);
		if($contador4>0)
		{
			while ($lista4 = mysqli_fetch_array($resultado4))
			{
				$id_usuario 	= $lista4['id_usuario'];
			}
		}

		$sql5 = "INSERT INTO ayudantes (id_usuario, id_institucion_carrera, certificacion) ";
     	$sql5.= "VALUES ($id_usuario, $id_institucion_carrera,'No')";
     	$insertar5 = mysqli_query($db,$sql5);
    }
?>