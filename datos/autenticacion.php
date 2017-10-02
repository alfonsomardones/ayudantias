<?php
include('conex.php');
session_start();

//obtener datos ingresados
if(isset($_POST['input_usuario']))
{
	$usuario 	= $_POST['input_usuario'];
	$usuario 	= strtolower($usuario);
	$clave 		= $_POST['input_clave'];
	$clave 		= md5($clave);
	//consultar a la BD
	$sql 			= "SELECT * FROM usuarios WHERE correo='$usuario' OR rut='$usuario'";
	$resultado 		= mysqli_query($db,$sql);
	$contador 		= mysqli_num_rows($resultado);
	if($contador>0)
	{
		$lista = mysqli_fetch_array($resultado);
		$correoBD 		= $lista["correo"];
		$rutBD 			= $lista["rut"];
		$claveBD 		= $lista["clave"];
		//si usuario y contraseña son válidos
		if (($usuario==$correoBD && $clave==$claveBD) || ($usuario==$rutBD && $clave==$claveBD))
		{
			$_SESSION['id_usuario'] 		= $lista["id_usuario"];
			$_SESSION['nombres'] 			= $lista["nombres"];
			$_SESSION['apellidos'] 			= $lista["apellidos"];
			$_SESSION['rut'] 				= $lista["rut"];
			$_SESSION['fecha_nacimiento'] 	= $lista["fecha_nacimiento"];
			$_SESSION['telefono'] 			= $lista["telefono"];
			$_SESSION['correo'] 			= $lista["correo"];
			$_SESSION['id_tipo_usuario'] 	= $lista["id_tipo_usuario"];
			$_SESSION['estado'] 			= $lista["estado"];

			$sql 			= "SELECT * FROM tipo_usuarios WHERE id_tipo_usuario=".$_SESSION['id_tipo_usuario'];
			$resultado 		= mysqli_query($db,$sql);
			$contador 		= mysqli_num_rows($resultado);
			if($contador>0)
			{
				$lista = mysqli_fetch_array($resultado);
				$_SESSION['nombre_tipo_usuario'] 		= $lista["nombre"];
				$_SESSION['control_usuarios'] 			= $lista["control_usuarios"];
				$_SESSION['control_instituciones'] 		= $lista["control_instituciones"];
				$_SESSION['control_carreras'] 			= $lista["control_carreras"];
				$_SESSION['control_ayudantes'] 			= $lista["control_ayudantes"];
				if($_SESSION['nombre_tipo_usuario']=="Administrador Institución")
				{
					$sql 			= "SELECT * FROM administrador_institucion WHERE id_usuario=".$_SESSION['id_usuario'];
					$resultado 		= mysqli_query($db,$sql);
					$contador 		= mysqli_num_rows($resultado);
					if($contador>0)
					{
						$lista = mysqli_fetch_array($resultado);
						$_SESSION['id_institucion']	= $lista['id_institucion'];
					}
					else
					{
						echo "Eres Administrador Institución, pero no tienes instituciones asociadas.";
					}
				}
			}
			else
			{
				echo "No tienes definido tu tipo de usuario";
			}
		}
		else
		{
			echo "Los datos no coinciden con ninguno de la Base de Datos";
		}
	}
}
else
{
	header("location: error.php");
}
?>