<?php
$e = 0;
if(!isset($_SESSION))
{session_start();}

if(isset($_SESSION['id_usuario']))
{$e = 1;}
else
{
	// VERIFICAR SI ENVIARON DATOS
	if(isset($_POST['usuario']) && isset($_POST['clave']))
	{
		include('validar.php');
		$no_valido = array('"',' ',"'");
		$usuario 	= todoMayuscula(str_replace($no_valido, '', trim($_POST['usuario'])));
		$clave 		= str_replace($no_valido, '', trim($_POST['clave']));

		if(strlen($usuario)>0 && strlen($clave)>0)
		{
			$clave = md5($clave);
			include('conexion.php');

			$sql = 'SELECT * FROM usuarios WHERE correo="'.$usuario.'"';
			$resultados = mysqli_query($db, $sql);
			$contador = mysqli_num_rows($resultados);
			if($contador==1)
			{
				$lista = mysqli_fetch_assoc($resultados);

				$id_tipo_usuario = $lista['id_tipo_usuario'];
				$sql2 = 'SELECT * FROM tipos_usuarios WHERE id_tipo_usuario='.$id_tipo_usuario;
				$resultados2 = mysqli_query($db, $sql2);
				$contador2 = mysqli_num_rows($resultados2);
				if($contador2==1)
				{
					$lista2 = mysqli_fetch_assoc($resultados2);
					$tipo_usuario = $lista2['tipo_usuario'];

					if($tipo_usuario == 'ADMINISTRADOR SUPERIOR' || $tipo_usuario == 'ADMINISTRADOR DE INSTITUCIÓN'  || $tipo_usuario == 'SUB-ADMINISTRADOR DE INSTITUCIÓN')
					{
						$claveBD = $lista['clave'];
						if($clave == $claveBD)
						{
							$estado = $lista['estado'];
							if($estado == 'HABILITADO')
							{
								$_SESSION['id_usuario'] = $lista['id_usuario'];
								$nom = $lista['nombres'];
								$nom = explode(' ',$nom);
								$ape = $lista['apellidos'];
								$ape = explode(' ',$ape);
								$_SESSION['nombre'] = $nom[0].' '.$ape[0];
								$_SESSION['sexo'] 	= $lista['sexo'];
								if($lista['imagen']!='')
								{$_SESSION['img'] = $lista['imagen'];}
								else
								{$_SESSION['img'] = 'DEFAULT-'.todoMayuscula($_SESSION['sexo']).'.png';}
								$_SESSION['tipo_usuario'] = $tipo_usuario;
								$e = 1;
							}
							else
							{$e = -50;}
						}
						else
						{$e = -4;}
					}
					else
					{$e = -54;}
				}
				else
				{$e = -106;}
			}
			else
			{$e = -3;}
		}
		else
		{$e = -2;}
	}
	else
	{$e = -52;}
}
echo $e;
?>