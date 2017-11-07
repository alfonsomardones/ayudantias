<?php
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
  include("../datos/conex.php");
  $sql      = "SELECT * FROM mensajes WHERE id_usuario_envia=".$_SESSION['id_usuario']." OR id_usuario_recibe=".$_SESSION['id_usuario'];
  $resultado    = mysqli_query($db,$sql);
  $contador     = mysqli_num_rows($resultado);
  if($contador>0)
  {
    echo '<div class="container-fluid" id="mensajes">
          <div class="row">';
    echo '<div class="col-md-3" id="menuMensaje">';
    $sql      = "SELECT DISTINCT id_usuario_envia, estado FROM mensajes WHERE id_usuario_envia=".$_SESSION['id_usuario']." OR id_usuario_recibe=".$_SESSION['id_usuario']. " ORDER BY SUBSTRING(fecha, 7) DESC,SUBSTRING(fecha, 4,2) DESC, SUBSTRING(fecha, 1,2) DESC";
    $resultado    = mysqli_query($db,$sql);
    $contador     = mysqli_num_rows($resultado);
    if($contador>0)
    {
      echo '<input type="text" value="0" id="input_id_otro" class="sr-only">';
      while ($lista = mysqli_fetch_array($resultado))
      {
        $id_usuario_envia 	= $lista['id_usuario_envia'];
        $estado 			= $lista['estado'];

        echo '<div class="list-group" id="listaMensajeUsuarios">';
        /*if($id_usuario_envia!=$_SESSION['id_usuario'])
        {
          $sql1 			= "SELECT * FROM usuarios WHERE id_usuario=".$id_usuario_envia;
          $resultado1 		= mysqli_query($db,$sql1);
          $contador1 		= mysqli_num_rows($resultado1);
          if($contador1>0)
          {
            $lista1 = mysqli_fetch_array($resultado1);
            $nombre = $lista1['nombres'];
            if($estado=="Pendiente"){ echo "<strong>";}
            echo '<a href="#" class="list-group-item list-group-item-action" onclick="cambiarUsuario('.$id_usuario_envia.')">'.$nombre.'</a>';
            if($estado=="Pendiente"){ echo "</strong>";}
          }
        }*/
        echo '</div>';
      }
    }
    echo '</div>';
    echo '<div class="col-md-9">
              <div id="contenidoMensaje"><h2>Selecciona algún usuario para conversar.</h2>
              </div>
              <div class="input-group" id="divEnviarMensaje">
                <input type="text" placeholder="Escribe tu mensaje" class="form-control" id="input_mensaje" onkeypress="if (event.keyCode == 13) enviar_mensaje()"><input type="button" value="Enviar" onclick="enviar_mensaje()" class="btn btn-warning" id="btn-enviarMensaje">
              </div>
          </div>
        </div></div>';
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