<?php
  include("../datos/conex.inc");
  session_start();
  $sql      = "SELECT * FROM usuarios WHERE id_usuario=".$_SESSION['id_usuario'];
  $resultado    = mysqli_query($db,$sql);
  $contador     = mysqli_num_rows($resultado);
  if($contador>0)
  {
    while ($lista = mysqli_fetch_array($resultado))
    {
      $id_usuario     = $lista['id_usuario'];
      $nombres        = $lista['nombres'];
      $apellidos      = $lista['apellidos'];
      $rut            = $lista['rut'];
      $fecha_nac      = $lista['fecha_nacimiento'];
      $telefono       = $lista['telefono'];
      $correo       = $lista['correo'];
      $id_tipo_usuario  = $lista['id_tipo_usuario'];
      $estado       = $lista['estado'];
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
      <label for="input_nombres">Nombres:</label>
      <input type="text" class="form-control" name="input_nombres" id="input_nombres" placeholder="Ingrese sus Nombres" value=<?php echo "'".$nombres."'"; ?> autocomplete="on" autofocus>
    </div>
    <div id="errorNombres"></div>
    <div class="form-group">
      <label for="input_apellidos">Apellidos:</label>
      <input type="text" class="form-control" name="input_apellidos" id="input_apellidos" placeholder="Ingrese sus Apellidos" value=<?php echo "'". $apellidos."'"; ?> autocomplete="on">
    </div>
    <div id="errorApellidos"></div>
    <div class="form-group">
      <label for="input_rut">RUT:</label>
      <input type="text" class="form-control" name="input_rut" id="input_rut" placeholder="12345678-9" value=<?php echo "'".$rut."'"; ?> autocomplete="on" disabled>
    </div>
    <div id="errorRut"></div>
    <div class="form-group">
      <label for="input_fecha_nac">Fecha Nacimiento:</label>
      <input type="date" class="form-control" name="input_fecha_nac" id="input_fecha_nac" value=<?php echo "'".$fecha_nac."'"; ?>>
    </div>
    <div class="form-group">
      <label for="input_telefono">Teléfono:</label>
      <input type="tel" class="form-control" name="input_telefono" id="input_telefono" placeholder="Ingrese su Teléfono" value=<?php echo "'".$telefono."'"; ?> autocomplete="on">
    </div>
    <div id="errorTelefono"></div>
    <div class="form-group">
      <label for="input_correo">Tipo de Usuario:</label>
      <input type="text" class="form-control" name="input_tipo" id="input_tipo" placeholder="Tipo de Usuario" value=<?php echo "'".$tipo_usuario."'"; ?> autocomplete="on" disabled>
    </div>
    <div class="form-group">
      <label for="input_correo">Correo:</label>
      <input type="email" class="form-control" name="input_correo" id="input_correo" placeholder="ejemplo@ejemplo.cl" value=<?php echo "'".$correo."'"; ?> autocomplete="on" >
    </div>
    <div id="errorCorreo"></div>
    <div class="form-group">
      <label for="input_clave">Nueva Contraseña:</label>
      <input type="password" class="form-control" name="input_clave" id="input_clave" placeholder="Desde 5 a 20 carácteres" autocomplete="on">
    </div>
    <div class="form-group">
      <label for="input_clave2">Confirmar contraseña:</label>
      <input type="password" class="form-control" name="input_clave2" id="input_clave2" placeholder="Confirma tu contraseña">
    </div>
    <input type="text" class="sr-only" name="input_estado" id="input_estado" value=<?php echo "'".$estado."'"; ?>>
    <div id="errorClave"></div>
    <button type="submit" class="btn btn-primary" onclick="comprobar_actualizar_usuario(0)">Actualizar</button>
</div>