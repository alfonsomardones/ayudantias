<div id="divRegistrarUsuario">
<div class="container">
    <div class="form-group">
      <label for="input_nombres">Nombres:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_nombres" id="input_nombres" placeholder="Ingrese sus Nombres" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div id="errorNombres"></div>
    <div class="form-group">
      <label for="input_apellidos">Apellidos:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_apellidos" id="input_apellidos" placeholder="Ingrese sus Apellidos" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div id="errorApellidos"></div>
    <div class="form-group">
      <label for="input_rut">RUT:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" name="input_rut" id="input_rut" placeholder="12345678-9" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div id="errorRut"></div>
    <div class="form-group">
      <label for="input_fecha_nac">Fecha Nacimiento:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        <input type="date" class="form-control" name="input_fecha_nac" id="input_fecha_nac" value="2000-01-01">
      </div>
    </div>
    <div id="errorNacimiento"></div>
    <div class="form-group">
      <label for="input_telefono">Teléfono:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
        <input type="tel" class="form-control" name="input_telefono" id="input_telefono" placeholder="Ingrese su Teléfono" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div id="errorTelefono"></div>
    <?php
    session_start();
    include("../datos/conex.php");
	if(isset($_SESSION['id_usuario']) && $_SESSION['control_usuarios']=='si')
	{
		echo '<div class="form-group">
	  	<label for="input_tipo">Tipo de Usuario:</label>
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
			<select class="form-control" name="input_tipo" id="input_tipo" onchange="listarIntituciones()">';
			$sql 			= "SELECT * FROM tipo_usuarios";
    		$resultado 		= mysqli_query($db,$sql);
    		$contador 		= mysqli_num_rows($resultado);
    		if($contador>0)
    		{
    			while ($lista = mysqli_fetch_array($resultado))
    			{
    				$id_tipo 	= $lista['id_tipo_usuario'];
    				$nombre 	= $lista['nombre'];
    				echo "<option value='$id_tipo'>$nombre</option>";
    			}
    		}
            else
            {
            	echo "<option value='0'>No hay datos.</option>";
            }
			echo '</select></div></div>';
	}
	else
	{
		echo "<div class='form-group'>
      				<label for='input_tipo'>Tipo de Usuario:</label>
              <div class='input-group'>
            <span class='input-group-addon'><span class='glyphicon glyphicon-briefcase'></span></span>
      			<select class='form-control' name='input_tipo' id='input_tipo'>
					<option value='1'>Estudiante</option>
					<option value='2'>Ayudante</option>
				</select></div></div>";
	}
    ?>
    <div id="errorTipoUsuario"></div>
    <div id="divInstituciones"></div>
    <div id="errorInstituciones"></div>
    <div id="divCarreras"></div>
    <div id="errorCarreras"></div>
    <div class="form-group">
      <label for="input_correo">Correo:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="email" class="form-control" name="input_correo" id="input_correo" placeholder="ejemplo@ejemplo.cl" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div id="errorCorreo"></div>
    <div class="form-group">
      <label for="input_clave">Contraseña:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input type="password" class="form-control" name="input_clave" id="input_clave" placeholder="Desde 5 a 20 carácteres" autocomplete="on" onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div class="form-group">
      <label for="input_clave2">Confirmar contraseña:</label>
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input type="password" class="form-control" name="input_clave2" id="input_clave2" placeholder="Confirma tu contraseña" onkeypress="if (event.keyCode == 13) comprobar_registrar_usuario()">
      </div>
    </div>
    <div id="errorClave"></div>
    <button type="submit" class="btn btn-warning btn-block" onclick="comprobar_registrar_usuario()">Registrar</button>
</div>
</div>