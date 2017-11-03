<?php
if(isset($_POST['input_nombres']))
{
    include('conex.php');
    
    $nombres        = $_POST['input_nombres'];
    $apellidos      = $_POST['input_apellidos'];
    $rut            = $_POST['input_rut'];
    list($año,$mes,$dia)     = explode("-", $_POST['input_fecha_nac']);
        $fecha_nac        = "$dia-$mes-$año";
    $telefono       = $_POST['input_telefono'];
    $correo         = $_POST['input_correo'];
    $correo         = strtolower($correo);
    $clave          = $_POST['input_clave'];
    $clave          = md5($clave); 
    $tipo           = $_POST['input_tipo'];
    $imagen         = "-";
    $estado         = "Habilitado";

    $sql = "INSERT INTO usuarios (nombres, apellidos, rut, fecha_nacimiento, telefono, correo, clave, id_tipo_usuario, imagen, estado) ";
    $sql.= "VALUES ('$nombres','$apellidos','$rut','$fecha_nac','$telefono','$correo','$clave',$tipo,'$imagen','$estado')";

    $insertar = mysqli_query($db,$sql);
}
else
{
    header("location: error.php");
}
?>