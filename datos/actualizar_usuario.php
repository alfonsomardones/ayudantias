<?php
    include('conex.inc');
    session_start();
    
    $nombres        = $_POST['input_nombres'];
    $apellidos      = $_POST['input_apellidos'];
    $fecha_nac      = $_POST['input_fecha_nac'];
    list($año, $mes, $dia) = split('[/.-]', $fecha_nac);
    $fecha_nac = "$dia-$mes-$año";
    $telefono       = $_POST['input_telefono'];
    $correo         = $_POST['input_correo'];
    $correo         = strtolower($correo);
    $clave          = $_POST['input_clave'];

    if ($clave=='')
    {
    	$sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo'";
    	$sql.= " WHERE id_usuario=".$_SESSION['id_usuario'];
    }
    else
    {
        $clave          = md5($clave); 
    	$sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo', clave='$clave' ";
    	$sql.= " WHERE id_usuario=".$_SESSION['id_usuario'];
    }

    $actualizar = mysqli_query($db,$sql);

    $_SESSION['nombres']            = $nombres;
    $_SESSION['apellidos']          = $apellidos;
    $fecha_nac      = $fecha_nac;
    list($dia, $mes, $año) = split('[/.-]', $fecha_nac);
    $fecha_nac = "$año-$mes-$dia";
    $_SESSION['fecha_nacimiento']   = $fecha_nac; 
    $_SESSION['telefono']           = $telefono;
    $_SESSION['correo']             = $correo;
    header ("Location: ../");
?>