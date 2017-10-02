<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
   	$id_carrera     	= $_POST['input_id'];
	$nombre             = $_POST['input_nombre'];
	$sql = "UPDATE carreras SET nombre='$nombre'";
	$sql.= " WHERE id_carrera=".$id_carrera;
    $actualizar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>