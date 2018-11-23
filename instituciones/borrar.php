<?php
if(!isset($_SESSION))
{session_start();}

include('../datos/mensajes.php');
echo '
<div class="modal-header">
	<h5 class="modal-title">BORRAR INSTITUCIÓN</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>';
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		if(isset($_POST['id']))
		{
			echo '
			<div class="modal-body">
				<p class="lead">¿Desea confirmar borrar institución?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="borrarInstitucion('.$_POST['id'].')">BORRAR</button>
				<button type="button" class="btn btn-info" onclick="modalInstitucion(2,'.$_POST['id'].')">ATRÁS</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
			</div>';
		}
		else
		{
			echo '
			<div class="modal-body">
				<p class="lead">'.mensajes(-55).'</p>
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