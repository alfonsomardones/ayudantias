<div class="container">
    <div class="form-group">
      <label for="input_nombre">Carrera:</label>
      <input type="text" class="form-control" name="input_nombre" id="input_nombre" placeholder="Ingrese nombre de Carrera" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_registrar_carrera()">
    </div>
    <div id="errorCarrera"></div>
    <button type="submit" class="btn btn-warning  btn-block" onclick="comprobar_registrar_carrera()">Registrar</button>
</div>