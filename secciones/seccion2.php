<div class="container-fluid" id="seccion2">
	<div class="row">
		<div class="col-xs-12 col-md-12" id="contenedorSeccion2">
			<div id="muestraRegistrar">
			<?php

			if(isset($_SESSION['id_usuario']))
			{
				echo "<h1>Bienvenido ".$_SESSION['nombre_apellido']."</h1>";
				echo "<p>En la <strong>barra superior</strong> se<br/>
						encuentra el menú de navegación.</p>";
				if(isset($_SESSION['nombre_tipo_usuario']))
				{
					if($_SESSION['nombre_tipo_usuario']=="Administrador Máster")
					{
						echo "<p>Dale <strong>clic</strong> y verás todo lo que puedes hacer en esta Web.</p>";
					}
					elseif($_SESSION['nombre_tipo_usuario']=="Administrador Institución")
					{
						echo "<p>Dale <strong>clic</strong> y verás todo lo que puedes realizar para tu Institución.</p>";
					}
					else
					{
						echo "<p>Desde aquí puedes actualizar tus datos...<br/>
							te recomendmos que uses la App!!</p><br/>
							<button type='submit' class='btn btn-warning'>Descargar App</button>";
					}
				}
			}
			else
			{
				echo '
				<h1><strong>Registro</strong></h1>
				<p>¿<strong>Necesitas</strong> o <strong>eres</strong> algún ayudante?<br/>Aquí encontrarás lo que buscas!</p>
				<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#ModalSeccion1" onclick="ObtenerModalSeccion1(2)">Registrarme</button>';
			}
			?>
			</div>
		</div>
	</div>
</div>