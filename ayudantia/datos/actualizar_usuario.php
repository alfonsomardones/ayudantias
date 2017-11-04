<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
    $id_usuario     = $_POST['input_id'];
    $rut            = $_POST['input_rut'];
    if($rut==0 or $rut=="0")
    {
        list($año,$mes,$dia)     = explode("-", $_POST['input_fecha_nac']);
        $fecha_nac        = "$dia-$mes-$año";
        $telefono       = $_POST['input_telefono'];
        $correo         = $_POST['input_correo'];
        $correo         = strtolower($correo);
        $id_tipo_usuario = $_POST['input_tipo'];
        $estado        = $_POST['input_estado'];
        $sql = "UPDATE usuarios SET fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo', id_tipo_usuario=".$id_tipo_usuario.", estado='$estado' WHERE id_usuario=".$id_usuario;
    }
    else
    {
        $nombres        = $_POST['input_nombres'];
        $apellidos      = $_POST['input_apellidos'];
        list($año,$mes,$dia)     = explode("-", $_POST['input_fecha_nac']);
        $fecha_nac        = "$dia-$mes-$año";
        $telefono       = $_POST['input_telefono'];
        $correo         = $_POST['input_correo'];
        $correo         = strtolower($correo);
        $id_tipo_usuario = $_POST['input_tipo'];
        $estado        = $_POST['input_estado'];
        $sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', rut='$rut', fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo', id_tipo_usuario=$id_tipo_usuario, estado='$estado'";
        $sql.= " WHERE id_usuario=".$id_usuario;
    }
    $actualizar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>