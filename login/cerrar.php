<?php
if(!isset($_SESSION))
{session_start();}

if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<div class="modal fade" id="modal_cerrar_sesion" tabindex="-1" role="dialog" aria-labelledby="titulo_cerrar_sesion" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="titulo_cerrar_sesion">Confirmar sesión</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<p class="lead">¿Desea cerrar sesión?</p>
					</div>
					<div class="modal-footer">
						<a class="btn btn-info" role="button" href="';
						if($_SERVER['PHP_SELF']=='/hmapp/index.php')
						{echo './datos/cerrar_sesion.php';}
						else
						{echo '../datos/cerrar_sesion.php';}
						echo '">CERRAR SESIÓN</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
					</div>
				</div>
			</div>
		</div>';
	}
}