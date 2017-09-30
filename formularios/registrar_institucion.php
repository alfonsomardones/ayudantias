<div class="container">
    <div class="form-group">
      <label for="input_nombre">Institución:</label>
      <input type="text" class="form-control" name="input_nombre" id="input_nombre" placeholder="Ingrese nombre de Institución" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_registrar_institucion()">
    </div>
    <div id="errorInstitucion"></div>
    <button type="submit" class="btn btn-primary" onclick="comprobar_registrar_institucion()">Registrar</button>
</div>