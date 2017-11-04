<div class="container">
    <div class="form-group">
      <label for="input_usuario">Usuario:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_usuario" id="input_usuario" placeholder="Ingrese RUT o correo" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_iniciar_sesion()">
  	 </div>
    </div>
    <div class="form-group">
      <label for="input_clave">Contraseña:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input type="password" class="form-control" name="input_clave" id="input_clave" placeholder="Su contraseña" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_iniciar_sesion()">
      </div>
    </div>
    <div id="errorIniciarSesion"></div>
    <button type="submit" class="btn btn-warning btn-block" onclick="comprobar_iniciar_sesion()">Iniciar</button>
</div>