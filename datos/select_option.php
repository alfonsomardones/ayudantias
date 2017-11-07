<?php
if(isset($_POST['input_tipo']))
{
	include('conex.php');
	$tipo  		= $_POST['input_tipo'];	
	if($tipo=="instituciones")
	{
		$sql 		= "SELECT * FROM instituciones";
		$resultado 	= mysqli_query($db,$sql);
		if(!$resultado){echo mysqli_error($db);	}
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id 	= $lista['id_institucion'];
				$nombre = $lista['nombre'];
				echo "<option value='$id'>$nombre</option>";
			}
		}
		else
		{
			echo "<option value='0'>NO HAY INSTITUCIONES REGISTRADAS</option>";
		}
	}
	elseif($tipo=="carreras")
	{
		$sql 		= "SELECT * FROM carreras";
		$resultado 	= mysqli_query($db,$sql);
		if(!$resultado){	echo mysqli_error($db);	}
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id 	= $lista['id_carrera'];
				$nombre = $lista['nombre'];
				echo "<option value='$id'>$nombre</option>";
			}
		}
		else
		{
			echo "<option value='0'>NO HAY CARRERAS REGISTRADAS</option>";
		}

	}
	elseif($tipo=="institucion_carrera")
	{
		if(isset($_POST['input_dato']))
		{	
			$dato  		= $_POST['input_dato'];
			$sql 		= "SELECT * FROM institucion_carrera WHERE id_institucion=".$dato;
			$resultado 	= mysqli_query($db,$sql);
			if(!$resultado){	echo mysqli_error($db);		}
			$contador 	= mysqli_num_rows($resultado);
			if ($contador>0)
			{
				while ($lista = mysqli_fetch_array($resultado))
				{
					$id_institucion_carrera = $lista['id_institucion_carrera'];
					$id_carrera 			= $lista['id_carrera'];

					$sql1 		= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera;
					$resultado1 	= mysqli_query($db,$sql1);
					if(!$resultado1){	echo mysqli_error($db);}
					$contador1 	= mysqli_num_rows($resultado1);
					if ($contador1>0)
					{
						while ($lista1 = mysqli_fetch_array($resultado1))
						{
							$nombre 	= $lista1['nombre'];
							echo "<option value='$id_institucion_carrera'>$nombre</option>";
						}
					}
				}
			}
			else
			{
				echo "<option value='0'>NO HAY CARRERA ASOCIADA</option>";
			}
		}
		else
		{ echo "no existe dato"; }
	}
}
else
{
	echo "alert('error')";
    header("location: error.php");
}
?>