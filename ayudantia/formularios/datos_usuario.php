<?php
  include("../datos/conex.php");
  session_start();
  if(!isset($_SESSION['id_usuario']))
  {
  	header ("Location: ./");
  }

  $sql      = "SELECT * FROM usuarios WHERE id_usuario=".$_SESSION['id_usuario'];
  $resultado    = mysqli_query($db,$sql);
  $contador     = mysqli_num_rows($resultado);
  if($contador>0)
  {
    while ($lista = mysqli_fetch_array($resultado))
    {
      $id_usuario       = $lista['id_usuario'];
      $nombres 			    = $lista['nombres'];
      $apellidos      	= $lista['apellidos'];
      $rut            	= $lista['rut'];
      list($dia,$mes,$año)     = explode("-", $lista['fecha_nacimiento']);
      $fecha_nac 		= "$año-$mes-$dia";
      $telefono       	= $lista['telefono'];
      $correo       	  = $lista['correo'];
      $id_tipo_usuario  = $lista['id_tipo_usuario'];
      $estado           = $lista['estado'];
    }
    $sql      = "SELECT * FROM tipo_usuarios WHERE id_tipo_usuario=".$id_tipo_usuario;
    $resultado    = mysqli_query($db,$sql);
    $contador     = mysqli_num_rows($resultado);
    if($contador>0)
    {
      while ($lista = mysqli_fetch_array($resultado))
      {
        $tipo_usuario     = $lista['nombre'];
      }
    }
  }

?>
<div class="container">
    <div class="form-group">
      <input type="text" class="sr-only" name="input_id" id="input_id" value=<?php echo "'".$id_usuario."'"; ?>>
      <input type="text" class="sr-only" name="input_estado" id="input_estado" value=<?php echo "'".$estado."'"; ?>>
      <label for="input_nombres">Nombres:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_nombres" id="input_nombres" value=<?php echo "'".$nombres."'"; ?> disabled>
      </div>
    </div>
    <div id="errorNombres"></div>
    <div class="form-group">
      <label for="input_apellidos">Apellidos:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_apellidos" id="input_apellidos" value=<?php echo "'". $apellidos."'"; ?> disabled>
      </div>
    </div>
    <div id="errorApellidos"></div>
    <div class="form-group">
      <label for="input_rut">RUT:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_rut" id="input_rut" value=<?php echo "'".$rut."'"; ?> disabled>
      </div>
    </div>
    <div id="errorRut"></div>
    <div class="form-group">
      <label for="input_fecha_nac">Fecha Nacimiento:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        <input type="date" class="form-control" name="input_fecha_nac" id="input_fecha_nac" value=<?php echo "'".$fecha_nac."'"; ?>>
      </div>
    </div>
    <div class="form-group">
      <label for="input_telefono">Teléfono:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
        <input type="tel" class="form-control" name="input_telefono" id="input_telefono" placeholder="Ingrese su Teléfono" value=<?php echo "'".$telefono."'"; ?> autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_actualizar_usuario(0)">
      </div>
    </div>
    <div id="errorTelefono"></div>
      <?php
      $sql1      = "SELECT * FROM tipo_usuarios";
      $resultado1    = mysqli_query($db,$sql1);
      $contador1     = mysqli_num_rows($resultado1);
      if($contador1>0)
      {
        echo '<div class="form-group">
          <label for="input_tipo">Tipo de Usuario:</label>
          <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
          <select name="input_tipo" id="input_tipo" class="form-control" disabled>';
        while ($lista1 = mysqli_fetch_array($resultado1))
        {
          $id = $lista1['id_tipo_usuario'];
          $nombre_t  = $lista1['nombre'];
          if($id==$id_tipo_usuario)
          { 
          	echo '<option value="'.$id.'" selected>'.$nombre_t.'</option>';
          }
        }
        echo '</select></div></div>';
      }
      ?>
    <div class="form-group">
      <label for="input_correo">Correo:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="email" class="form-control" name="input_correo" id="input_correo" placeholder="ejemplo@ejemplo.cl" value=<?php echo "'".$correo."'"; ?> autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_actualizar_usuario(0)">
      </div>
    </div>
    <div id="errorCorreo"></div>
    <div class="form-group">
      <label><a href="#">SOLICITAR CAMBIAR CONTRASEÑA</a></label>
    </div>
    <button type="submit" class="btn btn-warning" onclick="comprobar_actualizar_usuario(0)">Actualizar</button>
</div>