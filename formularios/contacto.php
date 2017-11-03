<?php
	session_start();
?>
<div class="container">
	<div class="form-group">
		<label for="input_remitente">De:</label>
		<input type="text" class="form-control" name="input_remitente" placeholder="Remitente del mensaje" 
		<?php
			if (isset($_SESSION['correo']))
			{
				echo "value='".$_SESSION['correo']."' disabled>";
			}
			else
			{
				echo 'autocomplete="on" autofocus>';
			}
		?>
	</div>
    <div class="form-group">
      <label for="input_asunto">Asunto:</label>
      <input type="text" class="form-control" name="input_asunto" placeholder="Escriba el motivo del mensaje" autocomplete="on" autofocus>
    </div>
    <div class="form-group">
      <label for="input_mensaje">Mensaje:</label>
      <textarea class="form-control" name="input_mensaje"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>