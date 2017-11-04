<?php
if(isset($_POST['cod']))
{
	include('conex.php');
    $id_usuario 	= $_POST['cod'];
    $sql 		= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario;
	$resultado 	= mysqli_query($db,$sql);
	if(!$resultado){echo mysqli_error($db);	}
	$contador 	= mysqli_num_rows($resultado);
	if ($contador>0)
	{
		while ($lista = mysqli_fetch_array($resultado))
		{	$tipo 	= $lista['id_tipo_usuario'];	}
	}

    $sql = "DELETE FROM usuarios WHERE id_usuario=".$id_usuario;
    $eliminar = mysqli_query($db,$sql);
    if($tipo==2 OR $tipo=="2")
    {
    	$sql 		= "SELECT * FROM ayudantes WHERE id_usuario=".$id_usuario;
		$resultado 	= mysqli_query($db,$sql);
		if(!$resultado){echo mysqli_error($db);	}
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{	$id_ayudante 	= $lista['id_ayudante'];	}

			$sql = "DELETE FROM ayudantes WHERE id_ayudante=".$id_ayudante;
    		$eliminar = mysqli_query($db,$sql);

			$sql = "DELETE FROM ayudante_especialidad WHERE id_ayudante=".$id_ayudante;
    		$eliminar = mysqli_query($db,$sql);

    		$sql = "DELETE FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante;
    		$eliminar = mysqli_query($db,$sql);

    		$sql = "DELETE FROM horarios WHERE id_ayudante=".$id_ayudante;
    		$eliminar = mysqli_query($db,$sql);
		}
    }
}
else
{
	header("location: error.php");
}
?>
