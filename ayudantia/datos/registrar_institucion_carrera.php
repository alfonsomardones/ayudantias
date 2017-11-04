<?php
session_start()
if(isset($_POST['input_carrera']))
{
	include('conex.php');
    $id_carrera  	= $_POST['input_carrera'];
    $sql = "INSERT INTO institucion_carrera (id_institucion,id_carrera) ";
    $sql.= "VALUES (".$_SESSION['id_institucion'].",".$id_carrera.")";
    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>