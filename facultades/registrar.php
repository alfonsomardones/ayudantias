<?php
if(!isset($_SESSION['id_usuario']))
{session_start();}

include('../datos/mensajes.php');
echo '
<div class="modal-header">
	<h5 class="modal-title">REGISTRAR FACULTAD</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>';
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="text" class="form-control" id="nombre" placeholder="NOMBRE" title="NOMBRE" onkeypress="return soloLetras(event)">
						</div>
					</div>
					<div class="col-12" id="infoRegistroFacultad"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-info" onclick="registrarFacultad()" title="REGISTRAR FACULTAD">REGISTRAR</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal" title="CANCELAR">CANCELAR</button>
			
		</div>';
	}
	else
	{
		echo '
	<div class="modal-body">
		<p class="lead">'.mensajes(-52).'</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>
	</div>';
	}
}
else
{
	echo '
	<div class="modal-body">
		<p class="lead">'.mensajes(-51).'</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>
	</div>';
}
echo '</div></div></div>';