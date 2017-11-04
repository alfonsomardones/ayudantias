<?php
if(isset($_POST['input_id']))
{
    include('conex.php');
   	$id_institucion     = $_POST['input_id'];
    $nombre             = $_POST['input_nombre'];
    $logo_institucion   = $_POST['input_logo_institucion'];
    $sql = "UPDATE instituciones SET nombre='$nombre', logo_institucion='$logo_institucion'";
    $sql.= " WHERE id_institucion=".$id_institucion;

    $actualizar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>