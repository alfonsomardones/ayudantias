<?php
    include('conex.inc');
    session_start();
    
    $id_usuario     = $_POST['input_id'];
    $nombres        = $_POST['input_nombres'];
    $apellidos      = $_POST['input_apellidos'];
    $rut            = $_POST['input_rut'];
    $fecha_nac      = $_POST['input_fecha_nac'];
    list($año, $mes, $dia) = explode('[/.-]', $fecha_nac);
    $fecha_nac = "$dia-$mes-$año";
    $telefono       = $_POST['input_telefono'];
    $correo         = $_POST['input_correo'];
    $correo         = strtolower($correo);
    $clave          = $_POST['input_clave'];
    $id_tipo_usuario = $_POST['input_tipo'];
    $estado        = $_POST['input_estado'];

    if ($clave=='')
    {
    	$sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', rut='$rut', fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo', id_tipo_usuario=$id_tipo_usuario, estado='$estado'";
    	$sql.= " WHERE id_usuario=".$id_usuario;
    }
    else
    {
        $clave          = md5($clave); 
    	$sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', rut='$rut', fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo', clave='$clave',  id_tipo_usuario=$id_tipo_usuario, estado='$estado' ";
    	$sql.= " WHERE id_usuario=".$id_usuario;
    }

    $actualizar = mysqli_query($db,$sql);
?>