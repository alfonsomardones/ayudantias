<?php
if(!isset($_SESSION))
{session_start();}
$e = 0;
if(isset($_SESSION['id_usuario']))
{
    if($_SESSION['tipo_usuario']=="ADMINISTRADOR SUPERIOR")
    {
        if(isset($_POST['id']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['rut']) && isset($_POST['correo']) && isset($_POST['tipo']))
        {
            include('conexion.php');
            include('validar.php');
            $id             = trim($_POST['id']);
            $nombres        = todoMayuscula(trim($_POST['nombres']));
            $apellidos      = todoMayuscula(trim($_POST['apellidos']));
            $rut            = todoMayuscula(trim($_POST['rut']));
            $fecha_nac      = todoMayuscula(trim($_POST['fecha_nac']));
            if(strlen($fecha_nac)==0)
            {$fecha_nac = '2000-01-01';}

            $sexo = '';
            if(isset($_POST['sexo']))
            {$sexo = todoMayuscula(trim($_POST['sexo']));}

            $telefono = '';
            if(isset($_POST['telefono']))
            {$telefono       = trim($_POST['telefono']);}
        
            $correo         = todoMayuscula(trim($_POST['correo']));
            $tipo           = trim($_POST['tipo']);

            $direccion = '';
            if(isset($_POST['direccion']))
            {$direccion      = todoMayuscula(trim($_POST['direccion']));}

            $region = '';
            if(isset($_POST['region']))
            {$region         = todoMayuscula(trim($_POST['region']));}

            $comuna = '';
            if(isset($_POST['comuna']))
            {$comuna         = todoMayuscula(trim($_POST['comuna']));}
            if(isset($_POST['img']))
            {$img = $_POST['img'];}
            else
            {$img          = '';}

            $estado = 'PENDIENTE';
            if(isset($_POST['estado']))
            {$estado         = todoMayuscula(trim($_POST['estado']));}

            $institucion = '';
            if(isset($_POST['institucion']))
            {$institucion         = trim($_POST['institucion']);}
            $unidad = '';
            if(isset($_POST['unidad']))
            {$unidad         = trim($_POST['unidad']);}


            if(validarNombre($nombres) && validarNombre($apellidos) && validarRut($rut) && validarCorreo($correo) && validarTipoUsuario($tipo))
            {
                $sql  = "SELECT rut,correo FROM usuarios WHERE (rut='".$rut."' AND id_usuario<>".$id.") OR (correo='".$correo."' AND id_usuario<>".$id.")";
                $resultado    = mysqli_query($db,$sql);
                $contador     = mysqli_num_rows($resultado);
                if($contador>0)
                {
                	$lista = mysqli_fetch_array($resultado);
                	$r = $lista["rut"];
                	$c = $lista["correo"];
                	if($r==$rut && $c==$correo)
                	{ $e = -57;}
                	else
                	{
                		if($r==$rut)
                		{ $e = -5; }
                		else
                		{ $e = -6;}
                    }
                }
                else
                {
                    if($tipo==2 || $tipo==3)
                    {
                        if($institucion!='' && $unidad!='')
                        {
                            $actual = date("Y-m-d H:i:s");
                            $sql = "UPDATE usuarios SET nombres='".$nombres."', apellidos='".$apellidos."', rut='".$rut."',fecha_nacimiento='".$fecha_nac."', sexo='".$sexo."', telefono='".$telefono."', correo='".$correo."', id_tipo_usuario=".$tipo.", direccion='".$direccion."', region='".$region."', comuna='".$comuna."',estado='".$estado."' WHERE id_usuario=".$id;
                            if($actualizar = mysqli_query($db,$sql))
                            {
                                $sql = "UPDATE administradores_instituciones SET id_institucion=".$institucion.", id_unidad=".$unidad." WHERE id_usuario=".$id;
                                if($actualizar = mysqli_query($db,$sql))
                                {$e = 3;}
                                else
                                {$e = -102;}
                            }
                            else
                            {$e = -102;}
                        }
                        else
                        {$e = -2;}
                    }
                    else
                    {
                        $actual = date("Y-m-d H:i:s");
                        $sql = "UPDATE usuarios SET nombres='".$nombres."', apellidos='".$apellidos."', rut='".$rut."',fecha_nacimiento='".$fecha_nac."', sexo='".$sexo."', telefono='".$telefono."', correo='".$correo."', id_tipo_usuario=".$tipo.", direccion='".$direccion."', region='".$region."', comuna='".$comuna."',estado='".$estado."' WHERE id_usuario=".$id;
                        if($actualizar = mysqli_query($db,$sql))
                        {$e = 3;}
                        else
                        {$e = -102;}
                    }
                }
            }
            else
            {$e = -56;}
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