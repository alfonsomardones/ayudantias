<?php
if(isset($_POST['cod']))
{
	include('conex.php');
    $id_institucion_carrera 	= $_POST['cod'];
    $sql = "DELETE FROM institucion_carrera WHERE id_institucion_carrera=".$id_institucion_carrera;

    $eliminar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>
