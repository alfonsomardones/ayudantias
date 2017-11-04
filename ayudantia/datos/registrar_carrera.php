<?php
if(isset($_POST['input_nombre']))
{
	session_start();
	include('conex.php');
    
    $nombre  	= $_POST['input_nombre'];
    $sql 		= "INSERT INTO carreras (nombre) ";
    $sql	.= "VALUES ('$nombre')";
    $insertar = mysqli_query($db,$sql);

    if(isset($_SESSION['id_institucion']))
	{
		$sql 		= "SELECT * FROM carreras WHERE nombre='$nombre'";
		$resultado 	= mysqli_query($db,$sql);
		if(!$resultado){echo mysqli_error($db);	}
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_carrera 	= $lista['id_carrera'];
			}
		    $sql = "INSERT INTO institucion_carrera (id_institucion, id_carrera) ";
		    $sql.= "VALUES (".$_SESSION['id_institucion'].",".$id_carrera.")";
		    $insertar = mysqli_query($db,$sql);
		}
	}
}
else
{
	header("location: error.php");
}
?>