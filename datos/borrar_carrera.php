<?php
    include('conex.inc');
    $id_carrera 	= $_POST['cod'];
    $sql = "DELETE FROM carreras WHERE id_carrera=".$id_carrera;

    $eliminar = mysqli_query($db,$sql);
?>
