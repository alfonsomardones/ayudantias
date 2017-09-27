<?php
    include('conex.inc');
    session_start();
    $id_usuario 	= $_POST['cod'];
    $sql = "DELETE FROM usuarios WHERE id_usuario=".$id_usuario;

    $eliminar = mysqli_query($db,$sql);
?>
