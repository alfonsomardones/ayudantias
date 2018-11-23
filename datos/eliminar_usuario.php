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
			$usuario 	= $_POST['id'];
		    include('conexion.php');
		    $sql1 		= "SELECT * FROM usuario WHERE id_usuario=".$usuario;
		    $resultado1 	= mysqli_query($db,$sql1);
			$contador1 	= mysqli_num_rows($resultado1);
			if ($contador1==1)
			{
				$sql1 = "DELETE FROM usuario WHERE id_usuario=".$usuario;
				if($eliminar1 = mysqli_query($db,$sql1))
				{echo 1;	}
				else
				{	echo -4;}
			}
			else
			{	echo -3;	}
		}
		else
		{	echo -2;	}
	}
	else
	{echo -1;}
}
else
{echo 0;}
?>
