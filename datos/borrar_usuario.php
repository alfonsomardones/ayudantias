<?php
if(isset($_POST['cod']))
{
	include('conex.php');
    $id_usuario 	= $_POST['cod'];
    $sql = "DELETE FROM usuarios WHERE id_usuario=".$id_usuario;

    $eliminar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>
