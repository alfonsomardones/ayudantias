<?php
if(!isset($_SESSION))
{session_start();}
if(!isset($_SESSION['id_usuario']))
{
    if(isset($_GET['id']) && isset($_GET['pass']))
    {
        include('../datos/conexion.php');
        include('../datos/validar.php');

        $id          = trim($_GET['id']);
        $pass        = trim($_GET['pass']);
        if(validarNumero($id) && strlen($pass)>10)
        {
            echo '
            <!DOCTYPE html>
            <html lang="es">
                <head>
                    <title>HelpMeApp - Activación</title>
                    <link rel="shortcut icon" href="../img/logos/favicon.ico" type="image/x-icon">
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <!-- VERSIÓN MOVIL -->
                    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <!-- COLOR DE LA BARRA -->
                    <meta name="theme-color" content="#2FC4D0" />
                    <!-- ESTILOS -->';
                    
                    include('../secciones/estilos.php');
                    

                echo '</head>
                <body>';
                    include('../secciones/barra_navegacion.php');
                    echo '
                    <div class="container-fluid">
                        <div class="row titulo-seccion">
                            <div class="col-12 ">
                                <h1>ACTIVAR CUENTA</h1>
                            </div>
                        </div>
                        <div class="row contenido-seccion"><div class="col-0 col-md-4"></div><div class="col-12 col-md-4">';
                        $sql  = "SELECT nombres, apellidos, correo, rut,fecha_registro,estado FROM usuarios WHERE id_usuario=".$id;
                        $resultado    = mysqli_query($db,$sql);
                        $contador     = mysqli_num_rows($resultado);
                        if($contador==1)
                        {
                            $lista      = mysqli_fetch_array($resultado);
                            $estado      = $lista['estado'];

                            if($estado=='PENDIENTE')
                            {
                                $nombres    = $lista['nombres'];
                                $nom        = explode(' ', $nom);
                                $nom        = $nom[0];
                                $apellidos  = $lista['apellidos'];
                                $rut        = $lista['rut'];
                                $correo     = $lista['correo'];
                                $fecha      = $lista['fecha_registro'];

                                // CLAVE = RUT + NOMBRE1 + CORREO + fecha registro
                                $clave = $rut.''.$correo.''.$fecha;
                                $clave = md5($clave);

                                if($clave == $pass)
                                {
                                    $sql = "UPDATE usuarios SET estado='HABILITADO' WHERE id_usuario=".$id;
                                    if($actualizar = mysqli_query($db,$sql))
                                    {
                                        echo '<h1>ACTIVACIÓN REALIZADA CON ÉXITO</h1><p class="lead">Inicie sesión desde la aplicación</p>';
                                    }
                                    else
                                    {echo '<h1>ERROR EN ACTIVACIÓN</h1><p class="lead">Error en la base de datos, contacte a un administrador.</p>';}
                                }
                                else
                                {echo '<h1>ERROR EN ACTIVACIÓN</h1><p class="lead">Las contraseña no coincide, contacte a un administrador.</p>';}
                            }
                            else
                            {echo '<h1>USUARIO ACTIVADO</h1><p class="lead">Este usuario ya se encuentra activado, para comprobar inicie sesión desde la aplicación.</p>';}
                        }
                        else
                        {echo '<h1>USUARIO NO ENCONTRADO</h1><p class="lead">Puede ser que no se haya registrado o exista algún otro error, por favor contacte a un administrador.</p>';}
                        echo '</div></div></div>';
                    include('../secciones/desarrollo.php');
                    echo '<!-- JAVASCRIPT -->';
                    include('../secciones/javascript.php');
                echo '
                </body>
            </html>
            ';
        }
        else
        {header ("Location: ../");}
    }
    else
    {header ("Location: ../");}
}
else
{header ("Location: ../");}
?>