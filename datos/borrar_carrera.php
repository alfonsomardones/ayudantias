<?php
if(!isset($_SESSION))
{session_start();}
$e = 0;
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=="ADMINISTRADOR SUPERIOR")
	{
		if(isset($_POST['id']))
		{
		    include('conexion.php');
		    $sql 	= "SELECT nombre FROM carreras WHERE id_carrera=".$_POST['id'];
		    $resultado 	= mysqli_query($db,$sql);
			$contador 	= mysqli_num_rows($resultado);
			if($contador==1)
			{
				$sql1 = "DELETE FROM carreras WHERE id_carrera=".$_POST['id'];
				if($eliminar = mysqli_query($db,$sql1))
				{$e = 4;}
				else
				{$e = -107;}
			}
			else
			{$e = -105;}
		}
		else
		{$e = -53;}
	}
	else
	{$e = -52;}
}
else
{$e = -51;}
echo $e;
?>
