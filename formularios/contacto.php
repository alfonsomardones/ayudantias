<div class="container">
	<div class="form-group">
		<label for="input_remitente">De:</label>
		<input type="text" class="form-control" id="input_remitente" name="input_remitente" placeholder="Remitente del mensaje" 
		<?php
			session_start();
			if(isset($_SESSION['correo']))
			{	echo "value='".$_SESSION['correo']."' disabled>";	}
			else
			{	echo 'autocomplete="on" autofocus>';	}
		?>
	</div>
	<div class="form-group">
		<label for="input_recibe">Para:</label>
		<select name="input_recibe" id="input_recibe" class="form-control">
		<?php
			include("../datos/conex.php");

			$sql 			= "SELECT * FROM usuarios WHERE id_tipo_usuario=4";
			$resultado 		= mysqli_query($db,$sql);
			$contador 		= mysqli_num_rows($resultado);
			if($contador>0)
			{	
				echo "<optgroup label='Administración Web'>";
				while ($lista = mysqli_fetch_array($resultado))
				{
					$id_usuario = $lista['id_usuario'];
					$nombres	= $lista['nombres'];
					$apellidos	= $lista['apellidos'];
					$nombres	= explode(" ", $nombres);
					$apellidos	= explode(" ", $apellidos);
					$nombre_completo = $nombres[0]." ".$apellidos[0];
					echo "<option value='$id_usuario'>$nombre_completo</option>";
				}
				echo "</optgroup>";
			}
			$sql1 			= "SELECT * FROM administrador_institucion";
			$resultado1 		= mysqli_query($db,$sql1);
			$contador1 		= mysqli_num_rows($resultado1);
			if($contador1>0)
			{	
				while ($lista1 = mysqli_fetch_array($resultado1))
				{
					$id_usuario 	= $lista1['id_usuario'];
					$id_institucion	= $lista1['id_institucion'];

					$sql2 			= "SELECT * FROM instituciones WHERE id_institucion=$id_institucion";
					$resultado2 		= mysqli_query($db,$sql2);
					$contador2 		= mysqli_num_rows($resultado2);
					if($contador2>0)
					{	
						while ($lista2 = mysqli_fetch_array($resultado2))
						{
							$nombre_institucion = $lista2['nombre'];
						}
						echo "<optgroup label='Administración: $nombre_institucion'>";
						$sql3 			= "SELECT * FROM usuarios WHERE id_usuario=$id_usuario AND id_tipo_usuario=3";
						$resultado3 		= mysqli_query($db,$sql3);
						$contador3 		= mysqli_num_rows($resultado3);
						if($contador3>0)
						{	
							while ($lista3 = mysqli_fetch_array($resultado3))
							{
								$nombres 	= $lista3['nombres'];
								$apellidos 	= $lista3['apellidos'];
								$nombres	= explode(" ", $nombres);
								$apellidos	= explode(" ", $apellidos);
								$nombre_completo = $nombres[0]." ".$apellidos[0];
								echo "<option value='$id_usuario'>$nombre_completo</option>";
							}
						}
						echo "</optgroup>";
					}
				}
			}
      ?>
  		</select>
    </div>
    <div class="form-group">
      <label for="input_tipo">Tipo:</label>
      <select name="input_tipo" id="input_tipo" class="form-control">
      	<option value="Sugerencia" selected>Sugerencia</option>
      	<option value="Reclamo">Reclamo</option>
      </select>
    </div>
    <div class="form-group">
      <label for="input_mensaje">Mensaje:</label>
      <textarea class="form-control" name="input_mensaje" id="input_mensaje"></textarea>
    </div>
    <button type="submit" class="btn btn-warning btn-block" onclick="comprobar_mensaje()">Enviar</button>
</div>