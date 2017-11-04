<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
    $id_usuario         = $_POST['input_id'];
    $id_ayudante        = $_POST['input_id_ayudante'];
    $estado             = $_POST['input_estado'];
    $id_institucion     = $_POST['input_institucion'];
    $id_carrera         = $_POST['input_carrera'];
    $id_certificacion   = $_POST['input_certificacion'];

    $sql = "UPDATE usuarios SET estado='$estado' WHERE id_usuario=".$id_usuario;
    $actualizar = mysqli_query($db,$sql);

    $sql           = "SELECT * FROM institucion_carrera WHERE id_institucion=".$id_institucion." AND id_carrera=".$id_carrera;
    $resultado         = mysqli_query($db,$sql);
    if(!$resultado){   echo mysqli_error($db); }
    $contador      = mysqli_num_rows($resultado);
    if($contador>0)
    {
        $lista = mysqli_fetch_array($resultado);
        $id_institucion_carrera = $lista['id_institucion_carrera'];

        $sql = "UPDATE ayudantes SET id_institucion_carrera=".$id_institucion_carrera.", id_certificacion=".$id_certificacion." WHERE id_ayudante=".$id_ayudante;
        $actualizar = mysqli_query($db,$sql);
    }
}
else
{
	header("location: error.php");
}
?>