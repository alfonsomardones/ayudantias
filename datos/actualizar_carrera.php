<?php
if(!isset($_SESSION))
{session_start();}
$e = 0;
if(isset($_SESSION['id_usuario']))
{
    if($_SESSION['tipo_usuario']=="ADMINISTRADOR SUPERIOR")
    {
        if(isset($_POST['id']) && isset($_POST['nombre']))
        {
            include('conexion.php');
            include('validar.php');
            $id             = trim($_POST['id']);
            $nombre        = todoMayuscula(trim($_POST['nombre']));
            if(validarNombre($nombre))
            {
                $sql  = "SELECT * FROM carreras WHERE nombre='".$nombre."' AND id_carrera<>".$id;
                $resultado    = mysqli_query($db,$sql);
                $contador     = mysqli_num_rows($resultado);
                if($contador>0)
                {$e = -60;}
                else
                {
                    $actual = date("Y-m-d H:i:s");
                	$sql = "UPDATE carreras SET nombre='".$nombre."' WHERE id_carrera=".$id;
                    if($actualizar = mysqli_query($db,$sql))
                    { $e = 3; }
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