<?php
    include('conex.inc');
    
    $nombre  		= $_POST['input_nombre'];
    $logo_institucion = "-";
    $logo_certificacion = "-";
    $sql = "INSERT INTO instituciones (nombre, logo_institucion, logo_certificacion) ";
    $sql.= "VALUES ('$nombre','$logo_institucion','$logo_certificacion')";

    $insertar = mysqli_query($db,$sql);
?>