<?php
if(isset($_POST['input_nombre']))
{
	include('conex.php');
    
    $nombre  		= $_POST['input_nombre'];
    $sql = "INSERT INTO carreras (nombre) ";
    $sql.= "VALUES ('$nombre')";

    $insertar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>