<?php
    include('conex.inc');
    
    $nombre  		= $_POST['input_nombre'];
    $sql = "INSERT INTO carreras (nombre) ";
    $sql.= "VALUES ('$nombre')";

    $insertar = mysqli_query($db,$sql);
?>