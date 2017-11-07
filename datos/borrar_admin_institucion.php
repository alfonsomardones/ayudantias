<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
    $id_usuario 	= $_POST['input_id'];
    $sql = "DELETE FROM administrador_institucion WHERE id_usuario=".$id_usuario;
    $eliminar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>
