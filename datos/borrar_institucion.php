<?php
    include('conex.inc');
    $id_institucion 	= $_POST['cod'];
    $sql = "DELETE FROM instituciones WHERE id_institucion=".$id_institucion;

    $eliminar = mysqli_query($db,$sql);
?>
