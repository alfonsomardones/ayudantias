<?php
	session_start();
?>
<div class="container">
    <div class="form-group">
      <label for="input_nombres">Nombres:</label>
      <input type="text" class="form-control" name="input_nombres" id="input_nombres" placeholder="Ingrese sus Nombres" value=<?php echo "'".$_SESSION['nombres']."'"; ?> autocomplete="on" autofocus>
    </div>
    <div id="errorNombres"></div>
    <div class="form-group">
      <label for="input_apellidos">Apellidos:</label>
      <input type="text" class="form-control" name="input_apellidos" id="input_apellidos" placeholder="Ingrese sus Apellidos" value=<?php echo "'". $_SESSION['apellidos']."'"; ?> autocomplete="on">
    </div>
    <div id="errorApellidos"></div>
    <div class="form-group">
      <label for="input_rut">RUT:</label>
      <input type="text" class="form-control" name="input_rut" id="input_rut" placeholder="12345678-9" value=<?php echo "'".$_SESSION['rut']."'"; ?> autocomplete="on" disabled>
    </div>
    <div id="errorRut"></div>
    <div class="form-group">
      <label for="input_fecha_nac">Fecha Nacimiento:</label>
      <input type="date" class="form-control" name="input_fecha_nac" id="input_fecha_nac" value=<?php echo "'".$_SESSION['fecha_nacimiento']."'"; ?>>
    </div>
    <div class="form-group">
      <label for="input_telefono">Teléfono:</label>
      <input type="tel" class="form-control" name="input_telefono" id="input_telefono" placeholder="Ingrese su Teléfono" value=<?php echo "'".$_SESSION['telefono']."'"; ?> autocomplete="on">
    </div>
    <div id="errorTelefono"></div>
    <div class="form-group">
      <label for="input_correo">Tipo de Usuario:</label>
      <input type="text" class="form-control" name="input_tipo" id="input_tipo" placeholder="Tipo de Usuario" value=<?php echo "'".$_SESSION['nombre_tipo_usuario']."'"; ?> autocomplete="on" disabled>
    </div>
    <div class="form-group">
      <label for="input_correo">Correo:</label>
      <input type="email" class="form-control" name="input_correo" id="input_correo" placeholder="ejemplo@ejemplo.cl" value=<?php echo "'".$_SESSION['correo']."'"; ?> autocomplete="on" >
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
    <div id="errorClave"></div>
    <button type="submit" class="btn btn-primary" onclick="comprobar_actualizar_usuario()">Actualizar</button>
</div>