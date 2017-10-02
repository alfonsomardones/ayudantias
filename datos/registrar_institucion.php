<?php
if(isset($_POST['input_nombre']))
{
	include('conex.php');
    
    $nombre  		= $_POST['input_nombre'];
    $logo_institucion = "-";
    $logo_certificacion = "-";
    $sql = "INSERT INTO instituciones (nombre, logo_institucion, logo_certificacion) ";
    $sql.= "VALUES ('$nombre','$logo_institucion','$logo_certificacion')";

    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>