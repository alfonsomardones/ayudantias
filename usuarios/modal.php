<?php
if(!isset($_SESSION))
{session_start();}

if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		
		echo '
		<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="tituloModalUsuario" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" id="contenidoModalUsuario">
					<div class="modal-header">
						<h5 class="modal-title" id="tituloModalUsuario">USUARIO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>';
	}
}