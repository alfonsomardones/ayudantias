<?php
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
  $id_otro = $_POST['input_id'];
  include("../datos/conex.php");
    $sql      = "SELECT * FROM mensajes WHERE id_usuario_envia=".$_SESSION['id_usuario']." AND id_usuario_recibe=".$id_otro." OR id_usuario_recibe=".$_SESSION['id_usuario']." AND id_usuario_envia=".$id_otro." ORDER BY SUBSTRING(fecha, 7) DESC,SUBSTRING(fecha, 4,2) DESC, SUBSTRING(fecha, 1,2) DESC";
    $resultado    = mysqli_query($db,$sql);
    $contador     = mysqli_num_rows($resultado);
    if($contador>0)
    {
      while ($lista = mysqli_fetch_array($resultado))
      {
        $id_mensaje = $lista['id_mensaje'];
        $fecha = $lista['fecha'];
        $hora = $lista['hora'];
        $id_usuario_envia = $lista['id_usuario_envia'];
        $id_usuario_recibe = $lista['id_usuario_recibe'];
        $mensaje = $lista['mensaje'];
        $estado = $lista['estado'];
        echo $id_mensaje."-".$fecha."-".$hora."-".$id_usuario_envia."-".$id_usuario_recibe."-".$mensaje.$id_mensaje."-".$estado."<br>";
      }
    }
  else
  {
    echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes mensajes.</strong></div>';
  }
}
else
{
  echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No has iniciado sesión.</strong></div>';
}