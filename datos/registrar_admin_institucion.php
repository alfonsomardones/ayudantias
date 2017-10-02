<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
    
    $id_usuario  		= $_POST['input_id'];
    $id_institucion		= $_POST['input_institucion'];
    $sql = "INSERT INTO administrador_institucion (id_usuario,id_institucion) ";
    $sql.= "VALUES ($id_usuario,$id_institucion)";
    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>