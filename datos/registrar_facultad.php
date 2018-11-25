<?php
if(!isset($_SESSION))
{session_start();}
$e = 0;
if(isset($_SESSION['id_usuario']))
{
    if($_SESSION['tipo_usuario']=="ADMINISTRADOR SUPERIOR")
    {
        if(isset($_POST['nombre']))
        {
            include('conexion.php');
            include('validar.php');
            $nombre  = todoMayuscula(trim($_POST['nombre']));
            
            if(validarNombre($nombre))
            {
                $sql  = "SELECT * FROM facultades WHERE nombre='".$nombre."'";
                $resultado    = mysqli_query($db,$sql);
                $contador     = mysqli_num_rows($resultado);
                if($contador>0)
                {$e = -59;}
                else
                {
                    $actual = date("Y-m-d H:i:s");
                	$sql = 'INSERT INTO facultades (nombre, id_usuario,fecha_registro)';
                    $sql.= "VALUES ('".$nombre."', ".$_SESSION['id_usuario'].", '".$actual."')";
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