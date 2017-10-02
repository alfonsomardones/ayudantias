<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
    
    $id_usuario  				= $_POST['input_id'];
    $id_institucion_carrera     = $_POST['input_institucion_carrera'];
    $certificacion				= $_POST['input_certificacion'];

    $sql = "INSERT INTO ayudantes (id_usuario, id_institucion_carrera,certificacion) ";
    $sql.= "VALUES ($id_usuario, $id_institucion_carrera,'$certificacion')";

    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>