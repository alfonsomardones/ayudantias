<div class="container">
	<!--<form method="POST" action="datos/autenticacion.php">-->
    <div class="form-group">
      <label for="input_usuario">Usuario:</label>
      <input type="text" class="form-control" name="input_usuario" id="input_usuario" placeholder="Ingrese RUT o correo" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_iniciar_sesion()">
    </div>
    <div class="form-group">
      <label for="input_clave">Contraseña:</label>
      <input type="password" class="form-control" name="input_clave" id="input_clave" placeholder="Su contraseña" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_iniciar_sesion()">
    </div>
    <div id="errorIniciarSesion"></div>
    <button type="submit" class="btn btn-primary" onclick="comprobar_iniciar_sesion()">Iniciar</button>
	<!--</form>-->
</div>