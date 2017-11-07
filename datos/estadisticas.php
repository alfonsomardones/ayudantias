<?php
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
  if($_SESSION['nombre_tipo_usuario']=="Administrador Máster")
  {
    if(isset($_POST['input_tipo']))
    {
      include("../datos/conex.php");
      $tipo = $_POST['input_tipo'];
      if($tipo==1 || $tipo=="1")
      {
        $año = $_POST['input_año'];
        $sql      = "SELECT * FROM usuarios WHERE año_registro=".$año;
        $resultado    = mysqli_query($db,$sql);
        $contador     = mysqli_num_rows($resultado);
      }
      elseif($tipo==2 || $tipo=="2")
      {
        $año = $_POST['input_año'];
        $mes = $_POST['input_mes'];
        $sql      = "SELECT * FROM usuarios WHERE año_registro=".$año." AND mes_registro=".$mes;
        $resultado    = mysqli_query($db,$sql);
        $contador     = mysqli_num_rows($resultado);
      }
      elseif($tipo==3 || $tipo=="3")
      {
        $año = $_POST['input_año'];
        $mes = $_POST['input_mes'];
        $dia = $_POST['input_dia'];
        $sql      = "SELECT * FROM usuarios WHERE año_registro=".$año." AND mes_registro=".$mes. " AND dia_registro=".$dia;
        $resultado    = mysqli_query($db,$sql);
        $contador     = mysqli_num_rows($resultado);
      }
      elseif($tipo==4 || $tipo=="4")
      {
        $sql      = "SELECT * FROM usuarios WHERE id_tipo_usuario=1";
        $resultado    = mysqli_query($db,$sql);
        $estudiante     = mysqli_num_rows($resultado);
        $sql      = "SELECT * FROM usuarios WHERE id_tipo_usuario=2";
        $resultado    = mysqli_query($db,$sql);
        $ayudante     = mysqli_num_rows($resultado);
        $sql      = "SELECT * FROM usuarios WHERE id_tipo_usuario=3";
        $resultado    = mysqli_query($db,$sql);
        $institucion     = mysqli_num_rows($resultado);
        $sql      = "SELECT * FROM usuarios WHERE id_tipo_usuario=4";
        $resultado    = mysqli_query($db,$sql);
        $master     = mysqli_num_rows($resultado);

        $contador = "Hay ".$estudiante." estudiantes, ".$ayudante." ayudantes, ".$institucion." Administradores de Institución, ".$master." Administradores Máster.";
      }
      echo $contador;
    }
  }
}
else
{
  echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No has iniciado sesión.</strong></div>';
}