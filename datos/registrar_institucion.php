<?php
if(isset($_POST['input_nombre']))
{
	include('conex.php');
    
    $nombre  		= $_POST['input_nombre'];
    $logo_institucion = "-";
    $sql = "INSERT INTO instituciones (nombre, logo_institucion) ";
    $sql.= "VALUES ('$nombre','$logo_institucion')";

    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>