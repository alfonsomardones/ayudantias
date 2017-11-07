<?php
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
  $id_otro = $_POST['input_id'];
  include("../datos/conex.php");
    $sql = "SELECT * FROM mensajes WHERE id_usuario_envia=".$_SESSION['id_usuario']." AND id_usuario_recibe=".$id_otro." OR id_usuario_recibe=".$_SESSION['id_usuario']." AND id_usuario_envia=".$id_otro." ORDER BY SUBSTRING(fecha, 7) DESC,SUBSTRING(fecha, 4,2) DESC, SUBSTRING(fecha, 1,2) DESC, hora DESC";
    $resultado    = mysqli_query($db,$sql);
    $contador     = mysqli_num_rows($resultado);
    if($contador>0)
    {
      while ($lista = mysqli_fetch_array($resultado))
      {
        $id_mensaje 		= $lista['id_mensaje'];
        $fecha 				= $lista['fecha'];
        $hora 				= $lista['hora'];
        $id_usuario_envia 	= $lista['id_usuario_envia'];
        $id_usuario_recibe 	= $lista['id_usuario_recibe'];
        $mensaje 			= $lista['mensaje'];
        $estado 			= $lista['estado'];

        $sql1       = "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario_envia;
        $resultado1     = mysqli_query($db,$sql1);
        $contador1    = mysqli_num_rows($resultado1);
        if($contador1>0)
        {
          $lista1 		= mysqli_fetch_array($resultado1);
          $nombres 		= $lista1['nombres'];
          $nombres 		= explode(" ", $nombres);
          $apellidos 	= $lista1['apellidos'];
          $apellidos 	= explode(" ", $apellidos);
        }
        echo "<p><strong>";
        echo "[".$fecha."|".$hora."] ";
        if($id_usuario_envia==$_SESSION['id_usuario'])
        { echo "Tú: ";    }
        else
        { echo $nombres[0]." ".$apellidos[0].": ";}
        echo "</strong>";
        echo $mensaje."</p>";
        $sql = "UPDATE mensajes SET estado='Visto' WHERE id_mensaje=".$id_mensaje." AND estado='Pendiente'";
        $actualizar = mysqli_query($db,$sql);
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