<?php
if(!isset($_SESSION))
{session_start();}
$e = 0;
if(isset($_SESSION['id_usuario']))
{
    if($_SESSION['tipo_usuario']=="ADMINISTRADOR SUPERIOR")
    {
        if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['rut']) && isset($_POST['correo']) && isset($_POST['tipo']))
        {
            include('conexion.php');
            include('validar.php');
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

            $clave = '';
            if(isset($_POST['clave']))
            {$clave = $_POST['clave'];}
            else
            {
                // TODO MAYUSCULA NOMBRE1 + 4 DIGITOS DE RUT + APELLIDOS1
                if(strlen($clave)==0)
                {
                    $c1             = explode(' ', $nombres);
                    $c1             = $c1[0];
                    $c2             = substr(str_replace(['.','-'], '', $rut), -4);
                    $c3             = explode(' ', $apellidos);
                    $c3             = $c3[0];
                    $clave          = $c1.''.$c2.''.$c3;
                }
            }
            
            if(validarNombre($nombres) && validarNombre($apellidos) && validarRut($rut) && validarCorreo($correo) && validarTipoUsuario($tipo))
            {
                $sql  = "SELECT rut,correo FROM usuarios WHERE rut='".$rut."' OR correo='".$correo."'";
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
                    $actual = date("Y-m-d H:i:s");
                	$sql = 'INSERT INTO usuarios (nombres, apellidos, rut, fecha_nacimiento, sexo, telefono, correo, clave, id_tipo_usuario, direccion, region, comuna, imagen, estado, fecha_registro)';
                    $sql.= "VALUES ('".$nombres."','".$apellidos."','".$rut."', '".$fecha_nac."', '".$sexo."', '".$telefono."', '".$correo."', '".$clave."',".$tipo.", '".$direccion."', '".$region."', '".$comuna."', '".$img."', '".$estado."', '".$actual."')";
                    if($insertar = mysqli_query($db,$sql))
                    { $e = 2; }
                    else
                    {$e = -102;}
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