<?php
    include('conex.inc');
    
    $id_carrera     	= $_POST['input_id'];
    $nombre             = $_POST['input_nombre'];

    $sql = "UPDATE carreras SET nombre='$nombre'";
    $sql.= " WHERE id_carrera=".$id_carrera;

    $actualizar = mysqli_query($db,$sql);
?>